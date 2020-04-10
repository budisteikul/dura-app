<?php

namespace App\Models\Rev;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class rev_shoppingcart_products extends Model
{
    use Uuid;
	protected $table = 'rev_shoppingcart_products';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function shoppingcarts()
    {
        return $this->belongsTo('App\Models\Rev\rev_shoppingcarts');
    }
	
	public function shoppingcart_rates()
    {
        return $this->hasMany('App\Models\Rev\rev_shoppingcart_rates','shoppingcart_products_id');
    }
	
}
