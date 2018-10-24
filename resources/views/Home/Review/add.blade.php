@extends("Home.HomePublic.public")
@section("home")
<div style="background-color: #36414F; height: 124px;"></div>
<div style="width:1000px;margin:0 auto;">
<div class="alert alert-error alert-dismissible fade show text-center margin-bottom-1x nerror" style="display: none">
              <span class="alert-close" data-dismiss="alert"></span>
              <p><font color="red">请 登 录 后 再 操 作 <a href="/login"> 登录</a></font></p>
</div>
<!-- 写入评论开始 -->
  <!-- 添加成功与否信息显示开始 -->
<!--   @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x">
      <span class="alert-close" data-dismiss="alert"></span>
      <p>{{session('success')}}</p>
  </div>
  @endif

  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x">
      <span class="alert-close" data-dismiss="alert"></span>
      <p>{{session('error')}}</p>
  </div>
  @endif -->
  <!-- 添加成功与否信息显示结束 -->
<h5 class="mb-30 padding-top-1x">撰写评论</h5>
<h6 class="mb-30 padding-top-1x">当前订单号 : {{$orderinfo->oid}}</h6>
<br>
<form class="row" method="post" action="/review">
    <div class="col-sm-6">
        <div class="form-group">
            <input type="hidden" name="oid" value="{{$orderinfo->oid}}">
            <input type="hidden" name="status" value="4">
            <label for="review_rating">所评价的商品:</label>
            <input type="text" class="form-control form-control-rounded" name="goodsname" value="@foreach($orderinfo->goodsinfo as $row) {{$row->name}}_&nbsp; @endforeach" readonly/><br>
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
            <textarea class="form-control form-control-rounde" id="review_text" rows="8" name="content" required placeholder="请 填 写 评 论 内 容 【只 可 以 输 入 中 文】" onkeyup="this.value=this.value.replace(/[^\u4e00-\u9fa5]/g,'')"></textarea>
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
@section("title","评论页")