@extends("Home.HomePublic.public")
@section("title","前台首页")
@section("home")
<!-- End NavBar -->
<div class="offcanvas-wrapper">
    <!-- Start Hero Content -->
    <section class="fw-section padding-top-7x padding-bottom-7x home-3-hero">
        <div class="container padding-top-3x text-center">
            <div class="d-inline-block mb-30">
                <img class="d-block w-150" src="static/assets/images/hero/logo-watch.png" alt="iWatch">
            </div>
            <h2 class="text-white text-normal mb-2">iWatch Premium Watch Collection</h2>
            <h6 class="text-white text-normal opacity-80 mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry ...</h6>
            <a class="btn btn-primary scroll-to" href="#collections">View Collection</a>
        </div>
    </section>
    <!-- End Hero Content -->
    <!-- Video Carousel-->
    <section class="container padding-top-3x padding-bottom-3x" id="collections">
        <!-- 这是广告 -->
        @foreach($list as $v)
        @if($v->status)
        <div class="alert alert-default alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span>
            <p>这是广告</p>
            <img src="{{$v->url}}" alt="这是广告" style="width:1135px;height:200px">
        </div>
        @endif
        @endforeach
        <!-- 广告结束 -->
         <!-- 轮播图 -->
        @if(count($arr) > 0)
        <h3 class="text-center mb-30">iWatch Video Collections</h3>
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="gallery-wrapper owl-carousel" data-owl-carousel="{ 'nav': true, 'dots': true }">
                	@foreach($arr as $row)
                    <div class="gallery-item no-hover-effect"><a href="#" data-video="<div class='wrapper'><div class='video-wrapper'><iframe class='pswp__video' width='960' height='640' "><img src="{{$row->path}}" alt="Cover" style="width:1000px;height:500px"></a><span class="caption">Classic Collection</span></div>
        			@endforeach
                </div> 
            </div>
        </div>
        @endif
       	<!-- 轮播图 -->
    </section>
    <!-- Start Hero Products -->
    <section class="bg-secondary padding-top-3x padding-bottom-3x">
        <div class="container">
            <h3 class="text-center mb-30">Trend Product Gathering Place</h3>
            <div class="isotope-grid filter-grid cols-4 mt-30">
                <div class="gutter-sizer"></div>
                <div class="grid-sizer"></div>
                <!-- Start 手机 #1 -->
                @foreach($goods as $v)
                <div class="grid-item classic">
                    <div class="product-card">
                        <a class="product-thumb" href="shop-single-1.html">
                            <img src="{{$v->pic}}" alt="Product" style="width: 225px;height: 200px">
                        </a>
                        <h2 class="product-title"><a href="shop-single-1.html">{{$v->name}}</a></h3>
                        <h3 class="product-title">类别 : {{$v->catename}}</h3>
                        <h4 class="product-price">¥ {{$v->price}}</h4>
                        <div class="product-buttons">
                            <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist">
                                <i class="icon-heart"></i>
                            </button>
                            <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!" href="#">Add to Cart</button>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- End 手机 #1 -->
            </div>
        </div>
    </section>
    <!-- End Hero Products -->
    <!-- Start Services -->
    <section class="container padding-top-3x padding-bottom-3x">
        <div class="row">
            <div class="col-md-3 col-sm-6 text-center home-cat">
                <img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="static/assets/images/services/01.png" alt="Shipping">
                <h6>Free Shipping</h6>
                <p class="text-muted margin-bottom-none">On order over $200 ...</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center home-cat">
                <img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="static/assets/images/services/02.png" alt="Money Back">
                <h6>Money Back</h6>
                <p class="text-muted margin-bottom-none">Moneyback guarantee ...</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center home-cat">
                <img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="static/assets/images/services/03.png" alt="Support">
                <h6>24/7 Support</h6>
                <p class="text-muted margin-bottom-none">Online consultations ...</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center home-cat">
                <img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="static/assets/images/services/04.png" alt="Payment">
                <h6>Secure Payment</h6>
                <p class="text-muted margin-bottom-none">Safe Shopping Guarantee ...</p>
            </div>
        </div>
    </section>
    <!-- End Services -->
@endsection