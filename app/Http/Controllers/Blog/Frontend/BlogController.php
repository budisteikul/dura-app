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

class BlogController extends Controller
{
	public function product_list($slug="",$id="")
	{
		$contents = BokunClass::get_product_list_byid($id);
		return view('blog.frontend.vt-product-list')->with(['contents'=>$contents]);
	}
	
	public function product_page($slug="",$id="")
    {
		$contents = BokunClass::get_product($id);
		$pickup = '';
        if($contents->meetingType=='PICK_UP' || $contents->meetingType=='MEET_ON_LOCATION_OR_PICK_UP')
        {
			$pickup = BokunClass::get_product_pickup($id);
        }
		$calendar = BokunClass::get_widget($contents->id);
        return view('blog.frontend.vt-product-page')->with(['contents'=>$contents,'pickup'=>$pickup,'calendar'=>$calendar]);
	}
	
	public function vt_product_page(Request $request,$id="")
    {
        $post = blog_posts::where('slug',$id)->first();
        if(isset($post))
        {
            $id = $post->product_id;
        }
		else
		{
			$id = $request->input('activityId');
			$blog_posts = blog_posts::where('product_id',$id)->first();
			if(isset($blog_posts))
			{
				return redirect('/tour/'. $blog_posts->slug );
			}
		}
        $contents = BokunClass::get_product($id);
        $pickup = '';
        if($contents->meetingType=='PICK_UP' || $contents->meetingType=='MEET_ON_LOCATION_OR_PICK_UP')
        {
			$pickup = BokunClass::get_product_pickup($id);
        }
		$calendar = BokunClass::get_widget($contents->id);
        return view('blog.frontend.vt-product-page')->with(['contents'=>$contents,'pickup'=>$pickup,'calendar'=>$calendar]);
    }
	
	public function vt_product_list($id)
	{
		$contents = BokunClass::get_product_list_byid($id);
		return redirect("/activities/". Str::slug($contents->title) ."/". $contents->id);
		//return view('blog.frontend.vt-product-list')->with(['contents'=>$contents]);
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
