@extends("Admin.AdminPublics.public")
@section('admin')
<html>
 <head></head>
  <script type="text/javascript" charset="utf-8" src="/static/admins/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/static/admins/ueditor/ueditor.all.min.js">
</script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加
载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/static/admins/ueditor/lang/zh-cn/zh-cn.js">
</script>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span></span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/goods" method="post" enctype="multipart/form-data">
      <div class="alert alert-danger">
      </div>
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品名称</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name" value=""/> 
       </div> 
      </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品分类</label> 
       <div class="mws-form-item">
        <select name="cate_id">
          <option value="">- - 请选择 - -</option>
          <!-- substr_count()统计某个元素子啊字符串中出现的次数 -->
          <!-- str_repeat()把某个元素重复多少次 -->
           @foreach($data as $v)
           {{$qianzhui = str_repeat('- ',(substr_count($v->path,','))*2)}}
          <option value="{{$v->id}}">{{$qianzhui}}{{$v->name}}</option>
          @endforeach
        </select>
       </div> 
      </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品价格</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="price" value=""/> 
       </div> 
      </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品库存</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="num" value=""/> 
       </div> 
      </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品标题</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="title" value=""/> 
       </div> 
      </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品规格(内存/版本)</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="size" value=""/> 
       </div> 
      </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品颜色</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="color" value=""/> 
       </div> 
      </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品描述</label>
       <div class="mws-form-item"> 
       </div> 
      </div>
      <script id="editor" type="text/plain" name="des" style="width:1060px;height:100px;"> </script>
      <div class="mws-form-row"> 
       <label class="mws-form-label">* 商品图片</label> 
       <div class="mws-form-item"> 
        <input type="file" class="large" name="pic" /> 
       </div> 
      </div>  
     </div> 
     <div class="mws-button-row">
      {{csrf_field()}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">
//实例化编辑器
//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接
// 调用UE.getEditor('editor')就能拿到相关的实例
var ue = UE.getEditor('editor');
</script>
 <script>
  $(':submit').click(function(){
      name = $('input[name=name]').val();
      pic = $('input[name=pic]').val();
      price = $('input[name=price]').val();
      num = $('input[name=num]').val();
      des = $('script[name=des]').val();
      title = $('input[name=title]').val();
      size = $('input[name=size]').val();
      color = $('input[name=color]').val();
      if(name == '' || pic == ''|| price==''|| num=='' || des== '' || title== '' || size== '' || color== ''){
        alert('请 填 写 必 选 项 ');
        return false;
      }
    });
 </script>
</html>
@endsection
@section('title','商品添加页')