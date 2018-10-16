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
    <form class="mws-form" action="/nodelist/{{$nodelist->id}}" method="post" enctype="multipart/form-data">
      <div class="alert alert-danger">
      </div>
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">权限名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name" value="{{$nodelist->name}}" required/> 
       </div>  
     </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">控制器</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="mname" value="{{$nodelist->mname}}" required/> 
       </div>  
     </div>
      <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">方法名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="aname" value="{{$nodelist->aname}}" required/> 
       </div>  
     </div> 
     <div class="mws-button-row">
      {{method_field('PUT')}}
      {{csrf_field()}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="恢复加载数据" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
 <script>
   $(':submit').click(function(){
        name = $('input[name=name]').val();
        mname = $('input[name=mname]').val();
        cname = $('input[name=cname]').val();
        if(name == ''|| mname == '' || cname == ''){
          alert('请 填 写 必 填 项 !');
          return false;
        }
    });
 </script>
</html>
@endsection
@section('title','权限修改页面')