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
	protected $keyType = 'string';
	
	public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
	
    public function attachments()
    {
        return $this->hasMany('App\Models\Blog\blog_attachments','post_id');
    }
	
	public function categories()
    {
        return $this->belongsToMany('App\Models\Blog\blog_categories','blog_categories_posts', 'post_id', 'category_id');
    }
	
}

