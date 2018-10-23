@extends('Home.HomePublic.public')
@section('title','个人信息')
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

  <!-- Bootsrap CSS -->
  <link rel="stylesheet" href="/static/assets/css/bootstrap.min.css">

    <!-- Start My Profile -->
    <div class="container padding-top-1x padding-bottom-3x"> 
     <div class="row"> 
      <div class="col-lg-4"> 
       <aside class="user-info-wrapper"> 
        <div class="user-cover account-details"> 

         <!-- 会员积分显示开始 -->
         <!-- <div class="info-label" data-toggle="tooltip" title="You currently have 530 Reward Points to spend">
          <i class="icon-medal"></i>530 Points
         </div> --> 
         <!-- 会员积分显示结束 -->
        </div> 
        <div class="user-info"> 
         <div class="user-avatar">
          <a class="edit-avatar" href="/editpic"></a>
          @if(!empty($userinfo))
          <img src="{{$userinfo->pic}}" alt="User" />
          @else
          <img src="/static/assets/images/account/default.png" alt="图片加载失败" />
          @endif
         </div> 
         <div class="user-data"> 
          <h4>{{session('username')}}</h4>
          <span>{{date('Y/m/d H:i:s',time())}}</span> 
         </div> 
        </div> 
       </aside> 
       <nav class="list-group"> 

        <a class="list-group-item active" href="/homeuserinfo"><i class="icon-head"></i>个人信息</a> 

        <a class="list-group-item with-badge" href="/homeorder"><i class="icon-bag"></i>查看订单</a> 

        <a class="list-group-item" href="/homeaddress"><i class="icon-map"></i>管理地址</a> 

        <a class="list-group-item with-badge" href="javascript:void(0)"><i class="icon-heart"></i>我的收藏</a>

        <a class="list-group-item with-badge" href="javascript:void(0)"><i class="icon-tag"></i>优惠券</a> 

       </nav> 
      </div> 

      <!-- 添加用户详情开始 -->
      <div class="col-lg-8"> 
       <div class="padding-top-2x mt-2 hidden-lg-up"></div> 
       <form class="row" action="/homeuserinfo/{{$userinfo->uid}}" method="post"> 

        <div class="col-md-6"> 
         <div class="form-group"> 
          <label>真实姓名</label> 
          <input class="form-control" type="text" value="{{$userinfo->rname}}" required="" name="rname" /> 
         </div> 
        </div> 

        <div class="col-md-6"> 
         <div class="form-group"> 
          <label>年龄</label> 
          <input class="form-control" type="text" value="{{$userinfo->age}}" required="" name="age" /> 
         </div> 
        </div> 

        <div class="col-md-6"> 
         <div class="form-group"> 
          <label>性别</label> <br>
          @if($userinfo->sex == 2)
          女<input class="radio-inline" type="radio" value="0" name="sex" />
          男<input class="radio-inline" type="radio" value="1" name="sex" />
          保密<input class="radio-inline" type="radio" value="2" name="sex" checked="checked" />
          @elseif($userinfo->sex == 1)
          女<input class="radio-inline" type="radio" value="0" name="sex" />
          男<input class="radio-inline" type="radio" value="1" name="sex" checked="checked"/>
          保密<input class="radio-inline" type="radio" value="2" name="sex" />
          @elseif($userinfo->sex == 0)
          女<input class="radio-inline" type="radio" value="0" name="sex" checked="checked"/>
          男<input class="radio-inline" type="radio" value="1" name="sex" />
          保密<input class="radio-inline" type="radio" value="2" name="sex" />
          @endif
         </div> 
        </div> 

        <div class="col-md-6"> 
         <div class="form-group"> 
          <label>手机号</label> 
          <input class="form-control" type="text" name="telphone" value="{{$userinfo->telphone}}" maxlength="11" /> 
         </div> 
        </div> 

        <div class="col-md-6"> 
         <div class="form-group"> 
          <label>邮箱</label> 
          <input class="form-control" type="email" name="email" value="{{$userinfo->email}}" />
         </div> 
        </div> 

        <div class="col-md-6"> 
         <div class="form-group"> 
          <label>家庭住址</label> 
          <input class="form-control" type="text" name="raddress" value="{{$userinfo->raddress}}" /> 
         </div> 
        </div> 

        <div class="col-12"> 
         <hr class="mt-2 mb-3" /> 
         <div class="text-right"> 
          <button class="btn btn-primary">保存</button> 
         </div> 
        </div> 
        {{method_field('PUT')}}
        {{csrf_field()}}
       </form> 
      </div> 
     </div> 
    </div> 
    <!-- 添加用户详情结束 -->
    <!-- End My Profile -->

  <!-- Start Back To Top --> 
  <a class="scroll-to-top-btn" href="#"> <i class="icon-arrow-up"></i> </a> 
  <!-- End Back To Top --> 
  <div class="site-backdrop"></div> 
@endsection