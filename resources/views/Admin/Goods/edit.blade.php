@extends("Admin.AdminPublics.public")
@section('admin')
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span></span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/goods/{{$data1->id}}" method="post" enctype="multipart/form-data">
      <div class="alert alert-danger">
      </div>
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品名称</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name" value="{{$data1->name}}" required /> 
       </div> 
      </div>
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品分类</label> 
       <div class="mws-form-item">
        <select name="cate_id">
          <!-- substr_count()统计某个元素子啊字符串中出现的次数 -->
          <!-- str_repeat()把某个元素重复多少次 -->
           @foreach($data as $v)
           {{$qianzhui = str_repeat('- ',(substr_count($v->path,','))*2)}}
          <option value="{{$v->id}}" {{$data1->cate_id=="$v->id"?'selected':''}} >{{$qianzhui}}{{$v->name}}</option>
          @endforeach
        </select>
       </div> 
      </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品价格</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="price" value="{{$data1->price}}" required/> 
       </div> 
      </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品库存</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="num" value="{{$data1->num}}" required/> 
       </div> 
      </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品描述</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="des" value="{{$data1->des}}" required/> 
       </div> 
      </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 原图片</label> 
       <div class="mws-form-item"> 
        <img src="../../{{$data1->pic}}" width="100">
       </div> 
      </div>
      <input type="hidden" value="{{$data1->pic}}" name="pic">
      <input type="hidden" value="{{$data1->time}}" name="time">
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品图片</label> 
       <div class="mws-form-item"> 
        <input type="file" class="large" name="pic"/> 
       </div> 
      </div>  
     </div>
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 状态</label> 
       <div class="mws-form-item">
        <label><input type="radio" name="status" value="上架" {{$data1->status==1?'checked':''}} />上架</label>
        <label>
        <input type="radio" name="status" {{$data1->status==0?'checked':''}} />下架</label>
       </div> 
      </div>
     <div class="mws-button-row">
      {{method_field("PUT")}}
      {{csrf_field()}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
 <script>
  $(':submit').click(function(){
      name = $('input[name=name]').val();
      price = $('input[name=price]').val();
      num = $('input[name=num]').val();
      des = $('input[name=des]').val();
      if(name == ''|| price==''|| num=='' || des== ''){
        alert('请 填 写 必 选 项 ');
        return false;
      }
    });
 </script>
</html>
@endsection
@section('title','商品修改页')