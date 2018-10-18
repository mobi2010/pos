<?php

namespace App\Helpers;

/**
 * 响应码
 */
class ResponseCode{
    //通用码
    const SUCCESS                           = 0; //请求成功
    const SYSTEM_ERROR                      = 10001;
    const OPERATION_FAILED                  = 10002;
    const INVALID_CLIENT_ID                 = 10003;
    const ACCESS_DENIED                     = 10004;
    const INVALID_TOKEN                     = 10005;
    const MISSING_PARAMETERS                = 10006;
    const NO_RECORD                         = 10007;//查无结果
    const NO_AUTHORITY                      = 10008;//没有权限



    //专属错误(用户)
    const PHONE_IS_OCCUPIED                 = 20001;
    const ORIGINAL_PASSWORD_ERROR           = 20002;
    const TWO_CIPHER_INCONSISTENCIES        = 20003;
    const PHONE_NUMBER_NOT_EXIST            = 20004;
    const PASSWORD_ERROR                    = 20005;
    const USER_IS_BOUND                     = 20006;
    const ADDRESS_IS_BOUND                  = 20007;
    const USER_NOT_BOUND                    = 20008;
    const ADDRESS_NOT_BOUND                 = 20009;
    const INVITE_CODE_NOT_EXIST             = 20010;

    //专属错误(交易)
    const XPUB_API_CREATE_ERROR             = 30001;
    const XPUB_DATA_CREATE_ERROR            = 30002;
    const USER_ADDRESS_BIND_ERROR           = 30003;
    const BTC_ADDRESS_CREATE_ERROR          = 30004;
    const BALANCE_NOT_ENOUGH                = 30005;


    //专属错误(其他)
    const SMS_CODE_ERROR                    = 40001;

    //专属错误(充值提现)
    const ACCESS_RECORD_TYPE_ERROR          = 50001;
    const ACCESS_RECORD_BALANCE_SHORT       = 50002;

    //专属错误(投资)
    const PRODUCT_NOT_FIND                  = 60001;
    const PRODUCT_ALREADY_DOWN              = 60002;
    const PRODUCT_NOT_OPERATION_AUTH        = 60003;
    const INSUFFICIENT_BALANCE              = 60004;


    public static function getMessage($code){
        $messageMap = [
            //通用错误
            '0'     => 'Success',
            '10001' => 'System error',
            '10002' => 'Operation failed',
            '10003' => 'Invalid client_id',
            '10004' => 'Access denied',
            '10005' => 'Invalid token',
            '10006' => 'Missing parameters',
            '10007' => 'No record',
            '10008' => 'No authority',

            //专属错误(用户)
            '20001' => 'Phone number is occupied',
            '20002' => 'Original password error',
            '20003' => 'Two cipher inconsistencies',
            '20004' => 'Phone number does not exist',
            '20005' => 'Password error',
            '20006' => 'User is bound',
            '20007' => 'Address is bound',
            '20008' => 'User not bound',
            '20009' => 'Address not bound',
            '20010' => 'Invite code not exist',

            //专属错误(交易)
            '30001' => 'Xpub api create error',
            '30002' => 'Xpub data create error',
            '30003' => 'User address bind error',
            '30004' => 'Btc address create error',
            '30005' => 'Balance is not enough',

            //专属错误(其他)
            '40001' => 'Sms code error',

            //专属错误(提现充值)
            '50001' => 'Access record type error',
            '50002' => 'Access record balance short',

            //专属错误(投资)
            '60001' => 'Product not find',
            '60002' => 'Product already down',
            '60003' => 'Product not operation auth',
            '60004' => 'Insufficient balance',
        ];
        return $messageMap[$code];
    }
}