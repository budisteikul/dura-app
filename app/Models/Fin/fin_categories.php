<?php

namespace App\Models\Fin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class fin_categories extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'fin_categories';
	public $incrementing = false;
	
	public function transactions()
    {
        return $this->hasMany('App\Models\Fin\fin_transactions','category_id','id');
    }
}
