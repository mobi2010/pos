<?php

namespace App\Helpers;

/**
 * 工具类
 *
 */
class Utils{
    /**
     * 加密
     */
    public static function object2array($object){
        $res = [];
        if(is_object($object)){
            $res = json_decode(json_encode($object), true);
        }
        return $res;
    }
    /**
     * 价格格式化
     */
    public static function priceFormat($price,$decimal=4){
        $price = (string)round(trim($price),$decimal);
        return $price;
    }

    /**
     * 量格式化
     */
    public static function quantityFormat($quantity,$decimal=2){
        $quantity = (string)round(trim($quantity),$decimal);
        return $quantity;
    }

    /**
     * [makeCode description]
     * 不能出现重复的三个数
     * @return [type] [description]
     */
    public static function makeCode($length=8){
        $seed = '123456789abcdefghijkmnpqrstuvwxyz';
        $code = "";

        for($i=0;$i<$length;$i++){
            $index = mt_rand(0,32);
            $code .= $seed[$index];
        }
        if(preg_match("/(\d)\\1{2,}/", $code)){
            return self::makeCode($length);
        }else{
            return $code;
        }
    }
}
?>