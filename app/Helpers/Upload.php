<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Storage;

class Upload{
    public function uploadImage($file){
        $status= ['code' => 0, 'msg' => 'Success'];

        $originalName = $file->getClientOriginalName(); // 文件原名

        $tmp = explode('.', $originalName);
        $suffix = end($tmp);

        $tim = time();
        $path = '/'.date('Y', $tim).'/'.date('m', $tim).'/'.date('d', $tim).'/'.md5($originalName).'.'.$suffix;

        $s3 = \Storage::disk('s3');

        $configs = config('params.api');
        if (!$s3->exists($path)) {
            $res = $s3->put($path, file_get_contents($file), 'public');
            if (!empty($res)) {
                $status['filePath'] = $path;
                $status['viewPath'] = $configs['aws']['image_uri'].$path;
                return $status;
            } else {
                $status = ['code' => 500, 'msg' => 'Fail'];
                return $status;
            }
        }

        $status['filePath'] = $path;
        $status['viewPath'] = $configs['aws']['image_uri'].$path;
        return $status;
    }
}