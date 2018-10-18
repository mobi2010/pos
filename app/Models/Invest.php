<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invest extends Model
{
    protected $table = 'invest';
    public $primaryKey = 'invest_id';
    public $timestamps = false;

    public $userModel;
    public $commissionLogModel;
    public $accountDetail;

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->userModel = new \App\Models\User();
        $this->commissionLogModel = new \App\Models\CommissionLog();
        $this->accountDetail = new \App\Models\AccountDetail();
    }

    //获取列表
    public function getList($where = []) {
        return self::where($where)->orderBy($this->primaryKey, 'desc')->paginate(20);
    }

    //添加
    public function createOne($data) {
        $this->user_id = $data['user_id'];
        $this->product_id = $data['product_id'];
        $this->amount = $data['amount'];
        $this->rate = $data['rate'];
        $this->end_time = $data['end_time'];
        $this->status = 0;
        $this->create_time = time();
        $this->update_time = time();

        $res = $this->save();
        if (!empty($res)) {
            $this->updateUserLv($data['user_id'], $data['amount']);
        }

        return $res;
    }

    //删除
    public function deleteOne($invest_id){
        $model = self::find($invest_id);
        return $model->delete();
    }

    //获取一条信息
    public function getOne($params = []) {
        if(isset($params[$this->primaryKey]) && (count($params) == 1)){
            $data = self::find($params[$this->primaryKey]);
        }else{
            $data = self::where($params)->first();
        }

        if (!empty($data)) {
            return $data->toArray();
        }
        return [];
    }

    //更新
    public function updateOne($primaryKey, $data) {
        return self::where('invest_id', $primaryKey)->update($data);
    }

    //到期/续投(任务使用)
    public function continuedInvest(){
        $tim = time();
        $data = self::where('status', 0)->where('end_time', '<=', $tim)->orderBy($this->primaryKey, 'asc')->get()->toArray();

        if (!empty($data)) {
            $productModel = new Product();
            foreach ($data as $value) {
                $info = [];
                $userInfo = $this->userModel->getOne(['user_id' => $value['user_id']]);
                $commission = $userInfo['invest_aic'] + $value['amount'] * $value['rate'];

                if ($value['is_continued_invest'] == 1) {           //续投
                    $countAmount = $value['amount'] + $value['amount'] * $value['rate'];
                    $productInfo = $productModel->getOne(['product_id' => $value['product_id']]);
                    if ($productInfo['is_delete'] == 1) {                   //如果产品已下架,则为到期
                        //更新为到期
                        $this->updateOne($value['invest_id'], ['status' => 1, 'update_time' => $tim]);

                        //投资额增加利息
                        $this->userModel->updateOne($value['user_id'], ['invest_aic' => $commission]);
                    } else {                                                //继续续投
                        $info['amount'] = $countAmount;
                        $info['rate'] = $productInfo['rate'];
                        $info['end_time'] = $value['end_time'] + $productInfo['duration'] * 24 * 3600;
                        $info['update_time'] = $tim;

                        $res = $this->updateOne($value['invest_id'], $info);
                        if (!empty($res)) {
                            $this->updateUserLv($value['user_id']);
                            //投资额增加利息
                            $this->userModel->updateOne($value['user_id'], ['invest_aic' => $commission]);
                        }
                    }
                } else {                                            //到期
                    //更新为到期
                    $this->updateOne($value['invest_id'], ['status' => 1, 'update_time' => $tim]);

                    //投资额增加利息
                    $this->userModel->updateOne($value['user_id'], ['invest_aic' => $commission]);
                }
            }
        }
    }

    //投资完后修改用户等级,如果传了金额会进行用户的余额/投资修改
    public function updateUserLv($user_id, $amount = 0){
        $countAmount = self::where('user_id', $user_id)->sum('amount');
        $lv = $this->lvGrade();
        arsort($lv);
        $user_lv = 0;
        foreach ($lv as $key=>$value) {
            if ($countAmount >= $value) {
                $user_lv = $key;
                break;
            }
        }

        $userModel = new \App\Models\User();
        $where['rank'] = $user_lv;
        if (!empty($amount)) {
            $userInfo = $userModel->getOne(['user_id' => $user_id]);
            $where['balance_aic'] = $userInfo['balance_aic'] - $amount;
            $where['invest_aic'] = $userInfo['invest_aic'] + $amount;
        }
        $userModel->updateOne($user_id, $where);
    }

    public function lvGrade(){
        return [
            '1' => 1,
            '2' => 100,
            '3' => 150,
            '4' => 200,
            '5' => 300,
            '6' => 400,
            '7' => 500,
            '8' => 800,
            '9' => 900,
            '10' => 1000,
            '11' => 1100,
            '12' => 1200,
            '13' => 1300,
            '14' => 1400,
            '15' => 1500,
            '16' => 1600,
            '17' => 1700,
            '18' => 1800,
            '19' => 1900
        ];
    }


    //提现
    public function withdraw($invest_id){
        $investInfo = $this->getOne(['invest_id' => $invest_id]);
        $userModel = new \App\Models\User();
        $userInfo = $userModel->getOne(['user_id' => $investInfo['user_id']]);

        $data['balance_aic'] = $userInfo['balance_aic'] + $investInfo['amount'];
        $data['invest_aic'] = $userInfo['invest_aic'] - $investInfo['amount'];
        //如果投资到期,则余额等于本金加利息,投资额同时减去利息
        if ($investInfo['status'] == 1) {
            $data['balance_aic'] += $investInfo['amount'] * $investInfo['rate'];
            $data['invest_aic'] -= $investInfo['amount'] * $investInfo['rate'];
        }

        if ($data['invest_aic'] < 0) {
            return false;
        }

        $res = $userModel->updateOne($userInfo['user_id'], $data);
        if (!empty($res)) {
            $this->updateOne($invest_id, ['status' => 2, 'update_time' => time()]);
        } else {
            return false;
        }

        //进行分成,-----以后可能会提出去做异步-----
        //如果投资到期,则进行分成
        if ($investInfo['status'] == 1) {
            $this->divided($userInfo['pid'], $i = 1, $investInfo);
        }
        return true;
    }

    //分成
    public function divided($pid, $i, $investInfo) {
        $userInfo = $this->userModel->getOne(['user_id' => $pid]);
        $commissionInfo = $this->commission();
        if (!empty($userInfo)) {
            $useCommission = $commissionInfo[$userInfo['rank']];
            //如果当前会员等级可以获取当前等级的分成,则进行分成
            if (count($useCommission) >= $i) {
                //开始分成
                $key = $i - 1;

                //提成 = 提现用户本金 * 利率 * 分成百分比
                $commission = $investInfo['amount'] * $investInfo['rate'] * $useCommission[$key];
                $balance_aic = $userInfo['balance_aic'] + $commission;

                $res = $this->userModel->updateOne($userInfo['user_id'], ['balance_aic' => $balance_aic]);
                if (!empty($res)) {
                    //记录log
                    $this->commissionLogModel->createOne([
                            'user_id' => $userInfo['user_id'],
                            'withdraw_user_id' => $investInfo['user_id'],
                            'lv' => $i,
                            'lv_rate' => $useCommission[$key],
                            'invest_id' => $investInfo['invest_id'],
                            'commission' => $commission
                    ]);

                    //记录帐单记录
                    $this->accountDetail->createOne(['user_id' => $userInfo['user_id'], 'quantity' => $commission, 'type' => 6]);
                }
            }

            //继续进行上一级验证分成操作
            if ($userInfo['pid'] > 0) {
                $i++;
                $this->divided($userInfo['pid'], $i, $investInfo);
            }
        }
    }

    //佣金表
    public function commission(){
        return [
            '1' => [
                0.1,
                0.03
            ],
            '2' => [
                0.3,
                0.2,
                0.1
            ],
            '3' => [
                0.5,
                0.3,
                0.2,
                0.1
            ],
            '4' => [
                0.5,
                0.3,
                0.07,
                0.05,
                0.03
            ],
            '5' => [
                0.5,
                0.3,
                0.08,
                0.07,
                0.05,
                0.03
            ],
            '6' => [
                0.5,
                0.3,
                0.2,
                0.07,
                0.05,
                0.03,
                0.01
            ],
            '7' => [
                0.6,
                0.4,
                0.3,
                0.08,
                0.07,
                0.06,
                0.05,
                0.03
            ],
            '8' => [
                0.6,
                0.5,
                0.4,
                0.06,
                0.05,
                0.04,
                0.03,
                0.02,
                0.01
            ],
            '9' => [
                0.6,
                0.5,
                0.4,
                0.08,
                0.07,
                0.06,
                0.05,
                0.04,
                0.03,
                0.02
            ],
            '10' => [
                0.6,
                0.5,
                0.3,
                0.09,
                0.07,
                0.065,
                0.06,
                0.05,
                0.03,
                0.02,
                0.01
            ],
            '11' => [
                0.6,
                0.5,
                0.4,
                0.11,
                0.1,
                0.09,
                0.08,
                0.06,
                0.05,
                0.03,
                0.025,
                0.02
            ],
            '12' => [
                0.8,
                0.7,
                0.6,
                0.13,
                0.11,
                0.091,
                0.08,
                0.07,
                0.06,
                0.05,
                0.03,
                0.02,
                0.01,
            ],
            '13' => [
                0.8,
                0.7,
                0.6,
                0.12,
                0.1,
                0.09,
                0.081,
                0.075,
                0.063,
                0.055,
                0.032,
                0.025,
                0.02,
                0.01
            ],
            '14' => [
                0.8,
                0.7,
                0.6,
                0.164,
                0.16,
                0.15,
                0.14,
                0.13,
                0.093,
                0.09,
                0.085,
                0.07,
                0.06,
                0.05,
                0.03
            ],
            '15' => [
                0.9,
                0.8,
                0.7,
                0.167,
                0.152,
                0.15,
                0.14,
                0.12,
                0.1,
                0.09,
                0.085,
                0.07,
                0.062,
                0.05,
                0.03,
                0.02
            ],
            '16' => [
                0.9,
                0.8,
                0.7,
                0.23,
                0.2,
                0.191,
                0.167,
                0.156,
                0.15,
                0.141,
                0.132,
                0.1,
                0.09,
                0.08,
                0.07,
                0.06,
                0.03
            ],
            '17' => [
                0.9,
                0.8,
                0.7,
                0.25,
                0.23,
                0.21,
                0.19,
                0.181,
                0.172,
                0.17,
                0.164,
                0.15,
                0.12,
                0.09,
                0.08,
                0.07,
                0.05,
                0.03
            ],
            '18' => [
                1,
                0.9,
                0.8,
                0.28,
                0.275,
                0.27,
                0.25,
                0.23,
                0.21,
                0.19,
                0.15,
                0.13,
                0.121,
                0.103,
                0.09,
                0.081,
                0.07,
                0.05,
                0.03
            ],
            '19' => [
                1,
                0.9,
                0.8,
                0.3,
                0.29,
                0.28,
                0.28,
                0.27,
                0.25,
                0.23,
                0.2,
                0.193,
                0.17,
                0.15,
                0.13,
                0.1,
                0.08,
                0.05,
                0.03,
                0.02
            ]
        ];
    }
}
