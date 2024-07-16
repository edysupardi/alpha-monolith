<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddressType extends Model
{
    use SoftDeletes;

    protected $table = "address_type";
    protected $fillabel = ['company_id', 'name', 'created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
	    'created_at'            => 'datetime:Y-m-d H:i',
	    'updated_at'            => 'datetime:Y-m-d H:i',
	    'deleted_at'            => 'datetime:Y-m-d H:i',
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
