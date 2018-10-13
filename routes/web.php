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

// Route::get('/', function () {
//     return view('welcome');
// });
//中间件结合路由组使用
Route::group(["middleware"=>"login"],function(){
	//购物车
	//订单
	//订单详情
	//个人信息
	//结算页
	//支付接口
	//短信接口
	//忘记密码
	//地址
});
//前台首页
Route::resource("/","Home\Index\IndexController");
//前台登录
Route::resource("login","Home\Login\LoginController");
//前台登录处理
Route::get("check","Home\Login\LoginController@check");
//前台注册处理
Route::get("register","Home\Login\LoginController@register");
//前台注销
Route::get("logout","Home\Login\LoginController@logout");

//前台友情链接
Route::resource('/friendslinks',"Home\FriendsLink\FriendsLinkController");
//前台Ajax校验友情链接名 URL 联系电话是否唯一
Route::get("/verifyflink","Home\FriendsLink\FriendsLinkController@verifyflink");

// ---------------前后台路由分割线--------------------

// 后台登录退出
Route::resource("/adminlogin","Admin\Admin\AdminLoginController");
// 登录结合中间件
Route::group(['middleware'=>'adminlogin'],function(){
	// 后台首页
	Route::resource("/admin","Admin\Admin\AdminController");
	// 后台会员模块
	Route::resource("/adminuser","Admin\User\UserController");
	// 分类管理
	Route::resource("/admincate","Admin\Cate\CateController");

	//后台友情链接
	Route::resource("/friendslink","Admin\FriendsLink\FriendsLinkController");
	//后台未审核状态的友情链接
	Route::get('/friendslinknoverify','Admin\FriendsLink\FriendsLinkController@adminFlink');
	//后台删除已审核的链接
	Route::get('/friendslinkDelVerifyPass/{id}','Admin\FriendsLink\FriendsLinkController@destroyPass');

	// 管理员管理
	Route::resource("/adminusers","Admin\Admin\AdminuserController");
	// 分配角色
	Route::get("/adminrole/{id}","Admin\Admin\AdminuserController@rolelist");
	// 保存角色
	Route::post("/saverole","Admin\Admin\AdminuserController@saverole");
	// 角色管理表
	Route::resource("/adminrolelist","Admin\Admin\RolelistController");
	// 分配权限
	Route::get("/auth/{id}","Admin\Admin\RolelistController@auth");
	// 保存权限
	Route::post("/saveauth","Admin\Admin\RolelistController@saveauth");
	// 权限管理
	Route::resource("nodelist","Admin\Admin\NodelistController");
	//广告管理
	Route::resource("/guanggao","Admin\GuangGao\GuangGaoController");
	//广告Aajx修改状态
	Route::get("/demo","Admin\GuangGao\GuangGaoController@ajax");
	//轮播图管理
	Route::resource("/lunbo","Admin\Carousel\CarouselController");
	//轮播图Aajx修改状态
	Route::get("/edit","Admin\Carousel\CarouselController@ajax");
});