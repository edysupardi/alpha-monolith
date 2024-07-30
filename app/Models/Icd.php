<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Icd extends Model
{
    use SoftDeletes;
    protected $table        = "icd";
    public $incrementing    = false;
    protected $primaryKey   = 'icd';
    protected $fillabel     = [
        'icd',
        'company_id',
        'parent_id',
        'name',
        'group',
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

    function parent()
    {
        return $this->belongsTo(Icd::class, 'parent_id');
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

    function scopeFilterByParent($q, $d)
    {
        return $q->where('parent_id', $d);
    }

    function scopeFilterByIcd($q, $d)
    {
        return $q->where('icd', $d);
    }
}
