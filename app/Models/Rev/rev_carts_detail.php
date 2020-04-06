<?php

namespace App\Models\Rev;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class rev_carts_detail extends Model
{
    use Uuid;
	
	protected $table = 'rev_carts_detail';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function carts()
    {
        return $this->belongsTo('App\Models\Rev\rev_carts');
    }
}
