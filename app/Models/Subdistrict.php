<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{SoftDeletes};
use App\Traits\{Uuids, Datatable};
use App\Models\BaseModel;

class Subdistrict extends BaseModel
{
    use Uuids, HasFactory, SoftDeletes, Datatable;

    protected $table = 'subdistrict';
    protected $fillable = [
        'provience_id',
        'district_id',
        'name',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = ['deleted_at', 'latitude', 'longitude'];

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
