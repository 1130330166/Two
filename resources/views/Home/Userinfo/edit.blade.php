@extends('Home.HomePublic.public')
@section('title','个人信息')
@section('home')
<div style="background-color: #36414F; height: 124px;"></div>
<script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
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
          <label>真实姓名</label>　<span id="checkrname"></span>
          <input class="form-control" type="text" value="{{$userinfo->rname}}" required="" name="rname" maxlength="4" /> 
         </div> 
        </div> 

        <div class="col-md-6"> 
         <div class="form-group"> 
          <label>年龄</label>　<span id="checkage"></span>
          <input class="form-control" type="text" value="{{$userinfo->age}}" required="" name="age" maxlength="3" /> 
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
          <label>手机号</label>　<span id="checktelphone"></span>
          <input class="form-control" type="text" name="telphone" value="{{$userinfo->telphone}}" required="" maxlength="11" /> 
         </div> 
        </div> 

        <div class="col-md-6"> 
         <div class="form-group"> 
          <label>邮箱</label>　<span id="checkemail"></span>
          <input class="form-control" type="email" name="email" required="" value="{{$userinfo->email}}" />
         </div> 
        </div> 

        <div class="col-md-6"> 
         <div class="form-group"> 
          <label>现居地址</label>　<span id="checkraddress"></span>
          <input class="form-control" type="text" name="raddress" required="" value="{{$userinfo->raddress}}" maxlength="50" /> 
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
  <script type="text/javascript">

    // 正则验证真实姓名
    function isRname(rname) {
        var pattern = /^[\u4e00-\u9fa5]{1,6}$/;
        return pattern.test(rname);
    }

    // 正则验证年龄
    function isAge(age) {
        var pattern = /^[1234567890]{1,3}$/;
        return pattern.test(age);
    }

    // 正则验证手机号
    function isTelPhone(telphone) {
        var pattern = /^1[34578]\d{9}$/;
        return pattern.test(telphone);
    }

    // 正则验证邮箱
    function isEmail(email) {
        var pattern = /^[a-z\d]+(\.[a-z\d]+)*@([\da-z](-[\da-z])?)+(\.{1,2}[a-z]+)+$/;
        return pattern.test(email);
    }

    // 正则验证真实地址
    function isRaddress(raddress) {
        var pattern = /^([\u4e00-\u9fa5]|\w){1,50}$/;
        return pattern.test(raddress);
    }

    //验证真实姓名
    function checkRname(){

      //判断链接名是否符合规则
      if (isRname($.trim($('input[name=rname]').val())) == false) {
          //链接名不符合规则 提示用户并组织表单提交
          $('#checkrname').html("<font style='color:#f00'>姓名必须为汉字!</font>");
          return false;
      }else{

          //链接名不符合规则 提示用户并组织表单提交
          $('#checkrname').html("<font style='color:#green'>姓名格式正确!</font>");
          return true;
      }
    }

    //验证现居地址
    function checkRaddress(){

      //判断现居地址是否符合规则
      if (isRaddress($.trim($('input[name=raddress]').val())) == false) {
          //现居地址不符合规则 提示用户并组织表单提交
          $('#checkraddress').html("<font style='color:#f00'>现居地址为汉字且不能大于50位!</font>");
          return false;
      }else{

          //现居地址不符合规则 提示用户并组织表单提交
          $('#checkraddress').html("<font style='color:#green'>现居地址格式正确!</font>");
          return true;
      }
    }

    //验证年龄
    function checkAge(){

      //判断链接名是否符合规则
      if (isAge($.trim($('input[name=age]').val())) == false) {
          //链接名不符合规则 提示用户并组织表单提交
          $('#checkage').html("<font style='color:#f00'>年龄必须为数字!</font>");
          return false;
      }else{

          //链接名不符合规则 提示用户并组织表单提交
          $('#checkage').html("<font style='color:#green'>年龄格式正确!</font>");
          return true;
      }
    }

  //验证手机号
  function checkTelPhone(){

    //判断联系电话是否符合规则
    if (isTelPhone($.trim($('input[name=telphone]').val())) == false) {
        //联系电话不符合规则 提示用户并组织表单提交
        $('#checktelphone').html("<font style='color:#f00'>该号码不存在!</font>");
        return false;
    }else{

        var str;

        $.ajax({

            async: false,
            url: '/verifyuserinfo?telphone='+$('input[name=telphone]').val(),
            success: function(data){

                if(data == 1){

                    //联系电话已存在 提示用户并阻止表单提交
                    $('#checktelphone').html("<font style='color:#f00'>该号码已存在!</font>");
                    str = false;

                }else{

                    //联系电话符合规则 提示用户
                    $('#checktelphone').html("<font style='color:green'>该号码可以使用!</font>");
                    str = true;
                }
            }

        });

        return str;
    }
  }

  //验证邮箱
  function checkEmail(){

    //判断邮箱是否符合规则
    if (isEmail($.trim($('input[name=email]').val())) == false) {
        //邮箱不符合规则 提示用户并组织表单提交
        $('#checkemail').html("<font style='color:#f00'>该邮箱不符合规则!</font>");
        return false;
    }else{

        var str;

        $.ajax({

            async: false,
            url: '/verifyuserinfo?email='+$('input[name=email]').val(),
            success: function(data){

                if(data == 2){

                    //邮箱已存在 提示用户并阻止表单提交
                    $('#checkemail').html("<font style='color:#f00'>该邮箱已存在!</font>");
                    str = false;

                }else{

                    //邮箱符合规则 提示用户
                    $('#checkemail').html("<font style='color:green'>该邮箱可以使用!</font>");
                    str = true;
                }
            }

        });

        return str;
    }
  }

  //点击申请友情链接时校验
  function save() {
      
      //判断是否所有校验都通过验证
      if(checkRname() && checkRaddress() && checkAge() && checkTelPhone() && checkEmail()){

          return true;
      }else{

          return false;
      }
  }
  
  $(':submit').click(function(){

      return save();
      
  });

  //页面加载完成自动调用校验
  $(function(){

    //真实姓名失去焦点触发事件
    $('input[name=rname]').blur(function(){
        //判断真实姓名是否为空
        if ($.trim($('input[name=rname]').val()).length == 0) {
            //真实姓名为空 提示用户
            $('#checkrname').html("<font style='color:#f00'>真实姓名没有输入!</font>");

        } else {
            //判断真实姓名是否符合规则
            if (isRname($.trim($('input[name=rname]').val())) == false) {
                //真实姓名不符合规则 提示用户
                $('#checkrname').html("<font style='color:#f00'>真实姓名必须为汉字!</font>");

            }else{

              //真实姓名符合规则 提示用户
              $('#checkrname').html("<font style='color:green'>姓名格式正确!</font>");

            }
        }
    });

    //年龄失去焦点触发事件
    $('input[name=age]').blur(function(){
        //判断年龄是否为空
        if ($.trim($('input[name=age]').val()).length == 0) {
            //年龄为空 提示用户
            $('#checkage').html("<font style='color:#f00'>年龄没有输入!</font>");

        } else {
            //判断年龄是否符合规则
            if (isAge($.trim($('input[name=age]').val())) == false) {
                //年龄不符合规则 提示用户
                $('#checkage').html("<font style='color:#f00'>年龄必须为数字!</font>");

            }else{

              //年龄符合规则 提示用户
              $('#checkage').html("<font style='color:green'>年龄格式正确!</font>");

            }
        }
    });

    //现居地址失去焦点触发事件
    $('input[name=raddress]').blur(function(){
        //判断现居地址是否为空
        if ($.trim($('input[name=raddress]').val()).length == 0) {
            //现居地址为空 提示用户
            $('#checkraddress').html("<font style='color:#f00'>现居地址没有输入!</font>");

        } else {
            //判断现居地址是否符合规则
            if (isRaddress($.trim($('input[name=raddress]').val())) == false) {
                //现居地址不符合规则 提示用户
                $('#checkraddress').html("<font style='color:#f00'>现居地址必须为汉字或数字或字母!</font>");

            }else{

              //现居地址符合规则 提示用户
              $('#checkraddress').html("<font style='color:green'>现居地址格式正确!</font>");

            }
        }
    });

    //手机号失去焦点触发事件
    $('input[name=telphone]').blur(function(){

        //判断手机号是否填写
        if ($.trim($('input[name=telphone]').val()).length == 0) {
            //手机号为空 提示用户
            $('#checktelphone').html("<font style='color:#f00'>手机号没有输入!</font>");

        } else {
            //判断手机号是否符合规则
            if (isTelPhone($.trim($('input[name=telphone]').val())) == false) {
                //手机号不符合规则 提示用户
                $('#checktelphone').html("<font style='color:#f00'>该号码不存在</font>");

            }else{

                //判断手机号是否存在
                $.get('/verifyuserinfo',{telphone:$('input[name=telphone]').val()},function(data){

                    if(data == 1){

                        //手机号已存在 提示用户
                        $('#checktelphone').html("<font style='color:#f00'>该号码已被注册!</font>");

                    }else{

                        //手机号符合规则 提示用户
                        $('#checktelphone').html("<font style='color:green'>该号码可以使用!</font>");
                    }
                    
                });
            }
        }
    });

    //邮箱失去焦点触发事件
    $('input[name=email]').blur(function(){

        //判断邮箱是否填写
        if ($.trim($('input[name=email]').val()).length == 0) {
            //邮箱为空 提示用户
            $('#checkemail').html("<font style='color:#f00'>邮箱没有输入!</font>");

        } else {
            //判断邮箱是否符合规则
            if (isEmail($.trim($('input[name=email]').val())) == false) {
                //手机号不符合规则 提示用户
                $('#checkemail').html("<font style='color:#f00'>邮箱格式不正确!</font>");

            }else{

                //判断邮箱是否存在
                $.get('/verifyuserinfo',{email:$('input[name=email]').val()},function(data){

                    if(data == 2){

                        //邮箱已存在 提示用户
                        $('#checkemail').html("<font style='color:#f00'>该邮箱已被注册!</font>");

                    }else{

                        //邮箱符合规则 提示用户
                        $('#checkemail').html("<font style='color:green'>该邮箱可以使用!</font>");
                    }
                    
                });
            }
        }
    });


  });

  </script>
@endsection