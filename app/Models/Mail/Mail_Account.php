<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Mail_Account extends Model
{
    use Uuid;
	
	protected $table = 'mail_accounts';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function users()
    {
        return $this->belongsTo('App\User');
    }
}
