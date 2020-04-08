<?php

namespace App\Models\Rev;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class rev_carts extends Model
{
    use Uuid;
	
	protected $table = 'rev_carts';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function carts_detail()
    {
        return $this->hasMany('App\Models\Rev\rev_carts_detail','cart_id');
    }
	
	public function carts_question()
    {
        return $this->hasMany('App\Models\Rev\rev_carts_question','cart_id');
    }
}
