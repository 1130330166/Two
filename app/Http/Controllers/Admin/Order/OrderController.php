<?php

namespace App\Http\Controllers\Admin\Order;

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
    //后台加载未付款订单模板分配数据
    public function index()
    {
        //查询待付款的订单 status = 0 根据下单时间降序排序
        $data = DB::select("SELECT a.aname,a.address,a.phone,o.* FROM mall_address AS a,mall_order_info AS o WHERE a.id=o.aid AND o.status=0 ORDER BY addtime DESC");

        $arr = array('待付款','待发货','待收货','已收货');
        // var_dump($arr);

        foreach($data as $k => $v){

            $data[$k]->status = $arr[$v->status];
            $data[$k]->addtime = date('Y/m/d H:i:s',intval($v->addtime));
            $data[$k]->paytime = date('Y/m/d H:i:s',intval($v->paytime));
            $data[$k]->updatetime = date('Y/m/d H:i:s',intval($v->updatetime));
        }

        // var_dump($data);die;

        //加载待付款订单模板,传递数据
        return view("Admin.Order.unpay",['data'=>$data]);
    }

    //后台加载未发货订单模板分配数据
    public function unSend(){

        //查询待发货的订单 status = 1 根据下单时间降序排序
        $data = DB::select("SELECT a.aname,a.address,a.phone,o.* FROM mall_address AS a,mall_order_info AS o WHERE a.id=o.aid AND o.status=1 ORDER BY addtime DESC");

        $arr = array('待付款','发货','待收货','已收货');

        foreach($data as $k => $v){

            $data[$k]->status = $arr[$v->status];
            $data[$k]->addtime = date('Y/m/d H:i:s',intval($v->addtime));
            $data[$k]->paytime = date('Y/m/d H:i:s',intval($v->paytime));
            $data[$k]->updatetime = date('Y/m/d H:i:s',intval($v->updatetime));
        }

        //加载待发货订单模板,传递数据
        return view("Admin.Order.unsend",['data'=>$data]);
    }

    //后台加载待收货订单模板分配数据
    public function waitReceipt(){

        //查询待发货的订单 status = 1 根据下单时间降序排序
        $data = DB::select("SELECT a.aname,a.address,a.phone,o.* FROM mall_address AS a,mall_order_info AS o WHERE a.id=o.aid AND o.status=2 ORDER BY addtime DESC");

        $arr = array('待付款','发货','待收货','已收货');

        foreach($data as $k => $v){

            $data[$k]->status = $arr[$v->status];
            $data[$k]->addtime = date('Y/m/d H:i:s',intval($v->addtime));
            $data[$k]->paytime = date('Y/m/d H:i:s',intval($v->paytime));
            $data[$k]->updatetime = date('Y/m/d H:i:s',intval($v->updatetime));
        }

        //加载待收货订单模板,传递数据
        return view("Admin.Order.waitreceipt",['data'=>$data]);
    }

    //后台加载已收货订单模板分配数据
    public function received(){

        //查询待发货的订单 status = 1 根据下单时间降序排序
        $data = DB::select("SELECT a.aname,a.address,a.phone,o.* FROM mall_address AS a,mall_order_info AS o WHERE a.id=o.aid AND o.status=3 ORDER BY addtime DESC");

        $arr = array('待付款','发货','待收货','已收货');

        foreach($data as $k => $v){

            $data[$k]->status = $arr[$v->status];
            $data[$k]->addtime = date('Y/m/d H:i:s',intval($v->addtime));
            $data[$k]->paytime = date('Y/m/d H:i:s',intval($v->paytime));
            $data[$k]->updatetime = date('Y/m/d H:i:s',intval($v->updatetime));
        }

        //加载已收货订单模板,传递数据
        return view("Admin.Order.received",['data'=>$data]);
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
    //后台更新订单状态
    public function update(Request $request, $id)
    {
        //根据接收的订单号查询具体订单信息
        $data = DB::table("mall_order_info")->where('oid','=',$id)->first();
        //根据订单状态做处理
        if($data->status == 0){

            //状态值为0,等待用户付款,后台无需操作
        }elseif($data->status == 1){

            //状态值为1,后台客服点击了发货,更新订单状态到数据库
            if(DB::table("mall_order_info")->where('oid','=',$id)->update(['status'=>2])){

                return back()->with("success","发货成功!");
            }else{

                return back()->with("error","发货失败!");
            }
        }elseif($data->status == 2){

            //状态值为2,等待用户收货,后台无需操作
        }elseif($data->status == 3){

            //状态值为3,等待用户评价,后台无需操作
        }elseif($data->status == 4){

            //状态值为4,用户已评价,后台无需操作
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
}
