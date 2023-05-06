<?php

namespace App\Models;

use App\Traits\Datatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends BaseModel
{
    use SoftDeletes, Datatable;

    protected $table = 'branch';
    protected $fillable = [
        'company_id',
        'name',
        'phone_number',
        'address',
        'village_id',
        'subdistrict_id',
        'district_id',
        'provience_id',
        'zip_code',
        'latitude',
        'longitude',
        'is_main',

        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = ['deleted_at', 'deleted_by', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by',];

    /**
     * **************************************************
     *    S C O P E
     * **************************************************
     */

    public function scopeFindByCompany($q, $v = '')
    {
        return $q->where('company_id', $v);
    }

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
