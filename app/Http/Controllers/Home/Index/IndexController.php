<?php

namespace App\Http\Controllers\Home\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//引入DB类
use DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取公告信息
        $data=DB::table("mall_article")->get();
        //获取用户详情
        $userinfo = DB::table('mall_home_userinfo')->where('uid','=',session('uid'))->first();
        // 定义公告编号
        $i=1;
        //加载列表模板
        $cates = self::getCatesByPid(0);
        $list = DB::table('mall_guanggao')->get();
        $arr = DB::table('mall_carousel')->where('status','=',1)->get();
        $atr = DB::table('mall_guanggao')->where('id','=',3)->first();
        // 获取商品信息-------------第一种方法
        // $goods=DB::table("mall_goods")->get();
        // // 获取分类名字
        // foreach ($goods as $key => $value) {
        //     $catename=DB::table("mall_cates")->where("id",'=',$value->cate_id)->first();
        //     $goods[$key]->catename=$catename->name;
        // }
        // 获取商品信息-------------第二种方法
        $goods=DB::table("mall_goods")->join('mall_cates','mall_goods.cate_id','=','mall_cates.id')->select('mall_goods.id as id','mall_goods.name as name','mall_cates.id as cid','mall_cates.name as catename','mall_goods.pic','mall_goods.des','mall_goods.num','mall_goods.price','mall_goods.status')->get();
        // var_dump($goods);die;
        // dd(count($arr));
        // dd($arr);
        // dd($cates);
        // dd($list);
        // var_dump($article);die;
        //加载前台首页模板
        return view("Home.Index.index",["cates"=>$cates,'userinfo'=>$userinfo,"list"=>$list,'arr'=>$arr,'goods'=>$goods,'data'=>$data,'i'=>$i]);

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
    // 公告展示页
    public function article($id){
        // echo $id;
        $article=DB::table("mall_article")->where("id",'=',$id)->first();
        // var_dump($article);die;
        return view("Home.Article.index",['article'=>$article]);
    }
    // 首页搜索框
    public function search(Request $request){
        // $data=$request->except("_token");
        // var_dump($request->all());die;
        $keywords=$request->input("search");
        // var_dump($keywords);die;
        $goods=DB::select("SELECT * FROM mall_goods WHERE name LIKE '%$keywords%' AND status = '1' ");
        // var_dump($goods);die;
        return view("Home.Search.index",['keywords'=>$keywords,'goods'=>$goods]);
    }
}
