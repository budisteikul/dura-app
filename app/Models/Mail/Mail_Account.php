<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Mail_Account extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'mail_accounts';
	public $incrementing = false;
	protected $fillable = ['user_id','name','email','notify'];
	protected $dates = ['deleted_at'];
	
	public function users()
    {
        return $this->belongsTo('App\User');
    }
}
