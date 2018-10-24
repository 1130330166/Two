<?php

namespace App\Http\Controllers\Home\Review;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 导入评论内容校验类
// use App\Http\Requests\Reviewinsert;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = self::getCatesByPid(0);
        // 加载评论视图
        return view("Home.Review.add",['cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo $id;die;
        // 获取全部数据
        // var_dump($request->all());die;
        // 获取评论主要内容_去除_token和id
        $review=$request->except("_token","id","oid","status");
        // 获取订单号
        $oid=$request->except("username","leavel","content","_token","status");
        $oid=$oid['oid'];
        // 获取评价订单后的状态
        $status=$request->except("username","leavel","content","_token","oid","goodsname");
        // 获取当前时间作为评论时间
        $review['time'] = date("Y-m-d H:i:s",time());
        // var_dump($review);die;
        if($review=DB::table("mall_review")->insert($review)){
            // 评论成功_修改订单状态已完成
            DB::table("mall_order_info")->where("oid",'=',$oid)->update($status);
            return redirect("/homeorder/$oid")->with("success",'评 价 成 功');
        }else{
            return redirect("/homeorder/$oid")->with("errors",'评 价 失 败');
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
