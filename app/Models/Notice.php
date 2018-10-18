<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    /**
     * @var string
     */
    protected $table = 'notice';

    /**
     * @var string
     */
    protected $primaryKey = 'notice_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * 获取一条记录
     *
     */
    public function getOne($params=[]){
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

    //获取多条信息
    public function getMore($params = []){
        $data = self::where($params)->orderBy($this->primaryKey,'desc')->get();
        if (!empty($data)) {
            return $data->toArray();
        }
        return [];
    }

    //创建
    public function createOne($data) {
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->video_url = $data['video_url'];
        $this->image_url = $data['image_url'];
        $this->create_time = time();

        $this->save();
        return $this->notice_id;
    }

    //更新
    public function updateOne($notice_id, $data){
        return self::where($this->primaryKey, $notice_id)->update($data);
    }

    //获取列表
    public function getList($pageSize = 20) {
        return self::orderBy($this->primaryKey, 'desc')->paginate($pageSize);
    }

    //删除
    public function deleteOne($notice_id){
        $model = self::find($notice_id);
        return $model->delete();
    }
}
