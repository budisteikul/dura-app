<?php

namespace App\Models\Rev;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class rev_widgets extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'rev_widgets';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function posts()
    {
        return $this->belongsTo('App\Models\Blog\blog_posts','id');
    }
}
