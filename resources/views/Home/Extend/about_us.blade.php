@extends("Home.HomePublic.public")
@section("title","关于我们")
@section("home")
<div style="background-color: #36414F; height: 124px;"></div>
<br>
<br>
<br>
<br>
<br>
<div class="container">
        <!-- Start About Us -->
        <div class="row align-items-center padding-bottom-3x">
            <div class="col-md-5">
                <img class="d-block w-270 m-auto" src="/static/assets/images/features/01.jpg" alt="Online Shopping">
            </div>
            <div class="col-md-7 text-md-left text-center">
                <div class="hidden-md-up"></div>
                <h2>在线安全支付</h2>
                <p>在线支付的安全性由银行方面保障，当用户选择了在线支付后，在需要填写银行卡资料时，实际上已经离开本站服务器，到达了到银行的支付网关。国内各大银行的支付网关，都采用了国际流行的SSL或SET方式加密，可以保障您的任何信息不会被任何人窃取。因为在线支付是在银行的支付网关中完成的，所以用户也不必担心您的银行卡资料会在经由本站泄露。</p>
            </div>
        </div>
        <hr>
        <div class="row align-items-center padding-top-3x padding-bottom-3x">
            <div class="col-md-5 order-md-2">
                <img class="d-block w-270 m-auto" src="/static/assets/images/features/02.jpg" alt="Delivery">
            </div>
            <div class="col-md-7 order-md-1 text-md-left text-center">
                <div class="hidden-md-up"></div>
                <h2>快速免费送货</h2>
                <p>消费金额达99元免费送货</p>
            </div>
        </div>
        <hr>
        <!-- End About Us -->
</div>
@endsection