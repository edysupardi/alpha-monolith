<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonIdentity extends Model
{
    use SoftDeletes;

    protected $table = "person_identity";
    protected $fillabel = [
        'company_id',
        'person_id',
        'identity_number',
        'identity_type_id',
        'identity_photo',
        'created_at',
        'updated_at',
        'deleted_at',
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

    function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    function identityType()
    {
        return $this->belongsTo(IdentityType::class, 'identity_type_id');
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

    function scopeFilterByPerson($q, $d)
    {
        return $q->where('person_id', $d);
    }

    function scopeFilterByIdentityType($q, $d)
    {
        return $q->where('identity_type_id', $d);
    }

    function scopeFilterByIdentityNumber($q, $d)
    {
        return $q->where('identity_number', $d);
    }
}
