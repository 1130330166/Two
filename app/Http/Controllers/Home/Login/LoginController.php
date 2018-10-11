<?php

namespace App\Http\Controllers\Home\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入DB类
use DB;
//导入Hash类
use Hash;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Home.Login.Login");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
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

    //登录模块
    public function check(Request $request)
    {
    	// echo 1;
        //获取传递过来的name
    	$name = $request->name;
        //获取传递过来的pass
    	$pass = $request->pass;
        //查询数据库的username有没有叫传递过来的登录名
    	$arr = DB::table('mall_home_users')->where('username','=',$name)->first();
    	if($arr == ''){
    		return 2;
    	}else{
            //通过Hash给传递过来密码加密再比对数据库里的密码
    		if(Hash::check($pass,$arr->password)){
                //把登录名存进session
                session(['name'=>$name]);
    			return 1;
    		}else{
    			return 2;
    		}
    	}	
    }

    //注册模块
    public function register(Request $request){
        //获取传递过来的除了Phone的值
        $result = $request->except('phone');
        //获取传递过来的username
        $arr = $request->input('username');
        //查询username字段的值
        $data = DB::table('mall_home_users')->pluck('username');
        //遍历
        foreach($data as $v){
            $atr[] = $v;
        }
        //设置状态为开启
        $result['status'] = 1;
        //设置Token
        $result['token'] = rand(1000,100000)+time();
        //给传递过来的密码Hash加密
        $result['password'] = Hash::make($result['password']);
        // dd($data);
        // dd($arr);
        // dd($atr);
        // dd($result);
        
        if(!empty($atr)){
            // 判断有没有用户注册了这个用户名
            if(in_array($arr,$atr)){
                return 1;
            }
        }

        //把传递过来的值存进数据库
        if(DB::table('mall_home_users')->insert($result)){
            return 2;
        }
    }

    //登出模块
    public function logout(Request $request){
        //删除session值
        $request->session()->pull('name');
        // 跳转到主页
        return redirect("/");
    }
}
