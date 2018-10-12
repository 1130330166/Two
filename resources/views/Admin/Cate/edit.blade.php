@extends("Admin.AdminPublics.public")
@section('title','后台分类修改')
@section('admin')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>分类修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/admincate/{{$data->id}}" method="post">

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
        <input type="text" class="small" name="name" value="" placeholder="{{$data->name}}" /> 
       </div> 
      </div> 

      <div class="mws-form-row"> 
       <label class="mws-form-label">父类</label> 
       <div class="mws-form-item"> 
        <select name="pid" class="small">
          <option value="">--请选择--</option>
          <option value="0">顶级分类</option>
          @if(!empty($res))
          @foreach($res as $row)
          <option value="{{$row->id}}">{{$row->name}}</option>
          @endforeach
          @endif
        </select>
       </div> 
      </div> 
        
     </div> 
     <div class="mws-button-row">
      {{method_field("PUT")}}
      {{csrf_field()}}
      <input type="submit" value="Submit" class="btn btn-info" /> 
      <input type="reset" value="Reset" class="btn btn-inverse" /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
