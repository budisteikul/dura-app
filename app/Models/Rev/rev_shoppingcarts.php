<?php

namespace App\Models\Rev;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class rev_shoppingcarts extends Model
{
    use Uuid;
	
	protected $table = 'rev_shoppingcarts';
	public $incrementing = false;
	protected $keyType = 'string';
}
