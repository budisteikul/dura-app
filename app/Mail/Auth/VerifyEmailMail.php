<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
		/*
		$this->action_url = URL::temporarySignedRoute(
            'verification.verify', now()->addMinutes(60), ['id' => $user->getKey()]
        );
		*/
		$this->action_url = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );
	}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		
        return $this->view('layouts.mail.verify-email')
                    ->text('layouts.mail.verify-email_plain')
				    ->to($this->user->email)
				    ->subject('Verify your email address')
				    ->with('action_url',$this->action_url);
    }
}
