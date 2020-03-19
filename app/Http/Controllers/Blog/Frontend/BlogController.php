<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rev\rev_availability;
use App\Models\Blog\blog_posts;
use App\Models\Blog\blog_categories;
use App\Models\Rev\rev_widgets;
use App\Models\Rev\rev_reviews;
use App\Classes\Rev\BokunClass;
use Illuminate\Support\Facades\Request as Http;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use GuzzleHttp\Client as GuzzleClient;

class BlogController extends Controller
{
	/**
     * Instantiate a new UserController instance.
     */
    public function __construct()
	{
		
	}
	
  

  public function vt_product_page(Request $request,$id="")
    {
        $activityId = "355686";
        if($id=="")
        {
            $post = rev_widgets::with('posts')->where('product_id', $request->input('activityId'))->first();
            if(isset($post)) return redirect('/tour/'. $post->posts->slug .'/');
            $activityId = $request->input('activityId');
        }
        else
        {
            $post = blog_posts::with('widgets')->where('slug',$id)->first();
            if(isset($post))
            {
                $activityId = $post->widgets->product_id;
            }
        }
		
        $contents = BokunClass::get_product($activityId);
        
        $pickup = '';
        if($contents->meetingType=='PICK_UP' || $contents->meetingType=='MEET_ON_LOCATION_OR_PICK_UP')
        {
			$pickup = BokunClass::get_product_pickup($activityId);
        }

        $calendar = '
				<script type="text/javascript" src="https://widgets.bokun.io/assets/javascripts/apps/build/BokunWidgetsLoader.js?bookingChannelUUID=27a58f40-93e3-4305-b54e-6679758958de" async></script>
     
    <div class="bokunWidget" data-src="https://widgets.bokun.io/online-sales/27a58f40-93e3-4305-b54e-6679758958de/experience-calendar/'.$contents->id.'"></div>
    <noscript>Please enable javascript in your browser to book</noscript>
				';
				
        $widget = rev_widgets::where('product_id',$activityId)->first();
        if(isset($widget)){
			if(isset($widget->time_selector)){
               $calendar = $widget->time_selector;
            }
        }

        return view('blog.frontend.vt-product-page')->with(['contents'=>$contents,'pickup'=>$pickup,'calendar'=>$calendar]);
    }
	
	public function vt_product_list(Request $request,$id="")
	{
		
		$default_id = '25594';
		if($id=="")
		{
			$id = $default_id;
		}
		else
		{
			$cat = blog_categories::where('slug',$id)->first();
			if(isset($cat))
			{
				$id = $cat->description;
			}
			
		}
		$contents = BokunClass::get_product_list($id);
		return view('blog.frontend.vt-product-list')->with(['contents'=>$contents]);
	}
	
	public function vertikaltrip(Request $request,$id="")
	{
		$default_id = '25594';
		if($id=="")
		{
			$id = $default_id;
		}
		else
		{
			$cat = blog_categories::where('slug',$id)->first();
			if(isset($cat))
			{
				$id = $cat->description;
			}
			else
			{
				$id = $default_id;
			}
		}
		$contents = BokunClass::get_product_list($id);
		$count = rev_reviews::count();
		return view('blog.frontend.vertikaltrip')->with(['contents'=>$contents,'count'=>$count]);
	}


	public function index()
    {
		$count = rev_reviews::count();
        return view('blog.frontend.foodtour')
		->with('count',$count);
    }

    public function shinjukufoodtour()
    {
        return view('blog.frontend.shinjukufoodtour');
    }
    
}
