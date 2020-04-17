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

class BlogController extends Controller
{
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
		
		$bookingChannelUUID = '93a137f0-bb95-4ea0-b4a8-9857824a2e79';
		$rev_resellers = rev_resellers::where('status',1)->first();
		if(isset($rev_resellers)) $bookingChannelUUID = $rev_resellers->id;
		if(env("BOKUN_WIDGET")=="classic")
		{
			if(env("APP_ENV")=="production")
			{
				$calendar = '<div id="bokun-w111662_1caddfc1_76b8_499c_959f_fcb6d96159df">Loading...</div><script type="text/javascript">
var w111662_1caddfc1_76b8_499c_959f_fcb6d96159df;
(function(d, t) {
  var host = \'widgets.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/111662?bookingChannelUUID='.$bookingChannelUUID.'&amp;activityId='.$contents->id.'&amp;lang=en&amp;ccy=USD&amp;hash=w111662_1caddfc1_76b8_499c_959f_fcb6d96159df\';
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
  var frameUrl = \'https://\' + host + \'/widgets/2531?bookingChannelUUID='.$bookingChannelUUID.'&amp;activityId='.$contents->id.'&amp;lang=en&amp;ccy=USD&amp;hash=w2531_c2173ff7_b853_4e16_a1a0_4b636370d50c\';
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
		}
		else
		{
			if(env("APP_ENV")=="production")
			{
				$calendar = '<div class="bokunWidget" data-src="https://widgets.bokun.io/online-sales/'.$bookingChannelUUID.'/experience-calendar/'.$contents->id.'"></div><noscript>Please enable javascript in your browser to book</noscript>';
			}
			else
			{
				$calendar = '<div class="bokunWidget" data-src="https://widgets.bokuntest.com/online-sales/'.$bookingChannelUUID.'/experience-calendar/'.$contents->id.'"></div><noscript>Please enable javascript in your browser to book</noscript>';	
			}
		}
        return view('blog.frontend.vt-product-page')->with(['contents'=>$contents,'pickup'=>$pickup,'calendar'=>$calendar]);
    }
	
	public function vt_product_list($id)
	{
		$contents = BokunClass::get_product_list_byid($id);
		return view('blog.frontend.vt-product-list')->with(['contents'=>$contents]);
	}
	
	public function vertikaltrip()
	{
		$count = rev_reviews::count();
		return view('blog.frontend.vertikaltrip')->with(['count'=>$count]);
	}


	public function jogjafoodtour()
    {
		$count = rev_reviews::count();
        return view('blog.frontend.foodtour')->with(['count'=>$count]);
    }

    public function shinjukufoodtour()
    {
        return view('blog.frontend.shinjukufoodtour');
    }
    
}
