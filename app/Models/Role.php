<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'role';
    public $primaryKey = 'role_id';
    public $timestamps = false;

    //获取角色列表
    public function getRoleList() {
        return self::orderBy($this->primaryKey, 'desc')->paginate(20);
    }

    //添加角色
    public function createOne($name, $content) {
        $this->name = $name;
        $this->content = $content;
        $this->create_time = time();

        return $this->save();
    }

    //删除角色
    public function deleteOne($role_id){
        $model = self::find($role_id);
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

    //更新角色
    public function updateOne($id, $name, $content) {
        return self::where('role_id', $id)->update(['name' => $name, 'content' => $content]);
    }

    //获取所有角色
    public function getAll(){
        return self::orderBy('role_id', 'desc')->get()->toArray();
    }
}
