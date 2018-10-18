@extends("Home.HomePublic.public")
@section("title","商品列表")
@section("home")
<div style="background-color: #36414F; height: 124px;"></div>
<script type="text/javascript" src="static/jquery-1.8.3.min.js"></script>
<!-- Start Page Content -->
    <div class="container padding-top-1x padding-bottom-3x">
        <!-- Start Toolbar -->
        <div class="shop-toolbar mb-30">
            <div class="column">
                <div class="shop-sorting">
                    <center><h1>Goods List</h1></center>
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
            <div class="grid-item">
                <div class="product-card">
                    <a class="product-thumb" href="/goodslist/{{$v->id}}">
                        <img src="{{$v->pic}}" alt="Product">
                    </a>
                    <h3 class="product-title"><a href="#">{{$v->name}}</a></h3>
                    <h4 class="product-price">
                        <del>￥9999.99</del>￥ {{$v->price}}
                    </h4>
                    <div class="product-buttons">
                        <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist">
                            <i class="icon-heart"></i>
                        </button>
                        <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- 商品遍历结束 -->
        </div>
    </div>
@endsection