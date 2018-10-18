<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionLog extends Model
{
    protected $table = 'commission_log';
    public $primaryKey = 'commission_log_id';
    public $timestamps = false;
    protected $guarded = [];

    //获取列表
    public function getList($where = []) {
        return self::where($where)->orderBy($this->primaryKey, 'desc')->paginate(20);
    }

    //添加
    public function createOne($data) {
        $data['create_time'] = time();
        $res = self::create($data);
        return $res->commission_log_id;
    }

    /*
     * 获取用户某个等级的分成总和
     */
    public function getUserCommissionSum($user_id, $lv){
        return self::where('user_id', $user_id)->where('lv', $lv)->sum('commission');
    }

    /*
     * 获取某个用户的总收益
     */
    public function getUserIncomeCount($user_id) {
        return self::where('user_id', $user_id)->sum('commission');
    }
}
