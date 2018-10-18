<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use App\Helpers\Utils;

class User extends Model
{
    /**
     * @var string
     */
    protected $table = 'user';

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string
     */
    public $userCacheKey = "user:";

    /**
     * @var string
     */
    public $tokenCacheKey = "cache:user:token:";


    /**
     * [用户的唯一标识]
     * @param array $params [
     * user_id    [必填]   user_id
     * auth_key   [必填]   auth_key
     * ]
     */
    public function setToken($user_id){
        $token = null;
        $user_id = (int)$user_id;
        if($user_id){
            $token = sha1($user_id.uniqid().rand(0, 10000));
            $tokenCacheKey = $this->tokenCacheKey.$token;
            //Redis::set($tokenCacheKey,$user_id);
            $expires = 3600*24*30;
            Redis::setex($tokenCacheKey,$expires,$user_id);
        }
        return $token;
    }

    /**
     * [用户的唯一标识]
     * @param array $params [
     * user_id    [必填]   user_id
     * auth_key   [必填]   auth_key
     * ]
     */
    public function delToken($token){
        $flag = false;
        if($token){
            $tokenCacheKey = $this->tokenCacheKey.$token;
            $flag = Redis::del($tokenCacheKey);
        }
        return $flag;
    }

    /**
     * 通过token获取用户信息
     */
    public function getInfoByToken($token){
        $res = [];
        $tokenCacheKey = "cache:user:token:".$token;
        $user_id = Redis::get($tokenCacheKey);
        if($user_id){
            $res = $this->getInfo(['user_id'=>$user_id]);
        }
        return $res;
    }

    /**
     * @param array $params
     * @return array|mixed
     */
    public function getInfo($params=[]){
        return $this->getOne($params);
    }


    /**
     * 获取一条记录
     *
     */
    public function getOne($params=[]){
        $res = [];

        if(isset($params[$this->primaryKey])) {
            $id = (int)$params[$this->primaryKey];
            $cacheKey = $this->userCacheKey . $id;
            $row = Redis::get($cacheKey);
            if ($row) {
                $res = json_decode($row, true);
                return $res;
            }
        }

        if(empty($res)) {
            $row = self::where($params)->get()->toArray();
            if(!empty($row)) {
                $res = $row[0];
            }
        }

        if(isset($params[$this->primaryKey]) && !empty($res)) {
            Redis::set($cacheKey,json_encode($res));
        }
        return $res;
    }
    /**
     * 获取多条记录
     *
     */
    public function getMore($params=[]){

        $res = self::where($params)->get()->toArray();
        return $res;
    }

    /**
     * 删除一条记录
     *
     */
    public function deleteOne($primaryKey){
        $id = (int)$primaryKey;
        $flag = self::destroy($id);
        if($flag){
            $cacheKey = $this->userCacheKey.$id;
            Redis::del($cacheKey);
        }
        return $flag;
    }

    /**
     * 修改一条记录
     *
     */
    public function updateOne($primaryKey,$params=[]){
        $time = time();
        $params['updated_at'] = $time;
        $id = (int)$primaryKey;
        $flag = self::where($this->primaryKey, $id)->update($params);
        if($flag){
            $cacheKey = $this->userCacheKey.$id;
            Redis::del($cacheKey);
        }
        return $flag;
    }

    /**
     * 创建一条记录
     *
     */
    public function createOne($params=[]){
        $lastId = 0;
        $time = time();
        $params['updated_at'] = $time;
        $params['created_at'] = $time;
        $flag = self::create($params);
        if($flag){
            $lastId = DB::getPdo()->lastInsertId();
        }
        return $lastId;
    }

    //获取列表
    public function getList($params = []) {
        $where = $params['where'];
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 20;
        return self::where($where)->orderBy('user_id', 'desc')->paginate($pageSize);
    }

    //根据user_id查询所有的子用户
    public function getChildUserByUserId($user_id){
        if (is_array($user_id)) {
            $data = self::whereIn('pid', $user_id)->get();
        } else {
            $data = self::where('pid', $user_id)->get();
        }

        if (!empty($data)) {
            return $data->toArray();
        }

        return [];
    }

    /**
     * [manageCode description]
     * 如果是唯一码验，先生成再验证是否存在，直到不存在，返回code
     * 
     * @return [type] [description]
     */
    public function makeIdentity($length=8){
        $code = $params['code'] = Utils::makeCode($length);
        $data = $this->getOne(['identity'=>$code]);
        if(!empty($data)){
            $this->makeIdentity($length);
        }
        return $code;
    }

    
}
