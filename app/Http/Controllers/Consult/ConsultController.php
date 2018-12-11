<?php 
namespace App\Http\Controllers\consult;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Consult;

class ConsultController extends Controller{
	// 展示页面
	public function consultindex(){
		$data = DB::table("hy_newlist")->paginate(6);
		return view('Consult.consultindex',['data'=>$data]);
	}
		  // 批量删除
     public function consultdeletes(){
        // 先获取id
        $id = $_GET['id'];
//        dump($_GET);die;
        // 拼接
        $str = explode(",",$id);
        // 循环str的数据
        foreach($str as $v){
            $del=DB::table('hy_newlist')->where('id',"=","$v")->delete();
        }
        if($del){
        	// 删除成功后跳转到展示页面
            return redirect("consultindex");
        }else{
            return redirect("consultindex");
        }
    }
    // 咨询删除
    public function consult_del(){
    	$id = $_GET['id'];
    	$data = DB::table('hy_newlist')->where('id',$id)->delete();
    	if($data){
    		return redirect('consultindex');
    	}else{
    		return "删除失败";
    	}
    }
    // 添加
    public function consult_add(Request $request){
    	$info = $request->all();
    	// print_r($info);die();
    	// 调取模型静态添加方法
    	$data = Consult::add($info);
    	if($data){
    		// 添加成功
    		return redirect("consultindex");
    	}else{
    		// 添加失败
    		return redirect("consult_add");
    	}
    }
    // 查询
    public function consultshow(){
    	// 获取name值
    	$name = $_POST["con_titil"];
    	// 模糊查询
    	$info = DB::select("select * from hy_newlist where con_titil like '%{$name}%' ");
    	// var_dump($data);die();
    	return view('Consult.consultindex',['info'=>$info]);

    }
}



?>