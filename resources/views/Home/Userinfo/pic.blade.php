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

      <div class="col-lg-8">
        <form action="/updatepic" method="post" enctype="multipart/form-data">
          {{csrf_field()}} 
         <div class="columns"> 
          <div class="column is-3"> 
           <div class=""> 
            <strong>请选择图片：</strong> 
            @if(!empty($userinfo))
            <figure class="image is-1by1">
             <img src="{{$userinfo->pic}}" />
            </figure> 
            @else
            <figure class="image is-1by1">
             <img src="/static/assets/images/account/default.png" />
            </figure> 
            @endif
           </div> 
          </div> 
         </div> 

         <div class="columns"> 
          <div class="column is-3"> 
           <div class="file is-boxed"> 
            <label class="file-label">
              <input class="file-input" type="file" name="avatar" />
            </label> 
           </div> 
          </div> 
         </div> 

         <div class="columns"> 
          <div class="column is-3"> 
           <button class="button is-link" type="submit"> <span>上传头像</span> </button> 
          </div> 
         </div>

        </form>
      </div>
    </div>
  </div>
    <!-- End My Profile -->

  <!-- Start Back To Top --> 
  <a class="scroll-to-top-btn" href="#"> <i class="icon-arrow-up"></i> </a> 
  <!-- End Back To Top --> 
  <div class="site-backdrop"></div> 
@endsection