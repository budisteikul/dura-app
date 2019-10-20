<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Mail_Option extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'mail_options';
	public $incrementing = false;
	protected $fillable = ['user_id','name','value'];
	protected $dates = ['deleted_at'];
	
	public function users()
    {
        return $this->belongsTo('App\User');
    }
}
