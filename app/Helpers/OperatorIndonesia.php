<?php
namespace App\Helpers;
use Illuminate\Support\Str;

class OperatorIndonesia {

    /**
     * Prefix operator
     *
     * @var array
     */
    protected static $prefix = array(
        'Telkomsel' => ['62811', '62812', '62813', '62821', '62822', '62823', '62851', '62852', '62853'],
        'XL' => ['62817', '62818', '62819', '62859', '62877', '62878', '62879'],
        'Axis' => ['62831', '62832', '62833', '62837', '62838'],
        'Indosat' => ['62814', '62815', '62815', '62816', '62855', '62856', '62857', '62858'],
        'Three' => ['62894', '62895', '62896', '62897', '62898', '62899'],
        'Smartfren' => ['62881', '62882', '62883', '62884', '62885', '62886', '62887', '62888', '62888'],
    );

    public static function sanitize($phoneNumber)
    {
        $sanitized = str_replace('+','',$phoneNumber);
        $sanitized = str_replace('-','',$sanitized);
        return (string) filter_var($sanitized, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Membuat format agar dapat dibaca sistem
     *
     * @param  string $phoneNumber
     * @return string Sanitized phone number
     */
    public static function parse($phoneNumber)
    {
        $sanitized = static::sanitize($phoneNumber);
        if ($sanitized && $sanitized[0] == "0") {
            $sanitized = '62'.substr($sanitized, 1);
        }

        return trim($sanitized);
    }

    /**
     * Check Operator/Provider berdasarkan prefix dari 5 angka pertama.
     *
     * @param  string $phoneNumber
     * @return string Operator
     */
    public static function check($phoneNumber)
    {
        $operator = 'Unknown';

        $sanitized = static::parse($phoneNumber);

        if (empty($sanitized))
            return $operator;

        foreach (self::$prefix as $key => $provider) {
            if (Str::startsWith($sanitized, $provider)) {
                $operator = $key;
                break;
            }
        }

        return  $operator;
    }

    public static function correction($phoneNumber)
    {
        return (Str::startsWith($phoneNumber, '62') || Str::startsWith($phoneNumber, '+62') || Str::startsWith($phoneNumber, '0'));
    }


    /**
     * Membuat format nomor agar dapat mudah dibaca manusia
     *
     * @param  string $phoneNumber
     * @return string beautified phone number
     */
    public static function beautify($phoneNumber)
    {
        $sanitized = static::sanitize($phoneNumber);
        if ($sanitized && Str::startsWith($sanitized, '62')) {
            $sanitized = '0'.substr($sanitized, 2);
        }

        return substr(chunk_split(trim($sanitized),4,'-'),0,-1);
    }
}
