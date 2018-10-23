@extends("Home.HomePublic.public")
@section("title","商品分类列表")
@section("home")
<div style="background-color: #36414F; height: 124px;"></div>
<!-- Start Page Content -->
    <div class="container padding-top-1x padding-bottom-3x">
        <!-- Start Toolbar -->
        <div class="shop-toolbar mb-30">
            <div class="column">
                <div class="shop-sorting">
                    <h6>当前分类 &gt; {{$catesname}} </h6>
                </div>
            </div>
            <!-- 这里右上角的按钮位置 -->
            <div class="column">
            </div>
        </div>
        <!-- End Toolbar -->
        <!-- Start Products Grid -->
        <div class="isotope-grid cols-4">
            <div class="gutter-sizer"></div>
            <div class="grid-sizer"></div>
            <!-- 商品遍历开始 -->
            @foreach($goods as $v)
            <div class="grid-item" style="display: {{$v->status=='0'?'none;':'block;'}}">
                <div class="product-card">
                    <a class="product-thumb" href="/goodslist/{{$v->id}}">
                        <img src="../{{$v->pic}}" style="width: 100%;height:200px">
                    </a>
                    <h3 class="product-title"><a href="#">{{$v->name}}</a></h3>
                    <h4 class="product-price">
                        <del>￥9999.99</del>￥ {{$v->price}}
                    </h4>
                    <div class="product-buttons">
                        <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist">
                            <i class="icon-heart"></i>
                        </button>
                        <div style="display:none">{{$v->id}}</div>
                        <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">加 入 购 物 车</button>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- 商品遍历结束 -->
        </div>
    </div>
    <script type="text/javascript" src=".././static/jquery-1.8.3.min.js"></script>
    <script>
        // 获取button按钮单击事件
        $(":button").click(function(){
            // alert(1);
            //获取gid
            gid = $(this).parent().find('div').html();
            // alert(gid)
            //使用ajax存储cookie
                $.get('/addcart',{gid:gid},function(data){
                });
        })
    </script>
@endsection