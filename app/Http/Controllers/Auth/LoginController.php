<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Request as Http;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	public function showLoginForm()
	{
		return view('auth.login');
	}
	
	public function login(Request $request)
    {
		$validator = Validator::make($request->all(), [
          	'email' => 'required',
        	'password' => 'required',
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$email = $request->input('email');
		$password = $request->input('password');
		$remember = $request->input('remember');
		$remember = ($remember == "true" ? true : false);
		
		$url = $request->input('url');
		$url = "/";

		if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
    		return response()->json([
    			'id' => '1',
    			'message' => $url
			]);
		}
		
		return response()->json([
    		'email' => "These credentials do not match our records."
		]);
	
    }
	
}
