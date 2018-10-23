@extends("Home.HomePublic.public")
@section("title","公告页面")
@section("home")
<div style="background-color: #36414F; height: 124px;"></div>
<!-- 公告页面部分开始 -->
<!-- Start Page Content -->
    <div class="container padding-top-1x padding-bottom-3x">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Start Blog Posts -->
                <article class="row">
                    <div class="col-md-3 order-md-1">
                        <ul class="post-meta">
                            <li><i class="icon-clock"></i><a href="javascript:void(0);">&nbsp;发布时间</a></li>
                            <li><i class="icon-clock"></i><a href="javascript:void(0);">&nbsp;{{$article->time}}</a></li>
                        </ul>
                    </div>
                    <div class="col-md-9 order-md-2 blog-post">
                        <h3 class="post-title">{{$article->title}}</h3>
                        <p>{!!$article->des!!}</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <!-- End Page Content -->
<!-- /公告页面部分结束 -->
@endsection