<?php

namespace App\Http\Controllers\Home\Review;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 导入评论内容校验类
use App\Http\Requests\Reviewinsert;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Reviewinsert $request)
    {
        // echo $id;die;
        // 获取全部数据
        // var_dump($request->all());

        $review=$request->except("_token","id");
        $id=$request->except("username","leavel","content","_token");
        $goodsid=$id['id'];
        // var_dump($id);die;
        // var_dump($goodsid);die;
        $review['time'] = date("Y-m-d H:i:s",time());
        // var_dump($review);die;
        if($review=DB::table("mall_review")->insert($review)){
            return redirect("/goodslist/$goodsid")->with("success",'评 论 添 加 成 功');
        }else{
            return redirect("/goodslist/$goodsid")->with("errors",'评 论 添 加 失 败');
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
