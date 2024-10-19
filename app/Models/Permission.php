<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'company_id',
        'name',
        'guard_name'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'guard_name',
        'pivot'
    ];

    function scopeFilterByCompany($q, $d)
    {
        return $q->where('company_id', $d);
    }

    function scopeOrderByName($q, $order='asc')
    {
        return $q->orderBy('name', $order);
    }
}
