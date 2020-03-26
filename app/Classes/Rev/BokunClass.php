<?php
namespace App\Classes\Rev;
use Illuminate\Support\Str;

class BokunClass {
	
	
	public static function get_connect($path,$method = 'GET',$accept = 'application/json')
	{
		$endpoint = "https://api.bokun.io";
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
          'Accept' => $accept,
          'X-Bokun-AccessKey' => $bokun_accesskey,
          'X-Bokun-Date' => $date,
          'X-Bokun-Signature' => $base64_signature,
        ];
    
        //$client = new \GuzzleHttp\Client(['headers' => $headers]);
    	//$response = $client->request($method, $endpoint.$path.$query);
        //$statusCode = $response->getStatusCode();   
		
		
		try {
			$client = new \GuzzleHttp\Client(['headers' => $headers]);
    		$response = $client->request($method, $endpoint.$path.$query);
        	$statusCode = $response->getStatusCode();   
		}
		catch (\GuzzleHttp\Exception\ClientException $e) {
			header("Location: /");
			exit();
		}
		
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
	
	public static function get_product($activityId)
	{
		return self::get_connect('/activity.json/'. $activityId);
	}
	
	public static function get_product_pickup($activityId)
	{
		return self::get_connect('/activity.json/'. $activityId .'/pickup-places');
	}
	
	public static function get_product_list_byid($id)
	{
		return self::get_connect('/product-list.json/'. $id);
	}
	
	public static function get_product_list()
	{
		return self::get_connect('/product-list.json/list');
	}
	
	public static function get_shopping_cart($sessionId)
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
	
	
}
?>