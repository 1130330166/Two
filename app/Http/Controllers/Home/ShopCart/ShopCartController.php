<?php

namespace App\Http\Controllers\Home\ShopCart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入DB类
use DB;
//导入Cookie类
use Cookie;
class ShopCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //购物车首页
    public function index(Request $request)
    {	
    	//获取所有的cookie;
        $cookies = $request->cookie();
        //删除cookie多余的字段
        unset($cookies['laravel_session']);
        unset($cookies['XSRF-TOKEN']);
        // var_dump($cookies);exit;
        // 遍历cookie
        foreach($cookies as $key=>$v){
            //根据cookie里的gid查询购物车表
            $list = DB::table('mall_cart')->where('gid','=',$v['gid'])->first();
            // var_dump($list);exit;
            // var_dump($cookies);
            // 判断购物车有没有这件商品
            if(empty($list)){
                //没有的这件商品的情况下
                //判断是否登录的状态
                if(!empty(session('username'))){
                    // 有登录的情况下
                    //获取登录名
                    $name = session('username');
                    //根据登录名查询mall_home_sers表的id
                    $data = DB::table('mall_home_users')->where('username','=',$name)->first();
                    // var_dump($data);exit;
                    // 赋值给$uid
                    $uid = $data->id;
                    //遍历cookie的值
                    foreach($cookies as $k=>$row){
                        //把$uid的值赋值给$row
                        $row['uid'] = $uid;
                        // var_dump($row['gid']);die;
                        
                        //删除购物车表没有的字段
                        unset($row['name']);
                        unset($row['pic']);
                        // var_dump($cookies);exit;
                        // 根据$row的gid查询购物车表有没有这件商品
                        // var_dump($row['gid']);die;
                        $relist = DB::table('mall_cart')->where('gid','=','12')->first();
                        //判断是否为空，不为空就有这件商品，为空就没有。
                        if(empty($relist)){
                        //没有这件商品的情况下
                        // var_dump($row);exit;
                        // 把数据加入购物车表
                        DB::table('mall_cart')->insert($row);
                        //清除cookie
                        setcookie($k,null,time()-3600);
                        // var_dump($request->cookie($k));
                        // var_dump($k);exit;
                        }else{
                            // 有这件商品的情况下
                            $v['num']+1;
                            //如果有这件商品就cookie的把$v的数量加1再加入购物车表
                            DB::table('mall_cart')->where('gid','=',$v['gid'])->update(['num'=>$v['num']]);
                            // echo 2;exit;
                            // 清除cookie
                            setcookie($key,null,time()-3600);
                        }
                    }
                }
            }else{
                // 判断是否登录状态
                if(!empty(session('username'))){
                    //有登陆的情况下
                    //如果有这件商品，$v数量+1.
                    $v['num']+1;
                    //把数据写入购物车表
                    DB::table('mall_cart')->where('gid','=',$v['gid'])->update(['num'=>$v['num']]);
                    //清除cookie
                    setcookie($key,null,time()-3600);
                }
            }
        }
        //判断是否登录
        if(!empty(session('username'))){
            //有登录的情况下
            //获取登录名
            $session = session('username');
            //根据登录名查询home_users表
            $username = DB::table('mall_home_users')->where('username','=',$session)->first();
            //获取uid
            $uid = $username->id;
            // var_dump($username);exit;
            // 根据uid查询该用户所有的商品
            $arr = DB::table('mall_cart')->where('uid','=',$uid)->get();
            // var_dump($arr);exit;
            // 判断该用户有没有商品
            if(count($arr)){
                // 有商品的情况
                //遍历$arr
                foreach($arr as $k=>$v){
                    //获取gid
                    $gid = $v->gid;
                    // var_dump($gid);
                    // 根据获取的gid查询商品表写入$art的数组里
                    $art[] = DB::table('mall_goods')->where('id','=',$gid)->first();
                    //！把$arr数量赋值$art
                    $art[$k]->num = $v->num;
                    //把计算好的商品的小计赋值给$art
                    $art[$k]->total = $v->num * $art[$k]->price;
                    // var_dump($art);exit;
                }
                $cates = self::getCatesByPid(0);
                //跳转到首页并分配数据
                return view('Home.ShopCart.index',['cates'=>$cates,'cookie'=>$cookies,'art'=>$art]);
            }else{
                //没有商品的情况
                $cates = self::getCatesByPid(0);
                //初始化总价格
                $total = 0;
                //初始化$art
                $art = array();
                //跳转到首页并分配数据
                return view('Home.ShopCart.index',['cates'=>$cates,'cookie'=>$cookies,'art'=>$art]);
            }
        }else{
            // 没有登录的情况下
            $cates = self::getCatesByPid(0);
            //跳转到首页并分配数据
            return view('Home.ShopCart.index',['cates'=>$cates,'cookie'=>$cookies,'total'=>0]);
        }    
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

    //购物车ajax储存cookie
    public function cookie(Request $request){
        // dd($request->all());
        //获取gid
        $gid = $request->input('gid');
        // var_dump($gid);
        //初始化cookie的名字  
        $cart = "cart$gid";
        $cookie=\Cookie::get("$cart");
        // var_dump($cookie);
        // 通过获取的id查询需要的数据
        $list = DB::table('mall_goods')->where('id','=',$gid)->first();
        //判断$cookie是否为空
        if(empty($cookie)){
            // 为空的情况下
            // var_dump($id); 
            // var_dump($list);exit;
            // 把查询商品表的id赋值给$data
            $data['gid'] = $list->id;
            // 把查询商品表的name赋值给$data
            $data['name'] = $list->name;
            // 把查询商品表的pic赋值给$data
            $data['pic'] = $list->pic;
            // 把查询商品表的num赋值给$data
            $data['num'] = 1;
            //初始化$num
            $num = 1;
            // 把查询商品表的price赋值给$data
            $data['price'] = $list->price;
            // var_dump($cookie);
            //存进cookie
            \Cookie::queue($cart,$data,'3600');
        }else{
            //不为空的情况下
            //把$num的值赋值给$cookie
            $num = $cookie['num'];
            //$num+1
            $num = $num+1;
            // 把查询商品表的id赋值给$data
            $data['gid'] = $list->id;
            // 把查询商品表的name赋值给$data
            $data['name'] = $list->name;
            // 把查询商品表的pic赋值给$data
            $data['pic'] = $list->pic;
            // 把查询商品表的num赋值给$data
            $data['num'] = $num;
            // 把查询商品表的price赋值给$data
            $data['price'] = $list->price;
            //存进cookie
            \Cookie::queue($cart,$data,'3600');
        }
    }

    //通过ajax减商品数量
    public function reduce(Request $request){
        // var_dump($request->all());
        // 获取传递过来的商品gid
        $gid = $request->input('gid');
        //获取传递过来的数量num
        $num = $request->input('num');
        // 再根据gid修改购物车的商品数量
        DB::table('mall_cart')->where('gid','=',$gid)->update(['num'=>$num]);
    }

    //通过ajax增加商品数量
    public function increase(Request $request){
        // var_dump($request->all());
        // // 获取传递过来的商品gid
        $gid = $request->input('gid');
        //获取传递过来的数量num
        $num = $request->input('num');
        // 再根据gid修改购物车的商品数量
        DB::table('mall_cart')->where('gid','=',$gid)->update(['num'=>$num]);
    }

    //清空购物车
    public function clean(){
        //获取登录名
        $name = session('username');
        // var_dump($name);
        // 根据用户名查询home_user表
        $list = DB::table('mall_home_users')->where('username','=',$name)->first();
        // 把查询的id赋值给$uid
        $uid = $list->id;
        //根据$uid删除商品
        DB::table('mall_cart')->where('uid','=',$uid)->delete();
    }

    //删除单间商品
    public function del(Request $request){
        //获取登录名
        $name = session('username');
        // var_dump($name);
        // 根据用户名查询home_user表
        $list = DB::table('mall_home_users')->where('username','=',$name)->first();
        // 把查询的id赋值给$uid
        $uid = $list->id;
        // var_dump($uid);exit;
        // 获取传递过来的gid
        $gid = $request->input('gid');
        // var_dump($gid);
        // 根据gid和uid来删除商品
        DB::table('mall_cart')->where('uid','=',$uid)->where('gid','=',$gid)->delete();
    }

}
