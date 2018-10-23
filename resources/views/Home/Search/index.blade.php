@extends("Home.HomePublic.public")
@section("title","搜索页")
@section("home")
<div style="background-color: #36414F; height: 124px;"></div>
<!-- 前台搜索页 -->
<!-- Start Page Content -->
    <div class="container padding-top-1x padding-bottom-3x">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Start Blog Posts -->
                <article class="row">
                    <div class="col-md-3 order-md-1">
                        <ul class="post-meta">
                            <li><i class="icon-clock"></i><a href="javascript:void(0);">&nbsp;本 次 搜 索 字 段 : </a></li>
                            <li><a href="javascript:void(0);">&nbsp;【 {{$keywords}} 】</a></li>
                        </ul>
                    </div>
                    <div class="col-md-9 order-md-2 blog-post">
                        <br>
                        @if(($goods))
                        <h6>本次查询数据有 {{count($goods)}} 条</h6><br>
                        @foreach($goods as $v)
                        <a href="/goodslist/{{$v->id}}">{{$v->name}}</a><br><br>
                        @endforeach
                        @else
                        <br>
                        <center><h1>此产品暂未上线</h1><h5>敬请期待</h5></center>
                        @endif
                    </div>
                </article>
            </div>
        </div>
    </div>
    <!-- End Page Content -->
<!-- 前台搜索页 -->
@endsection