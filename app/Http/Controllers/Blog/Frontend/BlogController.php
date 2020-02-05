<?php

namespace App\Http\Controllers\Blog\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rev\rev_availability;
use App\Models\Blog\blog_posts;
use App\Models\Blog\blog_categories;
use App\Models\Rev\rev_widgets;
use App\Models\Rev\rev_reviews;
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
        $activityId = "284167";
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
        
        
        $endpoint = "https://api.bokun.io";
        $path = '/activity.json/'. $activityId;
        $method = 'GET';
        $currency = 'USD';
        $lang = "EN";
        $query = '?currency='.$currency.'&lang='.$lang;
        $date = gmdate('Y-m-d H:i:s');
        $bokun_accesskey = env("BOKUN_ACCESSKEY", "");
        $bokun_secretkey = env("BOKUN_SECRETKEY", "");
    
        $string_signature = $date.$bokun_accesskey.$method. $path .$query;
        $sha1_signature =  hash_hmac("sha1",$string_signature, $bokun_secretkey, true);
        $base64_signature = base64_encode($sha1_signature);
    
        $headers = [
          'Accept' => 'application/json',
          'X-Bokun-AccessKey' => $bokun_accesskey,
          'X-Bokun-Date' => $date,
          'X-Bokun-Signature' => $base64_signature,
        ];
    
        $client = new \GuzzleHttp\Client(['headers' => $headers]);
        $response = $client->request($method, $endpoint.$path.$query);
        $statusCode = $response->getStatusCode();
        $contents = json_decode($response->getBody()->getContents());
        
        $pickup = '';
        if($contents->meetingType=='PICK_UP' || $contents->meetingType=='MEET_ON_LOCATION_OR_PICK_UP')
        {
			$endpoint = "https://api.bokun.io";
			$path = '/activity.json/'. $activityId .'/pickup-places';
			$method = 'GET';
			$currency = 'USD';
			$lang = "EN";
			$query = '?currency='.$currency.'&lang='.$lang;
			$date = gmdate('Y-m-d H:i:s');
			$bokun_accesskey = env("BOKUN_ACCESSKEY", "");
			$bokun_secretkey = env("BOKUN_SECRETKEY", "");
    
			$string_signature = $date.$bokun_accesskey.$method. $path .$query;
			$sha1_signature =  hash_hmac("sha1",$string_signature, $bokun_secretkey, true);
			$base64_signature = base64_encode($sha1_signature);
    
			$headers = [
				'Accept' => 'application/json',
				'X-Bokun-AccessKey' => $bokun_accesskey,
				'X-Bokun-Date' => $date,
				'X-Bokun-Signature' => $base64_signature,
			];
    
			$client = new \GuzzleHttp\Client(['headers' => $headers]);
			$response = $client->request($method, $endpoint.$path.$query);
			$statusCode = $response->getStatusCode();
			$pickup = json_decode($response->getBody()->getContents());

        }

        $calendar = '
				<script type="text/javascript" src="https://widgets.bokun.io/assets/javascripts/apps/build/BokunWidgetsLoader.js?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79" async></script>
				<div class="bokunWidget" data-src="https://widgets.bokun.io/online-sales/93a137f0-bb95-4ea0-b4a8-9857824a2e79/experience-calendar/'.$contents->id.'"></div>
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
		$default_id = '20041';

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
    

		$endpoint = "https://api.bokun.io";
		$path = '/product-list.json/'. $id;
		$method = 'GET';
		$currency = 'USD';
		$lang = "EN";
		$query = '?currency='.$currency.'&lang='.$lang;
		$date = gmdate('Y-m-d H:i:s');
		$bokun_accesskey = env("BOKUN_ACCESSKEY", "");
		$bokun_secretkey = env("BOKUN_SECRETKEY", "");
		
		$string_signature = $date.$bokun_accesskey.$method. $path .$query;
		$sha1_signature =  hash_hmac("sha1",$string_signature, $bokun_secretkey, true);
		$base64_signature = base64_encode($sha1_signature);
		$headers = [
			'Accept' => 'application/json',
			'X-Bokun-AccessKey' => $bokun_accesskey,
			'X-Bokun-Date' => $date,
			'X-Bokun-Signature' => $base64_signature,
		];
		$client = new \GuzzleHttp\Client(['headers' => $headers]);
		$response = $client->request($method, $endpoint.$path.$query);

		$statusCode = $response->getStatusCode();
		$contents = json_decode($response->getBody()->getContents());
		
		$count = rev_reviews::count();
		return view('blog.frontend.vt-product-list')->with(['contents'=>$contents,'count'=>$count]);
	}

    

    
	public function time_selector($id)
	{
		$render = '';
		$widget = blog_posts::with('widgets')->where('slug',$id)->first();
        if(isset($widget)){
			if(isset($widget->widgets->time_selector)){
               $render = $widget->widgets->time_selector;
            }
        }
		return view('blog.frontend.booking')->with(['product'=>$render]);
	}
	

    public function checkout()
    {
        $render = '<div id="bokun-w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa">Loading...</div><script type="text/javascript">
var w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa;
(function(d, t) {
  var host = \'vertikaltrip.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/97537?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79&amp;lang=en&amp;ccy=USD&amp;hash=w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa = new BokunWidgetEmbedder(); w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa.initialize(options); w97537_4f330d47_9b9e_4a0e_95f9_db234e2046aa.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
        return view('blog.frontend.booking')->with(['product'=>$render]);
    }

    public function receipt()
    {
        $render = '<div id="bokun-w97536_f6820178_ae16_4095_b0ec_4c203e94f898">Loading...</div><script type="text/javascript">
var w97536_f6820178_ae16_4095_b0ec_4c203e94f898;
(function(d, t) {
  var host = \'vertikaltrip.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/97536?bookingChannelUUID=93a137f0-bb95-4ea0-b4a8-9857824a2e79&amp;lang=en&amp;ccy=USD&amp;hash=w97536_f6820178_ae16_4095_b0ec_4c203e94f898\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\'w97536_f6820178_ae16_4095_b0ec_4c203e94f898\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      w97536_f6820178_ae16_4095_b0ec_4c203e94f898 = new BokunWidgetEmbedder(); w97536_f6820178_ae16_4095_b0ec_4c203e94f898.initialize(options); w97536_f6820178_ae16_4095_b0ec_4c203e94f898.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
        return view('blog.frontend.booking')->with(['product'=>$render]);
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
