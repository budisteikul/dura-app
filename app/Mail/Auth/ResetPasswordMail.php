<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use Illuminate\Support\Facades\URL;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token,$email)
    {
		$this->email = $email;
		$this->user = \App\User::where('email',$this->email)->first();
		$this->action_url = route('password.reset',[ 'token' => $token ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('layouts.mail.reset-password')
                    ->text('layouts.mail.reset-password_plain')
				    ->to($this->user->email)
				    ->subject('Reset Password Notification')
				    ->with('action_url',$this->action_url)
					->with('name',$this->user->name);
    }
}
