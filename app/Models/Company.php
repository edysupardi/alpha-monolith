<?php

namespace App\Models;

use App\Traits\Datatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends BaseModel
{
    use SoftDeletes, Datatable;

    protected $table = 'company';
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
}
