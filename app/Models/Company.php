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

    protected $hidden = ['deleted_at', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_by'];

    /**
     * **************************************************
     *    R E L A T I O N S H I P
     * **************************************************
     */

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function provience()
    {
        return $this->belongsTo(Provience::class);
    }
}
