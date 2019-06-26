<?php

namespace App\Models\Rev;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class rev_availability extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'rev_availability';
	public $incrementing = false;
}
