<?php
namespace App\Classes\Home\Relay;
use App\Models\Home\Relay as RelayModel;
use App\Classes\Home\Relay\Tasmota;
use App\Classes\Home\Relay\GPIO;
use Storage;

class Relay {
	public static function action($id,$action=""){

		$relay = RelayModel::findOrFail($id);
		if($action=="")
		{
			if($relay->state=="on")
			{
				$action = "off";
			}
			else
			{
				$action = "on";
			}
		}

		if($relay->type=="tasmota")
		{
			$status = Tasmota::switch($relay->ipOrGpio,$action,$relay->username,$relay->password);
		}
		else
		{
			$status = GPIO::switch($relay->ipOrGpio,$action);
		}
		if($status)
		{
			$relay->state = $action;
			$relay->save();
			Storage::put('relay/'. $relay->id, $action);
		}
		return $status;
	}
}
?>