<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseCode;
use App\Helpers\Sms;
use Illuminate\Http\Request;
use App\Helpers\Utils;


class UserController extends BaseController
{
    
    public function __construct(){
        parent::__construct();
        

    }

    /**
     * 编辑用户资料
     *
     */
    public function edit(){
        $userModel = $this->userModel;
        $rawBodyData = $this->rawBodyData;
        $fields = ['mobile','name','email'];
        $params = [];
        foreach ($fields as $key){
            if($rawBodyData[$key]){
                $params[$key] = $rawBodyData[$key];
            }
        }
        if(!empty($params)){
            $flag = $this->userInstance->updateOne($userModel['user_id'],$params);
        }
        $this->jsonResponse();
    }

    /**
     *
     * 找回密码
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function findPwd(){

        $rawBodyData = $this->verifyData(['mobile','new_password','code']);
        $code = trim($rawBodyData['code']);
        $mobile = trim($rawBodyData['mobile']);
        $new_password = trim($rawBodyData['new_password']);
        if(!Sms::verifyCode($mobile,$code)){
            $this->jsonResponse(['code'=>ResponseCode::SMS_CODE_ERROR]);
        }
        $userModel = $userModel = $this->userInstance->getOne(['mobile'=>$mobile]);
        if(empty($userModel)){
            $this->jsonResponse(['code'=>ResponseCode::PHONE_NUMBER_NOT_EXIST]);
        }

        $flag = $this->userInstance->updateOne($userModel['user_id'],['password'=>$new_password]);

        $res['code'] =  $flag ? ResponseCode::SUCCESS : ResponseCode::OPERATION_FAILED;
        $this->jsonResponse($res);

    }

    /**
     *
     * 修改密码
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePwd(){
        $userModel = $this->userModel;
        $mobile = $userModel['mobile'];
        $rawBodyData = $this->verifyData(['code','new_password']);
        $code = trim($rawBodyData['code']);
        $new_password = trim($rawBodyData['new_password']);

        if(!Sms::verifyCode($mobile,$code)){
            $this->jsonResponse(['code'=>ResponseCode::SMS_CODE_ERROR]);
        }

        $flag = $this->userInstance->updateOne($userModel['user_id'],['password'=>$new_password]);

        $res['code'] =  $flag ? ResponseCode::SUCCESS : ResponseCode::OPERATION_FAILED;
        $this->jsonResponse($res);

    }

    /**
     * 登录
     */
    public function login(){
        $rawBodyData = $this->verifyData(['mobile','password']);
        $mobile = trim($rawBodyData['mobile']);
        $password = trim($rawBodyData['password']);
        $userModel = $this->userInstance->getOne(['mobile'=>$mobile]);
        if(empty($userModel)){
            $this->jsonResponse(['code'=>ResponseCode::PHONE_NUMBER_NOT_EXIST]);
        }

        if($userModel['password'] != $password){
            $this->jsonResponse(['code'=>ResponseCode::PASSWORD_ERROR]);
        }

        $data['token'] = $this->userInstance->setToken($userModel['user_id']);
        $login_at = time();
        $this->userInstance->updateOne($userModel['user_id'],['login_at'=>$login_at]);

        $this->jsonResponse(['data'=>$data]);
    }

    /**
     * 注册
     */
    public function register(){
        $rawBodyData = $this->verifyData(['mobile','password','code']);
        $identity = strtolower(trim($rawBodyData['invite_code']));//邀请码
        if($identity){
            $userInfo = $this->userInstance->getOne(['identity'=>$identity]);
            if(!empty($userInfo)){
                $params['pid'] = $userInfo['user_id'];
            }else{
                $this->jsonResponse(['code'=>ResponseCode::INVITE_CODE_NOT_EXIST]);
            }
        }

        $code = trim($rawBodyData['code']);
        $params['mobile'] = $mobile = trim($rawBodyData['mobile']);

        $params['password'] = trim($rawBodyData['password']);
        $params['email'] = trim($rawBodyData['email']);
        if(!Sms::verifyCode($mobile,$code)){
            $this->jsonResponse(['code'=>ResponseCode::SMS_CODE_ERROR]);
        }

        $userModel = $this->userInstance->getOne(['mobile'=>$mobile]);
        if(!empty($userModel)){
            $this->jsonResponse(['code'=>ResponseCode::PHONE_IS_OCCUPIED]);
        }
        $params['identity'] = $this->userInstance->makeIdentity(8);
        $lastId = $this->userInstance->createOne($params);
        if($lastId){
            //$this->userInstance->updateOne($lastId,['identity'=>sha1($lastId)]);
            $data['token'] = $this->userInstance->setToken($lastId);
            $this->jsonResponse(['data'=>$data]);
        }
        $this->jsonResponse(['code'=>ResponseCode::OPERATION_FAILED]);
    }

    /**
     * 用户信息
     */
    public function info(){
        $userModel = $this->userModel;
        unset($userModel['password']);
        $this->jsonResponse(['data'=>$userModel]);
    }

    /**
     * 绑定aic地址
     */
    public function bindAicAddress(){
        $rawBodyData = $this->verifyData(['aic_address']);
        $aic_address = trim($rawBodyData['aic_address']);

        $this->userInstance->updateOne($this->userId,['aic_address'=>$aic_address]);

        $this->jsonResponse();
    }

    /**
     * 注销
     */
    public function logout(){
        $this->userInstance->delToken($this->token);
        $this->jsonResponse();
    }

    /**
     *  订单列表
     */
    public function orderList(){
        $rawBodyData = $this->rawBodyData;
        $ordParams['user_id'] = $this->userId;
        if(isset($rawBodyData['status']) && $rawBodyData['status'] > -1){
            $ordParams['status'] = (int)$rawBodyData['status'];
        }
        $ordParams['pageSize'] = 10;
        $orderObject = $this->orderInstance->getList($ordParams);
        $orderList = Utils::object2array($orderObject);
        if(!empty($orderList['data'])){
            foreach ($orderList['data'] as $key => $val){
                $val['average_price'] = Utils::priceFormat($val['total_turnover']/$val['entrust_quantity']);
                $orderList['data'][$key] = $val;
            }
        }
        $res['data'] = $orderList;
        $this->jsonResponse($res);
    }


    /**
     * 取消订单
     */
    public function cancelOrder(){
        $rawBodyData = $this->verifyData(['order_id']);

        $order_id = $rawBodyData['order_id'];//订单ID

        $orderInfo = $this->orderInstance->getOne(['order_id'=>$order_id]);

        if(empty($orderInfo)){
            $this->jsonResponse(['code'=>ResponseCode::NO_RECORD]);
        }


        if($this->userId != $orderInfo['user_id']){
            $this->jsonResponse(['code'=>ResponseCode::NO_AUTHORITY]);
        }

        if($orderInfo['status'] != 0){
            $this->jsonResponse(['code'=>ResponseCode::OPERATION_FAILED]);
        }


        $params['user_id'] = $this->userId;//用户ID

        $this->orderInstance->updateOne($order_id,['status'=>6]);
        $this->jsonResponse();
    }
}
