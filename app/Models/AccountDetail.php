<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use App\Helpers\Utils;

class AccountDetail extends Model
{
    /**
     * @var string
     */
    protected $table = 'account_detail';

    /**
     * @var string
     */
    protected $primaryKey = 'account_detail_id';

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
    public $account_detailCacheKey = "account_detail:";



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
            $cacheKey = $this->account_detailCacheKey . $id;
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
            $cacheKey = $this->account_detailCacheKey.$id;
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
            $cacheKey = $this->account_detailCacheKey.$id;
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
        return self::where($where)->orderBy('account_detail_id', 'desc')->paginate($pageSize);
    }
    
}
