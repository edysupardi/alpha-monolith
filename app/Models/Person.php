<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "person";
    protected $fillabel = [
        'company_id',
        'first_name',
        'last_name',
        'full_name',
        'name_of_father',
        'name_of_mother',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'ethnic',
        'languages',
        'region_id',
        'marital_status',
        'last_education',
    ];

    /**
     * **************************************************
     *  R E L A T I O N
     * **************************************************
     */

    function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
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
