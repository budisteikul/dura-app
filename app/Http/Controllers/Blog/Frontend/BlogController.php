<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rev\rev_availability;
use App\Models\Blog\blog_posts;
use App\Models\Blog\blog_categories;
use App\Models\Rev\rev_reviews;
use App\Models\Rev\rev_resellers;
use App\Classes\Rev\BokunClass;
use Illuminate\Support\Facades\Request as Http;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use GuzzleHttp\Client as GuzzleClient;
Use Str;
Use Session;

class BlogController extends Controller
{
	public function product_list_byslug($slug="",$id="")
	{
		$contents = BokunClass::get_product_list_byid($id);
		return view('blog.frontend.vt-product-list')->with(['contents'=>$contents]);
	}
	
	public function product_page_byslug($id="")
    {
		$contents = BokunClass::get_productbyslug($id);
		
		$pickup = '';
        if($contents->meetingType=='PICK_UP' || $contents->meetingType=='MEET_ON_LOCATION_OR_PICK_UP')
        {
			$pickup = BokunClass::get_product_pickup($contents->id);
        }
		
		if(Session::has('sessionId')){
			$sessionId = \Session::get('sessionId');
		}else{
			$sessionId = \Ramsey\Uuid\Uuid::uuid4()->toString();
			\Session::put('sessionId',$sessionId);
		}
		$bookingChannelUUID = rev_resellers::where('status',1)->first()->id;
		
		$availability = \App\Classes\Rev\BokunClass::get_availabilityactivity($contents->id,1);
		$first = '[{"date":'. $availability[0]->date .',"localizedDate":"'. $availability[0]->localizedDate .'","availabilities":';
		$middle = json_encode($availability);
		$last = '}]';
		$firstavailability = $first.$middle.$last;
		
		$microtime = $availability[0]->date;
		$month = date("n",$microtime/1000);
		$year = date("Y",$microtime/1000);
        return view('blog.frontend.vt-product-page')->with(['contents'=>$contents,'pickup'=>$pickup,'sessionId'=>$sessionId,'bookingChannelUUID'=>$bookingChannelUUID,'firstavailability'=>$firstavailability,'year'=>$year,'month'=>$month]);
	}
	
	public function product_page_byid(Request $request)
    {
        $id = $request->input('activityId');
        $contents = BokunClass::get_product($id);
        $pickup = '';
        if($contents->meetingType=='PICK_UP' || $contents->meetingType=='MEET_ON_LOCATION_OR_PICK_UP')
        {
			$pickup = BokunClass::get_product_pickup($id);
        }
		
		
		$availability = \App\Classes\Rev\BokunClass::get_availabilityactivity($contents->id,1);
		$first = '[{"date":'. $availability[0]->date .',"localizedDate":"'. $availability[0]->localizedDate .'","availabilities":';
		$middle = json_encode($availability);
		$last = '}]';
		$availability = $first.$middle.$last;
		
		$microtime = $availability[0]->date;
		$month = date("n",$microtime/1000);
		$year = date("Y",$microtime/1000);
        return view('blog.frontend.vt-product-page')->with(['contents'=>$contents,'pickup'=>$pickup,'sessionId'=>$sessionId,'bookingChannelUUID'=>$bookingChannelUUID,'firstavailability'=>$firstavailability,'year'=>$year,'month'=>$month]);
    }
	
	public function product_list_byid($id)
	{
		$contents = BokunClass::get_product_list_byid($id);
		if(Session::has('sessionId')){
			$sessionId = \Session::get('sessionId');
		}else{
			$sessionId = \Ramsey\Uuid\Uuid::uuid4()->toString();
			\Session::put('sessionId',$sessionId);
		}
		$bookingChannelUUID = rev_resellers::where('status',1)->first()->id;
		return redirect("/tours/". Str::slug($contents->title) ."/". $contents->id);
	}
	
	public function sitemap()
	{
		$product_lists = BokunClass::get_product_list_byid(env('BOKUN_NAVBAR'));
		foreach($product_lists->children as $line1)
		{
			echo url('/tours/'. Str::slug($line1->title).'/'.$line1->id) .'
';
			$contents = BokunClass::get_product_list_byid($line1->id);
			foreach($contents->items as $content)
			{
						if(isset($content->activity->slug))
                        {
                        	$link = '/tour/'. $content->activity->slug;
                        }
                        else
                        {
                        	$link = '/tour?activityId='. $content->activity->id;
                        }
						echo url($link) .'
';
			}
					
			if(!empty($line1->children))
			{
				foreach($line1->children as $line2)
				{
					echo url('/tours/'. Str::slug($line2->title).'/'.$line2->id) .'
';
					$contents = BokunClass::get_product_list_byid($line2->id);
					foreach($contents->items as $content)
					{
						if(isset($content->activity->slug))
                        {
                        	$link = '/tour/'. $content->activity->slug;
                        }
                        else
                        {
                        	$link = '/tour?activityId='. $content->activity->id;
                        }
						echo url($link) .'
';
					}
				}
			}
			
		}
	}
	
	public function vertikaltrip()
	{
		$count = rev_reviews::count();
		return view('blog.frontend.vertikaltrip')->with(['count'=>$count]);
	}
	
	public function foodtours()
	{
		$productArray = array("27690", "27698", "27684");
		$count = rev_reviews::count();
		return view('blog.frontend.foodtours')->with(['count'=>$count,'productArray'=>$productArray]);
	}


	public function jogjafoodtour()
    {
		$count = rev_reviews::count();
        return view('blog.frontend.jogjafoodtour')->with(['count'=>$count]);
    }

    public function shinjukufoodtour()
    {
        return view('blog.frontend.shinjukufoodtour');
    }
    
}
