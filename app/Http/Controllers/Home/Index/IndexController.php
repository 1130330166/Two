<?php

namespace App\Http\Controllers\Home\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入redis类
use Illuminate\Support\Facades\Redis;

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
        
        
        //获取用户详情
        $userinfo = DB::table('mall_home_userinfo')->where('uid','=',session('uid'))->first();
        // 定义公告编号
        $i=1;        
        // 获取商品信息-------------第一种方法
        // $goods=DB::table("mall_goods")->get();
        // // 获取分类名字
        // foreach ($goods as $key => $value) {
        //     $catename=DB::table("mall_cates")->where("id",'=',$value->cate_id)->first();
        //     $goods[$key]->catename=$catename->name;
        // }
        //把存在redis的键名加入到一个数组里面
        $key[] = array('list','cates','arr','goods','data');
        //遍历数组
        foreach($key as $k=>$v){
            // var_dump($v);exit;
            // 判断键值是否存在redis
            if(Redis::exists($v[$k])){
                //在redis拿数据  拿出来的是json字符串
                $list = Redis::get('list');
                $cates = Redis::get('cates');
                $arr = Redis::get('arr');
                $goods = Redis::get('goods');
                $data = Redis::get('data');
                //数组类型转换   当时什么数据类型存的redis就转换成什么类型
                $list = unserialize($list);
                $cates = unserialize($cates);
                $arr = unserialize($arr);
                $goods = unserialize($goods);
                $data = unserialize($data);
            }else{
                // 获取公告信息
                $data=DB::table("mall_article")->get();
                //加载列表模板
                $cates = self::getCatesByPid(0);
                //广告模块
                $list = DB::table('mall_guanggao')->get();
                //轮播图模块
                $arr = DB::table('mall_carousel')->where('status','=',1)->get();
                // 获取商品信息-------------第二种方法
                $goods=DB::table("mall_goods")->join('mall_cates','mall_goods.cate_id','=','mall_cates.id')->select('mall_goods.id as id','mall_goods.name as name','mall_cates.id as cid','mall_cates.name as catename','mall_goods.pic','mall_goods.des','mall_goods.num','mall_goods.price','mall_goods.status','mall_goods.like')->get();
                //储存redis
                Redis::setex('list', 300, serialize($list));
                Redis::setex('cates', 300, serialize($cates));
                Redis::setex('arr', 300, serialize($arr));
                Redis::setex('goods', 300, serialize($goods));
                Redis::setex('data', 300, serialize($data));
            }
        }
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
        $cates = self::getCatesByPid(0);
        // echo $id;
        $article=DB::table("mall_article")->where("id",'=',$id)->first();
        // var_dump($article);die;
        return view("Home.Article.index",['article'=>$article,'cates'=>$cates]);
    }
    // 首页搜索框
    public function search(Request $request){
        $cates = self::getCatesByPid(0);
        // $data=$request->except("_token");
        // var_dump($request->all());die;
        $keywords=$request->input("search");
        // var_dump($keywords);die;
        $goods=DB::select("SELECT * FROM mall_goods WHERE name LIKE '%$keywords%' AND status = '1' ");
        // var_dump($goods);die;
        return view("Home.Search.index",['keywords'=>$keywords,'goods'=>$goods,'cates'=>$cates]);
    }
    // 关于我们_模块
    public  function about_us(){
        $cates = self::getCatesByPid(0);
        // echo 1;die;
        return view("Home.Extend.about_us",['cates'=>$cates]);
    }
    // 我们的团队
    public  function team(){
        $cates = self::getCatesByPid(0);
        // echo 1;die;
        return view("Home.Extend.team",['cates'=>$cates]);
    }

    //点赞
    public function up(Request $request){
        // var_dump($request->all());
        $gid = $request->input('gid');
        $like['like'] = $request->input('like');
        $like['like'] += 1;
        // var_dump($like);exit;
        if(DB::table('mall_goods')->where('id','=',$gid)->update($like)){
            return 1;
        }
    }

}
