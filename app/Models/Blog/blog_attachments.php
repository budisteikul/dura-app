<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class blog_attachments extends Model
{
	use Uuid;
	use SoftDeletes;
	
	protected $table = 'blog_attachments';
    public $incrementing = false;
	protected $keyType = 'string';
	
    public function posts()
    {
        return $this->belongsTo('App\Models\Blog\blog_posts','id');
    }
}

