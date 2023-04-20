<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

/**
 * Format string.
 */
class Strings
{
    public static function simpleString($string, $medium = false, $useDot = false)
    {
        $length = $medium ? 12 : 5;
        return strlen($string) > 10 ? trim(substr($string, 0, $length)) . ($useDot ? "..." : "") : $string;
    }
}
