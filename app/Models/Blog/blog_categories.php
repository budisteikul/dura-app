<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class blog_categories extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'blog_categories';
	public $incrementing = false;
	
	public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
	
	public function posts()
    {
        return $this->belongsToMany('App\Models\Blog\blog_posts','blog_categories_posts', 'category_id', 'post_id');
    }
}
