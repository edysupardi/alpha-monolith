<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

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

    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
    const GENDER = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
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

    function identities()
    {
        return $this->hasMany(PersonIdentity::class, 'person_id');
    }

    function identity()
    {
        return $this->hasOne(PersonIdentity::class, 'person_id')->orderBy('updated_at', 'desc');
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

    function scopeFilterByName($q, $d)
    {
        return $q->where('full_name', $d);
    }

    function scopeFilterByDob($q, $d)
    {
        return $q->where('date_of_birth', $d);
    }
}
