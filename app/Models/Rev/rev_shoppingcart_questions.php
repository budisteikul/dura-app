<?php

namespace App\Models\Rev;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class rev_shoppingcart_questions extends Model
{
    use Uuid;
	protected $table = 'rev_shoppingcart_questions';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function shoppingcarts()
    {
        return $this->belongsTo('App\Models\Rev\rev_shoppingcarts','shoppingcarts_id','id');
    }
	
}
