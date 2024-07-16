<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class DivisionUnit extends Model
{
    use SoftDeletes;

    protected $table = "division_unit";
    protected $fillabel = ['company_id', 'parent_id', 'name', 'is_can_loan_rm_file', 'created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
	    'created_at'            => 'datetime:Y-m-d H:i',
	    'updated_at'            => 'datetime:Y-m-d H:i',
	    'deleted_at'            => 'datetime:Y-m-d H:i',
    ];

    const CAN_LOAN      = 'yes';
    const CANNOT_LOAN   = 'no';

    /**
     * **************************************************
     *  R E L A T I O N
     * **************************************************
     */

    function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    function parent()
    {
        return $this->belongsTo(DivisionUnit::class, 'parent_id');
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

    function scopeFilterByBranch($q, $d)
    {
        return $q->where('branch_id', $d);
    }
}
