<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>找回密码</title>
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

</header>
<!-- End NavBar -->
<div class="offcanvas-wrapper">
    <!-- Start Page Title -->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>找回密码</h1>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a></li>
                    <li class="separator">&nbsp;</li>
                    <li>Password Recovery</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Start Password Recovery -->
    <div class="container padding-top-1x padding-bottom-3x">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <h2>忘记密码了吗？</h2>
                <ol class="list-unstyled">
                    <li><span class="text-primary text-medium">1. </span>在下面写上您注册的电话号码</li>
                    <li><span class="text-primary text-medium">2. </span>我们会通过短信方式把验证码发给您</li>
                    <li><span class="text-primary text-medium">3. </span>通过短信验证码更改密码</li>
                    <li><span class="text-primary text-medium">4. </span>注意：本公司只会发验证码给您，不会向您收取任何的费用</li>
                </ol>
                <form class="card mt-4" action="/change" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <font style="display:none;padding-left:50px" color="red" class="herror">*手机格式错误*</font>
                            <input class="form-control" type="text" placeholder="输入你的手机号码" name="phone">
                        </div>
                        <div class="form-group">
                            <font style="display:none;padding-left:50px" color="red" class="error">*验证码错误*</font>
                            <input class="form-control code" type="text" placeholder="输入您的验证码">
                        </div>
                    </div>
                    <div class="card-footer">
                        {{csrf_field()}}
                        <button class="btn btn-primary send" type="submit">发送验证码</button><a href="/email">其它验证方式</a>
                        <button class="btn btn-primary edit" style="float:right" type="submit" disabled="ture">修改密码</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Start Password Recovery -->
</div>
<!-- Start Back To Top -->
<a class="scroll-to-top-btn" href="#">
    <i class="icon-arrow-up"></i>
</a>
<!-- End Back To Top -->
<div class="site-backdrop"></div>
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
    $('input[name=phone]').blur(function(){
        var h = /^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))\d{8}$/;
        //获取光标时间
        $('input[name=phone]').focus(function(){
                //错误信息
                $('.herror').attr('style','display:none');
        });
        //获取电话框的value值
        var phone = $('input[name=phone]').val();

        if(phone == ''){
            $('.herror').attr('style','display:block');
            $('.send').click(function(){
                return false;
            });
        }
        if(h.test(phone) == false){
            $('.herror').attr('style','display:block');
            $('input[name=phone]').val('');
        }
    });
    //触发单击时间
    $('.send').click(function(){
        //获取电话框的value值
        var phone = $('input[name=phone]').val();
        if(phone == ''){
            $('.herror').attr('style','display:block');
            $('input[name=phone]').focus(function(){
                //错误信息
                $('.herror').attr('style','display:none');
            });
            return false;
        }
        // 设置计时器
        var times = setInterval(func,1000);
        //定义秒数
        num = 60;
        function func(){
            //几时开始时，把按钮设定为禁用，再把html内容改掉
            $('.send').attr('disabled',true).html("("+num+")秒后重新发送");
            num--;
            //判断当num = 0的时候
            if(num == 0){
                //num = 0时候，把按钮样式改为可用，再把HTML内容改掉
                $('.send').attr('disabled',false).html("重新发送");
                //停止定时器
                clearInterval(times);
            }
        }
        //使用ajax调用接口
        $.get('/fgcode',{phone:phone},function(data){

        });
        return false;
    });

    //失去光标事件
    $('.code').blur(function(){
        //调用ajax
        $.get('/fgtest',{},function(result){
            //获取用户输入的验证码
            var recode = $('.code').val();
            //判断验证码是否正确
            if(recode != result){
                $('.error').attr('style','display:block');
                $('.edit').attr('disabled',true);
                $('.code').val('');
                $('.code').focus(function(){
                    $('.edit').attr('disabled',true);
                });
            }else{
                $('.edit').attr('disabled',false);
            }
        });
    });
    $('.edit').click(function(){
        var recode = $('.code').val();
        if(recode == ''){
            return false;
        }
    });

    $('.code').focus(function(){
        $('.error').attr('style','display:none');
    });

</script>
</html>
