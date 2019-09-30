<?php

namespace App\Models\SMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class sms extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'sms';
	public $incrementing = false;
}
