<?php

namespace App\Models;

use App\Traits\Datatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends BaseModel
{
    use SoftDeletes, Datatable;

    protected $table = 'personal';
    protected $fillable = [
        'identity_id',
        'identity_number',
        'village_id',
        'subdistrict_id',
        'district_id',
        'provience_id',
        'country_id',
        'name',
        'place_of_birth',
        'date_of_birth',
        'mother_name',
        'gender_id',
        'religion_id',
        'ethnic',
        'phone_number',
        'mobile_number',
        'domicile_village_id',
        'domicile_subdistrict_id',
        'domicile_district_id',
        'domicile_provience_id',
        'zip_code',
        'graduation_id',
        'education',
        'job',
        'marital_status_id',

        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];
}

