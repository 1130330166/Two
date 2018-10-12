@extends("Admin.AdminPublics.public")
@section('admin')
<html>
  <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span></span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/guanggao" method="post" enctype="multipart/form-data">
      <div class="alert alert-danger">
      </div>
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">广告名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name" value=""/> 
       </div> 
      </div>  
      <div class="mws-form-row"> 
       <label class="mws-form-label">广告详情</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="content" value="" />
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">广告图片</label> 
       <div class="mws-form-item"> 
        <input type="file" class="large" name="file" /> 
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
  <script>
    $(':submit').click(function(){
      name = $('input[name=name]').val();
      content = $('input[name=content]').val();
      file = $('input[name=file]').val();
      if(name == '' || content == '' || file == ''){
        alert('请认真填写资料');
        return false;
      }
    });
  </script>
</html>
@endsection
@section('title','广告添加')