<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class blog_settings extends Model
{
	use Uuid;
	
	protected $table = 'blog_settings';
    protected $primaryKey = 'id';
	
	public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
