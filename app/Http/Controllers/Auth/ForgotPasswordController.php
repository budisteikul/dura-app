<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
	
	public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
	
	public function sendResetLinkEmail(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'email' => 'required|email',
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$check = User::where('email',$request->input('email'))->first();
		if(!@count($check))
		{
			return response()->json([
    		'email' => "We can't find a user with that e-mail address."
		]);
		}
		
		$response = $this->broker()->sendResetLink(
            $request->only('email')
        );
		return response()->json([
    		'id' => '1',
    		'message' => 'We have e-mailed your password reset link!'
		]);
	}
	
	
	/**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }
	
}
