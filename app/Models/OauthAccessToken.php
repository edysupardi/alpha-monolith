<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthAccessToken extends Model
{
    protected $table = "oauth_access_tokens";

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
