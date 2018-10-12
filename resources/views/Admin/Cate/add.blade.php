@extends("Admin.AdminPublics.public")
@section('title','后台分类添加')
@section('admin')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>分类添加</span> 
   </div> 

   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/admincate" method="post">

       <!-- 提示框开始 -->
       @if (count($errors) > 0)
        <div class="mws-form-message error">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
       @endif
      <!-- 提示框结束 -->

     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">分类名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name" value="{{old('name')}}" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">父类</label> 
       <div class="mws-form-item"> 
        <select class="large" name="pid">
          <option value="0">--请选择--</option>
          @if(!empty($cate))
          @foreach($cate as $row)
          <option value="{{$row->id}}">{{$row->name}}</option>
          @endforeach
          @endif
        </select>
       </div> 
      </div>
    
     </div> 
     <div class="mws-button-row">
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
     {{csrf_field()}}
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
