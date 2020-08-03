<?php
namespace App\Classes\Home\Relay;
use App\Models\Home\Relay;
use Storage;
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
		$phpopen = '<?php 
		';

		$phpfile = '';

		$relays = Relay::where('type','gpio')->get();
		foreach($relays as $relay)
		{
			
			$phpfile .= '$file = file_get_contents(\'/home/pi/smarthome/storage/app/relay/'. $relay->id .'\', true);
					if($file=="off")
					{
							print("off");
							shell_exec(\'sudo -u www-data python /home/pi/smarthome/gpio/gpio.py '. $relay->ipOrGpio .' low\');
					}
					else
					{
							print("on");
							shell_exec(\'sudo -u www-data python /home/pi/smarthome/gpio/gpio.py '. $relay->ipOrGpio .' high\');
					}
					';
		}
		

		$phpclose = ' 
		?>';

		$phpfile = $phpopen . $phpfile . $phpclose;

		Storage::put('last_state.php', $phpfile);
		return $success;
	}
}
?>