<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

/**
 * Format string.
 */
class Strings
{
    public static function simpleString($val, $medium = false, $useDot = false)
    {
        $length = $medium ? 12 : 5;
        return strlen($val) > 10 ? trim(substr($val, 0, $length)) . ($useDot ? "..." : "") : $val;
    }
}
