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
    //展示订单页
    public function index()
    {
        //查询分配公共导航栏分类数据
        $cates = self::getCatesByPid(0);
        //查询用户详情
        $userinfo = DB::table('mall_home_userinfo')->where('uid','=',session('uid'))->first();
        //新建数组[索引数组格式]对应订单status
        $arr = ['待付款','待发货','待收货','待评价','已评价'];

        /**************************************/
        // 根据session uid查询该用户所有状态订单[未删除] 按下单时间降序排序
        $allorder = DB::table('mall_order_info')->where('isdel','=',0)->where('uid','=',session('uid'))->orderBy("addtime","desc")->get();
        //遍历该用户所用订单信息,改变时间显示,订单状态显示格式
        foreach ($allorder as $key => $value) {
            
            $allorder[$key]->addtime = date('Y/m/d H:i:s',$value->addtime);
            $allorder[$key]->status = $arr[$value->status];
        }
        // var_dump($allorder);exit;

        /**************************************/
        // 根据session uid查询该用户待付款订单 status = 0 按下单时间降序排序
        $unpay = DB::table('mall_order_info')->where('isdel','=',0)->where('status','=',0)->where('uid','=',session('uid'))->orderBy("addtime","desc")->get();
        //遍历该用户待付款订单信息,改变时间显示,订单状态显示格式
        foreach ($unpay as $key => $value) {
            
            $unpay[$key]->addtime = date('Y/m/d H:i:s',$value->addtime);
            $unpay[$key]->status = $arr[$value->status];
        }
        // var_dump($unpay);exit;
        
        /**************************************/
        // 根据session uid查询该用户待发货订单 status = 1 按下单时间降序排序
        $unsend = DB::table('mall_order_info')->where('isdel','=',0)->where('status','=',1)->where('uid','=',session('uid'))->orderBy("addtime","desc")->get();
        //遍历该用户待发货订单信息,改变时间显示,订单状态显示格式
        foreach ($unsend as $key => $value) {
            
            $unsend[$key]->addtime = date('Y/m/d H:i:s',$value->addtime);
            $unsend[$key]->status = $arr[$value->status];
        }
        // var_dump($unsend);exit;
        
        /**************************************/
        // 根据session uid查询该用户待收货订单 status = 2 按下单时间降序排序
        $waitreceipt = DB::table('mall_order_info')->where('isdel','=',0)->where('status','=',2)->where('uid','=',session('uid'))->orderBy("addtime","desc")->get();
        //遍历该用户待收货订单信息,改变时间显示,订单状态显示格式
        foreach ($waitreceipt as $key => $value) {
            
            $waitreceipt[$key]->addtime = date('Y/m/d H:i:s',$value->addtime);
            $waitreceipt[$key]->status = $arr[$value->status];
        }
        // var_dump($waitreceipt);exit;
        
        /**************************************/
        // 根据session uid查询该用户待评论订单 status = 3 按下单时间降序排序
        $uncomment = DB::table('mall_order_info')->where('isdel','=',0)->where('status','=',3)->where('uid','=',session('uid'))->orderBy("addtime","desc")->get();
        //遍历该用户待评论订单信息,改变时间显示,订单状态显示格式
        foreach ($uncomment as $key => $value) {
            
            $uncomment[$key]->addtime = date('Y/m/d H:i:s',$value->addtime);
            $uncomment[$key]->status = $arr[$value->status];
        }
        // var_dump($uncomment);exit;
        
        /**************************************/
        // 根据session uid查询该用户已评论订单 status = 4 按下单时间降序排序
        $commented = DB::table('mall_order_info')->where('isdel','=',0)->where('status','=',4)->where('uid','=',session('uid'))->orderBy("addtime","desc")->get();
        //遍历该用户已评论订单信息,改变时间显示,订单状态显示格式
        foreach ($commented as $key => $value) {
            
            $commented[$key]->addtime = date('Y/m/d H:i:s',$value->addtime);
            $commented[$key]->status = $arr[$value->status];
        }
        // var_dump($commented);exit;

        //加载订单模板 分配数据
        return view("Home.Order.index",['cates'=>$cates,'allorder'=>$allorder,'unpay'=>$unpay,'unsend'=>$unsend,'waitreceipt'=>$waitreceipt,'uncomment'=>$uncomment,'commented'=>$commented,'userinfo'=>$userinfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 结算页
    public function create()
    {
        //查询分配公共导航栏分类数据
        $cates = self::getCatesByPid(0);
        //判断该用户购物车中是否有商品
        if(DB::table('mall_cart')->where('uid','=',session('uid'))->count('gid') > 0){

            //当前用户购物车内有商品
            //根据session 的uid 获取当前用户的收货地址
            $address = DB::table("mall_address")->where('uid','=',session('uid'))->orderBy("isdefault","desc")->get();
            // var_dump($address);
            //判断该用户的收货地址是否为空
            if(count($address) == 0){

                //该用户地址表为空,查询购物车表中的商品遍历并加载添加地址和备注的模板
                //根据session('uid')[登录用户的ID]查询购物车表
                $car = DB::table("mall_cart")->where("uid",'=',session('uid'))->get();
                // var_dump($car);
                // 购物车总价格
                $total = 0;
                //根据购物车商品ID查询商品信息
                foreach($car as $key => $value){
                    // 根据商品ID查询具体商品
                    $goods[$key] = DB::table("mall_goods")->where('id','=',$value->gid)->first();
                    // 将购物车中对应商品的数量放到商品信息中
                    $goods[$key]->num = $value->num;
                    // 计算购物车总价
                    $total += $value->price*$value->num;
                }

                // var_dump($goods);exit;
                // 加载模板传递数据
                return view('Home.Order.emptyaddressadd',['goods'=>$goods,'total'=>$total]);
            }else{

                //根据session('uid')获取该用户的所有收货地址
                $address = DB::table("mall_address")->where('uid','=',session('uid'))->orderBy('isdefault','desc')->get();
                //根据session('uid')[登录用户的ID]查询购物车表
                $car = DB::table("mall_cart")->where("uid",'=',session('uid'))->get();
                // 购物车总价格
                $total = 0;
                //根据购物车商品ID查询商品信息
                foreach($car as $key => $value){
                    // 根据商品ID查询具体商品
                    $goods[$key] = DB::table("mall_goods")->where('id','=',$value->gid)->first();
                    // 将购物车中对应商品的数量放到商品信息中
                    $goods[$key]->num = $value->num;
                    // 计算购物车总价
                    $total += $value->price*$value->num;
                }
                // var_dump($car);
                // var_dump($address);exit;

                //加载模板传递数据
                return view("Home.Order.hasaddressadd",['address'=>$address,'goods'=>$goods,'total'=>$total]);
            }
        }else{

            //当前用户购物车内没有商品,返回购物车页
            return redirect('/cart');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 生成订单,前往支付
    public function store(Request $request)
    {
        //接收用户输入的收货信息
        $arr = $request->except('beizhu','_token');
        //将用户提交的收货信息添加到地址表
        $arr['uid'] = session('uid');
        //判断地址是否成功添加到地址表,获取插入的地址id
        if($data['aid'] = DB::table("mall_address")->insertGetId($arr)){

            $data['gid'] = '';
            $data['num'] = '';
            // 获取购物车表的信息
            $car = DB::table("mall_cart")->where('uid','=',session('uid'))->get();
            //遍历拼接订单gid[gid1#gid2#gid3#...] 和 购买数量num[num1#num2#num3#...]
            foreach($car as $key => $value){

                $data['gid'] .= $value->gid.'#';
                $data['num'] .= $value->num.'#';
            }

            //定义订单名字
            $orderName = '';
            // 定义订单总价格
            $data['total'] = 0;
            //以商品名拼接订单名字
            foreach($car as $v){

                $orderName .= DB::table('mall_goods')->where('id','=',$v->gid)->first()->name;
                // 订单总价
                $data['total'] += $v->price*$v->num;
            }
            // 生成订单号
            $data['oid'] = date('YmdHis',time()).rand(11111,99999);
            // 生成下单时间
            $data['addtime'] = time();
            // 生成订单更新时间
            $data['updatetime'] = time();
            //生成备注
            $data['beizhu'] = !empty($request->input('beizhu'))?$request->input('beizhu'):'无';
            // 生成uid
            $data['uid'] = session('uid');
            // var_dump($data);exit;
            //判断订单是否生成成功[将订单数据入库]
            if(DB::table('mall_order_info')->insert($data)){

                // 删除该用户的购物车数据
                DB::table("mall_cart")->where("uid","=",session("uid"))->delete();
                //调用支付函数跳转到支付页[订单号,订单名,支付价格,支付描述]
                pay($data['oid'],$orderName,$data['total'],$data['beizhu']);
            }else{

                //订单生成失败跳回结算页
                return back()->with("error","下单失败,请联系客服!");
            }

        }else{

            //地址添加失败,返回上一步
            return back();
        }
        // var_dump($data);exit;
    }

    //用户使用已有地址生成订单
    public function makeOrderWithAddress(Request $request,$id)
    {

        //接收用户输入的备注信息
        $data['beizhu'] = !empty($request->input('beizhu'))?$request->input('beizhu'):'';
        //接收用户选择的地址ID
        $data['aid'] = $id;
        //获得用户ID
        $data['uid'] = session('uid');

        $data['gid'] = '';
        $data['num'] = '';
        // 获取购物车表的信息
        $car = DB::table("mall_cart")->where('uid','=',session('uid'))->get();
        //遍历拼接订单gid[gid1#gid2#gid3#...] 和 购买数量num[num1#num2#num3#...]
        foreach($car as $key => $value){

            $data['gid'] .= $value->gid.'#';
            $data['num'] .= $value->num.'#';
        }

        //定义订单名字
        $orderName = '';
        // 定义订单总价格
        $data['total'] = 0;
        //以商品名拼接订单名字
        foreach($car as $v){

            $orderName .= DB::table('mall_goods')->where('id','=',$v->gid)->first()->name;
            // 订单总价
            $data['total'] += $v->price*$v->num;
        }
        // 生成订单号
        $data['oid'] = date('YmdHis',time()).rand(11111,99999);
        // 生成下单时间
        $data['addtime'] = time();
        // 生成订单更新时间
        $data['updatetime'] = time();
        // 生成uid
        $data['uid'] = session('uid');
        // var_dump($request->all());
        // var_dump($data);exit;
        
        //判断订单是否生成成功[将订单数据入库]
        if(DB::table('mall_order_info')->insert($data)){

            // 删除该用户的购物车数据
            DB::table("mall_cart")->where("uid","=",session("uid"))->delete();
            //调用支付函数跳转到支付页
            pay($data['oid'],$orderName,$data['total'],$data['beizhu']);
        }else{

            //订单生成失败跳回结算页
            return back()->with("error","下单失败,请联系客服!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //订单详情页
    public function show($id)
    {
        //判断传递过来的订单号是否属于登录的该用户[防止用户在地址栏输入不存在的订单号]
        if(DB::table('mall_order_info')->where('uid','=',session('uid'))->where('oid','=',$id)->count() > 0){

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
        }else{

            //地址栏传递过来的订单号不属于该用户,返回
            return back();
            
        }
        
        
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
    //用户修改订单状态--付款,取消订单,确认收货...
    public function update(Request $request, $id)
    {	
        //根据传递过来的订单号查询订单状态
        $data = DB::table("mall_order_info")->where('oid','=',$id)->first();
        //根据订单状态处理订单
        if($data->status == 0){

            //状态值为0,该订单未付款,跳转到付款页面
            // 拼凑订单名[商品名拼接]
            //去除商品ID最右边的#号然后转换成数组[一个由商品ID组成的数组]
            $data->gid = explode('#',rtrim($data->gid,'#'));

            //定义订单名
            $orderName = '';
            //遍历查询对应商品,拼接订单名
            foreach($data->gid as $v){

                $orderName .= DB::table("mall_goods")->where("id",'=',$v)->first()->name;
            }
            // 调用支付函数[订单号,订单名,支付价格,支付描述]
            pay($data->oid,$orderName,$data->total,$data->beizhu);
            // var_dump($orderName);
            // var_dump($data);die;
            
        }elseif($data->status == 1){

            //状态值为1,等待发货无需操作
        }elseif($data->status == 2){

            //状态值为2,用户点击了确认收获,应更新订单状态值为3[待评价],更新时间
            if(DB::table("mall_order_info")->where('oid','=',$id)->update(['status'=>3,'updatetime'=>time()])){

                //如果状态更新成功,跳转回订单详情页
                return back()->with("success","收货成功!");
            }else{
                //状态更新失败,返回订单详情页
                return back();
            }
        }elseif($data->status == 3){

            //状态值为3,用户点击了去评价,加载评价页面
            //根据订单号查询对应订单信息
            $orderinfo = DB::table('mall_order_info')->where('oid','=',$id)->first();
            //去除商品ID最右边的#号然后转换成数组[一个由商品ID组成的数组]
            $orderinfo->gid = explode('#',rtrim($orderinfo->gid,'#'));
            //去除商品数量最右边的#号然后转换成数组[一个由商品数量组成的数组]
            $orderinfo->num = explode('#',rtrim($orderinfo->num,'#'));
            //根据gid循环查询商品信息,存储到一个数组$arr中
            for($i=0;$i<count($orderinfo->gid);$i++){

                $arr[$i] = DB::table('mall_goods')->where('id','=',$orderinfo->gid[$i])->get(); 
            }
            //根据num查询商品购买数量,存储到数组$arr对应的商品信息中 
            for($i=0;$i<count($orderinfo->num);$i++){

                $arr[$i][0]->num = $orderinfo->num[$i];
            }
            // dd($arr);
            //将数组$arr做为订单的商品信息存储到$data中
            foreach($arr as $k => $v){
                //去掉商品图片路径左边的点,用于模板遍历
                $v[0]->pic = ltrim($v[0]->pic,'.');
                //截取商品title
                $v[0]->title = mb_substr($v[0]->title, 0,30).'...';
                //将商品信息存储到$data中方便遍历
                $orderinfo->goodsinfo[$k] = $v[0];
            }
            // var_dump($orderinfo);exit;
            
            //加载评价模板 分配数据
            return view("Home.Review.add",['orderinfo'=>$orderinfo]);
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
    //用户取消订单操作
    public function destroy($id)
    {
        //将传递过来的订单id的是否删除字段赋值为1 0为正常状态 1为删除状态
        if(DB::table("mall_order_info")->where('oid','=',$id)->update(['isdel'=>1,'updatetime'=>time()])){

            return redirect('/homeorder')->with("success","订单已取消!");
        }else{

            return redirect('/homeorder')->with("error","订单取消失败,请联系客服!");
        }
        
    }

    //支付宝支付成功后回调到这
    public function returnUrl()
    {

        //获取支付成功的订单号
        $oid = $_GET['out_trade_no'];
        //修改订单状态
        if(DB::table("mall_order_info")->where("oid","=",$oid)->update(['status'=>1,'paytime'=>time(),'updatetime'=>time()])){

            return redirect("/homeorder")->with("success","付款成功,卖家正在发货!");
        }else{

            return redirect("/homeorder")->with("error","尊敬的客户,您已付款成功,因未知原因订单状态未被修改,抱歉给您带来不便,请联系客服发货并修改订单状态!");
        }
        
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
