<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class blog_tmp extends Model
{
	use Uuid;
	
	protected $table = 'blog_tmp';
    protected $primaryKey = 'id';
    protected $fillable = array('file', 'user_id', 'key');
}
