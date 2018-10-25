<?php

namespace App\Http\Controllers\Home\FriendsLink;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入redis类
use Illuminate\Support\Facades\Redis;
use DB;

class FriendsLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //查询审核通过并上架的友情链接遍历显示到前台
    public function index()
    {
        // $cates = self::getCatesByPid(0);
        $userinfo = DB::table("mall_home_userinfo")->where('uid','=',session('uid'))->first();
        //获取上架的友情链接
        // $data = DB::table('mall_flink')->where('status','=',1)->where('display','=',1)->get();

        $arr = ['cates','friendslinks'];
        // 遍历数组
        foreach($arr as $k => $v){
            // 判断redis中是否存在当前键值的值
            if(Redis::exists($v[$k])){
                //如果存在,取出反序列化
                $$v[$k] = Redis::get($v[$k]);
                $$v[$k] = unserialize($$v[$k]);
            }else{
                //如果不存在,序列化成字符串后存进redis
                $cates = self::getCatesByPid(0);
                $friendslinks = DB::table('mall_flink')->where('status','=',1)->where('display','=',1)->get();
                Redis::setex('cates',300,serialize($cates));
                Redis::setex('friendslinks',300,serialize($friendslinks));
            }
        }

        //加载友情链接模板 分配数据
        return view("Home.FriendsLink.index",["cates"=>$cates,'friendslinks'=>$friendslinks,'userinfo'=>$userinfo]);
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

    //Ajax校验申请友情链接的 链接名 URL 电话
    public function verifyflink(Request $request){

        //获取Ajax传递过来的链接名
        $lname = $request->input('lname');
        //获取Ajax传递过来的URL
        $lurl = $request->input('lurl');
        //获取Ajax传递过来的联系电话
        $phone = $request->input('phone');
        //查询数据库判断链接名是否存在
        if(DB::table('mall_flink')->where('lname','=',$lname)->count() > 0){

            echo 1;
        }
        //查询数据库判断URL是否存在
        if(DB::table('mall_flink')->where('lurl','=',$lurl)->count() > 0){

            echo 2;
        }
        //查询数据库判断联系电话是否存在
        if(DB::table('mall_flink')->where('phone','=',$phone)->count() > 0){

            echo 3;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //前台申请友情链接插入数据库
    public function store(Request $request)
    {

        //获取数据
        $arr = $request->except("_token");
        //将数据添加到数据库
        if(DB::table('mall_flink')->insert($arr)){

            return redirect('/friendslinks')->with('success','申请成功,请等待审核!');
        }else{

            return redirect('/friendslinks')->with('error','申请失败,请联系客服!');
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
