<?php

namespace App\Models;

use App\Traits\Datatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, Notifiable, SoftDeletes, HasRoles, Datatable;

    protected $table = "user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar',
        'branch_id',
        'company_id',
        'email',
        'email_verified_at',
        'id',
        'name',
        'password',
        'remember_token',
        'status',
        'personal_id',

        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'status',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function createToken(string $name, array $abilities = ['*'])
    {
        $hash = hash('sha256', $plainTextToken = Str::random(240));
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => $hash,
            'abilities' => $abilities,
        ]);

        return new NewAccessToken($token, $plainTextToken);
    }

    /**
     * **************************************************
     *    R E L A T I O N S H I P
     * **************************************************
     */

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    /**
     * **************************************************
     *    S C O P E
     * **************************************************
     */

    public function scopeFindByEmail($q, $email = '')
    {
        return $q->where('email', $email);
    }
}
