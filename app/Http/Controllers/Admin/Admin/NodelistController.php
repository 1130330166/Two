<?php

namespace App\Http\Controllers\Admin\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\NodelistInsert;
class NodelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取权限信息
        $nodelist=DB::table("mall_node")->get();
        // 加载模版
        return view("Admin.Nodelist.index",['nodelist'=>$nodelist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加模板
        return view("Admin.Nodelist.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NodelistInsert $request)
    {
        //获取所有参数
        // dd($request->all());
        // 除去token添加进数据库
        $data=$request->except('_token');
        // 封装status
        $data['status']=1;
        // dd($data);die;
        // 写入数据库
        if(DB::table("mall_node")->insert($data)){
        return redirect("nodelist")->with("success",'添加成功');
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
        // echo $id;	
        // 执行操作
          if(DB::table("mall_node")->where("id",'=',$id)->delete()){
            return redirect("/nodelist")->with('success','权限删除成功');
        }else{
            return redirect("/nodelist")->with('error','权限删除失败');
        }
    }
}
