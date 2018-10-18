<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Notice;
//use Illuminate\Support\Facades\Redis;


class HomeController extends BaseController
{
    public function __construct(){
        parent::__construct();
        

    }
    /**
     * 隐私条款
     */
    public function index()
    {
        $data = [];
        // $value = $_GET['value'];
        // $cacheKey = 'test_key';
        // $row = Redis::get($cacheKey);

        // var_dump($row);
        // Redis::set($cacheKey,$value);
        


        return view('frontend.home', ['data' => $data]);
    }
}
