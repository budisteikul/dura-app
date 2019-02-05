<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class blog_attachments extends Model
{
	use Uuid;
	
	protected $table = 'blog_attachments';
    public $incrementing = false;
	
	
    public function posts()
    {
        return $this->belongsTo('App\Models\Blog\blog_posts','id');
    }
}

