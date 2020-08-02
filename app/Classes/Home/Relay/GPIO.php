<?php
namespace App\Classes\Home\Relay;

class GPIO {
	public static function switch($gpio,$action){
		$success = true;
		if($action=="on")
		{
			$cmdn = "high";
		}
		else
		{
			$cmdn = "low";
		}

		shell_exec('sudo -u www-data python /home/pi/smarthome/gpio/gpio.py '. $gpio.' '. $cmdn);
		return $success;
	}
}
?>