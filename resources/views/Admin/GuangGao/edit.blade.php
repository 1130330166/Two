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
    <form class="mws-form" action="/guanggao/update" method="post" enctype="multipart/form-data">
      <div class="alert alert-danger">
      </div>
     <div class="mws-form-inline">
      <input type="hidden" name="id" value="{{$str->id}}">  
      <input type="hidden" name="url" value="{{$str->url}}">  
      <div class="mws-form-row"> 
       <label class="mws-form-label">广告名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name" value="{{$str->name}}" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">广告图片</label> 
       <div class="mws-form-item"> 
        <input type="file" class="large" name="file" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">广告详情</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="content" value="{{$str->content}}" /> 
       </div> 
      </div>  
     </div> 
     <div class="mws-button-row">
      {{method_field('PUT')}}
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
      file = $('input[name=file]').val();
      if(file == ''){
        alert('请上传图片');
        return false;
      }
  });
    
 </script>
</html>
@endsection
@section('title','广告修改')