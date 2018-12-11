<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Video extends Model{
	public static function video(){
		$info = DB::table("hy_video")->get();
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
}


?>