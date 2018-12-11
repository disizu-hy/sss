<?php 
namespace App\Http\Controllers\contact;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ContactController extends Controller{
	// 联系我们展示页面
	public function contactindex(){
		$data = DB::table('hy_homeuser')->paginate(2);
		return view('contact.contactindex',['data'=>$data]);
	}
	// 联系我们删除
	public function contact_del(){
		$id = $_GET['id'];
		$del = DB::table('hy_homeuser')->where('id',$id)->delete();
		if($del){
			// 删除成功
			return redirect('contactindex');
		}else{
			// 删除失败
			return "删除失败";
		}
	}
	// 联系我们批量删除
	     public function contactdeletes(){
        // 先获取id
        $id = $_GET['id'];
//        dump($_GET);die;
        // 拼接
        $str = explode(",",$id);
        // 循环str的数据
        foreach($str as $v){
            $del=DB::table('hy_homeuser')->where('id',"=","$v")->delete();
        }
        if($del){
        	// 删除成功后跳转到展示页面
            return redirect("contactindex");
        }else{
            return redirect("contactindex");
        }
    }
    // 联系我们添加
        public function contact_add(Request $request){
        	$rel = $request->all();
        	//获取表的后缀
			$file = $request->file('drcode');
			// 返回上传文件的扩展名称
			$ext = $file->getClientOriginalExtension();
			// 给图片一个时间+随机数前缀
			$filename=date('Y-m-dHis').rand(111111,999999).'.'.$ext;
			// 创建存图片目录
			$path =$file->move("./drcode/",$filename);
            
            $arr['contact']=$rel['contact'];
			$arr['drcode']="/".$filename;
			$arr['weixin_name']=$rel['weixin_name'];

			$data = DB::table('hy_homeuser')->insert($arr);
			if($data){
				return redirect("contactindex");
			}else{
				return "添加失败";
			}


        }

        // 联系我们搜索
        public function contactshow(){
        	$name = $_POST['wexin_name']; 
        	$info = DB::select("select * from hy_homeuser where weixin_name like '%{$name}%' ");
        	return view('contact.contactindex',['info'=>$info]);
        }
}


?>