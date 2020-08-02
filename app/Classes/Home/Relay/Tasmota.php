<?php
namespace App\Classes\Home\Relay;

class Tasmota {
	public static function switch($ip,$action,$username,$password){
		$auth = '';
		if($username!='' && $password!='')
		{
			$auth = "&user=".$username."&password=".$password;
		}

		$cmdn = '?cmnd=Power%20On';
		if($action=="off")
		{
			$cmdn = '?cmnd=Power%20Off';
		}

		$headers = [
                		'Accept' => 'application/json',
            		];
        $client = new \GuzzleHttp\Client(['headers' => $headers,'exceptions' => false]);
		$url = "http://". $ip ."/cm".$cmdn.$auth;
		$request = $client->get($url);
		return $request;
	}
}
?>