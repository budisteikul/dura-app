<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class blog_posts extends Model
{
	use Uuid;
	use SoftDeletes;
	
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

