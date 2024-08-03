<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecordCategory extends Model
{
    use SoftDeletes;
    protected $table = "medical_record_category";
    protected $fillabel = [
        'company_id',
        'name'
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
