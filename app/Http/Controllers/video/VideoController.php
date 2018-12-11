<?php 
namespace App\Http\Controllers\video;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Video;

class VideoController extends Controller{
	// 直播分类显示
	public function videoindex(){
		$data =  Video::video();
		// print_r($data);die();
		return view('video.videoindex',['data'=>$data]);
	}
	// 直播分类批量删除
	     public function videodeletes(){
        // 先获取id
        $id = $_GET['id'];
//        dump($_GET);die;
        // 拼接
        $str = explode(",",$id);
        // 循环str的数据
        foreach($str as $v){
            $del=DB::table('hy_video')->where('id',"=","$v")->delete();
        }
        if($del){
        	// 删除成功后跳转到展示页面
            return redirect("videoindex");
        }else{
            return redirect("videoindex");
        }
    }
    //直播分类单条删除
    public function video_del(){
    	// 获取id
    	$id = $_GET['id'];
    	$del = DB::table('hy_video')->where('id',$id)->delete();
    	if($del){
    		// 删除成功跳转页面
    		return redirect('videoindex');
    	}else{
    		return redirect('videoindex');
    	}
    }
    // 搜索
    public function videoshow(){
    	$name = $_POST['video_name'];
    	// sql语句
    	$data = DB::select("select * from hy_video where video_name like '%{$name}%' ");
    	return view('video.videoindex',['data'=>$data]);
    }
    public $timestamps=true;
	public function getDateFormat(){
	return time();
	}
    // 添加
    public function video_add(Request $request){
		$data = $request->all();
		//获取表的后缀
		$file = $request->file('video_image');
		// 返回上传文件的扩展名称
		$ext = $file->getClientOriginalExtension();
		// 给图片一个时间+随机数前缀
		$filename=date('Y-m-dHis').rand(111111,999999).'.'.$ext;
		// 创建存图片目录
		$path =$file->move("./uploadss/",$filename);
		$arr['video_image']="/".$filename;
		$arr['video_name']=$data['video_name'];
		$arr['pid']=$data['pid'];
		$arr['video_date']=date('Y-m-d H:i:s');
		$arr['video_link']=$data['video_link'];
		$arr['sort']=$data['sort'];
		$info = DB::table('hy_video')->insert($arr);
		if($info){
			return redirect('videoindex');
		}
    }
}



?>