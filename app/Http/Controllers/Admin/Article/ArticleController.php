<?php

namespace App\Http\Controllers\Admin\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::table("mall_article")->get();
        //加载列表模板
        return view("Admin.Article.index",['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加公告模块
        return view("Admin.Article.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取数据
        // dd($request->all());die;
        $data=$request->only('title','des');
        $data['time']=date('Y-m-d _ H:i:s',time());
        // dd($data);die;
        if(DB::table("mall_article")->insert($data)){
            // echo "ok";
            return redirect('/article')->with("success",'公告添加成功');
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
        // echo $id;
        // 获取数据
        $info=DB::table("mall_article")->where("id",'=',$id)->first();
        // $info['time']=date('Y-m-d _ H:i:s',time());
        // var_dump($info);die;
        // 加载修改模板并分配数据
        return view("Admin.article.edit",['info'=>$info]);
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
        // echo $id;
        // 获取提交数据
        // dd($request->all());die;
        $data=$request->except("_method","_token");
        // var_dump($data);die;
        if(DB::table("mall_article")->where("id",'=',$id)->update($data)){
            return redirect("/article")->with("success","公告修改成功");
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
    
     // ajax批量删除
    public function ajax(Request $request){
        // 获取当前参数
        $a=$request->input('a');
        // echo json_encode($a);
        if($a==""){
            echo "请 至 少 选 择 一 条 数 据 ";exit;
        }
        // 遍历删除
        foreach ($a as $key => $v) {
            DB::table("mall_article")->where("id",'=',$v)->delete();
        }
        echo 1;
    }
}
