<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use App\Classes\Blog\BlogClass;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use App\Models\settings;
use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$ipcamera = settings::where('name','ipcamera')->first()->value;
        $state = settings::where('name','lightbulb')->first()->value;
        if($state=="off")
        {
            $button = '<button id="btn-edit" type="button" onClick="TOGGLE(); return false;" class="btn btn-block btn-danger">OFF</button>';
        }
        else
        {
            $button = '<button id="btn-edit" type="button" onClick="TOGGLE(); return false;" class="btn btn-block btn-success">ON</button>';
        }
		return view('home')->with(['ipcamera'=>$ipcamera,'button'=>$button]);
    }

    public function toggle(Request $request)
    {
        $settings = settings::where('name','lightbulb')->first();
        if($settings->value=="off")
        {
            Storage::put('state.txt', 'on');
            $settings->value = "on";
            shell_exec('sudo -u www-data python /home/pi/smarthome/gpio/gpio.py 17 high');
            $button = '<button id="btn-edit" type="button" onClick="TOGGLE(); return false;" class="btn btn-block btn-success">ON</button>';
        }
        else
        {
            Storage::put('state.txt', 'off');
            $settings->value = "off";
            shell_exec('sudo -u www-data python /home/pi/smarthome/gpio/gpio.py 17 low');
            $button = '<button id="btn-edit" type="button" onClick="TOGGLE(); return false;" class="btn btn-block btn-danger">OFF</button>';
        }
        $settings->save();
        return response()->json([
                'id' => '1', 'message' => $button
            ]);
    }

    public function on()
    {
        $settings = settings::where('name','lightbulb')->first();
        
        $settings->value = "on";
        shell_exec('sudo -u www-data python /home/pi/smarthome/gpio/gpio.py 18 high');

        $settings->save();
        return response()->json([
                'id' => '1'
            ]);
    }

    public function off()
    {
        $settings = settings::where('name','lightbulb')->first();
        
        $settings->value = "off";
        shell_exec('sudo -u www-data python /home/pi/smarthome/gpio/gpio.py 18 low');

        $settings->save();
        return response()->json([
                'id' => '1'
            ]);
    }
}
