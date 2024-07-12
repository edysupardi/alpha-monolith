<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    protected $table = "branch";
    protected $fillabel = [ 'company_id', 'name', 'phone', 'address', 'status', 'main_branch', 'created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
	    'created_at'            => 'datetime:Y-m-d H:i',
	    'updated_at'            => 'datetime:Y-m-d H:i',
	    'deleted_at'            => 'datetime:Y-m-d H:i',
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
