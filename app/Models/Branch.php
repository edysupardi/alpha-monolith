<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = "company";
    protected $fillabel = [
        'company_id',
        'name',
        'phone',
        'address',
        'status',
        'main_branch',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const IS_MAIN = 1;
    const IS_NOT_MAIN = 0;

    /**
     * **************************************************
     *  R E L A T I O N
     * **************************************************
     */

    function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * **************************************************
     *  S C O P E
     * **************************************************
     */

    function scopeFilterByCompany($q, $d)
    {
        return $q->where('company_id', $d);
    }
}
