<?php

namespace App\Login;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Login extends Model
{
    //注册
    public function register(){
        $all = request()->all();
        $tel = $all['tel'];
        $tel1="/^1[34578]\d{9}$/";
        if(!preg_match("/^1[34578]\d{9}$/", $tel)){
            echo "<script>alert('手机号格式不正确')</script>";
            echo "<script>window.location.href='/logins'</script>";
        }
        $email = $all['Email'];
        if(!preg_match("/^[a-z0-9]+([._-][a-z0-9]+)*@([0-9a-z]+\.[a-z]{2,14}(\.[a-z]{2})?)$/i", $email)){
            echo "<script>alert('邮箱格式不正确')</script>";
            echo "<script>window.location.href='/logins'</script>";
        }
        $pwd = $all['Password'];
        if(!preg_match("/^[a-zA-Z\d_]{8,}$/", $pwd)){
            echo "<script>alert('密码格式不正确')</script>";
            echo "<script>window.location.href='/logins'</script>";
        }
        $sql = DB::table('hy_user')->where('tel',$tel)->first();
        if(!empty($sql)){
            echo "<script>alert('该用户已存在')</script>";
            echo "<script>window.location.href='/logins'</script>";
        }

        $new_pwd = md5($pwd);
        $name = rand(11111,99999);
        $time=date('Y-m-d H:i:s',time());
        $data = [
            'tel'=>$tel,
            'email'=>$email,
            'password'=>$new_pwd,
            'name'=>$name,
            'sex'=>0,
            'time'=>$time,
            'email_stat'=>0,
            'image'=>'https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=1394969417,3934508970&fm=27&gp=0.jpg',
            'type'=>'账号',
            'fans'=>0,
        ];
        $sql = DB::table('hy_user')->insert($data);
        if($sql){
            $url = request()->url();

            Mail::send('Login/Email',['list'=>$email],function ($s){

               //from  里面填写邮件的名称  以及你的邮箱
                $s->from('19832193815@163.com','孙赛赛');
                //邮箱标题
                $s->subject('孙赛赛著');
                //获取来的email值
                $s->to($_POST['Email']);
            });
           // print_r($_POST['Email']);die;
            echo "<script>alert('已发送至您的邮箱')</script>";
            echo "<script>window.location.href='/logins'</script>";
        }
    }
    //邮箱验证
    public function youxiang(){
        $email=$_GET['email'];
        $sql = DB::update("update hy_user set email_stat=1 where email='{$email}'");
        if($sql){
            echo "<script>alert('您已经可以登陆')</script>";
            echo "<script>window.location.href='/logins'</script>";
        }
    }
    //登陆
    public function land(){
        $all=request()->all();
        $tel = $all['tel'];
        $pwd = md5($all['Password']);
        $sql =DB::table('hy_user')->where('tel',$tel)->select('password','email_stat')->first();
        $pwd1=$sql->password;
        $stat=$sql->email_stat;
        if($pwd!=$pwd1){
            echo "<script>alert('密码错误')</script>";
            echo "<script>window.location.href='/logins'</script>";
        }else{
            if($stat==0){
                echo "<script>alert('对不起你的账号没有激活')</script>";
                echo "<script>window.location.href='/logins'</script>";
            }
            echo "<script>alert('恭喜你登陆成功')</script>";
            echo "<script>window.location.href='/Admin_show'</script>";
        }

    }
}
