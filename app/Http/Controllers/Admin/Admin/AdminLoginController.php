<?php

namespace App\Http\Controllers\Admin\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //执行退出
        // 销毁session
        $request->session()->pull('name');
        // 跳转
        return redirect("/adminlogin/create");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载登录模版
        return view("Admin.Adminlogin.login");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // post方式获取表单
    public function store(Request $request)
    {
        //获取数据
        // dd($request->all());
        // 获取登录的管理员
        $name=$request->input('name');
        $password=$request->input('password');
        // 检测用户名
        $info=DB::table("mall_admin_users")->where("name",'=',$name)->first();
        // dd($info);die;
        if($info){
            // echo "ok";
            // 检测密码
        if(Hash::check($password,$info->password)){
                // echo "ok";
            // 将后台登录信息存储到session里面
            session(['name'=>$name]);
            // 1.获取当前登录的信息存储在session里面
            $list=DB::select("select * from mall_user_role as ur,mall_role_node as rn,mall_node as n where ur.rid=rn.rid and rn.nid=n.id and uid={$info->id}");
            // echo "<pre>";
            // var_dump($list);die;
            // 2.初始化权限 让所有管理员都有一个公共权限(访问后台首页)
            $nodelist['AdminController'][]="index";
            // 遍历
            foreach($list as $key=>$value){
                $nodelist[$value->mname][]=$value->aname;
                if($value->aname=="create"){
                    $nodelist[$value->mname][]="store";
                }
                if($value->aname=="edit"){
                    $nodelist[$value->mname][]="update";
                }
            }
            // echo "<pre>";
            // var_dump($nodelist);die;
            // 3.把所有的权限信息存储在session里面
            session(['nodelist'=>$nodelist]);
            // 4.获取访问模块的控制器和方法和权限列表作对比
            // 跳转到后台首页=>写在中间件里面
            return redirect("/admin")->with('success','登录成功');
            }else{
                return back()->with('error',' : 密码有误');
            }
        }else{
            return back()->with('error',' : 用户名有误');
        }
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
