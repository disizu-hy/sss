<?php 
namespace App\Http\Controllers\Nav;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Nav;

class NavController extends Controller{
	// 导航展示
	public function navindex(){
		$data =  Nav::showNav();
		// print_r($data);die();
		return view('Nav/navindex',['data'=>$data]);
	}
	// 导航添加
	public function nav_insert(Request $request){
		// 获取表单全部数据
		$data = $request->all();
		$info = Nav::anvadd($data);
		if($info){
			// 请求成功后
			return redirect('navindex');
		}else{
			return redirect('nav_insert');
		}
	}
	// 导航删除
	public function navdel(){
		// 获取id
		$id = $_GET['id'];
		$delete = DB::table('hy_privileges')->where('id',$id)->delete();
		if($delete){
			// 删除成功跳转页面
			return redirect('navindex');
		}else{
			// 删除失败
			return "删除失败";
		}
	}
	  // 批量删除
     public function navdeletes(){
        // 先获取id
        $id = $_GET['id'];
//        dump($_GET);die;
        // 拼接
        $str = explode(",",$id);
        // 循环str的数据
        foreach($str as $v){
            $del=DB::table('hy_privileges')->where('id',"=","$v")->delete();
        }
        if($del){
        	// 删除成功后跳转到展示页面
            return redirect("navindex");
        }else{
            return redirect("navindex");
        }
    }
    // 查询
    public function navshow(){
    	$name = $_POST['nav_name'];
        // 使用模糊查询
        $data =DB::select("select * from hy_privileges where nav_name like '%{$name}%' ");
        return view('Nav.navindex',['data'=>$data]);
        
    }
}


?>