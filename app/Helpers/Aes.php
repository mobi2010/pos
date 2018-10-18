<?php

namespace App\Helpers;

/**
 * AES 加密
 *
 * 加密方式:AES-128-CBC
 *
 */
class Aes{
    /**
     * 加密
     */
    public static function encrypt($data,$key,$iv,$model='AES-128-CBC'){
        $res = openssl_encrypt($data, $model,$key,0,$iv);
        return $res;
    }

    /**
     * 解密
     */
    public static function decrypt($data,$key,$iv,$model='AES-128-CBC'){
        $res = openssl_decrypt($data, $model, $key, 0, $iv);
        return $res;
    }
}
?>