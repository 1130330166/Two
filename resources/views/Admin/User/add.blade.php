@extends("Admin.AdminPublics.public")
@section('admin')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>用户添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminuser" method="post">
      <div class="alert alert-danger">
          <div class="mws-form-message error">
            <ul>
            <li> </li>
            </ul>
          </div>
      </div>
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">用户名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="username" value="{{old('username')}}"/> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">密码</label> 
       <div class="mws-form-item"> 
        <input type="password" class="large" name="password" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">确认密码</label> 
       <div class="mws-form-item"> 
        <input type="password" class="large" name="repassword" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">邮箱</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="email" value="{{old('email')}}"/> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">手机号</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="phone" value="{{old('phone')}}" /> 
       </div> 
      </div>  
     </div> 
     <div class="mws-button-row">
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','后台用户添加')