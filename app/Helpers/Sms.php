<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Redis;

/**
 * 短信类
 *
 */
class Sms{
    public static $smsCacheKey = "cache:sms:mobile:";
    /**
     * 发送验证码
     */
    public static function sendCode($mobile){
        $code = null;
        if($mobile){
            $code = rand(1000,9999);
            $expires = 60*10;//10分钟
            $smsCacheKey = self::$smsCacheKey.$mobile;
            Redis::setex($smsCacheKey,$expires,$code);
            $awsParamsConfig = config('params.api.aws');
            $sns = \Aws\Sns\SnsClient::factory(array(
                'credentials' => [
                    'key'    => $awsParamsConfig['key'],
                    'secret' => $awsParamsConfig['secret'],
                ],
                'region' => $awsParamsConfig['region'],
                'version'  => 'latest',
            ));
            $result = $sns->publish([
                'Message' => "【区块宝】您本次操作的短信验证码为{$code}，切勿告知他人！", // REQUIRED
                'PhoneNumber' => "+86{$mobile}",
            ]);
        }
        return $code;
    }
    /**
     * 验证code
     */
    public static function verifyCode($mobile,$code){
        $res = false;
        if($mobile){
            $smsCacheKey = self::$smsCacheKey.$mobile;
            $ocode = Redis::get($smsCacheKey);
            if($ocode == $code){
                $res = true;
                Redis::del($smsCacheKey);
            }
        }
        return $res;
    }
}
?>