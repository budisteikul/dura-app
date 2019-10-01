<?php

namespace App\Models\Fin;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

use Illuminate\Database\Eloquent\Model;

class fin_transactions extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'fin_transactions';
	public $incrementing = false;
	
	
	public function categories()
    {
        return $this->belongsTo('App\Models\Fin\fin_categories','id');
    }
	
}
