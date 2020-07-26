<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use App\Classes\Blog\BlogClass;
use Illuminate\Support\Facades\Auth;

use App\DataTables\LightbulbDatatable;
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
    public function index(LightbulbDataTable $dataTable)
    {
		$ipcamera = settings::where('name','ipcamera')->first()->value;
        return $dataTable->render('home',compact('ipcamera'));
		//return view('home')->with(['ipcamera'=>$ipcamera]);
    }

    public function toggle(Request $request)
    {
        $settings = settings::where('name','lightbulb')->first();
        if($settings->value=="off")
        {
            Storage::put('state.txt', 'on');
            $settings->value = "on";
            shell_exec('sudo -u www-data python /home/pi/gpio/relay17_on.py');
        }
        else
        {
            Storage::put('state.txt', 'off');
            $settings->value = "off";
            shell_exec('sudo -u www-data python /home/pi/gpio/relay17_off.py');
        }
        $settings->save();
        return response()->json([
                'id' => '1', 'message' => 'sukses'
            ]);
    }
}
