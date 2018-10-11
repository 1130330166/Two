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
// 后台首页
Route::resource("/admin","Admin\Admin\AdminController");
// 后台管理员模块
Route::resource("/adminuser","Admin\User\UserController");
// 分类管理
Route::resource("/admincate","Admin\Cate\CateController");