<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>@yield("title")</title>
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

<!-- 左侧导航栏开始 -->
<!-- Start Shop Category Menu -->
<div class="offcanvas-container" id="shop-categories">
    <div class="offcanvas-header">
        <h3 class="offcanvas-title">商品类别</h3>
    </div>
    <nav class="offcanvas-menu">
        @if(!empty($cates))
        <ul class="menu">
            @foreach($cates as $row)
            <li class="has-children">
                <span>
                    <a href="javascript:void(0);">{{$row->name}}</a>
                    <span class="sub-menu-toggle"></span>
                </span>
                @if(!empty($row->dev))
                <ul class="offcanvas-submenu">
                    @foreach($row->dev as $rows)
                    <li><a href="javascript:void(0);">{{$rows->name}}</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
        @endif
    </nav>
</div>
<!-- End Shop Category Menu -->
<!-- 左侧导航栏结束 -->


<!-- 头部开始 -->
<!-- Start NavBar -->
<header class="navbar navbar-sticky navbar-ghost">
    <!-- Start Search -->
    <form class="site-search" method="get">
        <input type="text" name="site_search" placeholder="请输入你想要购买的产品!">
        <div class="search-tools">
            <span class="clear-search">Clear</span>
            <span class="close-search"><i class="icon-cross"></i></span>
        </div>
    </form>
    <!-- End Search -->
    <!-- Start Logo -->
    <div class="site-branding">
        <div class="inner">
            <a class="offcanvas-toggle cats-toggle" href="#shop-categories" data-toggle="offcanvas"></a>
            <a class="offcanvas-toggle menu-toggle" href="#mobile-menu" data-toggle="offcanvas"></a>
            <a class="site-logo light-logo" href="javascript:void(0);"><img src="static/assets/images/logo/logo-light.png" alt="Inspina"></a>
            <a class="site-logo logo-stuck" href="javascript:void(0);"><img src="static/assets/images/logo/logo.png" alt="Inspina"></a>
        </div>
    </div>
    <!-- End Logo -->

    <!-- Start Nav Menu -->
    <nav class="site-menu">
        @if(!empty($cates))
        <ul>
            @foreach($cates as $row)
            <li>
                <a href="#"><span>{{$row->name}}</span></a>
                @if(!empty($row->dev))
                <ul class="sub-menu">
                    @foreach($row->dev as $rows)
                    <li class="has-children">
                        <a href="javascript:void(0);"><span>{{$rows->name}}</span></a>
                        @if(!empty($rows->dev))
                        <ul class="sub-menu">
                            @foreach($rows->dev as $rowss)
                            <li><a href="shop-categories-1.html">{{$rowss->name}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
        @endif
    </nav>
    <!-- End Nav Menu -->
    <!-- Start Toolbar -->
    <div class="toolbar">
        <div class="inner">
            <div class="tools">
                <div class="search"><i class="icon-search"></i></div>
                <!-- Start Account -->

                <div class="account">
                    <a href="javascript:void(0);"></a><i class="icon-head"></i>
                    <!-- 判断是否存在session(是否登录) -->
                    @if(!empty(session('name')))
                    <ul class="toolbar-dropdown">
                        <li class="sub-menu-user">
                            <div class="user-ava">
                                <img src="" alt="Tony Stark">
                            </div>
                            <div class="user-info">
                                <h6 class="user-name">姓名</h6>
                                <span class="text-xs text-muted"></span>
                            </div>
                        </li>
                        <li><a href="javascript:void(0);">个人信息</a></li>
                        <li><a href="javascript:void(0);">我的订单</a></li>
                        <li><a href="javascript:void(0);">找回密码</a></li>
                        <li><a href="javascript:void(0);">邮寄地址</a></li>
                        <li class="sub-menu-separator"></li>
                        <li><a href="/logout">退出</a></li>
                    </ul>
                    @else
                    <ul class="toolbar-dropdown">
                        <li><a href="/login">登录</a></li>
                        <li><a href="/login">注册</a></li>
                        <li class="sub-menu-separator"></li>
                    </ul>
                    @endif
                </div>
                <!-- End Account -->
                <!-- Start Cart -->
                <div class="cart">
                    <a href="#"></a>
                    <i class="icon-bag"></i>
                    <span class="subtotal">购物车</span>
                    <div class="toolbar-dropdown">
                        <div class="dropdown-product-item">
                            <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                            <a class="dropdown-product-thumb" href="shop-single-1.html">
                                <img src="static/assets/images/cart-dropdown/01.jpg" alt="Product">
                            </a>
                            <div class="dropdown-product-info">
                                <a class="dropdown-product-title" href="shop-single-1.html">Samsung Galaxy A8</a>
                                <span class="dropdown-product-details">1 x $520</span>
                            </div>
                        </div>
                        <div class="toolbar-dropdown-group">
                            <div class="column">
                                <span class="text-lg">总价格</span>
                            </div>
                            <div class="column text-right">
                                <span class="text-lg text-medium">$1920 </span>
                            </div>
                        </div>
                        <div class="toolbar-dropdown-group">
                            <div class="column">
                                <a class="btn btn-sm btn-block btn-secondary" href="cart.html">查看购物车</a>
                            </div>
                            <div class="column">
                                <a class="btn btn-sm btn-block btn-success" href="checkout-address.html">购买</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Cart -->
            </div>
        </div>
    </div>
    <!-- End Toolbar -->
</header>
<!-- 头部结束 -->



    @section("home")
    @show
    <!-- 尾部开始 -->
    <footer class="site-footer">
        <div class="container">
            <!-- Start Footer Info -->
            <div class="row">
                <!-- Start Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <section class="widget widget-light-skin">
                        <h3 class="widget-title">客服上班时间</h3>
                        <ul class="list-unstyled text-sm text-white">
                            <li><span class="opacity-50">周一至周五: </span>09:00 - 18:00</li>
                            <li><span class="opacity-50">周六至周日: </span>10:00 - 15:00</li>
                        </ul>
                        <a class="social-button shape-circle sb-facebook sb-light-skin" href="#">
                            <i class="socicon-facebook"></i>
                        </a>
                        <a class="social-button shape-circle sb-twitter sb-light-skin" href="#">
                            <i class="socicon-twitter"></i>
                        </a>
                        <a class="social-button shape-circle sb-instagram sb-light-skin" href="#">
                            <i class="socicon-googleplus"></i>
                        </a>
                        <a class="social-button shape-circle sb-instagram sb-light-skin" href="#">
                            <i class="socicon-instagram"></i>
                        </a>
                    </section>
                </div>
                <!-- End Contact Info -->
                <!-- Start Mobile Apps -->
                <div class="col-lg-3 col-md-6">
                    <section class="widget widget-links widget-light-skin">
                        <h3 class="widget-title">友情链接</h3>
                        <ul>
                            <li><a href="/friendslinks">友情链接</a></li>
                        </ul>
                    </section>
                </div>
                <!-- End Mobile Apps -->
                <!-- Start About Us -->
                <div class="col-lg-3 col-md-6">
                    <section class="widget widget-links widget-light-skin">
                        <h3 class="widget-title">关于我们</h3>
                        <ul>
                            <li><a href="#">我们的公司</a></li>
                            <li><a href="#">我们的队伍</a></li>
                            <li><a href="#">我们的产品</a></li>
                            <li><a href="#">我们的推荐</a></li>
                            <li><a href="#">全天候支持</a></li>
                            <li><a href="#">隐私政策</a></li>
                        </ul>
                    </section>
                </div>
                <!-- End About Us -->
            </div>
            <!-- End Footer Info -->
            <hr class="hr-light">
            <!-- Start Copyright -->
            <p class="footer-copyright text-center">© 2018 Inspina | All rights <a href="">Reserved</a></p>
            <!-- End Copyright -->
        </div>
    </footer>
    <!-- 尾部结束 -->
</div>
<!-- Start Photoswipe Container -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Photoswipe Container -->
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
