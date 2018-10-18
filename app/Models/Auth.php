<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    //
    protected $table = 'auth';
    public $primaryKey = 'auth_id';
    public $timestamps = false;
    public $returns = [];

    //获取所有分类
    public function getAll(){
        return self::orderBy('pid', 'desc')->get()->toArray();
    }

    //将分类数据进行结构转换
    public function getCategoryTree() {
        $newArray = [];
        $data = $this->getAll();

        foreach ($data as $key=>$value) {
            $newArray[$value['auth_id']] = $value;
        }

        foreach ($newArray as $key=>$value) {
            if (isset($newArray[$value['pid']])) {
                $newArray[$value['pid']]['data'][] = $newArray[$key];
                unset($newArray[$key]);
            }
        }

        $this->lv($newArray);

        return $this->returns;
    }

    public function conversionArray() {
        $newArray = [];
        $data = $this->getAll();

        foreach ($data as $key=>$value) {
            $newArray[$value['auth_id']] = $value;
        }

        foreach ($newArray as $key=>$value) {
            if (isset($newArray[$value['pid']])) {
                $newArray[$value['pid']]['data'][] = $newArray[$key];
                unset($newArray[$key]);
            }
        }

        return $newArray;
    }

    public function lv($data, $i = 0){
        foreach ($data as $key=>$value) {
            $value['lv'] = $i;
            $newData = $value;

            unset($newData['data']);
            $this->returns[] = $newData;
            if (!empty($value['data'])){
                $this->lv($value['data'], $i+1);
            }
        }
    }

    //添加
    public function createOne($name, $route, $pid) {
        $this->name = $name;
        $this->route = $route;
        $this->pid = $pid;

        return $this->save();
    }

    //获取一条信息
    public function getOne($params = []) {
        if(isset($params[$this->primaryKey])){
            $data = self::find($params[$this->primaryKey]);
        }else{
            $data = self::where($params)->first();
        }

        if (!empty($data)) {
            return $data->toArray();
        }
        return [];
    }

    //删除
    public function deleteOne($auth_id){
        $model = self::find($auth_id);
        return $model->delete();
    }
}
