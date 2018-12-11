<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Login/Login');
});
//登陆注册页面
Route::any('/logins', function () {
    return view('Login/Login');
});
//注册
Route::any('/register','Loginscontroller\Loginscontroller@logins');
//登陆
Route::any('/land','Loginscontroller\Loginscontroller@land');
//邮箱激活
Route::any('/youxiang','Loginscontroller\Loginscontroller@youxiang');

//角色
//角色页面显示

Route::any('/role','Rolecontroller\RoleController@index');
Route::any('/role_add','Rolecontroller\RoleController@add');
Route::any('/del2','Rolecontroller\RoleController@del2');
Route::any('/del1','Rolecontroller\RoleController@del1');

Route::any('/update', function () {
    return view('Login/Login');
});
Route::any('/roleupdate','Rolecontroller\Rolecontroller@update');//修改页面
Route::any('/roleupdatee','Rolecontroller\Rolecontroller@updatee');//修改
Route::any('/code','Rolecontroller\Rolecontroller@code');//修改





//范志超
Route::any('/Admin_show','C\ViewController@show');
Route::any('/setup','C\ViewController@setup');//返回模块设置视图
Route::any('/css_setup','C\ViewController@css_setup');//返回样式模块设置视图
Route::any('/user_manager','C\ViewController@user_manager');//用户管理
Route::any('/adpicture','C\ViewController@adpicture');//轮播图管理
Route::any('/link','C\ViewController@link');//友情链接
Route::any('/updatepwd','C\ViewController@updatepwd');//个人中心修改密码

Route::any('/userdel','C\UserController@userdel');////用户删除
Route::any('/useradd','C\UserController@useradd');//用户添加
Route::any('/userupdate','C\UserController@userupdate');//修改页面
Route::any('/userupdatee','C\UserController@userupdatee');//修改数据

Route::any('/fileadd','C\UserController@fileadd');//轮播图
Route::any('/filedel','C\UserController@filedel');//轮播图删除
Route::any('/fileupdate','C\UserController@fileupdate');//用户批量删除
Route::any('/fileupdatee','C\UserController@fileupdatee');//用户批量删除

Route::any('/countdel','C\UserController@countdel');//用户批量删除
//--------------------------------------------------------------------------------------------------------

// 导航管理
Route::any('navindex',array('uses'=>"Nav\NavController@navindex"));
// 导航添加
Route::any('nav_insert',array('uses'=>"Nav\NavController@nav_insert"));
// 导航删除
Route::any('navdel',array('uses'=>"Nav\NavController@navdel"));
// 导航批量删除
Route::any('navdeletes',array('uses'=>"Nav\NavController@navdeletes"));
// 查询
Route::any('navshow',array('uses'=>"Nav\NavController@navshow"));


// 咨询管理页面
Route::any('consultindex',array('uses'=>"Consult\ConsultController@consultindex"));
// 批量删除
Route::any('consultdeletes',array('uses'=>"Consult\ConsultController@consultdeletes"));
// 咨询删除
Route::any('consult_del',array('uses'=>"Consult\ConsultController@consult_del"));
// 咨询添加
Route::any('consult_add',array('uses'=>"Consult\ConsultController@consult_add"));
// 咨询查找
Route::any('consultshow',array('uses'=>"Consult\ConsultController@consultshow"));


/*
 *直播分类管理
 *有增删改查  搜索 全选反选之类得
 */
// 直播分类管理显示
Route::any('videoindex',array('uses'=>"video\VideoController@videoindex"));
// 直播分类删除
Route::any('video_del',array('uses'=>"video\VideoController@video_del"));
// 直播分类搜索
Route::any('videoshow',array('uses'=>"video\VideoController@videoshow"));
// 直播分类批量删除
Route::any('videodeletes',array('uses'=>"video\VideoController@videodeletes"));
//直播分类添加
Route::any('video_add',array('uses'=>"video\VideoController@video_add"));


/*
 *联系我们管理
 *有增删改查  搜索 全选反选之类得
 */
// 联系我们页面显示
Route::any('contactindex',array('uses'=>"contact\ContactController@contactindex"));
// 联系我们删除
Route::any('contact_del',array('uses'=>"contact\ContactController@contact_del"));
// 联系我们批量删除
Route::any('contactdeletes',array('uses'=>"contact\ContactController@contactdeletes"));
// 联系我们添加
Route::any('contact_add',array('uses'=>"contact\ContactController@contact_add"));
// 联系我们搜索
Route::any('contactshow',array('uses'=>"contact\ContactController@contactshow"));