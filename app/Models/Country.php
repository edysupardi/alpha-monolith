<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{SoftDeletes};
use App\Traits\{Uuids, Datatable};
use App\Models\BaseModel;

class Country extends BaseModel
{
    use Uuids, HasFactory, SoftDeletes, Datatable;

    protected $table = 'country';
    protected $fillable = [
        'name',
        'official_state_name',
        'alpha_2',
        'alpha_3',
        'code',
        'cctld',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = ['deleted_at'];

    /**
     * **************************************************
     *    R E L A T I O N S H I P
     * **************************************************
     */

    function provience()
    {
        return $this->belongsTo(Provience::class);
    }

    function district()
    {
        return $this->belongsTo(District::class);
    }

    function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class);
    }

    /**
     * **************************************************
     *    S C O P E
     * **************************************************
     */

    function scopeByProvience($q, $v = '')
    {
        return $q->where('provience_id', $v);
    }

    function scopeByDistrict($q, $v = '')
    {
        return $q->where('district_id', $v);
    }

    function scopeBySubdistrict($q, $v = '')
    {
        return $q->where('subdistrict_id', $v);
    }
}
