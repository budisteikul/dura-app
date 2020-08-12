<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Products extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'products';
	public $incrementing = false;
	protected $keyType = 'string';
}
