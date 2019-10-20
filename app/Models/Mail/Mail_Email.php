<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Mail_Email extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'mail_emails';
	public $incrementing = false;
	protected $fillable = ['user_id','recipient','sender','from','subject','body_plain','stripped_text','stripped_signature','body_html','stripped_html','attachment_count','attachment_x','timestamp','signature','message_headers','content_id_map','read','folder'];
	protected $dates = ['deleted_at'];
	
	public function users()
    {
        return $this->belongsTo('App\User');
    }
	
	public function mail_attachments()
	{
		return $this->hasMany('App\Models\Mail\Mail_Attachment','email_id');
	}
}
