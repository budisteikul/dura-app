<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use App\Classes\Blog\BlogClass;
use Illuminate\Support\Facades\Auth;

use App\DataTables\LightbulbDataTable;
use Illuminate\Support\Facades\Validator;

use App\Models\settings;

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
            $settings->value = "on";
        }
        else
        {
            $settings->value = "off";
        }
        $settings->save();
        return response()->json([
                'id' => '1', 'message' => 'sukses'
            ]);
    }
}
