<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Company extends Model
{
    use SoftDeletes;

    protected $table = "company";
    protected $fillabel = [ 'name', 'phone', 'address', 'created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
	    'created_at'            => 'datetime:Y-m-d H:i',
	    'updated_at'            => 'datetime:Y-m-d H:i',
	    'deleted_at'            => 'datetime:Y-m-d H:i',
    ];
}
