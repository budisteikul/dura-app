<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use Illuminate\Support\Facades\URL;

class ChangeEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token,$new_email,$id)
    {
        $this->new_email = $new_email;
		$this->user = \App\User::find($id);
		$this->action_url = route('profiles.index',[ 'id' => $id, 'setting' => 'verification', 'token' => $token ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		
        return $this->view('layouts.mail.change-email')
                    ->text('layouts.mail.change-email_plain')
				    ->to($this->new_email)
				    ->subject('Change Email Confirmation')
				    ->with('action_url',$this->action_url)
					->with('name',$this->user->name);
    }
}
