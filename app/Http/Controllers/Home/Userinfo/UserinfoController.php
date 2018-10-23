<?php

namespace App\Http\Controllers\Home\Userinfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入DB类
use DB;

class UserinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //加载添加个人信息模板
    public function index()
    {
        //查询分配公共导航栏分类数据
        $cates = self::getCatesByPid(0);

        //根据session('uid')获取用户详情
        if(DB::table('mall_home_userinfo')->where('uid','=',session('uid'))->first()){

            //获取用户详情
            $userinfo = DB::table('mall_home_userinfo')->where('uid','=',session('uid'))->first();
            // var_dump($data);
            //加载用户性情模板传递数据
            return view('Home.Userinfo.edit',['cates'=>$cates,'userinfo'=>$userinfo]);
        }else{

            //该用户没有用户详情数据,加载添加用户详情模板

            return view("Home.Userinfo.add",['cates'=>$cates]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 用户添加个人信息
    public function store(Request $request)
    {
        //获取用户输入的数据
        $arr = $request->except('_token');
        //用户uid
        $arr['uid'] = session('uid');
        //用户会员等级默认为1级
        $arr['level'] = 1;
        //用户头像默认地址
        $arr['pic'] = '/static/assets/images/account/default.png';
        //将数据插入数据库
        if(DB::table('mall_home_userinfo')->insert($arr)){

            return back()->with('success','保存成功!');
        }else{

            return back()->with('error','保存失败!');
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
    //用户修改个人信息
    public function update(Request $request, $id)
    {
        //接收用户修改信息
        $arr = $request->except('_token','_method');
        //修改用户信息
        if(DB::table('mall_home_userinfo')->where('uid','=',session('uid'))->update($arr)){
            //同时修改用户表的邮箱
            DB::table("mall_home_users")->where('id','=',session('uid'))->update(['email'=>$arr['email'],'phone'=>$arr['telphone']]);
            return back()->with('success','修改成功!');
        }else{

            return back()->with('error','修改失败!');
        }
    }

    //加载用户修改头像模板
    public function editPic()
    {   
        //根据用户uid查询用户详情
        $userinfo = DB::table('mall_home_userinfo')->where('uid','=',session('uid'))->first();
        //判断该用户是否有用户详情
        if($userinfo){

            //查询用户原有头像
            $pic = $userinfo->pic;
            //加载修改头像模板
            return view("Home.Userinfo.pic",['userinfo'=>$userinfo]);
        }else{

            //用户uid
            $arr['uid'] = session('uid');
            //用户头像默认地址
            $arr['pic'] = '/static/assets/images/account/default.png';

            //添加用户详情
            if(DB::table('mall_home_userinfo')->insert($arr)){

                //查询用户原有头像
                $userinfo = DB::table('mall_home_userinfo')->where('uid','=',session('uid'))->first();
                //加载修改头像模板
                return view("Home.Userinfo.pic",['userinfo'=>$userinfo]);
            }else{

                return back();
            }
        }
        
    }

    //用户修改头像
    public function updatePic(Request $request)
    {

        //查询用户信息
        $userinfo = DB::table('mall_home_userinfo')->where('uid','=',session('uid'))->first();

        //判断是否有文件上传
        if($request->hasFile('avatar')){

            //初始化上传文件名字
            $name = date('Ymd',time()).rand(00001,99999);
            //获取上传文件后缀
            $ext = $request->file('avatar')->getClientOriginalExtension();
            //拼接上传文件最终存储路径
            $truepath = "./avatar/".date('Y-m-d')."/".$name.".".$ext;
            //判断原有路径是否等于默认头像路径
            if($userinfo->pic == '/static/assets/images/account/default.png'){

                //用户只有默认头像,这是第一次上传
                //将上传文件移动到指定目录下
                $request->file('avatar')->move("./avatar/".date('Y-m-d')."/",$name.".".$ext);
                //更新数据库头像路径
                if(DB::table('mall_home_userinfo')->where('uid','=',session('uid'))->update(['pic'=>$truepath])){

                    return redirect('/homeuserinfo')->with('success','头像修改成功!');
                }else{

                    return back()->with('error','头像修改失败!');
                    
                }
            }else{

                //用户曾经上传过头像,删除原有头像
                if(unlink($userinfo->pic)){

                    //原有图像删除成功,将上传文件移动到指定目录下
                    $request->file('avatar')->move("./avatar/".date('Y-m-d')."/",$name.".".$ext);
                    //更新数据库头像路径
                    if(DB::table('mall_home_userinfo')->where('uid','=',session('uid'))->update(['pic'=>$truepath])){

                        return redirect('/homeuserinfo')->with('success','头像修改成功!');
                    }else{

                        return back()->with('error','头像修改失败!');
                        
                    }
                }else{

                    return back()->with('error','头像修改失败!');
                }

            }
            
        }else{

            // 没有图片上传
            return back();
        }
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

    //无限分类递归数据遍历
    public static function getCatesByPid($pid){

        $res = DB::table("mall_cates")->where("pid",'=',$pid)->get();
        $data = [];
        //遍历
        foreach($res as $key => $value){
            //获取父类的子类信息
            $value->dev = self::getCatesByPid($value->id);
            $data[] = $value;
        }
        return $data;
    }
}
