<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
 <!--<![endif]-->
 <head> 
  <meta charset="utf-8" /> 
  <!-- Viewport Metatag --> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0" /> 
  <!-- Plugin Stylesheets first to ease overrides --> 
  <link rel="stylesheet" type="text/css" href="/static/admins/plugins/colorpicker/colorpicker.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/admins/custom-plugins/wizard/wizard.css" media="screen" /> 
  <!-- Required Stylesheets --> 
  <link rel="stylesheet" type="text/css" href="/static/admins/bootstrap/css/bootstrap.min.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/admins/css/fonts/ptsans/stylesheet.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/admins/css/fonts/icomoon/style.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/admins/css/mws-style.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/admins/css/icons/icol16.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/admins/css/icons/icol32.css" media="screen" /> 
  <!-- Demo Stylesheet --> 
  <link rel="stylesheet" type="text/css" href="/static/admins/css/demo.css" media="screen" /> 
  <!-- jQuery-UI Stylesheet --> 
  <link rel="stylesheet" type="text/css" href="/static/admins/jui/css/jquery.ui.all.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/admins/jui/jquery-ui.custom.css" media="screen" /> 
  <!-- Theme Stylesheet --> 
  <link rel="stylesheet" type="text/css" href="/static/admins/css/mws-theme.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/admins/css/themer.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/admins/css/my.css" media="screen" /> 
  <title>@yield('title')</title> 
 </head> 
 <body>
  <!-- Header --> 
  <div id="mws-header" class="clearfix"> 
   <!-- Logo Container --> 
   <div id="mws-logo-container"> 
    <!-- Logo Wrapper, images put within this wrapper will always be vertically centered --> 
    <div id="mws-logo-wrap"> 
     <img src="/static/admins/images/mws-logo.png" alt="mws admin" /> 
    </div> 
   </div> 
   <!-- User Tools (notifications, logout, profile, change password) --> 
   <div style="color: #c3c3c3;float: right;line-height: 60px"><a href="/updateredis" class=" btn btn-success icon-loading">更新缓存</a></div>
   <div id="mws-user-tools" class="clearfix"> 
    <!-- Notifications --> 
    <div id="mws-user-notif" class="mws-dropdown-menu"> 
     <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-winsows"></i></a> 
     <!-- Unread notification count --> 
     <span class="mws-dropdown-notif">01</span> 
     <!-- Notifications dropdown --> 
     <div class="mws-dropdown-box"> 
      <div class="mws-dropdown-content"> 
       <ul class="mws-notifications"> 
        <li class="read"> <a href="#"> <span class="message"> 恭 喜 你 们 , 二 期 项 目 开 始 了.</span> <span class="time"> 十月 08, 2018 </span> </a> </li> 
       </ul> 
       <div class="mws-dropdown-viewall"> 
        <a href="#">加载全部消息</a> 
       </div> 
      </div> 
     </div> 
    </div> 
    <!-- Messages --> 
    <div id="mws-user-message" class="mws-dropdown-menu"> 
     <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-envelope"></i></a> 
     <!-- Unred messages count --> 
     <span class="mws-dropdown-notif">01</span> 
     <!-- Messages dropdown --> 
     <div class="mws-dropdown-box"> 
      <div class="mws-dropdown-content"> 
       <ul class="mws-messages"> 
        <li class="read"> <a href="#"> <span class="sender">Turbo</span> <span class="message"> 预计会在2018年10月26日结束 </span> <span class="time"> October 26, 2018 </span> </a> </li> 
       </ul> 
       <div class="mws-dropdown-viewall"> 
        <a href="#">加载全部消息</a> 
       </div> 
      </div> 
     </div> 
    </div> 
    <!-- User Information and functions section --> 
    <div id="mws-user-info" class="mws-inset"> 
     <!-- User Photo --> 
     <div id="mws-user-photo"> 
      <img src="/static/admins/example/profile.jpg" alt="User Photo" /> 
     </div> 
     <!-- Username and Functions --> 
     <div id="mws-user-functions"> 
      <div id="mws-username">
        你好, <font color="#CE00FF" size="4">{{session('name')}}</font>
      </div> 
      <ul>   
       <li><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="/adminlogin" class="icon-remove"> 退出 </a></li> 
      </ul>  
     </div> 
    </div> 
   </div> 
  </div> 
  <!-- Start Main Wrapper --> 
  <div id="mws-wrapper"> 
   <!-- Necessary markup, do not remove --> 
   <div id="mws-sidebar-stitch"></div> 
   <div id="mws-sidebar-bg"></div> 
   <!-- Sidebar Wrapper --> 
   <div id="mws-sidebar"> 
    <!-- Hidden Nav Collapse Button --> 
    <div id="mws-nav-collapse"> 
     <span></span> 
     <span></span> 
     <span></span> 
    </div> 
    <!-- Main Navigation --> 
    <div id="mws-navigation"> 
     <ul>

      <!-- 管理员管理开始 -->
      <li> <a href="#"><i class="icon-user"></i> 管理员管理</a> 
       <ul class="closed">
        <li><a href="/adminusers">管理员列表</a></li>
        <li><a href="/adminusers/create">管理员添加</a></li> 
      </ul></li> 
      <!-- 管理员管理结束 -->

      <!-- 角色管理开始 -->
      <li> <a href="#"><i class="icon-add-contact"></i> 管理员角色管理</a> 
       <ul class="closed">
        <li><a href="/adminrolelist">角色管理</a></li>
      </ul></li> 
      <!-- 角色管理结束 -->

      <!-- 权限管理开始 -->
      <li> <a href="#"><i class="icon-warning-sign"></i> 权限管理</a> 
       <ul class="closed"> 
          <li><a href="/nodelist/create">权限添加</a></li>
        <li><a href="/nodelist">权限列表</a></li>
       </ul> </li> 
       <!-- 权限管理结束 -->

      <!-- 会员管理开始 -->
      <li> <a href="#"><i class="icon-users"></i> 会员管理</a> 
       <ul class="closed"> 
       <!--  <li><a href="/adminuser/create">会员添加</a></li>  -->
        <li><a href="/adminuser">会员列表</a></li> 
       </ul> </li> 
       <!-- 会员管理结束 -->

       <!-- 分类管理开始 -->
      <li> <a href="#"><i class="icon-th-list"></i> 分类管理</a> 
       <ul class="closed"> 
        <li><a href="/admincate/create">分类添加</a></li> 
        <li><a href="/admincate">分类列表</a></li> 
       </ul> </li> 
       <!-- 分类管理结束 -->

       <!-- 文章管理开始 -->
      <!-- <li> <a href="#"><i class="icon-file"></i> 文章管理</a> 
       <ul class="closed"> 
        <li><a href="">文章添加</a></li> 
        <li><a href="">文章列表</a></li> 
       </ul> </li>  -->
       <!-- 文章管理结束 -->

       <!-- 商品管理开始 -->
      <li> <a href="#"><i class="icon-shopping-cart"></i> 商品管理</a> 
       <ul class="closed"> 
        <li><a href="/goods/create">商品添加</a></li> 
        <li><a href="/goods">商品列表</a></li> 
       </ul> 
      </li>
      <!-- 商品管理结束 -->

      <!-- 订单管理开始 -->
      <li> <a href="#"><i class="icon-list-2"></i> 订单管理</a> 
       <ul class="closed"> 
        <li><a href="/adminorder">待付款订单</a></li> 
        <li><a href="/adminorderunsend">待发货订单</a></li> 
        <li><a href="/adminorderwaitreceipt">待收货订单</a></li> 
        <li><a href="/adminorderreceived">已收货订单</a></li> 
        <li><a href="/adminorderdelorder">已取消订单</a></li>
        <!-- <li><a href="">退货中订单</a></li>  -->
        <!-- <li><a href="">已退货订单</a></li>  -->
       </ul> 
      </li>
      <!-- 订单管理结束 -->

      <!-- 广告管理开始 -->
      <li> 
      <a href="#"><i class="icon-attachment"></i> 广告管理</a> 
       <ul class="closed"> 
        <li><a href="/guanggao">广告列表</a></li> 
        <li><a href="/guanggao/create">广告添加</a></li>
       </ul> 
      </li>
      <!-- 广告管理结束 -->

      <!-- 轮播图管理开始 -->
      <li> 
      <a href="#"><i class="icon-picture"></i> 轮播图管理</a> 
       <ul class="closed"> 
        <li><a href="/lunbo">轮播图列表</a></li> 
        <li><a href="/lunbo/create">轮播图添加</a></li>
       </ul> 
      </li> 
      <!-- 轮播图管理结束 -->

      <!-- 友情链接模块开始 -->
      <li> <a href="#"><i class="icon-link"></i> 友情链接</a> 
       <ul class="closed"> 
        <li><a href="/friendslink">已审核链接</a></li> 
        <li><a href="/friendslinknoverify">未审核链接</a></li> 
       </ul> </li>
       <!-- 友情链接模块结束 -->
       
       <!-- 公告模块开始 -->
       <li> <a href="#"><i class="icon-file-powerpoint"></i> 公告管理</a> 
       <ul class="closed"> 
        <li><a href="/article">公告列表</a></li> 
        <li><a href="/article/create">添加公告</a></li> 
       </ul> </li>
       <!-- 公告模块结束 -->

        <!-- 评论模块开始 -->
       <li> <a href="#"><i class="icon-edit"></i> 评论管理</a> 
       <ul class="closed"> 
        <li><a href="/adminreview">评论列表</a></li> 
       </ul> </li>
       <!-- .评论模块结束 -->

     </ul> 
    </div> 
   </div> 
   <!-- Main Container Start --> 
   <div id="mws-container" class="clearfix"> 
    <div class="container">
       
        @if(session('success'))
           <div class="mws-form-message success">
             {{session('success')}}
          </div>
        @endif
      
        @if(session('error'))
          <div class="mws-form-message warning">
             {{session('error')}}
          </div>
        @endif 
        @section('admin')
        @show
     <!-- Panels End --> 
    </div> 
    <!-- footer --> 
    <div id="mws-footer">
      Copyright Your Website 2019. All Rights Reserved. 
    </div> 
   </div> 
   <!-- Main Container End --> 
  </div> 
  <!-- JavaScript Plugins --> 
  <script src="/static/admins/js/libs/jquery-1.8.3.min.js"></script> 
  <script src="/static/admins/js/libs/jquery.mousewheel.min.js"></script> 
  <script src="/static/admins/js/libs/jquery.placeholder.min.js"></script> 
  <script src="/static/admins/custom-plugins/fileinput.js"></script> 
  <!-- jQuery-UI Dependent Scripts --> 
  <script src="/static/admins/jui/js/jquery-ui-1.9.2.min.js"></script> 
  <script src="/static/admins/jui/jquery-ui.custom.min.js"></script> 
  <script src="/static/admins/jui/js/jquery.ui.touch-punch.js"></script> 
  <!-- Plugin Scripts --> 
  <script src="/static/admins/plugins/datatables/jquery.dataTables.min.js"></script> 
  <!--[if lt IE 9]>
    <script src="js/libs/excanvas.min.js"></script>
    <![endif]--> 
  <script src="/static/admins/plugins/flot/jquery.flot.min.js"></script> 
  <script src="/static/admins/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script> 
  <script src="/static/admins/plugins/flot/plugins/jquery.flot.pie.min.js"></script> 
  <script src="/static/admins/plugins/flot/plugins/jquery.flot.stack.min.js"></script> 
  <script src="/static/admins/plugins/flot/plugins/jquery.flot.resize.min.js"></script> 
  <script src="/static/admins/plugins/colorpicker/colorpicker-min.js"></script> 
  <script src="/static/admins/plugins/validate/jquery.validate-min.js"></script> 
  <script src="/static/admins/custom-plugins/wizard/wizard.min.js"></script> 
  <!-- Core Script --> 
  <script src="/static/admins/bootstrap/js/bootstrap.min.js"></script> 
  <script src="/static/admins/js/core/mws.js"></script> 
  <!-- Themer Script (Remove if not needed) --> 
  <script src="/static/admins/js/core/themer.js"></script> 
  <!-- Demo Scripts (remove if not needed) --> 
  <script src="/static/admins/js/demo/demo.dashboard.js"></script>  
 </body>
</html>