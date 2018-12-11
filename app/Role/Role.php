<?php

namespace App\Role;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use QRcode;

class Role extends Model
{
    public function add(){
        $name=$_POST['name'];

        $time=$_POST['time'];
        if(!preg_match("/^[a-zA-Z\d_]{8,}$/", $name)){
            echo "<script>alert('用户名格式不正确')</script>";
            echo "<script>window.location.href='/role'</script>";
        }
        if(!preg_match("/^[a-zA-Z\d_]{8,}$/", $_POST['pwd'])){
            echo "<script>alert('密码格式不正确')</script>";
            echo "<script>window.location.href='/role'</script>";
        }
        $pwd=md5($_POST['pwd']);
        $sql=DB::insert("insert into hy_role values(null,'{$name}','{$pwd}','{$time}',0)");
        if($sql){
            echo "<script>alert('添加成功')</script>";
            echo "<script>window.location.href='/role'</script>";
        }
    }
    public function del2(){
        $id=rtrim($_POST['id'],',');
        $sql=DB::delete("delete from hy_role where rid in($id)");
        if($sql){
            echo "<script>alert('删除成功')</script>";
            echo "<script>window.location.href='/role'</script>";
        }
    }
    public function del1(){
        $sql=DB::table('hy_role')->where('rid',$_GET['id'])->delete();
        if($sql){
            echo "<script>alert('删除成功')</script>";
            echo "<script>window.location.href='/role'</script>";
        }
    }
//2. 在生成的二维码中加上logo(生成图片文件)
    function scerweima1($url=''){
        require_once 'phpqrcode.php';
        $value = $url;         //二维码内容
        $errorCorrectionLevel = 'H';  //容错级别
        $matrixPointSize = 6;      //生成图片大小
        //生成二维码图片
        $filename = 'image/'.microtime().'.png';
        QRcode::png($value,$filename , $errorCorrectionLevel, $matrixPointSize, 2);
        $logo = "image/i2.png"; //准备好的logo图片
        $QR = $filename;      //已经生成的原始二维码图
        if (file_exists($logo)) {
            $QR = imagecreatefromstring(file_get_contents($QR));    //目标图象连接资源。
            $logo = imagecreatefromstring(file_get_contents($logo));  //源图象连接资源。
            $QR_width = imagesx($QR);      //二维码图片宽度
            $QR_height = imagesy($QR);     //二维码图片高度
            $logo_width = imagesx($logo);    //logo图片宽度
            $logo_height = imagesy($logo);   //logo图片高度
            $logo_qr_width = $QR_width / 4;   //组合之后logo的宽度(占二维码的1/5)
            $scale = $logo_width/$logo_qr_width;  //logo的宽度缩放比(本身宽度/组合后的宽度)
            $logo_qr_height = $logo_height/$scale; //组合之后logo的高度
            $from_width = ($QR_width - $logo_qr_width) / 2;  //组合之后logo左上角所在坐标点
            //重新组合图片并调整大小
            /*
             * imagecopyresampled() 将一幅图像(源图象)中的一块正方形区域拷贝到另一个图像中
             */
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,$logo_qr_height, $logo_width, $logo_height);
        }
        //输出图片
        imagepng($QR, 'qrcode.png');
        imagedestroy($QR);
        imagedestroy($logo);
        return '<img src="qrcode.png" alt="使用微信扫描支付">';
    }




}
//调用查看结果
/*echo scerweima1("sss.haoyunyun.cn");*/