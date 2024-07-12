<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchPolygon extends Model
{
    use SoftDeletes;

    protected $table = "branch_polygon";
    protected $fillabel = [ 'branch_id', 'latitude', 'longitude', 'created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
	    'created_at'            => 'datetime:Y-m-d H:i',
	    'updated_at'            => 'datetime:Y-m-d H:i',
	    'deleted_at'            => 'datetime:Y-m-d H:i',
    ];
}
