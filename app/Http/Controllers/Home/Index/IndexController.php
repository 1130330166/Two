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
        $goods=DB::table("mall_goods")->join('mall_cates','mall_goods.cate_id','=','mall_cates.id')->select('mall_goods.id as id','mall_goods.name as name','mall_cates.id as cid','mall_cates.name as catename','mall_goods.pic','mall_goods.des','mall_goods.num','mall_goods.price')->get();
        // var_dump($goods);die;
        // dd(count($arr));
        // dd($arr);
        // dd($cates);
        // dd($list);
        //加载前台首页模板
        return view("Home.Index.index",["cates"=>$cates,"list"=>$list,'arr'=>$arr,'goods'=>$goods]);

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
        // echo $id;die;
        // 获取分类导航数据
        $cates = self::getCatesByPid(0);
        // 获取商品详情
        $info=DB::table('mall_goods')->where("id",'=',$id)->first();
        $data=DB::table("mall_cates")->select(DB::raw("*,concat(path,',',id) as paths"))->orderBy("paths")->where("id",'=',$info->cate_id)->first();
        $catename=$data->name;
        $pic=ltrim(($info->pic),"./");
        // var_dump($info);
        // var_dump($catename);
        // var_dump($pic);die;
        // 加载模板
        return view("Home.Index.goodsinfo",['cates'=>$cates,'info'=>$info,'pic'=>$pic,'catename'=>$catename]);
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
