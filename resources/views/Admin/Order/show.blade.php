@extends('Admin.AdminPublics.public')
@section('title','订单详情')
@section('admin')

  <!-- 添加成功与否信息显示开始 -->
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x">
      <span class="alert-close" data-dismiss="alert"></span>
      <p>{{session('success')}}</p>
  </div>
  @endif

  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x">
      <span class="alert-close" data-dismiss="alert"></span>
      <p>{{session('error')}}</p>
  </div>
  @endif
  <!-- 添加成功与否信息显示结束 -->

  <!-- Start My Orders -->

      <!-- ************************************************************** -->
        <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>我的订单</title>
          <meta name="format-detection" content="telephone=no">
          <link type="text/css" rel="stylesheet" href="/Order/css/commonbak.css" source="widget">       
          <link rel="stylesheet" href="/Order/css/myjd.order2015bak.css">
          <link rel="stylesheet" href="/Order/css/alpha3bak.css">
          <link charset="utf-8" rel="stylesheet" href="/Order/css/tipsbak.css">

          <style>
            .fukuan{background-color:#fff;border:none;}
          </style>

        </head>  
            <table class="td-void order-tb">
              <colgroup>
                  <col class="number-col">
                  <col class="consignee-col">
                  <col class="amount-col">
                  <col class="status-col">
                  <col class="operate-col">
              </colgroup>

              <thead>
                <tr>
                  <th>

                    <div class="ordertime-cont">
                      <div class="time-txt">购买的宝贝</div>
                    </div>
                    <div class="order-detail-txt ac">订单详情</div>
                  </th>

                  <th>收件人</th>
                  <th>收货地址</th>
                  <th>金额</th>
                  <th>状态</th>
                  <th>操作</th>
                </tr>
              </thead>
            

            
            <tbody id="tb-43244043248">

              <tr class="sep-row">
                <td colspan="5"></td>
              </tr>
                
              <tr class="tr-th">
                <td colspan="6">
                  <span class="gap"></span>

                  <span class="dealtime" title="下单时间">下单时间:{{$data->addtime}}</span>

                  <span class="number" title="订单号">订单号:{{$data->oid}}</span>

                </td>
              </tr>

                <tr class="tr-bd" id="track43244043248" oty="0,1,70">
                  <td style='padding:0px;'>
                          
                    <!--  每一种商品  -->
                    @if(!empty($data->goodsinfo))
                    @foreach($data->goodsinfo as $row)
                    <div style="padding:14px 0;border:1px solid #e5e5e5;border-collapse:collapse;">
                      <div class="goods-item p-11362614">
                        <div class="p-img">
                          <a href="javascript:void(0);" clstag="click|keycount|orderinfo|order_product" target="_blank">
                            <img class="" src="{{$row->pic}}" data-lazy-img="done" style="height: 100%;">
                          </a>
                        </div>

                        <div class="p-msg">
                          <div class="p-name">
                            <a href="javascript:void(0);" class="a-link" >{{$row->name}}
                          </div>

                          <div class="p-extra">
                            <ul class="o-info">
                              <li>
                                <span class="o-match J-o-match" data-sku="11362614">
                                  <em>{{$row->color}}</em>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>

                      <div class="goods-number">{{$row->price}}*{{$row->num}}</div>

                      <div class="goods-repair">{{$row->price*$row->num}}</div>
                      <div class="clr"></div>

                    </div> 
                    <!-- 商品遍历结束 -->
                    @endforeach
                    @endif

                    <div class="tr-bd" style="padding:14px 0;border:1px solid #e5e5e5;border-collapse:collapse;">
                      <!-- 备注开始 -->
                      <div class="tr-pd-more">
                        <a href="javascript:void(0);" target="_blank">
                          <span style="font-size: 15px;">备注:</span><span class="text-primary" style="font-size: 22px;">{{$data->beizhu}}</span>
                        </a>
                      </div>
                      
                      <div class="clr"></div>
                      <!-- 备注结束 -->
                    </div>

                  </td>

                  <!--  订单的其它内容  -->
                  <!-- 收件人开始 -->
                  <td>
                      <div class="">
                        <br>
                        <span class="" style="font-size: 22px;">{{$address->aname}}</span><b></b>       
                      </div>
                  </td>
                  <!-- 收件人结束 -->
                  
                  <!-- 收货地址开始 -->
                  <td width="150">
                      <div class="">
                        <br>
                        <span class="" style="font-size: 15px;">{{$address->address}}</span><b></b>
                      </div>
                  </td>
                  <!-- 收货地址结束 -->

                  <!-- 订单总价开始 -->
                  <td >
                      <div class="amount">
                        <br>
                        <span style="font-size: 15px;">总额¥{{$data->total}}</span> <br>
                        <strong style="font-size: 15px;">应付</strong> <br>
                          <strong style="font-size: 22px;">¥{{$data->total}}</strong> <br>
                          <span class="ftx-13"></span>
                      </div>
                  </td>
                  <!-- 订单总价结束 -->

                  <!-- 订单状态开始 -->
                  <td width="105">
                    <div class="status">
                          <br>
                          <span class="" style="font-size: 22px;">
                            {{$data->status}}
                          </span><br>
                      </div>
                  </td>
                  <!-- 订单状态结束 -->

                  <!-- 订单状态操作开始 -->
                  <td width="105">
                    <form action="" method="post">
                      <div class="status">
                          @if($data->status == '待付款')
                            <br><span style="font-size: 22px;">待付款</span><br>
                            <!-- <a href="" style="font-size: 22px;color: orangered" onclick="return confirm('确定取消该订单吗?');">取消订单</a> -->
                          @elseif($data->status == '待发货')

                            <form action="/adminorder/{{$data->oid}}" method="post">
                              <br><button type="submit" class="btn btn-info" title="发货"><i class="icon-truck"></i></button>
                              {{method_field("PUT")}}
                              {{csrf_field()}}
                            </form>
                            <!-- <br><button class="btn btn-info" title="发货"><i class="icon-truck"></i></button> -->
                          @elseif($data->status == '待收货')
                            <br><span style="font-size: 22px;">待收货</span>
                          @elseif($data->status == '待评价')
                            <br><span style="font-size: 22px;">待评价</span>
                          @elseif($data->status == '已评价')
                            <!-- <button class="btn btn-link-info" type="submit" style="font-size: 22px;">申请退货</button> -->
                            <br><span style="font-size: 22px;">已评价</span>
                          <!-- @elseif($data->status == '退货中')
                            <br><span style="font-size: 22px;">退货中</span>
                          @elseif($data->status == '已退货')
                            <br><span style="font-size: 22px;">已退货</span> -->
                          @endif
                      </div>
                      {{method_field("PUT")}}
                      {{csrf_field()}}
                    </form>
                  </td>
                  <!-- 订单状态操作结束 -->
                </tr>
                <!--  其它内容结束   -->
            </tbody>
           
            </table>

      <!-- ************************************************************** -->

  <!-- End My Orders --> 

@endsection