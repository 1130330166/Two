@extends('Home.HomePublic.public')
@section('title','我的订单')
@section('home')
<div style="background-color: #36414F; height: 124px;"></div>

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
  <div class="container padding-top-1x padding-bottom-3x"> 
   <div class="row"> 

    <div class="col-lg-4"> 
     <aside class="user-info-wrapper"> 
      <div class="user-cover account-details"> 
       <div class="info-label" data-toggle="tooltip" title="You currently have 530 Reward Points to spend"> 
        <i class="icon-medal"></i>530 Points 
       </div> 
      </div> 
      <div class="user-info"> 
       <div class="user-avatar"> 
        <a class="edit-avatar" href="#"></a> 
        <img src="/static/assets/images/account/user-ava.jpg" alt="User" /> 
       </div> 
       <div class="user-data"> 
        <h4>Tony Stark</h4> 
        <span>Joined February 06, 2018</span> 
       </div> 
      </div> 
     </aside> 
     <nav class="list-group"> 
      <a class="list-group-item" href="account-profile.html"><i class="icon-head"></i>My Profile</a> 
      <a class="list-group-item active with-badge" href="/homeorder"><i class="icon-bag"></i>查看订单<span class="badge badge-primary badge-pill">{{count($allorder)}}</span></a> 
      <a class="list-group-item" href="/homeaddress"><i class="icon-map"></i>管理地址</a> 
      <a class="list-group-item with-badge" href="account-wishlist.html"><i class="icon-heart"></i>我的收藏<span class="badge badge-primary badge-pill">3</span></a> 
      <a class="list-group-item with-badge" href="account-tickets.html"><i class="icon-tag"></i>优惠卷<span class="badge badge-primary badge-pill">4</span></a> 
     </nav> 
    </div> 

    <!-- Start Content -->
      <div class="col-lg-8 "> 
       <h6 class="text-muted text-normal text-uppercase">我的订单</h6> 
       
       <hr class="margin-bottom-1x" /> 
       <ul class="nav nav-tabs" role="tablist"> 

        <li class="nav-item"><a class="nav-link active show" href="#fade" data-toggle="tab" role="tab" aria-selected="false">全部订单</a></li> 

        <li class="nav-item"><a class="nav-link" href="#scaleup" data-toggle="tab" role="tab" aria-selected="true">待付款</a></li> 

        <li class="nav-item"><a class="nav-link" href="#scaledown" data-toggle="tab" role="tab">待发货</a></li> 

        <li class="nav-item"><a class="nav-link" href="#left" data-toggle="tab" role="tab">待收货</a></li> 

        <li class="nav-item"><a class="nav-link" href="#bottom" data-toggle="tab" role="tab">待评价</a></li> 

        <li class="nav-item"><a class="nav-link" href="#right" data-toggle="tab" role="tab">已评价</a></li>

        <!-- <li class="nav-item"><a class="nav-link" href="#top" data-toggle="tab" role="tab">退货中</a></li> 
        
        <li class="nav-item"><a class="nav-link" href="#filp" data-toggle="tab" role="tab">已退货</a></li>  -->

       </ul> 

       <div class="tab-content"> 

        <!-- 全部订单开始 -->
        <div class="tab-pane transition fade active show" id="fade" role="tabpanel"> 
         
           <div class="col-lg-12"> 
            <div class="padding-top-2x mt-2 hidden-lg-up"></div> 
            <div class="table-responsive"> 
             <table class="table table-hover margin-bottom-none"> 
              <thead> 
               <tr> 
                <th>订单号</th> 
                <th>下单时间</th> 
                <th>状态</th> 
                <th>查看详情</th> 
               </tr> 
              </thead> 
              <tbody> 
              @if(!empty($allorder))
              @foreach($allorder as $row)
               <tr> 
                <td><span class="">{{$row->oid}}</span></td> 
                <td><span class="text-muted">{{$row->addtime}}</span></td>
                @if($row->status == '待付款')
                <td><span class="text-primary">{{$row->status}}</span></td> 
                @elseif($row->status == '待发货')
                <td><span class="text-success">{{$row->status}}</span></td>
                @elseif($row->status == '待收货')
                <td><span class="text-danger">{{$row->status}}</span></td>
                @elseif($row->status == '待评价')
                <td><span class="text-muted">{{$row->status}}</span></td>
                @elseif($row->status == '已评价')
                <td><span class="">{{$row->status}}</span></td>
                @endif
                <td><a class="text-info margin-bottom-none" href="/homeorder/{{$row->oid}}">查看详情</a></td> 
               </tr> 
               @endforeach
               @endif
              </tbody> 
             </table> 
            </div> 

            <!-- <hr /> 
            <div class="text-right">
             <a class="btn btn-link-primary margin-bottom-none" href="#"><i class="icon-download"></i>&nbsp;Order Details</a>
            </div>  -->

           </div>

        </div> 
        <!-- 全部订单结束 -->

        <!-- 待付款订单开始 -->
        <div class="tab-pane transition fade scale" id="scaleup" role="tabpanel"> 
          <div class="col-lg-12"> 
           <div class="padding-top-2x mt-2 hidden-lg-up"></div> 
           <div class="table-responsive"> 
            <table class="table table-hover margin-bottom-none"> 
             <thead> 
              <tr> 
               <th>订单号</th> 
               <th>下单时间</th> 
               <th>状态</th> 
               <th>查看详情</th> 
              </tr> 
             </thead> 
             <tbody> 
             @if(!empty($unpay))
             @foreach($unpay as $row)
              <tr> 
               <td><span class="">{{$row->oid}}</span></td> 
               <td><span class="text-muted">{{$row->addtime}}</span></td>
               @if($row->status == '待付款')
               <td><span class="text-primary">{{$row->status}}</span></td> 
               @elseif($row->status == '待发货')
               <td><span class="text-success">{{$row->status}}</span></td>
               @elseif($row->status == '待收货')
               <td><span class="text-danger">{{$row->status}}</span></td>
               @elseif($row->status == '待评价')
               <td><span class="text-muted">{{$row->status}}</span></td>
               @elseif($row->status == '已评价')
               <td><span class="">{{$row->status}}</span></td>
               @endif
               <td><a class="text-info margin-bottom-none" href="/homeorder/{{$row->oid}}">查看详情</a></td> 
              </tr> 
              @endforeach
              @endif
             </tbody> 
            </table> 
           </div> 

           <!-- <hr /> 
           <div class="text-right">
            <a class="btn btn-link-primary margin-bottom-none" href="#"><i class="icon-download"></i>&nbsp;Order Details</a>
           </div>  -->

          </div>
        </div> 
        <!-- 待付款订单结束 -->

        <!-- 待发货订单开始 -->
        <div class="tab-pane transition fade scaledown" id="scaledown" role="tabpanel"> 
          <div class="col-lg-12"> 
           <div class="padding-top-2x mt-2 hidden-lg-up"></div> 
           <div class="table-responsive"> 
            <table class="table table-hover margin-bottom-none"> 
             <thead> 
              <tr> 
               <th>订单号</th> 
               <th>下单时间</th> 
               <th>状态</th> 
               <th>查看详情</th> 
              </tr> 
             </thead> 
             <tbody> 
             @if(!empty($unsend))
             @foreach($unsend as $row)
              <tr> 
               <td><span class="">{{$row->oid}}</span></td> 
               <td><span class="text-muted">{{$row->addtime}}</span></td>
               @if($row->status == '待付款')
               <td><span class="text-primary">{{$row->status}}</span></td> 
               @elseif($row->status == '待发货')
               <td><span class="text-success">{{$row->status}}</span></td>
               @elseif($row->status == '待收货')
               <td><span class="text-danger">{{$row->status}}</span></td>
               @elseif($row->status == '待评价')
               <td><span class="text-muted">{{$row->status}}</span></td>
               @elseif($row->status == '已评价')
               <td><span class="">{{$row->status}}</span></td>
               @endif
               <td><a class="text-info margin-bottom-none" href="/homeorder/{{$row->oid}}">查看详情</a></td> 
              </tr> 
              @endforeach
              @endif
             </tbody> 
            </table> 
           </div> 

           <!-- <hr /> 
           <div class="text-right">
            <a class="btn btn-link-primary margin-bottom-none" href="#"><i class="icon-download"></i>&nbsp;Order Details</a>
           </div>  -->

          </div>
        </div> 
        <!-- 待发货订单结束 -->

        <!-- 待收货订单开始 -->
        <div class="tab-pane transition fade left" id="left" role="tabpanel"> 
          <div class="col-lg-12"> 
           <div class="padding-top-2x mt-2 hidden-lg-up"></div> 
           <div class="table-responsive"> 
            <table class="table table-hover margin-bottom-none"> 
             <thead> 
              <tr> 
               <th>订单号</th> 
               <th>下单时间</th> 
               <th>状态</th> 
               <th>查看详情</th> 
              </tr> 
             </thead> 
             <tbody> 
             @if(!empty($waitreceipt))
             @foreach($waitreceipt as $row)
              <tr> 
               <td><span class="">{{$row->oid}}</span></td> 
               <td><span class="text-muted">{{$row->addtime}}</span></td>
               @if($row->status == '待付款')
               <td><span class="text-primary">{{$row->status}}</span></td> 
               @elseif($row->status == '待发货')
               <td><span class="text-success">{{$row->status}}</span></td>
               @elseif($row->status == '待收货')
               <td><span class="text-danger">{{$row->status}}</span></td>
               @elseif($row->status == '待评价')
               <td><span class="text-muted">{{$row->status}}</span></td>
               @elseif($row->status == '已评价')
               <td><span class="">{{$row->status}}</span></td>
               @endif
               <td><a class="text-info margin-bottom-none" href="/homeorder/{{$row->oid}}">查看详情</a></td> 
              </tr> 
              @endforeach
              @endif
             </tbody> 
            </table> 
           </div> 

           <!-- <hr /> 
           <div class="text-right">
            <a class="btn btn-link-primary margin-bottom-none" href="#"><i class="icon-download"></i>&nbsp;Order Details</a>
           </div>  -->

          </div>
        </div> 
        <!-- 待收货订单结束 -->

        <!-- 待评价订单开始 -->
    		<div class="tab-pane transition fade bottom" id="bottom" role="tabpanel">
    		  <div class="col-lg-12"> 
           <div class="padding-top-2x mt-2 hidden-lg-up"></div> 
           <div class="table-responsive"> 
            <table class="table table-hover margin-bottom-none"> 
             <thead> 
              <tr> 
               <th>订单号</th> 
               <th>下单时间</th> 
               <th>状态</th> 
               <th>查看详情</th> 
              </tr> 
             </thead> 
             <tbody> 
             @if(!empty($uncomment))
             @foreach($uncomment as $row)
              <tr> 
               <td><span class="">{{$row->oid}}</span></td> 
               <td><span class="text-muted">{{$row->addtime}}</span></td>
               @if($row->status == '待付款')
               <td><span class="text-primary">{{$row->status}}</span></td> 
               @elseif($row->status == '待发货')
               <td><span class="text-success">{{$row->status}}</span></td>
               @elseif($row->status == '待收货')
               <td><span class="text-danger">{{$row->status}}</span></td>
               @elseif($row->status == '待评价')
               <td><span class="text-muted">{{$row->status}}</span></td>
               @elseif($row->status == '已评价')
               <td><span class="">{{$row->status}}</span></td>
               @endif
               <td><a class="text-info margin-bottom-none" href="/homeorder/{{$row->oid}}">查看详情</a></td> 
              </tr> 
              @endforeach
              @endif
             </tbody> 
            </table> 
           </div> 

           <!-- <hr /> 
           <div class="text-right">
            <a class="btn btn-link-primary margin-bottom-none" href="#"><i class="icon-download"></i>&nbsp;Order Details</a>
           </div>  -->

          </div>
    		</div>
        <!-- 待评价订单结束 -->

        <!-- 已评价订单开始 -->
    		<div class="tab-pane transition fade right" id="right" role="tabpanel">
	        <div class="col-lg-12"> 
           <div class="padding-top-2x mt-2 hidden-lg-up"></div> 
           <div class="table-responsive"> 
            <table class="table table-hover margin-bottom-none"> 
             <thead> 
              <tr> 
               <th>订单号</th> 
               <th>下单时间</th> 
               <th>状态</th> 
               <th>查看详情</th> 
              </tr> 
             </thead> 
             <tbody> 
             @if(!empty($commented))
             @foreach($commented as $row)
              <tr> 
               <td><span class="">{{$row->oid}}</span></td> 
               <td><span class="text-muted">{{$row->addtime}}</span></td>
               @if($row->status == '待付款')
               <td><span class="text-primary">{{$row->status}}</span></td> 
               @elseif($row->status == '待发货')
               <td><span class="text-success">{{$row->status}}</span></td>
               @elseif($row->status == '待收货')
               <td><span class="text-danger">{{$row->status}}</span></td>
               @elseif($row->status == '待评价')
               <td><span class="text-muted">{{$row->status}}</span></td>
               @elseif($row->status == '已评价')
               <td><span class="">{{$row->status}}</span></td>
               @endif
               <td><a class="text-info margin-bottom-none" href="/homeorder/{{$row->oid}}">查看详情</a></td> 
              </tr> 
              @endforeach
              @endif
             </tbody> 
            </table> 
           </div> 

           <!-- <hr /> 
           <div class="text-right">
            <a class="btn btn-link-primary margin-bottom-none" href="#"><i class="icon-download"></i>&nbsp;Order Details</a>
           </div>  -->

          </div>
    		</div>
        <!-- 已评价订单结束 -->

        <!-- 退货中订单开始 -->
        <!-- <div class="tab-pane transition fade top" id="top" role="tabpanel">
         <p>555555555</p>
        </div> -->
        <!-- 退货中订单结束 -->

        <!-- 已退货订单开始 -->
        <!-- <div class="tab-pane transition fade top" id="filp" role="tabpanel">
         <p>666666666</p>
        </div> -->
        <!-- 已退货订单结束 -->
        
     </div> 
    </div>
    <!-- End Content -->

   </div> 
  </div> 
  <!-- End My Orders --> 

  <!-- Start Back To Top --> 
  <a class="scroll-to-top-btn" href="#"> <i class="icon-arrow-up"></i> </a> 
  <!-- End Back To Top --> 
  <div class="site-backdrop"></div> 
@endsection