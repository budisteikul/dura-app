<?php

namespace App\Models\Rev;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class rev_shoppingcart_question_options extends Model
{
    use Uuid;
	protected $table = 'rev_shoppingcart_question_options';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function shoppingcart_questions()
    {
        return $this->belongsTo('App\Models\Rev\rev_shoppingcart_questions','shoppingcart_questions_id','id');
    }
}
