<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{SoftDeletes};
use App\Traits\{Uuids, Datatable};
use App\Models\BaseModel;

class Provience extends BaseModel
{
    use Uuids, HasFactory, SoftDeletes, Datatable;

    protected $table = 'provience';
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = ['deleted_at'];

    /**
     *    S C O P E
     */

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
}
