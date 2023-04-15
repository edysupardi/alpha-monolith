<?php

namespace App\Models;

use App\Traits\Datatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends BaseModel
{
    use SoftDeletes, Datatable;

    protected $table = 'branch';
    protected $fillable = [
        'name',
        'phone_number',
        'address',
        'village_id',
        'subdistrict_id',
        'district_id',
        'provience_id',
        'zip_code',

        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = ['deleted_at', 'deleted_by'];
}
