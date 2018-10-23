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
                    <li><span class="text-primary text-medium">1. </span>在下面写上您注册的邮箱</li>
                    <li><span class="text-primary text-medium">2. </span>我们会通过邮箱方式把修改密码的链接发给您</li>
                    <li><span class="text-primary text-medium">3. </span>点击修改密码链接修改用户登陆密码</li>
                </ol>
                <form class="card mt-4" action="/send" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <input class="form-control" type="email" placeholder="输入您的邮箱" name="email">
                        </div>
                    </div>
                    <div class="card-footer">
                        {{csrf_field()}}
                        <button class="btn btn-primary send" type="submit">发送邮件</button>
                        <a href="/forget">其它验证方式</a>
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
</html>
