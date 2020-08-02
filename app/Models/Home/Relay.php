<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Relay extends Model
{
    use Uuid;
	//use SoftDeletes;
	
	protected $table = 'home_relay';
	public $incrementing = false;
	protected $keyType = 'string';
}
