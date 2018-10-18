@extends("Home.HomePublic.public")
@section("home")
<div style="background-color: #36414F; height: 124px;"></div>
<script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
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
                <div class="rating-stars">
                    <i class="icon-star filled"></i>
                    <i class="icon-star filled"></i>
                    <i class="icon-star filled"></i>
                    <i class="icon-star filled"></i>
                    <i class="icon-star filled"></i>
                </div>
                <span class="text-muted align-middle">&nbsp;&nbsp;5 | 13 客户评论</span>
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
                    <a class="navi-link" href="#">{{$catename}}</a>
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
                        <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="" data-original-title="Whishlist">
                            <i class="icon-heart"></i>
                        </button>
                        <button class="btn btn-primary" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-bag"></i> Add to Cart</button>
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
                    <!-- Start Review #1 -->
                    <div class="comment">
                        <div class="comment-author-ava"><img src="/static/assets/images/reviews/01.jpg" alt="Review Author"></div>
                        <div class="comment-body">
                            <div class="comment-header d-flex flex-wrap justify-content-between">
                                <h4 class="comment-title">Lorem Ipsum is simply dummy</h4>
                                <div class="mb-2">
                                    <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i></div>
                                </div>
                            </div>
                            <p class="comment-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
                            <div class="comment-footer"><span class="comment-meta">John Doe</span></div>
                        </div>
                    </div>
                    <!-- End Review #1 -->
                    <!-- Start Review #2 -->
                    <div class="comment">
                        <div class="comment-author-ava"><img src="/static/assets/images/reviews/02.jpg" alt="Review Author"></div>
                        <div class="comment-body">
                            <div class="comment-header d-flex flex-wrap justify-content-between">
                                <h4 class="comment-title">Lorem Ipsum is simply dummy</h4>
                                <div class="mb-2">
                                    <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i></div>
                                </div>
                            </div>
                            <p class="comment-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
                            <div class="comment-footer"><span class="comment-meta">Julia Smith</span></div>
                        </div>
                    </div>
                    <!-- End Review #2 -->
                    <!-- Start Review #3 -->
                    <div class="comment">
                        <div class="comment-author-ava"><img src="{{$info->pic}}" alt="Review Author"></div>
                        <div class="comment-body">
                            <div class="comment-header d-flex flex-wrap justify-content-between">
                                <h4 class="comment-title">Lorem Ipsum is simply dummy</h4>
                                <div class="mb-2">
                                    <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i></div>
                                </div>
                            </div>
                            <p class="comment-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
                            <div class="comment-footer"><span class="comment-meta">Rick Armstrong</span></div>
                        </div>
                    </div>
                    <!-- End Review #3 -->
                    <!-- Start Review Form -->
                    <h5 class="mb-30 padding-top-1x">Leave Review</h5>
                    <form class="row" method="post">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review_name">Your Name</label>
                                <input class="form-control form-control-rounded" type="text" id="review_name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review_email">Your Email</label>
                                <input class="form-control form-control-rounded" type="email" id="review_email" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review_subject">Your Subject</label>
                                <input class="form-control form-control-rounded" type="text" id="review_subject" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review_rating">Your Rate</label>
                                <select class="form-control form-control-rounded" id="review_rating">
                                    <option>5 Stars</option>
                                    <option>4 Stars</option>
                                    <option>3 Stars</option>
                                    <option>2 Stars</option>
                                    <option>1 Star</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="review_text">Review </label>
                                <textarea class="form-control form-control-rounded" id="review_text" rows="8" required></textarea>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <button class="btn btn-outline-primary" type="submit">Submit Review</button>
                        </div>
                    </form>
                    <!-- End Review Form -->
                </div>
            </div>
        </div>
        <!-- End Product Tabs -->
    </div>
    <!-- End Product Content -->            
@endsection
@section("title","商品详情页")