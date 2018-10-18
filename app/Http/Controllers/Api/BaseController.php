<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\Aes;
use App\Helpers\ResponseCode;

error_reporting(E_ERROR | E_WARNING | E_PARSE);

class BaseController extends Controller
{
    /**
     * @var
     */
    public $apiParamsConfig;

    /**
     * @var
     */
    public $errorCodeConfig;


    /**
     * @var
     */
    public $rawBodyData;

    /**
     * @var
     */
    public $rawBodyParams;

    /**
     * @var
     */
    public $client_id;

    /**
     * @var
     */
    public $identity;

    /**
     * @var
     */
    public $secretTypeConfig;

    /**
     * @var
     */
    public $userModel;

    /**
     * @var
     */
    public $userId;

    /**
     * @var
     */
    public $userInstance;

    /**
     * @var
     */
    public $token;

    /**
     * BaseController constructor.
     */
    public function __construct() {
        //初始化
        $this->init();

        //权限
        $this->permission();
    }

    /**
     * 权限认证
     */
    protected function permission(){
        $requestUri = \Request::getRequestUri();
        $permissionConfig = $this->apiParamsConfig['permission'];
        $clientIdConfig = $this->clientIdConfig;
        $client_id = $this->client_id;

        //验证client_id
        if(!$client_id || !$clientIdConfig[$client_id]){
            $this->jsonResponse(['code'=>ResponseCode::INVALID_CLIENT_ID]);
        }

        $pass = false;
        foreach ($permissionConfig['free_user'] as $value){//验证游客权限
            if(strstr($requestUri,$value)){
                $pass = true;
                break;
            }
        }

        if(isset($permissionConfig[$client_id])){//验证客户端权限
            foreach ($permissionConfig[$client_id] as $value){
                if(strstr($requestUri,$value)){
                    $pass = true;
                    break;
                }
            }
        }
        if(!$pass){
            $token = $this->token;
            if($token){
                $this->userModel = $this->userInstance->getInfoByToken($token);
                if(empty($this->userModel)){//token不合法
                    $this->jsonResponse(['code'=>ResponseCode::INVALID_TOKEN]);
                }
                $this->userId = $this->userModel['user_id'];
            }else{//无权访问
                $res['code'] = ResponseCode::ACCESS_DENIED;
                $this->jsonResponse($res);
            }
        }
    }
    /**
     * 初始化
     */
    protected function init(){
        //config params
        $apiParamsConfig = $this->apiParamsConfig = config('params.api');
        $this->errorCodeConfig = $apiParamsConfig['error_code'];
        $this->clientIdConfig = $apiParamsConfig['client_id'];

        $this->rawBodyData = \Request::getContent();
        $this->rawBodyParams = $this->rawBodyDecode($this->rawBodyData);
        $this->client_id = \Request::header('client-id');
        $this->token = \Request::header('token');
        $this->secretTypeConfig = $this->clientIdConfig[$this->client_id]['secret_type'];

        $this->userInstance = new \App\Models\User;


    }

    /**
     * [json响应客户端]
     * @param  array  $params [
     *
     * code     [选填]    //状态码，默认:0
     * message  [选填]    //描述信息，默认:It is works!
     * data     [选填]    //数据，默认:null
     *
     * ]
     * @return [type]         [description]
     */
    public function jsonResponse($params=[]){
        header('Content-type: application/json');
        //状态
        $res['code'] = isset($params['code']) ? (int)$params['code'] : 0;

        if(isset($params['message'])){
            $res['message'] = $params['message'];
        }else{
            $res['message'] =  ResponseCode::getMessage($res['code']);
        }

        //数据
        $res['data'] = isset($params['data']) ? $params['data'] : null;

        echo json_encode($res);exit;
    }

    /**
     * 解密
     * @param  [type] $rawBody [description]
     * @return [type]          [description]
     */
    public function rawBodyDecode($rawBody){
        if(empty($rawBody)){
            $rawBody = [];
        }else{
//            $secretTypeConfig = $this->secretTypeConfig;
//            $rawBody = Aes::decrypt($rawBody, $secretTypeConfig['key'], $secretTypeConfig['iv']);
            $rawBody = json_decode($rawBody,true);
            $rawBody = empty($rawBody) ? [] : $rawBody;
        }
        $rawBody = array_merge($rawBody,$_GET);
        $this->rawBodyData = $rawBody;
        return $rawBody;
    }

    /**
     * [加密]
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public function rawBodyEncode($params=[]){
        $secretTypeConfig = $this->secretTypeConfig;
        $rawBody = json_encode($params);
        //$rawBody = Aes::encrypt($rawBody, $secretTypeConfig['key'], $secretTypeConfig['iv']);
        return $rawBody;
    }

    /**
     * 数据验证
     * @param  array  $params [description]
     * @return [type]         [description]
     */
    public function verifyData($fields=[]){
        foreach ($fields as $key => $value) {
            if(!$this->rawBodyData[$value]){
                $this->jsonResponse(['code'=>ResponseCode::MISSING_PARAMETERS,'message'=>'Missing parameters '.$value]);
            }
        }
        return $this->rawBodyData;
    }


}