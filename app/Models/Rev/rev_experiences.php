<?php

namespace App\Models\Rev;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class rev_experiences extends Model
{
    use Uuid;
	protected $table = 'rev_experiences';
	public $incrementing = false;
	protected $keyType = 'string';
}
