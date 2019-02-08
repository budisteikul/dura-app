<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class blog_tmp extends Model
{
	use Uuid;
	
	protected $table = 'blog_tmp';
    public $incrementing = false;
	
	public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
   
}
