<?php

namespace App\Http\Controllers\Admin\Review;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 此处运用ajax分页
        //加载后台评论模版并获取台用户评论的数据
        $tot=DB::table("mall_review")->count();
        // 规定每页显示的数据条数
        $rev=4;
        // 获取总页数
        $maxpage=ceil($tot/$rev);
        // echo $maxpage;
        // 获取参数page
        $page=$request->input('page');
        // echo $page;
        // 判断$page是否为空赋值为1
        if(empty($page)){
        $page=1;
        }
        // 准备sql语句步骤
        // 偏移量
        $offset=($page-1)*$rev;
        // 准备sql语句
        $sql="select * from mall_review limit {$offset},{$rev}";
        // 准备sql语句结束
        // 执行sql语句
        $data=DB::select($sql);
        // 检测是否为ajax请求
        if($request->ajax()){
            // echo $page;exit;
            return view("Admin.Review.test",['data'=>$data]);
        }
        // 设置一个空数组放置分页
        $pp=array();
        // 遍历后放入数组$pp
        for($i=1;$i<=$maxpage;$i++){
        $pp[$i]=$i;
        }
        // var_dump($pp);
        // 获取附加参数值
        return view("Admin.Review.index",['pp'=>$pp,'data'=>$data]);
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
    public function store(Request $request)
    {
        //
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
    // 评论删除操作
    public function destroy($id)
    {
        // echo $id;
        // 删除评论
        if(DB::table("mall_review")->where("id",'=',$id)->delete()){
            return redirect("/review")->with('success','删除成功');
        }
    }
}
