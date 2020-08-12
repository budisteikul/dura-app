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
		//return redirect('/home/relay');
        return view('home');
    }
}
