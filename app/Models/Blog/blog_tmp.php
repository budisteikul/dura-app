<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class blog_tmp extends Model
{
	use Uuid;
	use SoftDeletes;
	
	protected $table = 'blog_tmp';
    public $incrementing = false;
	protected $keyType = 'string';
	
	public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
   
}
