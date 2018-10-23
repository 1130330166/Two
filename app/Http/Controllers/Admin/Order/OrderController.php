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
    public function index(Request $request)
    {

        //获取搜索的关键词
        $k = $request->input('keywords');

        //查询待付款的订单 status = 0 根据下单时间降序排序 isdel=>0为正常订单 1为取消订单
        // $data = DB::select("SELECT a.aname,a.address,a.phone,o.* FROM mall_address AS a,mall_order_info AS o WHERE a.id=o.aid AND o.status=0 ORDER BY addtime DESC");

        $data = DB::table("mall_order_info")->join('mall_address','mall_order_info.aid','=','mall_address.id')->where('mall_order_info.oid','like',"%".$k."%")->where('mall_order_info.status','=',0)->where('mall_order_info.isdel','=',0)->select('mall_address.aname','mall_address.address','mall_address.phone','mall_order_info.*')->orderBy('addtime','desc')->paginate(1);
        // dd($data);

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
        return view("Admin.Order.unpay",['data'=>$data,'request'=>$request->all()]);
    }

    //后台加载未发货订单模板分配数据
    public function unSend(Request $request){

        //获取搜索的关键词
        $k = $request->input('keywords');

        //查询待发货的订单 status = 1 根据下单时间降序排序 isdel=>0为正常订单 1为取消订单
        // $data = DB::select("SELECT a.aname,a.address,a.phone,o.* FROM mall_address AS a,mall_order_info AS o WHERE a.id=o.aid AND o.status=1 ORDER BY addtime DESC");

        $data = DB::table("mall_order_info")->join('mall_address','mall_order_info.aid','=','mall_address.id')->where('mall_order_info.oid','like',"%".$k."%")->where('mall_order_info.status','=',1)->where('mall_order_info.isdel','=',0)->select('mall_address.aname','mall_address.address','mall_address.phone','mall_order_info.*')->orderBy('addtime','desc')->paginate(2);

        $arr = array('待付款','发货','待收货','已收货');

        foreach($data as $k => $v){

            $data[$k]->status = $arr[$v->status];
            $data[$k]->addtime = date('Y/m/d H:i:s',intval($v->addtime));
            $data[$k]->paytime = date('Y/m/d H:i:s',intval($v->paytime));
            $data[$k]->updatetime = date('Y/m/d H:i:s',intval($v->updatetime));
        }

        //加载待发货订单模板,传递数据
        return view("Admin.Order.unsend",['data'=>$data,'request'=>$request->all()]);
    }

    //后台加载待收货订单模板分配数据
    public function waitReceipt(Request $request){

        //获取搜索的关键词
        $k = $request->input('keywords');

        //查询待收货的订单 status = 2 根据下单时间降序排序 isdel=>0为正常订单 1为取消订单
        // $data = DB::select("SELECT a.aname,a.address,a.phone,o.* FROM mall_address AS a,mall_order_info AS o WHERE a.id=o.aid AND o.status=2 ORDER BY addtime DESC");

        $data = DB::table("mall_order_info")->join('mall_address','mall_order_info.aid','=','mall_address.id')->where('mall_order_info.oid','like',"%".$k."%")->where('mall_order_info.status','=',2)->where('mall_order_info.isdel','=',0)->select('mall_address.aname','mall_address.address','mall_address.phone','mall_order_info.*')->orderBy('addtime','desc')->paginate(1);

        $arr = array('待付款','发货','待收货','已收货');

        foreach($data as $k => $v){

            $data[$k]->status = $arr[$v->status];
            $data[$k]->addtime = date('Y/m/d H:i:s',intval($v->addtime));
            $data[$k]->paytime = date('Y/m/d H:i:s',intval($v->paytime));
            $data[$k]->updatetime = date('Y/m/d H:i:s',intval($v->updatetime));
        }

        //加载待收货订单模板,传递数据
        return view("Admin.Order.waitreceipt",['data'=>$data,'request'=>$request->all()]);
    }

    //后台加载已收货订单模板分配数据
    public function received(Request $request){

        //获取搜索的关键词
        $k = $request->input('keywords');

        //查询已收货的订单 status = 3 根据下单时间降序排序 isdel=>0为正常订单 1为取消订单
        // $data = DB::select("SELECT a.aname,a.address,a.phone,o.* FROM mall_address AS a,mall_order_info AS o WHERE a.id=o.aid AND o.status=3 ORDER BY addtime DESC");

        $data = DB::table("mall_order_info")->join('mall_address','mall_order_info.aid','=','mall_address.id')->where('mall_order_info.oid','like',"%".$k."%")->where('mall_order_info.status','=',3)->where('mall_order_info.isdel','=',0)->select('mall_address.aname','mall_address.address','mall_address.phone','mall_order_info.*')->orderBy('addtime','desc')->paginate(1);

        $arr = array('待付款','发货','待收货','已收货');

        foreach($data as $k => $v){

            $data[$k]->status = $arr[$v->status];
            $data[$k]->addtime = date('Y/m/d H:i:s',intval($v->addtime));
            $data[$k]->paytime = date('Y/m/d H:i:s',intval($v->paytime));
            $data[$k]->updatetime = date('Y/m/d H:i:s',intval($v->updatetime));
        }

        //加载已收货订单模板,传递数据
        return view("Admin.Order.received",['data'=>$data,'request'=>$request->all()]);
    }

    //后台加载已取消订单模板分配数据
    public function delOrder(Request $request){

        //获取搜索的关键词
        $k = $request->input('keywords');

        //查询已取消订单 isdel = 1 根据下单时间降序排序 isdel=>0为正常订单 1为取消订单
        // $data = DB::select("SELECT a.aname,a.address,a.phone,o.* FROM mall_address AS a,mall_order_info AS o WHERE a.id=o.aid AND o.isdel=1 ORDER BY addtime DESC");

        $data = DB::table("mall_order_info")->join('mall_address','mall_order_info.aid','=','mall_address.id')->where('mall_order_info.oid','like',"%".$k."%")->where('mall_order_info.isdel','=',1)->select('mall_address.aname','mall_address.address','mall_address.phone','mall_order_info.*')->orderBy('addtime','desc')->paginate(1);

        $arr = array('待付款','发货','待收货','已收货');

        foreach($data as $k => $v){

            $data[$k]->status = $arr[$v->status];
            $data[$k]->addtime = date('Y/m/d H:i:s',intval($v->addtime));
            $data[$k]->paytime = date('Y/m/d H:i:s',intval($v->paytime));
            $data[$k]->updatetime = date('Y/m/d H:i:s',intval($v->updatetime));
        }

        //加载已收货订单模板,传递数据
        return view("Admin.Order.delorder",['data'=>$data,'request'=>$request->all()]);
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

        //加载订单详情模板
        return view("Admin.Order.show",['data'=>$data,'address'=>$address]);
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
