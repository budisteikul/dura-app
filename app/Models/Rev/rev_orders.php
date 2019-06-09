<?php

namespace App\Models\Rev;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class rev_orders extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'rev_orders';
	public $incrementing = false;
}
