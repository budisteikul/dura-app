<?php

namespace App\Models\Rev;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class rev_shoppingcart_rates extends Model
{
    use Uuid;
	protected $table = 'rev_shoppingcart_rates';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function shoppingcart_products()
    {
        return $this->belongsTo('App\Models\Rev\rev_shoppingcart_products','shoppingcart_products_id','id');
    }
	
	public function shoppingcarts()
    {
        return $this->belongsTo('App\Models\Rev\rev_shoppingcarts','shoppingcarts_id','id');
    }
}
