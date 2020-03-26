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
        $activityId = "";
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

		
		if(env("APP_ENV")=="production")
		{
			$calendar = '<div id="bokun-w111662_1caddfc1_76b8_499c_959f_fcb6d96159df">Loading...</div><script type="text/javascript">
var w111662_1caddfc1_76b8_499c_959f_fcb6d96159df;
(function(d, t) {
  var host = \'widgets.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/111662?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79&amp;activityId='.$contents->id.'&amp;lang=en&amp;ccy=USD&amp;hash=w111662_1caddfc1_76b8_499c_959f_fcb6d96159df\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w111662_1caddfc1_76b8_499c_959f_fcb6d96159df\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w111662_1caddfc1_76b8_499c_959f_fcb6d96159df = new BokunWidgetEmbedder(); w111662_1caddfc1_76b8_499c_959f_fcb6d96159df.initialize(options); w111662_1caddfc1_76b8_499c_959f_fcb6d96159df.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
		}
		else
		{
			$calendar = '<div id="bokun-w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c">Loading...</div><script type="text/javascript">
var w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c;
(function(d, t) {
  var host = \'widgets.bokuntest.com\';
  var frameUrl = \'https://\' + host + \'/widgets/2531?bookingChannelUUID=bfaa0f13-9831-4e68-866b-f5dab49b7ff4&amp;activityId='.$contents->id.'&amp;lang=en&amp;ccy=USD&amp;hash=w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c = new BokunWidgetEmbedder(); w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c.initialize(options); w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
		}
		
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
		$contents = BokunClass::get_product_list();
		foreach($contents as $content)
		{
			$default_id = $content->id;
		}
		
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
		$contents = BokunClass::get_product_list_byid($id);
		return view('blog.frontend.vt-product-list')->with(['contents'=>$contents]);
	}
	
	public function vertikaltrip($id="")
	{
		$contents = BokunClass::get_product_list();
		foreach($contents as $content)
		{
			$id = $content->id;
		}
		$contents = BokunClass::get_product_list_byid($id);
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
