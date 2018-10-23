<?php

namespace App\Http\Controllers\Home\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入DB类
use DB;
//导入Hash类
use Hash;
//导入Mail
use Mail;
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
                session(['username'=>$name,'uid'=>$arr->id]);
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
        $username = $request->input('username');
        //获取传递过来的email
        $email = $request->input('email');
        //获取传递过来的phone
        $phone = $request->input('phone');
        //查询username字段的值
        $data1 = DB::table('mall_home_users')->pluck('username');
        //查询email字段
        $data2 = DB::table('mall_home_users')->pluck('email');
        //查询phone字段
        $data3 = DB::table('mall_home_users')->pluck('phone');

        //遍历
        foreach($data1 as $v){
            $atr1[] = $v;
        }
        foreach($data2 as $v){
            $atr2[] = $v;
        }
        foreach($data3 as $v){
            $atr3[] = $v;
        }
        //设置状态为开启
        $result['status'] = 1;
        //设置Token
        $result['token'] = rand(1000,100000)+time();
        //给传递过来的密码Hash加密
        $result['password'] = Hash::make($result['password']);
        //设置电话
        $result['phone'] = $phone;
        // dd($data);
        // dd($atr1);
        // dd($atr2);
        // dd($atr3);
        // dd($result);
        
        if(!empty($atr1)){
            // 判断有没有用户注册了这个用户名
            if(in_array($username,$atr1)){
                return 1;
            }
        }
        if(!empty($atr2)){
            //判断用户有没有注册这个邮箱
            if(in_array($email,$atr2)){
                return 3;
            }
        }
        if(!empty($atr3)){
            //判断用户有没有注册这个邮箱
            if(in_array($phone,$atr3)){
                return 4;
            }
        }

        //把传递过来的值存进数据库
        if(DB::table('mall_home_users')->insert($result)){
            $user = DB::table('mall_home_users')->where('username','=',$username)->first();
            $info['uid'] = $user->id;
            $info['email'] = $result['email'];
            $info['telphone'] = $result['phone'];
            $info['pic'] = "/static/assets/images/account/default.png";
            // var_dump($info);exit;
            if(DB::table('mall_home_userinfo')->insert($info)){
                return 2;
            }
        }
    }

    //登出模块
    public function logout(Request $request){
        //删除session值
        $request->session()->pull('username');
        $request->session()->pull('uid');
        // 跳转到主页
        return redirect("/");
    }

    //注册验证码模块
    public function code(Request $request){
        // var_dump($request->all());exit;
        $phone = $request->input('phone');
        $json = message($phone);
    }

    //验证验证码
    public function test(Request $request){
        if($request->session()->has('code')){
            return session('code');
        }
    }

    //忘记密码电话验证码
    public function forget(){
        return view('Home.Forget.index');
    }

    //忘记密码验证码模块
    public function fgcode(Request $request){
        // var_dump($request->all());exit;
        $phone = $request->input('phone');
        $json = message($phone);
    }

    //验证验证码
    public function fgtest(Request $request){
        if($request->session()->has('code')){
            return session('code');
        }
    }

    //密码修改首页
    public function change(Request $request){
        // var_dump($request->all());exit;
        $phone = $request->input('phone');
        // var_dump($phone);exit;
        session(['phone'=>$phone]);
        return view('Home.Forget.edit');
    }

    public function operation(Request $request){
        $pass = $request->all('password');
        $phone = session('phone');
        // var_dump($phone);exit;
        $list = DB::table('mall_home_users')->where('phone','=',$phone)->first();
        // var_dump($list);
        // var_dump($pass);exit;
        $id = $list->id;
        $result['password'] = Hash::make($pass['password']);
        // var_dump($result);
        if(DB::table('mall_home_users')->where('id','=',$id)->update($result)){
            $request->session()->pull('phone');
            return redirect("/login");
        }
    }

    public function email(){
        return view('Home.Register.index');
    }

    public function send(Request $request){
        // var_dump($request->all());exit;
        $email = $request->input('email');
        session(['email'=>$email]);
        Mail::send('Home.Register.a',['email'=>$email],function($message)use($email){
            $message->subject('用户激活');
            $message->to($email);
        });
        return view('Home.Register.send');
    }
    

    public function xiugai(){
        return view('Home.Register.edit');
    }

    public function xiugaicaozuo(Request $request){
        $pass = $request->all('password');
        $email = session('email');
        // var_dump($email);exit;
        $list = DB::table('mall_home_users')->where('email','=',$email)->first();
        // var_dump($list);exit;
        // var_dump($pass);exit;
        $id = $list->id;
        $result['password'] = Hash::make($pass['password']);
        // var_dump($result);
        if(DB::table('mall_home_users')->where('id','=',$id)->update($result)){
            $request->session()->pull('email');
            return redirect("/login");
        }
    }
}
