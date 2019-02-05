<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use Illuminate\Support\Facades\URL;

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
		$this->action_url = URL::temporarySignedRoute(
            'verification.verify', now()->addMinutes(60), ['id' => $user->getKey()]
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
