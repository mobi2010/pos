<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public $primaryKey = 'product_id';
    public $timestamps = false;

    //获取列表
    public function getList($where = []) {
        return self::where($where)->orderBy($this->primaryKey, 'desc')->paginate(20);
    }

    //添加
    public function createOne($data) {
        $this->name = $data['name'];
        $this->rate = $data['rate'];
        $this->duration = $data['duration'];
        $this->create_time = time();

        return $this->save();
    }

    //删除
    public function deleteOne($product_id){
        $model = self::find($product_id);
        return $model->delete();
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

    //更新
    public function updateOne($primaryKey, $data) {
        return self::where('product_id', $primaryKey)->update($data);
    }
}
