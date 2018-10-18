<?php

namespace App\Http\Controllers\Home\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入DB类;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查询分配公共导航栏分类数据
        $cates = self::getCatesByPid(0);
        //新建数组[索引数组格式]对应订单status
        $arr = ['待付款','待发货','待收货','待评价','已评价'];

        /**************************************/
        // 根据session uid查询该用户所有状态订单 按下单时间降序排序
        $allorder = DB::table('mall_order_info')->where('uid','=',session('uid'))->orderBy("addtime","desc")->get();
        //遍历该用户所用订单信息,改变时间显示,订单状态显示格式
        foreach ($allorder as $key => $value) {
            
            $allorder[$key]->addtime = date('Y/m/d H:i:s',$value->addtime);
            $allorder[$key]->status = $arr[$value->status];
        }
        // var_dump($allorder);exit;

        /**************************************/
        // 根据session uid查询该用户待付款订单 status = 0 按下单时间降序排序
        $unpay = DB::table('mall_order_info')->where('status','=',0)->where('uid','=',session('uid'))->orderBy("addtime","desc")->get();
        //遍历该用户待付款订单信息,改变时间显示,订单状态显示格式
        foreach ($unpay as $key => $value) {
            
            $unpay[$key]->addtime = date('Y/m/d H:i:s',$value->addtime);
            $unpay[$key]->status = $arr[$value->status];
        }
        // var_dump($unpay);exit;
        
        /**************************************/
        // 根据session uid查询该用户待发货订单 status = 1 按下单时间降序排序
        $unsend = DB::table('mall_order_info')->where('status','=',1)->where('uid','=',session('uid'))->orderBy("addtime","desc")->get();
        //遍历该用户待发货订单信息,改变时间显示,订单状态显示格式
        foreach ($unsend as $key => $value) {
            
            $unsend[$key]->addtime = date('Y/m/d H:i:s',$value->addtime);
            $unsend[$key]->status = $arr[$value->status];
        }
        // var_dump($unsend);exit;
        
        /**************************************/
        // 根据session uid查询该用户待收货订单 status = 2 按下单时间降序排序
        $waitreceipt = DB::table('mall_order_info')->where('status','=',2)->where('uid','=',session('uid'))->orderBy("addtime","desc")->get();
        //遍历该用户待收货订单信息,改变时间显示,订单状态显示格式
        foreach ($waitreceipt as $key => $value) {
            
            $waitreceipt[$key]->addtime = date('Y/m/d H:i:s',$value->addtime);
            $waitreceipt[$key]->status = $arr[$value->status];
        }
        // var_dump($waitreceipt);exit;
        
        /**************************************/
        // 根据session uid查询该用户待评论订单 status = 3 按下单时间降序排序
        $uncomment = DB::table('mall_order_info')->where('status','=',3)->where('uid','=',session('uid'))->orderBy("addtime","desc")->get();
        //遍历该用户待评论订单信息,改变时间显示,订单状态显示格式
        foreach ($uncomment as $key => $value) {
            
            $uncomment[$key]->addtime = date('Y/m/d H:i:s',$value->addtime);
            $uncomment[$key]->status = $arr[$value->status];
        }
        // var_dump($uncomment);exit;
        
        /**************************************/
        // 根据session uid查询该用户已评论订单 status = 4 按下单时间降序排序
        $commented = DB::table('mall_order_info')->where('status','=',4)->where('uid','=',session('uid'))->orderBy("addtime","desc")->get();
        //遍历该用户已评论订单信息,改变时间显示,订单状态显示格式
        foreach ($commented as $key => $value) {
            
            $commented[$key]->addtime = date('Y/m/d H:i:s',$value->addtime);
            $commented[$key]->status = $arr[$value->status];
        }
        // var_dump($commented);exit;

        //加载订单模板 分配数据
        return view("Home.Order.index",['cates'=>$cates,'allorder'=>$allorder,'unpay'=>$unpay,'unsend'=>$unsend,'waitreceipt'=>$waitreceipt,'uncomment'=>$uncomment,'commented'=>$commented]);
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

        //根据接收的订单ID查询订单具体信息
        $data = DB::table("mall_order_info")->where("oid",'=',$id)->first();

        //去除商品ID最右边的#号然后转换成数组[一个由商品ID组成的数组]
        $data->gid = explode('#',rtrim($data->gid,'#'));
        //去除商品数量最右边的#号然后转换成数组[一个由商品数量组成的数组]
        $data->num = explode('#',rtrim($data->num,'#'));

        //根据gid循环查询商品信息,存储到一个数组$arr中
        for($i=0;$i<count($data->gid);$i++){

            $arr[$i] = DB::table('mall_goods')->where('id','=',$data->gid[$i])->get(); 
        }
        //根据num查询商品购买数量,存储到数组$arr对应的商品信息中 
        for($i=0;$i<count($data->num);$i++){

            $arr[$i][0]->num = $data->num[$i];
        }
        // dd($arr);
        //将数组$arr做为订单的商品信息存储到$data中
        foreach($arr as $k => $v){
            //去掉商品图片路径左边的点,用于模板遍历
            $v[0]->pic = ltrim($v[0]->pic,'.');
            //截取商品title
            $v[0]->title = mb_substr($v[0]->title, 0,30).'...';
            //将商品信息存储到$data中方便遍历
            $data->goodsinfo[$k] = $v[0];
        }

        //计算订单的总价格
        foreach($data->goodsinfo as $v){

            $data->total += $v->price*$v->num;
        }
        //新建数组[索引数组格式]对应订单status
        $arr = ['待付款','待发货','待收货','待评价','已评价'];
        //转换订单状态显示
        $data->status = $arr[$data->status];
        //转换下单时间显示格式
        $data->addtime = date('Y/m/d H:i:s',$data->addtime);
        //根据订单信息的aid查询收货地址
        $address = DB::table('mall_address')->where('id','=',$data->aid)->first();
        // var_dump($address);
        // dd($data);die;

        /*//根据接收的订单ID===>$id连表查询订单具体信息
        $data = DB::select("SELECT o.oid,o.status,o.addtime,g.pic,g.des,g.price,i.num FROM mall_order AS o,mall_goods AS g,mall_order_info AS i WHERE o.oid={$id} AND i.oid=o.oid AND i.gid=g.id");
                                          
        var_dump($data);exit;*/

        /*$order = DB::table("mall_order")->where('oid','=',$id)->first();
        $order_info = DB::table("mall_order_info")->where('oid','=',$order->oid)->get();
        // var_dump($order_info);exit;
        foreach($order_info as $k => $v){

            $goods[$k] = DB::table("mall_goods")->where('id','=',$v->gid)->first();
        }
        var_dump($order);
        var_dump($order_info);
        var_dump($goods);exit;*/
        
        //加载订单详情模板
        return view("Home.Order.show",['data'=>$data,'address'=>$address]);
        
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
        //根据传递过来的订单号查询订单状态
        $data = DB::table("mall_order_info")->where('oid','=',$id)->first();
        //根据订单状态处理订单
        if($data->status == 0){

            //状态值为0,该订单未付款,跳转到付款页面
            
        }elseif($data->status == 1){

            //状态值为1,等待发货无需操作
        }elseif($data->status == 2){

            //状态值为2,用户点击了确认收获,应更新订单状态值为3[待评价]
            if(DB::table("mall_order_info")->where('oid','=',$id)->update(['status'=>3])){

                //如果状态更新成功,跳转回订单详情页
                return back()->with("success","收货成功!");
            }else{
                //状态更新失败,返回订单详情页
                return back();
            }
        }elseif($data->status == 3){

            //状态值为3,用户点击了去评价,加载评价页面
        }elseif($data->status == 4){

            //状态值为4,用户点击了提交[评价],跳转回订单页
            return redirect('/homeorder');
        }
        // var_dump($data);exit;
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
