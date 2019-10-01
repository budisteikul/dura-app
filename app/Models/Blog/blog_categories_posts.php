<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class blog_categories_posts extends Model
{
    use Uuid;
	use SoftDeletes;
	
	protected $table = 'blog_categories_posts';
	public $incrementing = false;
	protected $keyType = 'string';
	
	public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
	
	public function posts()
    {
        return $this->belongsTo('App\Models\Blog\blog_posts','post_id');
    }
	
	public function categories()
    {
        return $this->belongsTo('App\Models\Blog\blog_categories','category_id');
    }
}
