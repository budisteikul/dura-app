<?php
$file = file_get_contents('/home/pi/smarthome/storage/app/state.txt', true);
if($file=="off")
{
	print("off");
	shell_exec('sudo -u www-data python /home/pi/smarthome/gpio/gpio.py 17 low');
}
else
{
	print("on");
	shell_exec('sudo -u www-data python /home/pi/smarthome/gpio/gpio.py 17 high');
}
shell_exec('sudo -u www-data python /home/pi/smarthome/gpio/gpio.py 18 high');
?>
