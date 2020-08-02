<?php
namespace App\Classes\Home\Relay;

class Tasmota {
	public static function switch($ip,$action,$username,$password){
		$success = true;
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
        $client = new \GuzzleHttp\Client(['headers' => $headers,'exceptions' => false, 'timeout' => 3, 'connect_timeout' => 3 ]);
		$url = "http://". $ip ."/cm".$cmdn.$auth;
		
		print($url);	
		try {
  			$request = $client->get($url);
		} catch(\GuzzleHttp\Exception\GuzzleException $e) {
  			$success = false;
		}
		return $success;
	}
}
?>