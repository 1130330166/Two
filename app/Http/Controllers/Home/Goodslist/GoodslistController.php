<?php

namespace App\Http\Controllers\Home\Goodslist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class GoodslistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 商品分类主页
    public function index()
    {
        // 获取分类 
        $cates = self::getCatesByPid(0);
        //获取用户个人信息
        $userinfo = DB::table("mall_home_userinfo")->where('uid','=',session('uid'))->first();
        // 获取商品数据
        $goods=DB::table("mall_goods")->join('mall_cates','mall_goods.cate_id','=','mall_cates.id')->select('mall_goods.id as id','mall_goods.name as name','mall_cates.id as cid','mall_cates.name as catename','mall_goods.pic','mall_goods.des','mall_goods.num','mall_goods.price','mall_goods.status')->get();
        // var_dump($cates);
        // var_dump($goods);die;
        // 加载商品列表并分配数据
        return view("Home.Goodslist.index",['goods'=>$goods,'cates'=>$cates,'userinfo'=>$userinfo]);
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
    // 商品详情页
    public function show($id)
    {
        // echo $id;
        // 获取分类导航数据
        $cates = self::getCatesByPid(0);
        //获取用户个人信息
        $userinfo = DB::table("mall_home_userinfo")->where('uid','=',session('uid'))->first();
        // var_dump($userinfo);die;
        //为商品详情页拼接用户头像路径
        if($userinfo){
             $userinfo->pic = '.'.$userinfo->pic;
        }
        
        // 获取商品详情
        $info=DB::table('mall_goods')->where("id",'=',$id)->first();
        $data=DB::table("mall_cates")->select(DB::raw("*,concat(path,',',id) as paths"))->orderBy("paths")->where("id",'=',$info->cate_id)->first();
        $catename=$data->name;
        $pic=ltrim(($info->pic),"./");
        // var_dump($info);
        // var_dump($catename);
        // var_dump($pic);die;
        // 获取评论信息
        $review=DB::table("mall_review")->orderBy('time','desc')->get();
        // var_dump($review);die;
        // 对用户名进行加密
        foreach ($review as $key => $value) {
            $review[$key]->musername= '****'.substr($value->username,3);
        }
        // var_dump($review);die;
        // 加载模板
        return view("Home.goodslist.goodsinfo",['cates'=>$cates,'info'=>$info,'pic'=>$pic,'catename'=>$catename,'review'=>$review,'userinfo'=>$userinfo]);
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
    // 商品分类模块
    public function goodscates($id){
    	$cates = self::getCatesByPid(0);
        //获取用户个人信息
        $userinfo = DB::table("mall_home_userinfo")->where('uid','=',session('uid'))->first();
        //为商品详情页拼接用户头像路径
        if($userinfo){
             $userinfo->pic = '.'.$userinfo->pic;
        }
    	// echo "分类商品详情 : $id";
    	// 获取当前分类名
    	$catess=DB::table("mall_cates")->where("id",'=',$id)->first();
    	$catesname=$catess->name;
    	// 获取分类下的所有商品
    	$goods=DB::select("SELECT * FROM mall_goods WHERE name LIKE '%$catesname%'");
    	// var_dump($goods);die;
    	// var_dump($catesname);die;
    	return view("Home.goodscates.index",['catesname'=>$catesname,'goods'=>$goods,'cates'=>$cates,'userinfo'=>$userinfo]);
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
