<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class blog_posts extends Model
{
	use Uuid;
	
	protected $table = 'blog_posts';
	public $incrementing = false;
	
	public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
	
    public function attachments()
    {
        return $this->hasMany('App\Models\Blog\blog_attachments','post_id');
    }
	
}

