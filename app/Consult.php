<?php 
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Consult extends Model{
	public $timestamps=true;
	public function getDateFormat(){
	return time();
	}
	// 静态添加方法
	public static function add($rel){
		$arr['type_status']=$rel['type_status'];
		$arr['con_titil']=$rel['con_titil'];
		$arr['con_date']=date('Y-m-d H:i:s');
		$arr['con_status']=$rel['con_status'];
		$arr['con_text']=$rel['con_text'];
		$data = DB::table("hy_newlist")->insert($arr);
		return $data;
	}
}


?>