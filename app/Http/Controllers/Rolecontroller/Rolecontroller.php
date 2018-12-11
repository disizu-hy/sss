<?php

namespace App\Http\Controllers\Rolecontroller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role\Role;
use Illuminate\Support\Facades\DB;

class Rolecontroller extends Controller
{
    public function index(){
        $list=DB::select("select * from hy_role");
       // print_r($list);die;
        return view('Role/Role',['list'=>$list]);
    }
    public function add(){
        $s = new Role();
        $s->add();
    }
    public function del1(){
        $s = new Role();
        $s->del1();
    }
    public function del2(){
        $s = new Role();
        $s->del2();
    }
    public function update(){
        $list=$_GET;
        return view('Role/update',['list'=>$list]);
    }
    public function updatee(){
        $id = $_POST['id'];
        $name=$_POST['name'];
        $sql = DB::update("update hy_role set name='{$name}' where rid={$id}");
        if($sql){
            echo "<script>alert('修改成功')</script>";
            echo "<script>window.location.href='/role'</script>";
        }
    }
    public function code(){
        $s=new Role();
        $list= $s->scerweima1('http://sss.haoyunyun.cn');
        print_r($list);die;

    }
}
