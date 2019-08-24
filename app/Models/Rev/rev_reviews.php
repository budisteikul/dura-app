<?php

namespace App\Models\Rev;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class rev_reviews extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'rev_reviews';
	public $incrementing = false;
}