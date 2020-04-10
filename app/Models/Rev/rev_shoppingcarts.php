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
	
	public function shoppingcart_products()
    {
        return $this->hasMany('App\Models\Rev\rev_shoppingcart_products','shoppingcarts_id','id');
    }
	
	public function shoppingcart_questions()
    {
        return $this->hasMany('App\Models\Rev\rev_shoppingcart_questions','shoppingcarts_id','id');
    }
	
	
}
