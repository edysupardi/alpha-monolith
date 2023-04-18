<?php

namespace App\Models;

use App\Traits\Datatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poly extends BaseModel
{
    use SoftDeletes, Datatable;

    protected $table = 'poly';
    protected $fillable = [
        'department_id',
        'name',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
}
