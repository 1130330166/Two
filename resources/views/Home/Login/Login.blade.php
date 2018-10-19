<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>登录与注册</title>
    <!-- Mobile Specific Meta Tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="static/assets/images/favicon.ico">
    <!-- Bootsrap CSS -->
    <link rel="stylesheet" media="screen" href="static/assets/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" media="screen" href="static/assets/css/font-awesome.min.css">
    <!-- Feather Icons CSS -->
    <link rel="stylesheet" media="screen" href="static/assets/css/feather-icons.css">
    <!-- Pixeden Icons CSS -->
    <link rel="stylesheet" media="screen" href="static/assets/css/pixeden.css">
    <!-- Social Icons CSS -->
    <link rel="stylesheet" media="screen" href="static/assets/css/socicon.css">
    <!-- PhotoSwipe CSS -->
    <link rel="stylesheet" media="screen" href="static/assets/css/photoswipe.css">
    <!-- Izitoast Notification CSS -->
    <link rel="stylesheet" media="screen" href="static/assets/css/izitoast.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" media="screen" href="static/assets/css/style.css">
</head>
<body>

<!-- Start NavBar -->
<!-- End NavBar -->
<div class="offcanvas-wrapper">
    <!-- Start Page Title -->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>登录与注册</h1>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="">Home</a></li>
                    <li class="separator">&nbsp;</li>
                    <li>Login & Register</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title -->
    <!-- Start Account Access -->
    <div class="container padding-top-1x padding-bottom-3x">
        <div class="row">
            <div class="col-md-6 one" style="display:block">
                    <form action="/login" class="login-box" method="post">
                        <h4 class="margin-bottom-1x">登录</h4>
                        <div class="form-group input-group">
                            <input class="form-control" type="username" placeholder="请输入账号" name="username" required><span class="input-group-addon"><i class="icon-mail"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input class="form-control" type="password" placeholder="请输入密码" name="password" required><span class="input-group-addon"><i class="icon-lock"></i></span>
                        </div>
                        <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="remember_me" checked>
                                <label class="custom-control-label" for="remember_me">记住我</label>
                            </div><a class="navi-link" href="account-password-recovery.html">忘记密码</a>
                        </div>
                        <div class="text-center text-sm-right">
                            {{csrf_field()}}
                            <button class="btn btn-primary margin-bottom-none login" type="submit">登录</button>
                            <button class="btn btn-primary margin-bottom-none register" type="submit">注册</button>
                        </div>
                    </form>
            </div>
            <div class="col-md-6 two" style="display:none">
                <div class="padding-top-3x hidden-md-up"></div>
                <h3 class="margin-bottom-1x padding-top-1x">没有账号？来这里注册</h3>
                <p>请认真填写注册需要的资料</p>
                <form action="" class="row" method="post">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg-fn">账号</label>
                            <input class="form-control" type="text" id="reg-fn" placeholder="请填写账号" name="name" required value="">
                        </div>
                    </div>
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg-email">邮箱</label>
                            <input class="form-control" type="email" id="reg-email" placeholder="请填写邮箱" name="email" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg-phone">电话号码</label>
                            <input class="form-control" type="text" id="reg-phone" placeholder="请填写电话号码" name="phone" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg-pass">密码</label>
                            <input class="form-control" type="password" id="reg-pass" placeholder="请填写密码" name="pass" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg-pass-confirm">确认密码</label>
                            <input class="form-control" type="password" id="reg-pass-confirm" placeholder="请再次填写密码" name="repass" required>
                        </div>
                    </div>
                    <div class="col-12 text-center text-sm-right">
                        已注册用户，<a href="/login">去登陆</a>
                        <button class="btn btn-primary margin-bottom-none button" type="submit">注册</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x error" style="display:none">
                    <p>用户名或者密码错误，请重新输入</p>
                </div>
                <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x errorr" style="display:none">
                    <p>用户名或者密码不能为空，请重新输入</p>
                </div>
                <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x nerror" style="display:none">
                    <p>用户名格式错误，字母开头，允许4-16字节，允许字母数字下划线</p>
                </div>
                <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x perror" style="display:none">
                    <p>密码不能含有非法字符，长度在6-20之间,允许字母数字下划线小数点</p>
                </div>
                <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x eerror" style="display:none">
                    <p>邮箱格式错误，请填写真确的邮箱</p>
                </div>
                <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x herror" style="display:none">
                    <p>电话号码格式错误，请填写正确的电话号码</p>
                </div>
                <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x rerror" style="display:none">
                    <p>两次密码输入不同，请重新输入</p>
                </div>
                <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x qerror" style="display:none">
                    <p>请认真填写资料</p>
                </div>
                <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x rnerror" style="display:none">
                    <p>该用户名已被注册</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Access -->
