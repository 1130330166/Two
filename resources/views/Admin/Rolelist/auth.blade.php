@extends("Admin.AdminPublics.public")
@section('admin')
<html>
 <head>
 <script src="/static/admins/js/libs/jquery-1.8.3.min.js"></script></head></head>
 <body>
  <div class="container"> 
   <div class="container"> 
    <div class="mws-panel-body no-padding"> 
     <form class="mws-form" action="/saveauth" method="post"> 
      <div class="mws-form-inline"> 
       <div class="mws-form-row"> 
        <label class="mws-form-label">权限信息</label> 
        <div class="mws-form-item clearfix"> 
         <h4>当前角色:【 {{$role->name}} 】的角色信息</h4> 
         <ul class="mws-form-list inline">
          @foreach($auth as $row)
          <li id="lilist"><input type="checkbox" name="nids[]" value="{{$row->id}}" @if(in_array($row->id,$nids)) checked @endif/> <label>{{$row->name}}</label></li> 
          @endforeach
         </ul> 
        </div> 
       </div>
       <center>
          <a href="javascript:void(0)" class="btn btn-success allchoose">全选</a>
          <a href="javascript:void(0)" class="btn btn-success nochoose">全不选</a>
          </center>
      </div> 
      <div class="mws-button-row">
      {{csrf_field()}}
       <input type="hidden" name="rid" value="{{$role->id}}">
       <input value="分配权限" class="btn btn-danger" type="submit" /> 
       <input value="Reset" class="btn " type="reset" /> 
      </div> 
     </form> 
    </div> 
    <!-- Panels End --> 
   </div> 
   <!-- Panels End --> 
  </div>
 </body>
  <script type="text/javascript">
 // alert($);
 //全选
 $(".allchoose").click(function(){
  $(':checkbox').attr('checked',true);
 });

//全不选
 $(".nochoose").click(function(){
  $(':checkbox').attr('checked',false);
 });
</script>
</html>
@endsection
@section('title','后台分配权限')