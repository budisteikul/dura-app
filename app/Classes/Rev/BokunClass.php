<?php
namespace App\Classes\Rev;
use Illuminate\Support\Str;

class BokunClass {
	
	
	public static function get_connect($path)
	{
		$endpoint = "https://api.bokun.io";
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
    
        
		try {
			$client = new \GuzzleHttp\Client(['headers' => $headers]);
    		$response = $client->request($method, $endpoint.$path.$query);
        	$statusCode = $response->getStatusCode();   
		}
		catch (\GuzzleHttp\Exception\ClientException $e) {
    		header("Location: /");
			exit();
		}
        $contents = json_decode($response->getBody()->getContents());
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
	
	public static function get_product_list($id)
	{
		return self::get_connect('/product-list.json/'. $id);
	}
	
}
?>