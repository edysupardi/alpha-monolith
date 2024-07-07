<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = "sessions";

    /**
     * **************************************************
     *  S C O P E
     * **************************************************
     */

    function scopeFilterByUserId($q, $userId = '')
    {
        return $q->where('user_id', $userId);
    }
}
