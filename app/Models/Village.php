<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{SoftDeletes};
use App\Traits\{Uuids, Datatable};
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Crypt;

class Village extends BaseModel
{
    use Uuids, HasFactory, SoftDeletes, Datatable;

    protected $table = 'village';
    protected $fillable = [
        'provience_id',
        'district_id',
        'subdistrict_id',
        'name',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at', 'latitude', 'longitude'];

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

    public function scopeFindByName($q, $v = '')
    {
        if(empty($v))
            return $q;
        return $q->where('name', $v);
    }

    public function scopeLikeByName($q, $v = '')
    {
        if(empty($v))
            return $q;
        return $q->where('name', 'like', "%{$v}%");
    }

    public function scopeOrderByName($q, $v = 'asc')
    {
        return $q->orderBy('name', $v);
    }
}
