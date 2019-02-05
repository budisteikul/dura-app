<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\Auth\ResetPasswordNotifications;
use App\Traits\Uuid;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
	use Uuid;
	
	public $incrementing = false;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function sendPasswordResetNotification($token)
	{
    	$this->notify(new ResetPasswordNotifications($token,request()->input('email')));
	}
	
	
	// =======================================================================================
	
	public function mail_accounts()
    {
        return $this->hasMany('App\Models\Mail\Mail_Account');
    }
	
	public function mail_options()
    {
        return $this->hasMany('App\Models\Mail\Mail_Option');
    }
	
	public function mail_emails()
    {
        return $this->hasMany('App\Models\Mail\Mail_Email');
    }
		
	// =======================================================================================
}
