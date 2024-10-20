<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;

class Employee extends Authenticatable
{
    use HasRoles, Notifiable, SoftDeletes, HasApiTokens;

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

    // public function tokens()
    // {
    //     return $this->hasMany(PersonalAccessToken::class, 'tokenable_id');
    // }

    public function createToken(string $name, array $abilities = ['*'], DateTimeInterface $expiresAt = null)
    {
        if($expiresAt === null){
            $expiresAt = Carbon::now()->addMinutes(config('session.lifetime'));
        }
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(240)),
            'abilities' => $abilities,
            'expires_at' => $expiresAt,
        ]);

        return new NewAccessToken($token, $plainTextToken);
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
