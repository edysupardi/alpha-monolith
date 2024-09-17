<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasApiTokens, HasRoles, Notifiable, SoftDeletes;

    protected $table = "employee";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'branch_id',
        'person_id',
        'username',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const TOKEN_TYPE = 'Bearer';
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 1;

    /**
     * **************************************************
     *  R E L A T I O N
     * **************************************************
     */

    function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    function divisionUnit()
    {
        return $this->belongsTo(DivisionUnit::class, 'division_unit_id');
    }

    /**
     * Validate the password of the user for the Passport password grant.
     */
    public function validateForPassportPasswordGrant(string $password): bool
    {
        return Hash::check($password, $this->password);
    }

    /**
     * **************************************************
     *  S C O P E
     * **************************************************
     */

    function scopeFilterByUsername($q, $d)
    {
        return $q->where('username', $d);
    }

    function scopeFilterByCompany($q, $d)
    {
        return $q->where('company_id', $d);
    }

    function scopeFilterByPerson($q, $d)
    {
        return $q->where('person_id', $d);
    }
}
