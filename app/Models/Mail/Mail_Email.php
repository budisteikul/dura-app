<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Mail_Email extends Model
{
    use Uuid;
	
	protected $table = 'mail_emails';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function users()
    {
        return $this->belongsTo('App\User');
    }
	
	public function mail_attachments()
	{
		return $this->hasMany('App\Models\Mail\Mail_Attachment','email_id');
	}
}
