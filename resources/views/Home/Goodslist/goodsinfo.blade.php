@extends("Home.HomePublic.public")
@section("home")
<div style="background-color: #36414F; height: 124px;"></div>

<!-- 评论信息添加成功提示开始 -->
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x">
      <span class="alert-close" data-dismiss="alert"></span>
      <p>{{session('success')}}</p>
  </div> 
@endif
<!-- /评论信息添加成功提示结束 -->

<!-- 提示信息的样式开始 -->
@if (count($errors) > 0)
<div class="alert alert-danger">
<div class="mws-form-message error">
<ul>
@foreach ($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
</div>
@endif
<!-- /提示信息的样式结束 -->

<!-- Start Product Content -->
    <div class="container padding-top-1x padding-bottom-3x">
        <div class="row">
            <!-- Start Product Gallery -->
            <div class="col-md-6">
                <div class="product-gallery"><span class="product-badge text-danger">20% Off</span>
                    <div class="gallery-wrapper">
                        <div class="gallery-item active"><a href="../{{$pic}}" data-hash="one" data-size="1000x667"></a></div>
                        <div class="gallery-item"><a href="../{{$pic}}" data-hash="two" data-size="1000x667"></a></div>
                        <div class="gallery-item"><a href="../{{$pic}}" data-hash="three" data-size="1000x667"></a></div>
                        <div class="gallery-item"><a href="../{{$pic}}" data-hash="four" data-size="1000x667"></a></div>
                        <div class="gallery-item"><a href="../{{$pic}}" data-hash="five" data-size="1000x667"></a></div>
                    </div>
                    <div class="product-carousel owl-carousel">
                        <div data-hash="one"><img src="../{{$pic}}" alt="Product"></div>
                        <div data-hash="two"><img src="../{{$pic}}" alt="Product"></div>
                        <div data-hash="three"><img src="../{{$pic}}" alt="Product"></div>
                        <div data-hash="four"><img src="../{{$pic}}" alt="Product"></div>
                        <div data-hash="five"><img src="../{{$pic}}" alt="Product"></div>
                    </div>
                    <ul class="product-thumbnails">
                        <li class="active"><a href="#one"><img src="../{{$pic}}" alt="Product"></a></li>
                        <li><a href="#two"><img src="../{{$pic}}" alt="Product"></a></li>
                        <li><a href="#three"><img src="../{{$pic}}" alt="Product"></a></li>
                        <li><a href="#four"><img src="../{{$pic}}" alt="Product"></a></li>
                        <li><a href="#five"><img src="../{{$pic}}" alt="Product"></a></li>
                    </ul>
                </div>
            </div>
            <!-- End Product Gallery -->
            <!-- Start Product Info -->
            <div class="col-md-6 single-shop">
                <div class="hidden-md-up"></div>
                <h2 class="padding-top-1x text-normal with-side">{{$info->name}}</h2>
                <span class="h2 d-block with-side"><del class="text-muted text-normal">￥ 10999.00</del>&nbsp; ￥ {{$info->price}}</span>
                <br>
                <p>{{$info->title}}</p>
                <br>
                <div class="row margin-top-1x">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="size">规格</label>
                            <select class="form-control" id="size">
                                <option>请选择</option>
                                <option selected>{{$info->size}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="color">颜色</label>
                            <select class="form-control" id="color">
                                <option>请选择</option>
                                <option selected>{{$info->color}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="quantity"></label>
                            
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="pt-1 mb-2"><span class="text-medium">CCK :</span> #176856869068769932</div>
                <br>
                <div class="padding-bottom-1x mb-2">
                    <span class="text-medium">类 别 :&nbsp;</span>
                    <a class="navi-link" href="javascript:void(0);">{{$catename}}</a>
                </div>
            </div>
            <div class="col-md-12">
                <hr class="mt-30 mb-30">
                <div class="d-flex flex-wrap justify-content-between mb-30">
                    <div class="entry-share">
                        <span class="text-muted">Share:</span>
                        <div class="share-links">
                            <a class="social-button shape-circle sb-facebook" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
                                <i class="socicon-facebook"></i>
                            </a>
                            <a class="social-button shape-circle sb-twitter" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
                                <i class="socicon-twitter"></i>
                            </a>
                            <a class="social-button shape-circle sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Instagram">
                                <i class="socicon-instagram"></i>
                            </a>
                            <a class="social-button shape-circle sb-google-plus" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Google +">
                                <i class="socicon-googleplus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="sp-buttons mt-2 mb-2">
                        <div style="display:none">{{$info->id}}</div>
                        <button class="btn btn-primary" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-bag"></i> 加 入 购 物 车</button>
                    </div>
                </div>
            </div>
            <!-- End Product Info -->
        </div>
        <!-- Start Product Tabs -->
        <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" href="#description" data-toggle="tab" role="tab">商 品 描 述</a></li>
                <li class="nav-item"><a class="nav-link" href="#reviews" data-toggle="tab" role="tab">评 价</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                    <p>{!!$info->des!!}</p>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <!-- 提示信息的样式开始 -->
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                    <div class="mws-form-message error">
                    <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    </div>
                    </div>
                    @endif
                    <!-- /提示信息的样式结束 -->
                    <!-- 写入评论开始 -->
                    <h5 class="mb-30 padding-top-1x">撰写评论</h5>
                    <form class="row" method="post" action="/review">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{$info->id}}">
                                <input type="hidden" name="goodsname" value="{{$info->name}}">
                                 <div class="alert alert-error alert-dismissible fade show text-center margin-bottom-1x nerror" style="display: none">
                                  <span class="alert-close" data-dismiss="alert"></span>
                                  <p><font color="red">请 登 录 后 再 操 作 <a href="/login"> 登录</a></font></p>
                              </div>
                                <label for="review_name">当 前 用 户</label>
                                <input class="form-control form-control-rounded" type="text" id="review_name" name="username" value="{{session('username')}}" readonly />
                            </div>
                        </div>
                        
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review_rating">你 的 评 价</label>
                                <select class="form-control form-control-rounded" id="review_rating" name="leavel">
                                    <option value="3">好 评</option>
                                    <option value="2">中 评</option>
                                    <option value="1">差 评</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="review_text">评 论 内 容 </label>
                                <textarea class="form-control form-control-rounde" id="review_text" rows="8" name="content" required placeholder="请 填 写 评 论 内 容"></textarea>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            {{csrf_field()}}
                            <button class="btn btn-outline-primary reviews" type="submit">提 交 评 论</button>
                        </div>
                    </form>
                    <!-- /写入评论结束 -->
                    <br>
                    <hr>
                    <br>
                    <h5 class="mb-30 padding-top-1x">评论列表</h5><h6>(最新评论)</h6>
                    <!-- 评论遍历开始 -->
                    @foreach($review as $v)
                    <div class="comment">
                        <div class="comment-author-ava"><img src="/static/assets/images/reviews/01.jpg" alt="Review Author"></div>
                        <div class="comment-body">
                            <div class="comment-header d-flex flex-wrap justify-content-between">
                                <div class="mb-2">
                                    @if($v->leavel =='3')
                                    <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i>
                                        <i class="icon-star filled"></i>
                                        <i class="icon-star filled"></i><i class="icon-star filled"></i></div>
                                    @elseif($v->leavel == '2')
                                    <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i>
                                        <i class="icon-star filled"></i></div>
                                    @elseif($v->leavel == '1')
                                    <div class="rating-stars"><i class="icon-star filled"></i></div>
                                    @endif
                                </div>
                                <div class="mb-2">
                                    商品 # <b> {{$v->goodsname}}</b>
                                </div>
                            </div>
                            <p class="comment-text">{{$v->content}}</br></p>
                            <div class="comment-footer"><span class="comment-meta">{{$v->musername}} &nbsp;&nbsp;&nbsp;&nbsp; 评论时间 : {{$v->time}}</span></div>
                        </div>
                    </div>
                    @endforeach
                    <!-- /评论遍历结束 -->
                </div>
            </div>
        </div>
        <!-- End Product Tabs -->
    </div>
    <!-- End Product Content -->
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
        // 验证用户是否登录_评论内容是否填写
        $(".reviews").click(function(){
            // alert(1);
            var name = $('input[name=username]').val();
            var content = $('input[name=content]').val();
            // 判断用户名是否登录
            if(name==""|| content==""){
                // 更改弹框状态
                 $('.nerror').attr('style','display:block');
                //阻止表单跳转
                return false;
            }
        });
    </script>          
@endsection
@section("title","商品详情页")