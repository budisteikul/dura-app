<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use App\Classes\Blog\BlogClass;
use Illuminate\Support\Facades\Auth;


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
		//BlogClass::setConf('domain',preg_replace('#^https?://#', '', Request::root()),Auth::user()->id);
        return redirect('/blog/photo');
		//return view('home');
    }
}
