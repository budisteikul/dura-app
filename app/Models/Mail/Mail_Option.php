<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Mail_Option extends Model
{
    use Uuid;
	
	protected $table = 'mail_options';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function users()
    {
        return $this->belongsTo('App\User');
    }
}
