<?php

namespace App\Http\Controllers\Loginscontroller;

use App\Login\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Loginscontroller extends Controller
{
    public function logins(){
        $s = new Login();
        $s->register();
    }
    public function land(){
        $s=new Login();
        $s->land();
    }
    //邮箱验证
    public function youxiang(){
        $s=new  Login();
        $s->youxiang();
    }
}
