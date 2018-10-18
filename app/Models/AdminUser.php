<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    //
    protected $table = 'admin_user';
    protected $primaryKey = 'admin_user_id';
    public $timestamps = false;

    //根据id获取用户信息
    public function getOne($params){
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

    //修改用户密码
    public function upPassword($user_id, $newpassword) {
        $newpassword = md5($newpassword);
        return self::where('admin_user_id', $user_id)->update(['password' => $newpassword]);
    }

    //获取后台用户列表
    public function getUserList() {
        return self::where('role_id', '!=', 0)->orderBy('admin_user_id', 'desc')->paginate(20);
    }

    //创建用户
    public function createOne($nickname, $username, $password, $role_id) {
        $this->nickname = $nickname;
        $this->username = $username;
        $this->password = md5($password);
        $this->role_id = $role_id;
        $this->create_time = time();

        return $this->save();
    }

    public function updateOne($id, $nickname, $username, $role_id, $password = ''){
        if (!empty($password)) {
            $userInfo = ['nickname' => $nickname, 'username' => $username, 'role_id' => $role_id, 'password' => md5($password)];
        } else {
            $userInfo = ['nickname' => $nickname, 'username' => $username, 'role_id' => $role_id];
        }

        return self::where('admin_user_id', $id)->update($userInfo);
    }

    //删除用户
    public function deleteOne($id){
        $model = self::find($id);
        return $model->delete();
    }
}
