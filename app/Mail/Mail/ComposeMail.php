<?php

namespace App\Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use App\Models\Mail\Mail_Email;
use App\Models\Mail\Mail_Attachment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ComposeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from_name,$from_email,$mail_to,$mail_subject,$mail_body_html,$mail_body_plain,$mail_attachments,$mail_old_attachments="")
    {
        $this->from_name = $from_name;
		$this->from_email = $from_email;
		$this->mail_to = $mail_to;
		$this->mail_subject = $mail_subject;
		$this->mail_body_html = $mail_body_html;
		$this->mail_body_plain = $mail_body_plain;
		$this->mail_attachments = $mail_attachments;
		$this->mail_old_attachments = $mail_old_attachments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$mail_compose = $this->view('layouts.mail.compose');
		$mail_compose->text('layouts.mail.compose_plain');
		$mail_compose->to($this->mail_to);
		$mail_compose->from($this->from_email, $this->from_name);
		$mail_compose->subject($this->mail_subject);
		$mail_compose->with('mail_body_html',$this->mail_body_html);
		$mail_compose->with('mail_body_plain',$this->mail_body_plain);
		
		if(@count($this->mail_attachments)>0)
		{
			foreach($this->mail_attachments as $mail_attachment)
            {
				$mail_attachment_name = $mail_attachment->getClientOriginalName();
				$mail_attachment_mimetype = $mail_attachment->getClientMimeType();
				$mail_attachment_path = $mail_attachment->getRealPath();
				$mail_compose->attach($mail_attachment_path,[
                        'as' => $mail_attachment_name,
                        'mime' => $mail_attachment_mimetype,
                    ]);
			}
		}
		
		if(@count($this->mail_old_attachments)>0)
			{
				foreach($this->mail_old_attachments as $mail_old_attachment)
            	{
					$mail_old_attachment_ = Mail_Attachment::find($mail_old_attachment);
					$path = "../storage/logs/". $mail_old_attachment;
					$mail_compose->attach($path,[
                        'as' => $mail_old_attachment_->file_name,
                        'mime' => $mail_old_attachment_->file_mimetype,
                    ]);
				}
				
			}
			
        return $mail_compose;
    }
}