<!-- Modernizr JS -->
<script src="static/assets/js/modernizr.min.js"></script>
<!-- JQuery JS -->
<script src="static/assets/js/jquery.min.js"></script>
<!-- Popper JS -->
<script src="static/assets/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="static/assets/js/bootstrap.min.js"></script>
<!-- CountDown JS -->
<script src="static/assets/js/count.min.js"></script>
<!-- Gmap JS -->
<script src="static/assets/js/gmap.min.js"></script>
<!-- ImageLoader JS -->
<script src="static/assets/js/imageloader.min.js"></script>
<!-- Isotope JS -->
<script src="static/assets/js/isotope.min.js"></script>
<!-- NouiSlider JS -->
<script src="static/assets/js/nouislider.min.js"></script>
<!-- OwlCarousel JS -->
<script src="static/assets/js/owl.carousel.min.js"></script>
<!-- PhotoSwipe UI JS -->
<script src="static/assets/js/photoswipe-ui-default.min.js"></script>
<!-- PhotoSwipe JS -->
<script src="static/assets/js/photoswipe.min.js"></script>
<!-- Velocity JS -->
<script src="static/assets/js/velocity.min.js"></script>
<!-- Main JS -->
<script src="static/assets/js/script.js"></script><script src="static/assets/js/custom.js"></script>
</body>
<script>
    //触发单击事件
    $('.login').click(function(){
        // 获取表单的username
        name = $('input[name=username]').val();
        //获取表单的password
        pass = $('input[name=password]').val();
        //判断有没有填写用户名和密码
        if(pass == '' || name == ''){
            //更改display属性为显示
            $('.errorr').attr('style','display:block');
            //单击事件
            $('.errorr').click(function(){
                //更改display属性为隐藏
                $('.errorr').attr('style','display:none');
            });
        }else{
            //连接Ajax
            $.get('/check',{name:name,pass:pass},function(data){
                // alert(data);
                //判断是否成功登录成功
                //1为登录成功
                if(data == 1){
                    //跳转首页
                    $(location).attr('href','/');
                }
                //2为登录不成功
                if(data == 2){
                    //把密码设置为空
                    $(':password').html();
                    $('.error').attr('style','display:block');
                    $('.error').click(function(){
                        $('.error').attr('style','display:none');
                    });
                }
            });
        }
        //阻止表单跳转
        return false;
    });
    //注册单击事件
    $('.register').click(function(){
        //把登录模板隐藏
        $('.one').attr('style','display:none');
        //把注册模板隐藏
        $('.two').attr('style','display:block');
        //用户名正则，(字母开头，允许4-16字节，允许字母数字下划线)
        var n = /^[a-zA-Z][a-zA-Z0-9_]{3,15}$/;
        //密码不能含有非法字符，长度在4-10之间
        var p = /^[a-zA-Z0-9_.]{6,20}$/;
        //邮箱验证
        var e = /^\w+@\w+(\.[a-zA-Z]{2,3}){1,2}$/;
        //手机号验证
        var h = /^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))\d{8}$/;

        //用户名框的失去焦点事件
        $('input[name=name]').blur(function(){
            //获取用户名框的value值
            var name = $('input[name=name]').val();
            //匹配正则表达式
            if(n.test(name) == false){
                //错误提示
                $('.nerror').attr('style','display:block');
                //错误提示的单击事件
                $('.nerror').click(function(){
                    //隐藏错误提示
                	$('.nerror').attr('style','display:none');
                });
                //设置用户框的value为空
                $('input[name=name]').val('');
            }
        });
        //密码框的失去焦点事件
        $('input[name=pass]').blur(function(){
            //获取密码框的value值
            var pass = $('input[name=pass]').val();
            if(p.test(pass) == false){
                $('.perror').attr('style','display:block');
                $('.perror').click(function(){
                	$('.perror').attr('style','display:none');
                });
                $('input[name=pass]').val('');
            }
        });
        //邮箱框的失去焦点事件
        $('input[name=email]').blur(function(){
            //获取密码框的value值
            var email = $('input[name=email]').val();
            if(e.test(email) == false){
                $('.eerror').attr('style','display:block');
                $('.eerror').click(function(){
                	$('.eerror').attr('style','display:none');
                });
                $('input[name=email]').val('');
            }
        });
        //电话框的失去焦点事件
        $('input[name=phone]').blur(function(){
            //获取电话框的value值
            var phone = $('input[name=phone]').val();
            if(h.test(phone) == false){
                $('.herror').attr('style','display:block');
                $('.herror').click(function(){
                	$('.herror').attr('style','display:none');
                });
                $('input[name=phone]').val('');
            }
        });
        //重复密码框的失去焦点事件
        $('input[name=repass]').blur(function(){
            //获取重复密码框的value值
            var repass = $('input[name=repass]').val();
            var pass = $('input[name=pass]').val();
            if(p.test(repass) == false){
                $('.perror').attr('style','display:block');
                $('.perror').click(function(){
                	$('.perror').attr('style','display:none');
                });
                $('input[name=repass]').val('');
            }
            //判断密码框的值和重复密码框的值是否为空
            if(pass != repass){
                $('.rerror').attr('style','display:block');
                $('.rerror').click(function(){
                	$('.rerror').attr('style','display:none');
                });
                $('input[name=pass]').val('');
                $('input[name=repass]').val('');
            }
        });
        //注册按钮的单击事件
        $('.button').click(function(){
        	var name = $('input[name=name]').val();
        	var pass = $('input[name=pass]').val();
        	var email = $('input[name=email]').val();
        	var phone = $('input[name=phone]').val();
            //判断每个框是否为空
            if(name == '' || pass == '' || email == '' || phone == ''){
                $('.qerror').attr('style','display:block');
                $('.qerror').click(function(){
                	$('.qerror').attr('style','display:none');
                });
                //阻止Ajax传值
                return false;
            }   
                //Ajax的传值
                $.get('/register',{username:name,password:pass,email:email,phone:phone},function(data){
                    // alert(data);
                    // 判断是否注册成功
                    // 1为注册不成功
                    if(data == 1){
                    	$('.rnerror').attr('style','display:block');
                		$('.rnerror').click(function(){
                			$('.rnerror').attr('style','display:none');
                		});
                    // 2为注册不成功
                    }else if(data == 2){
                    	alert('注册成功');
                        //跳转到登录页面
                    	$(location).attr('href','/login');
                    }
                });
            //阻止表单提交
            return false;
        });
    });
</script>
</html>