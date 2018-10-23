<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>修改密码</title>
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
                <h1>修改密码</h1>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a></li>
                    <li class="separator">&nbsp;</li>
                    <li>Change Password</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Start Password Recovery -->
    <div class="container padding-top-1x padding-bottom-3x">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <h2>修改密码</h2>
                <ol class="list-unstyled">
                    <li><span class="text-primary text-medium">1. </span>允许4-22字节，允许字母数字下划线</li>
                    <li><span class="text-primary text-medium">2. </span>两次密码必须相同</li>
                    <li><span class="text-primary text-medium">3. </span>密码不能为空</li>
                </ol>
                <form class="card mt-4" action="/operation" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <font style="display:none;padding-left:50px" color="red" class="perror">*密码格式错误*</font>
                            <input class="form-control" type="password" placeholder="输入您的密码" name="password" required>
                        </div>
                        <div class="form-group">
                            <font style="display:none;padding-left:50px" color="red" class="error">*密码格式错误*</font>
                            <font style="display:none;padding-left:50px" color="red" class="rerror">*两次密码不一样*</font>
                            <input class="form-control repass" type="password" placeholder="再次输入您的密码" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{csrf_field()}}
                        <button class="btn btn-primary edit" type="submit">修改密码</button>
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
    //密码正则验证
    $('input[name=password]').blur(function(){
        //密码不能含有非法字符，长度6-22之间
        var p = /^[a-zA-Z0-9_.]{6,22}$/;
        //获取密码框的value值
        var pass = $('input[name=password]').val();
        //验证正则表达式
        if(p.test(pass) == false){
            $('.perror').attr('style','display:block');
            setTimeout(function(){
                $('.perror').attr('style','display:none');
            },2000);
            $('input[name=password]').val('');
        }
    });

    //重复密码框的失去焦点事件
    $('.repass').blur(function(){
        //密码不能含有非法字符，长度6-22之间
        var p = /^[a-zA-Z0-9_.]{6,22}$/;
        //获取重复密码框的value值
        var repass = $('.repass').val();
        var pass = $('input[name=password]').val();
        if(p.test(repass) == false){
            $('.error').attr('style','display:block');
            setTimeout(function(){
                $('.error').attr('style','display:none');
            },2000);
            $('.repass').val('');
        }
        //判断密码框的值和重复密码框的值是否为空
        if(pass != repass){
            $('.rerror').attr('style','display:block');
            setTimeout(function(){
                $('.rerror').attr('style','display:none');
            },2000);
            $('.repass').val('');
        }
    });
</script>
</html>
