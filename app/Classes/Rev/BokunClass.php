<?php
namespace App\Classes\Rev;
use Illuminate\Support\Str;
use App\Models\Rev\rev_resellers;
use Cache;

class BokunClass {
	
	public static function get_widget($product_id="")
	{
		if($product_id=="")
		{
			header("Location: /");
			exit();	
		}
		
		$widget_hash = env("BOKUN_WIDGET_HASH");
		$widget_id = explode("_",$widget_hash);
		$widget_id = str_ireplace("w","",$widget_id[0]);
		
		$bookingChannelUUID = rev_resellers::where('status',1)->first()->id;
		
		if(env("BOKUN_WIDGET")=="classic")
		{
			$calendar = '<div id="bokun-'.$widget_hash.'">Loading...</div><script type="text/javascript">
var '.$widget_hash.';
(function(d, t) {
  var host = \'widgets.bokun.io\';
  var frameUrl = \'https://\' + host + \'/widgets/'.$widget_id.'?bookingChannelUUID='.$bookingChannelUUID.'&amp;activityId='.$product_id.'&amp;lang=en&amp;ccy=USD&amp;hash='.$widget_hash.'\';
  var s = d.createElement(t), options = {\'host\': host, \'frameUrl\': frameUrl, \'widgetHash\':\''.$widget_hash.'\', \'autoResize\':true,\'height\':\'\',\'width\':\'100%\', \'minHeight\': 0,\'async\':true, \'ssl\':true, \'affiliateTrackingCode\': \'\', \'transientSession\': true, \'cookieLifetime\': 43200 };
  s.src = \'https://\' + host + \'/assets/javascripts/widgets/embedder.js\';
  s.onload = s.onreadystatechange = function() {
    var rs = this.readyState; if (rs) if (rs != \'complete\') if (rs != \'loaded\') return;
    try {
      '.$widget_hash.' = new BokunWidgetEmbedder(); '.$widget_hash.'.initialize(options); '.$widget_hash.'.display();
    } catch (e) {}
  };
  var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, \'script\');
</script>';
		}
		else
		{
			$calendar = '<div class="bokunWidget" data-src="https://widgets.bokun.io/online-sales/'.$bookingChannelUUID.'/experience-calendar/'.$product_id.'"></div><noscript>Please enable javascript in your browser to book</noscript>';
		}
		
		return $calendar;
	}
	
	public static function get_connect($path,$method = 'GET',$accept = 'application/json')
	{
		if(env("BOKUN_ENV")=="production")
		{
			$endpoint = "https://api.bokun.io";
		}
		else
		{
			$endpoint = "https://api.bokuntest.com";
		}
        $currency = 'USD';
        $lang = "EN";
        $query = '?currency='.$currency.'&lang='.$lang;
        $date = gmdate('Y-m-d H:i:s');
        $bokun_accesskey = env("BOKUN_ACCESSKEY");
        $bokun_secretkey = env("BOKUN_SECRETKEY");
		
		$string_signature = $date.$bokun_accesskey.$method. $path .$query;
        $sha1_signature =  hash_hmac("sha1",$string_signature, $bokun_secretkey, true);
        $base64_signature = base64_encode($sha1_signature);
    
        $headers = [
          'Accept' => $accept,
          'X-Bokun-AccessKey' => $bokun_accesskey,
          'X-Bokun-Date' => $date,
          'X-Bokun-Signature' => $base64_signature,
        ];
    
        //$client = new \GuzzleHttp\Client(['headers' => $headers]);
    	//$response = $client->request($method, $endpoint.$path.$query);
        //$statusCode = $response->getStatusCode();   
		
		
		
		$client = new \GuzzleHttp\Client(['headers' => $headers,'exceptions' => false]);
		$response = $client->request($method, $endpoint.$path.$query);
		$statusCode = $response->getStatusCode(); 
		if(200 === $statusCode)
		{
			if($accept=='application/json')
			{
        		$contents = json_decode($response->getBody()->getContents());
			}
			else
			{
				$contents = $response->getBody()->getContents();
			}
			return $contents;
		}
		else if(400 === $statusCode)
		{
			return "400";
		}
		else
		{
			//print_r($response);
			header("Location: /");
			exit();
		}
	}
	
	public static function get_product($activityId)
	{
		$value = Cache::store('database')->remember('bokunProductbyid_'. $activityId, 86400, function() use ($activityId) {
    		return self::get_connect('/activity.json/'. $activityId);
		});
		return $value;
	}
	
	public static function get_productbyslug($slug)
	{
		$value = Cache::store('database')->remember('bokunProductbyslug_'. $slug, 86400, function() use ($slug) {
    		return self::get_connect('/activity.json/slug/'. $slug);
		});
		return $value;
	}
	
	public static function get_product_pickup($activityId)
	{
		$value = Cache::store('database')->remember('bokunProductpickup_'. $activityId, 86400, function() use ($activityId) {
    		return self::get_connect('/activity.json/'. $activityId .'/pickup-places');
		});
		return $value;
	}
	
	public static function get_product_list_byid($id)
	{
		$value = Cache::store('database')->remember('bokunProductlistbyid_'. $id, 86400, function() use ($id) {
    		return self::get_connect('/product-list.json/'. $id);
		});
		return $value;
	}
	
	public static function get_product_list()
	{
		$value = Cache::store('database')->remember('bokunProductlist', 86400, function() {
    		return self::get_connect('/product-list.json/list');
		});
		return $value;
	}
	
	public static function get_questionshoppingcart($id)
	{
		return self::get_connect('/question.json/shopping-cart/'.$id);
	}
	
	public static function get_questionbooking($id)
	{
		return self::get_connect('/question.json/activity-booking/'.$id);
	}
	
	public static function get_activeids()
	{
		$value = Cache::store('database')->remember('bokunActiveids', 86400, function() {
    		return self::get_connect('/activity.json/active-ids');
		});
		return $value;
	}
	
	public static function get_country()
	{
		$value = Cache::store('database')->remember('bokunCountry', 86400, function() {
    		return self::get_connect('/country.json/findAll');
		});
		return $value;
	}
	
	public static function get_checkout($sessionId)
	{
		return self::get_connect('/checkout.json/options/shopping-cart/'. $sessionId);
	}
	
	public static function get_shoppingcart($sessionId)
	{
		return self::get_connect('/shopping-cart.json/session/'. $sessionId);
	}
	
	public static function get_ticket($confirmationCode)
	{
		return self::get_connect('/booking.json/activity-booking/'.$confirmationCode.'/ticket','GET','application/pdf');
	}
	
	public static function get_invoice($id)
	{
		return self::get_connect('/booking.json/'. $id .'/summary','GET','application/pdf');
	}
	
	public static function get_productbooking($id)
	{
		return self::get_connect('/booking.json/activity-booking/'.$id);
	}
	
	public static function get_removeshoppingcart($sessionId,$id)
	{
		return self::get_connect('/shopping-cart.json/session/'.$sessionId.'/remove-activity/'.$id);
	}
	
	public static function get_removepromocode($sessionId)
	{
		return self::get_connect('/cart.json/'.$sessionId.'/remove-promo-code');
	}
	
	public static function get_applypromocode($sessionId,$id)
	{
		$id = strtolower($id);
		return self::get_connect('/cart.json/'.$sessionId.'/apply-promo-code/'.$id);
	}
	
	public static function get_availabilities($id,$start,$end)
	{
		return self::get_connect('/activity.json/'.$id.'/availabilities?start='.$start.'&end='.$end.'&lang=EN&currency=USD&includeSoldOut=false');
	}
	
	public static function get_removeactivity($sessionId,$id)
	{
		return self::get_connect('/shopping-cart.json/session/'.$sessionId.'/remove-activity/'. $id);
	}
	
}
?>