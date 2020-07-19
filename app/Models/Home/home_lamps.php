<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class home_lamps extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'home_lamps';
	public $incrementing = false;
	protected $keyType = 'string';
}
