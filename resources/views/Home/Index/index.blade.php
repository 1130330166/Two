@extends("Home.HomePublic.public")
@section("title","前台首页")
@section("home")
<script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="static/jquery-1.8.3.min.js"></script>
<!-- 公告模块样式开始 -->
<style type="text/css">
.cls_container{border:1px solid #eee;width:100%;font-size:12px;height:24px;overflow:hidden;background-color: #FEFECC;}
.cls_container ul{list-style-type:none;margin:0;padding:0;margin-left:32px;}
.cls_container ul li{height:26px;line-height:26px;width:100%;float:left;display:inline;}
.myscroll{
    width:100%;
    margin: 0 auto;
}
</style> 
<!-- /公告模块样式结束 -->
<!-- 公告模块开始 -->
    <div id="myscroll" class="cls_container " align="center">
        <ul>
        @foreach($data as $v)
        <input type="hidden" name="id" value="{{$v->id}}">
        <li><a href="/homearticle/{{$v->id}}"><font color="#36414F" size="2">{{$i++}} . {{$v->title}}</a></font> <a href="javascript:void(0);" onclick="javascript:turnoff('myscroll')"><font size="2">点击关闭公告显示</a></font>
        </li>
        @endforeach
        </ul>
        
    </div>
    <!-- /公告模块结束 -->
<!-- End NavBar -->
<div class="offcanvas-wrapper">
    <!-- Start Hero Content -->
    <section class="fw-section padding-top-7x padding-bottom-7x home-3-hero">
        <div class="container padding-top-3x text-center">
            <div class="mb-30">
                <h1 class="text-white text-normal mb-2" title="超级产品">Super Product</h1>
            </div>
            <h2 class="text-white text-normal mb-2">趋 势 产 品 聚 集 地</h2>
            <h6 class="text-white text-normal opacity-80 mb-4">Welcome to here !</h6>
            <a class="btn btn-primary scroll-to" href="/goodslist" title="更多精彩">More</a>
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
        <h3 class="text-center mb-30" title="轮播图">Sowing map</h3>
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
            <h3 class="text-center mb-30" title="趋势产品聚集地">Trend Product Gathering Place</h3>
            <div class="isotope-grid filter-grid cols-4 mt-30">
                <div class="gutter-sizer"></div>
                <div class="grid-sizer"></div>
                <!-- Start 手机 #1 -->
                @foreach($goods as $v)
                <div class="grid-item classic" style="display: {{$v->status=='0'?'none;':'block;'}}">
                    <div class="product-card">
                        <a class="product-thumb" href="/goodslist/{{$v->id}}">
                            <img src="{{$v->pic}}" style="width: 100%;height:200px">
                        </a>
                        <h2 class="product-title"><a href="/{{$v->id}}">{{$v->name}}</a></h3>
                        <h3 class="product-title">类别 : {{$v->catename}}</h3>
                        <h4 class="product-price">¥ {{$v->price}}</h4>
                        <div class="product-buttons">
                            <string style="color:orange;font-size:12px;display:none" class="num">{{$v->like}}</string>
                            <string style="color:orange;font-size:12px;">{{$v->like>999?"999+":"$v->like"}}</string>
                            <button class="btn btn-outline-secondary btn-sm "  name="up">
                                <i class="icon-heart"></i>
                            </button>
                            <div style="display:none">{{$v->id}}</div>
                            <button class="btn btn-outline-primary btn-sm addcart" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!" href="#">加 入 购 物 车</button>
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
                <h6>免 费 拿 货</h6>
                <p class="text-muted margin-bottom-none">订 单 金 额 超 过 1299 元</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center home-cat">
                <img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="static/assets/images/services/02.png" alt="Money Back">
                <h6>退 款</h6>
                <p class="text-muted margin-bottom-none">退 款 保 证</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center home-cat">
                <img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="static/assets/images/services/03.png" alt="Support">
                <h6>24 小 时 在 线</h6>
                <p class="text-muted margin-bottom-none">在 线 客 服</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center home-cat">
                <img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="static/assets/images/services/04.png" alt="Payment">
                <h6>安 全 付 款</h6>
                <p class="text-muted margin-bottom-none">安 全 购 物 保 证</p>
            </div>
        </div>
    </section>
    <!-- End Services -->
    <!-- 存储cookie -->
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

        $('button[name=up]').click(function(){
            gid = $(this).next().html();
            like = $(this).prev().prev().html();
            a = $(this);
            $.get('/up',{gid:gid,like:like},function(data){
              if(data){
                like = parseInt(like)+1;
                a.prev().prev().html(like);
                if(like > 999){
                  like = 999+"+";
                }
                a.prev().html(like);
              }
            })
        });
    </script>
    <!-- 公告滚动脚本开始 -->
<script type="text/javascript">
function $(element){
 if(arguments.length>1){
  for(var i=0,length=arguments.length,elements=[];i<length;i++){
   elements.push($(arguments[i]));
  }
  return elements;
 }
 if(typeof element=="string"){
  return document.getElementById(element);
 }else{
  return element;
 }
}
var Class={
 create:function(){
  return function(){
   this.initialize.apply(this,arguments);
  }
 }
}
Function.prototype.bind=function(object){
 var method=this;
 return function(){
  method.apply(object,arguments);
 }
}
var Scroll=Class.create();
Scroll.prototype={
 initialize:function(element,height){
  this.element=$(element);
  this.element.innerHTML+=this.element.innerHTML;
  this.height=height;
  this.maxHeight=this.element.scrollHeight/2;
  this.counter=0;
  this.scroll();
  this.timer="";
  this.element.onmouseover=this.stop.bind(this);
  this.element.onmouseout=function(){this.timer=setTimeout(this.scroll.bind(this),1000);}.bind(this);
 },
 scroll:function(){
  if(this.element.scrollTop<this.maxHeight){
   this.element.scrollTop++;
   this.counter++;
  }else{
   this.element.scrollTop=0;
   this.counter=0;
  }
  
  if(this.counter<this.height){
   this.timer=setTimeout(this.scroll.bind(this),22);
  }else{
   this.counter=0;
   this.timer=setTimeout(this.scroll.bind(this),3126);
  }
 },
 stop:function(){
  clearTimeout(this.timer);
 }
}
var myscroll=new Scroll("myscroll",26);
// 公告点击关闭按钮开始
function turnoff(obj){
document.getElementById(obj).style.display="none";
}
// 公告点击关闭按钮结束
</script>
<!-- /公告滚动脚本结束 -->

<!-- 分享按钮开始 -->
<script>
  window._bd_share_config = {
    // 这是配置内容
    common : {
      bdText : 'This is our two phase._这是我们的项目的_首页', 
      bdDesc : 'Victory_Two_二期项目哔哔大队', 
      bdUrl : 'www.two.com',   
      bdPic : 'www.two.com/static/assets/images/features/02.jpg',
      bdSign: 'on',
      bdMini: '1'
    },
    // 分享按钮设置
    share : [{
      "bdSize" : 2
    }],
    // 浮窗按钮设置
    slide : [{     
      bdImg : 0,
      bdPos : "right",
      bdTop : 266,
      bdMiniList : ['mshare','qzone','tsina','copy','weixin']
    }],
  }
  with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
<!-- /分享按钮结束 -->
@endsection