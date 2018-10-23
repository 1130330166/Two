@extends("Home.HomePublic.public")
@section('home')
<div style="height:124px;background:#36414f"></div>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>购物车</title>
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
<style>
    .gw_num{border: 1px solid #dbdbdb;width: 110px;line-height: 26px;overflow: hidden;}
.gw_num em{display: block;height: 26px;width: 26px;float: left;color: #7A7979;border-right: 1px solid #dbdbdb;text-align: center;cursor: pointer;}
.gw_num .num{display: block;float: left;text-align: center;width: 52px;font-style: normal;font-size: 14px;line-height: 24px;border: 0;}
.gw_num em.add{float: right;border-right: 0;border-left: 1px solid #dbdbdb;}
</style>
<body>
<div class="offcanvas-wrapper">
    <!-- Start Page Title -->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>购物车</h1>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="">Home</a></li>
                    <li class="separator">&nbsp;</li>
                    <li>Shopping Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title -->
    <!-- Start Cart Content -->
    <div class="container padding-top-1x padding-bottom-3x">

        <!-- 未登录状态提示 -->
        @if(empty(session('username')))
        <div class="alert alert-info alert-dismissible fade show text-center margin-bottom-1x">
            <p>您还没有登录，登陆后购物车的商品将保存在亲的账号中<a class="btn btn-outline-primary btn-sm" href="/login">立即登录</a>
        </div>
        @endif
        <!-- 未登录状态提示结束 -->     


        <!-- Start Shopping Cart -->
        <div class="table-responsive shopping-cart">
        <!-- 未登录状态和没有商品加入购物车 -->
            @if(empty(session('username')))
                @if(empty($cookie))
                <table class="table">
                    <thead>
                        <tr>
                            <th>商品名称</th>
                            <th class="text-center">数量</th>
                            <th class="text-center">小计</th>
                            <th class="text-center">
                                <a class="btn btn-sm btn-outline-danger" href="/login">清空购物车</a>
                            </th>
                        </tr>
                    </thead>
                        <tr>
                            <td></td>
                            <td class="text-right">
                                <span>亲，您还没添加任何商品请去商城<a href="/goodslist" data-toggle="tooltip">添加商品</a></span>
                            </td>
                        </tr>
                </table>
                <!-- 未登录状态和没有商品加入购物车结束 -->
                    @else
                    <!-- 未登录状态和有商品加入购物车 -->
                    <table class="table">
                    <thead>
                    <tr>
                        <th>商品名称</th>
                        <th>数量</th>
                        <th class="text-center">小计</th>
                        <th class="text-center">
                            <a class="btn btn-sm btn-outline-danger" href="/login">清空购物车</a>
                        </th>
                    </tr>
                    </thead>
                        @foreach($cookie as $v)
                        <tr class="trs">
                            <td>
                                <div class="product-item">
                                    <a class="product-thumb" href="/goodslist/{{$v['gid']}}">
                                        <img src="{{$v['pic']}}" alt="Product">
                                    </a>
                                    <div class="product-info">
                                        <h4 class="product-title"><a href="/goodslist/{{$v['gid']}}">{{$v['name']}}</a></h4>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="gw_num">
                                    <center>
                                   <input type="text" value="{{$v['num']}}" class="num" readonly/>
                                   </center>
                                </div>
                            </td>
                            <td style="display:none">{{$v['price']}}</td>
                            <td class="text-center text-lg text-medium price">{{$v['price']}}</td>
                            <td class="text-center">
                                <a class="remove-from-cart remove" href="/login" data-toggle="tooltip"><i class="icon-cross"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @endif
                    <!-- 未登录状态和有商品加入购物车 -->
                @else
                <!-- 登录状态 -->
                <table class="table">
                    <thead>
                    <tr>
                        <th>商品名称</th>
                        <th class="text-center">数量</th>
                        <th class="text-center">小计</th>
                        <th class="text-center">
                            @if(!empty($art))
                            <!-- 购物车有商品 -->
                            <a class="btn btn-sm btn-outline-danger clean">清空购物车</a>
                            @else
                            <!-- 购物车没有商品 -->
                            <a class="btn btn-sm btn-outline-danger">清空购物车</a>
                            @endif
                        </th>
                    </tr>
                    </thead>
                    @if(!empty($art))
                    @foreach($art as $v)
                    <!-- 购物车有商品 -->
                    <tr class="trs">
                        <td>
                            <div class="product-item">
                                <a class="product-thumb" href="/goodslist/{{$v->id}}">
                                    <img src="{{$v->pic}}" alt="Product">
                                </a>
                                <div class="product-info">
                                    <h4 class="product-title"><a href="/goodslist/{{$v->id}}">{{$v->name}}</a></h4>
                                </div>
                            </div>
                        </td>
                        <td style="display:none" class="gid">{{$v->id}}</td>
                        <td class="text-center">
                            <center>
                            <div class="gw_num">
                                   <em class="jian">-</em>
                                   <input type="text" value="{{$v->num}}" class="num" readonly/>
                                   <em class="add">+</em>
                            </div>
                            </center>
                        </td>
                        <td style="display:none">{{$v->price}}</td>
                        <td class="text-center text-lg text-medium price">{{$v->total}}</td>
                        <td class="text-center">
                            <a class="remove-from-cart" href="#" data-toggle="tooltip"><i class="icon-cross del"></i></a>
                        </td>
                    </tr>
                    <!-- 购物车有商品结束 -->
                    @endforeach
                    @else
                    <!-- 购物车没有商品 -->
                    <table class="table">
                        <tr>
                            <td class="text-center">
                                <span>亲，您还没添加任何商品请去商城<a href="/goodslist" data-toggle="tooltip" >添加商品</a></span>
                            </td>
                        </tr>
                    </table>
                    <!-- 购物车没有商品结束 -->
                    @endif
                </table>
            @endif
            <!-- 登录状态结束 -->
        </div>
        <div class="shopping-cart-footer">
            <div class="column text-lg total">总计： 
                
                <span class="total"></span>

            </div>
        </div>
        <div class="shopping-cart-footer">
            <div class="column">
                <a class="btn btn-outline-secondary" href="/goodslist"><i class="icon-arrow-left"></i>&nbsp;继续购物</a>
            </div>
            <div class="column">
                <a id="update" class="btn btn-primary" href="#" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="您的购物车" data-toast-message="已更新成功" href="#">更新购物车</a><a class="btn btn-success" href="#">结账</a>
            </div>
        </div>
        <!-- End Shopping Cart -->
        <!-- Start Related Products -->
        <h3 class="text-center padding-top-3x mb-30">发布的产品</h3>
        <div class="owl-carousel" data-owl-carousel='{ "nav": false, "dots": false, "margin": 30, "responsive": {"0":{"items":1},"576":{"items":2},"768":{"items":3},"991":{"items":4},";1200":{"items":4}} }'>
            <!-- Start Product #1 -->
            @foreach($random as $v)
            <div class="grid-item">
                <div class="product-card">
                    <a class="product-thumb" href="/goodslist/{{$v->id}}">
                        <img src="{{$v->pic}}" alt="Product">
                    </a>
                    <h3 class="product-title"><a href="/goodslist/{{$v->id}}">{{$v->name}}</a></h3>
                    <h4 class="product-price">{{$v->price}}</h4>
                    <div class="product-buttons">
                        <div class="product-buttons">
                            <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist">
                                <i class="icon-heart"></i>
                            </button>
                            <div style="display:none">{{$v->id}}</div>
                            <button class="btn btn-outline-primary btn-sm addcart" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">加 入 购 物 车</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- End Product #1 -->
        </div>
        <!-- End Related Products -->
    </div>
    <!-- End Cart Content -->
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
    // 获取button按钮单击事件
    $(".addcart").click(function(){
        // alert(1);
        //获取gid
        gid = $(this).parent().find('div').html();
        // alert(gid)
        //使用ajax存储cookie
        $.get('/addcart',{gid:gid},function(data){
            });
        })
    //更新购物车
    $('#update').click(function(){
        window.location.reload();
    });
    //初始化totals值
    var totals = 0
    //遍历class为.price的数据
    $.each($('.price'),function(){
        //获取每件商品的小计
        prices = $(this).html();
        // alert(prices);
        // 转化数据类型
        a = parseInt(prices);
        // 每件商品的小计相加
        totals = totals + a;
    });

    //把总价写上去
    $('.total').html("总价："+totals);

    //减少商品的数量
    //class名为.jian的单击事件
    $('.jian').click(function(){
        //获取商品数量
        var num1 = $(this).next().val();
        //数量减一
        var n1 =parseInt(num1)-1;
        //判断数量是否等于0；等于零就赋值为1
        if(n1 == 0){
            n1 = 1;
        }
        //获取商品的id
        var gid = $(this).parents('td').prev().html();
        // alert(gid);
        // 通过ajax把商品的id传递过去
        $.get('/reduce',{gid:gid,num:n1},function(data){

        });
        //获取每个商品的单价
        var price = $(this).parents('td').next().html();
        // alert(n1);
        // alert(price);
        // 每个商品的单价乘以数量得出小计
        var total =price * n1;
        //把得出的小计写上去
        $(this).parents('td').next().next().html(total);
        //把数量写上去
        $(this).next().val(n1);
        //初始化totals
        var totals = 0
        //遍历class为.price的数据
        $.each($('.price'),function(){
        //获取每件商品的小计
        prices = $(this).html();
        // alert(prices);
        // 转化数据类型
        a = parseInt(prices);
        // 每件商品的小计相加
        totals = totals + a;
        // alert(totals);
        //把总价写上去
        $('.total').html("总价："+totals);
        });
    });


    //增加商品的数量
    //class名为.add的单击事件
    $('.add').click(function(){
        //获取商品数量
        num2 = $(this).prev().val();
        //商品数量加一
        var n2 =parseInt(num2)+1;
        // alert(num2);
        // 设置最大值
        if(n2 == 999){
            n2 = 999;
        }
        //获取商品id
        var gid = $(this).parents('td').prev().html();
        // alert(gid);
        // 通过ajax传递商品的id过去
        $.get('/reduce',{gid:gid,num:n2},function(data){

        });
        //获取每件商品的单价
        var price = $(this).parents('td').next().html();
        // alert(price);
        // 每件商品的单价乘以每件商品的数量得出总价
        var total =price * n2;
        //把每件商品的小计写上去
        $(this).parents('td').next().next().html(total);
        //把数量写上去
        $(this).prev().val(n2);
        // 初始化总价
        var totals = 0
        //遍历class名为price的数据
        $.each($('.price'),function(){
        //获取每件商品的小计
        prices = $(this).html();
        // alert(prices);
        // 转换数据类型
        a = parseInt(prices);
        // 每件商品的小计相加得出总价
        totals = totals + a;
        // alert(totals);
        // 把总价写上去
        $('.total').html("总价："+totals);
        });
    });

    //清空购物车
    $('.clean').click(function(){
        //判断是否确定清空购物车
        if(confirm('确认清空购物车吗')){
            // 把总价写为0
            $('.total').html("总价："+0);
            //把html代码赋值给v2
            var v2 = '<a class="btn btn-sm btn-outline-danger">清空购物车</a>';
            //把html代码赋值给v1
            var v1 = '<table class="table">'+
                '<tr>'+
                '<td class="text-center">'+
                '<span>亲，您还没添加任何商品请去商城<a href="/goodslist" data-toggle="tooltip" >添加商品</a></span>'+
                '</td>'+
                '</tr>'+
                '</table>';
            //删除class名为trs的html代码
            $('.trs').remove();
            //把v1写在talbe的父级元素的尾部
            $(this).parents('table').parent().append(v1);
            //吧v2写在清空购物车按钮的父级元素尾部
            //删除清空购物车按钮
            $('.clean').parent().append(v2);
            $('.clean').remove();
        }
        //通过ajax吧数据库的数据删除
        $.get('/clean',{},function(data){
        });
    });

    //通过ajax删除单件商品
    $('.del').click(function(){
        //获取每件商品的gid
        gid = $(this).parents('tr').find('td:first').next().html();
        //通过ajax删除对应的商品
        $.get('/del',{gid:gid},function(data){

        });
        //删除当前触发点击事件的父级元素的tr标签
        $(this).parents('tr').remove();
        // 初始化totals
        totals = 0;
        //遍历class名为price的数据
        $.each($('.price'),function(){
        //获取每件商品的小计
        prices = $(this).html();
        // alert(prices);
        // 初始化数据类型
        a = parseInt(prices);
        //每件商品的小计相加
        totals = totals + a;
        // alert(totals);
        // 把商品总价写上去
        $('.total').html("总价："+totals);
        });
        //判断class名为del的长度是否为0
        if($('.del').length == 0){
            // alert(1);
            // 把html代码赋值给v1
            var v1 = '<table class="table">'+
                '<tr>'+
                '<td class="text-center">'+
                '<span>亲，您还没添加任何商品请去商城<a href="/goodslist" data-toggle="tooltip" >添加商品</a></span>'+
                '</td>'+
                '</tr>'+
                '</table>';
            // 把v1写在class名为.table的父级元素的尾部
            $('.table').parent().append(v1);
            //把总价改为0
            $('.total').html("总价："+0);
        }
    });
    </script>
</html>
@endsection
