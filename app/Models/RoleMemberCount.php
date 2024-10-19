<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleMemberCount extends Model
{
    protected $table = "role_count_member";

    function scopeFilterByCompany($q, $d)
    {
        return $q->where('company_id', $d);
    }
}
