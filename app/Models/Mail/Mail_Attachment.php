<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Mail_Attachment extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'mail_attachments';
	public $incrementing = false;
	protected $fillable = ['email_id','file_path','file_url','file_name','file_mimetype','file_size'];
	protected $dates = ['deleted_at'];
	
	public function mail_emails()
    {
        return $this->belongsTo('App\Models\Mail\Mail_Email','id');
    }
}
