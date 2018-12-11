<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Nav extends Model{
	public static function showNav(){
		$info = DB::table("hy_privileges")->get();
		//print_r($info);die();

		// 递归调用 自己调用自己
		$result = self::list_level($info,$pid=0,$level=0);
		 // print_r($result);die();
		return $result;
	}
	// 写一个提供无限极分类调取得方法
	public static function list_level($info,$pid,$level){
		//静态定义一个数组
		static $array=array();
		// 循环
		foreach($info as $k => $v){
			if($pid==$v->pid){
				$v->level=$level;
				$array[]=$v;
				self::list_level($info,$v->id,$level+1);
			}
			
		}
		return $array;
	}
	// 添加方法
	public static function anvadd($rel){
		$arr['nav_name']=$rel['nav_name'];
		$arr['pid']=$rel['pid'];
		$arr['nav_link']=$rel['nav_link'];
		$info = DB::table('hy_privileges')->insert($arr);
		return $info;
	}
}

?>