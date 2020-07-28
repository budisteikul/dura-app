<?php
$file = file_get_contents('/home/pi/smarthome/storage/app/state.txt', true);

if($file=="off")
{
	print("off");
	shell_exec('sudo -u www-data python /home/pi/smarthome/gpio/relay17_off.py');
}
else
{
	print("on");
	shell_exec('sudo -u www-data python /home/pi/smarthome/gpio/relay17_on.py');
}
shell_exec('sudo -u www-data python /home/pi/smarthome/gpio/relay18_on.py');
?>
