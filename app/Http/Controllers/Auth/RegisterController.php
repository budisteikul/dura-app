<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Notifications\Auth\VerifyEmailNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }
	
	public function showRegistrationForm()
    {
        return view('auth.register');
    }
	
	public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
          	'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
$validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}

		$name =  $request->input('name');
		$email =  $request->input('email');
		$password =  $request->input('password');
		
		
		$user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
		
		Auth::login($user);
		
		$user->notify(new VerifyEmailNotifications($user));
   		//Mail::send(new VerifyEmail($user));
		
		
       	return response()->json([
    		'id' => '1',
    		'message' => route('verification.notice')
		]);
    }
	
}
