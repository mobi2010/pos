<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Notice;



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
        return view('frontend.home', ['data' => $data]);
    }
}
