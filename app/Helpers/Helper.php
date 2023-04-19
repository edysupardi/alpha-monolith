<?php
namespace App\Helpers;

class Helper {
    public static function encodeBase($string) : string {
		if ($string!='') {
			$encode = base64_encode(openssl_encrypt($string,"AES-256-ECB", config('app.key')));
			return $encode;
		}
		return '';
	}

	public static function decodeBase($string) : string {
		$encode = openssl_decrypt(base64_decode($string),"AES-256-ECB", config('app.key'));
		return $encode;
	}
}
