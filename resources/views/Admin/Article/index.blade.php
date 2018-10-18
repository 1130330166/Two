@extends("Admin.AdminPublics.public")
@section('admin')
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>后台公告列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
      <div id="uid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">操作</th>
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">标题</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 300px;">内容</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      @foreach($data as $row)
       <tr class="odd">
        <td class=" "><input type="checkbox" value="{{$row->id}}"></td>  
        <td class="  sorting_1">{{$row->id}}</td> 
        <td class=" ">{{$row->title}}</td> 
        <td class=" ">{!!$row->des!!}</td>
        <td class=" ">
          <a href="/article/{{$row->id}}/edit" class="btn btn-info"><i class="icon-wrench"></i>修改</a></td> 
       </tr>
       @endforeach
       <tr>
        <td colspan="5"><a href="javascript:void(0)" class="btn btn-success allchoose">全选</a>
          <a href="javascript:void(0)" class="btn btn-success nochoose">全不选</a>
          <a href="javascript:void(0)" class="btn btn-success fchoose">反选</a>
        </td>
       </tr>
        <tr>
          <td colspan="5"><a href="javascript:void(0)" class="btn btn-danger del">批 量 删 除</a></td>
        </tr>
      </tbody>
     </table>
     </div>
     <!-- 分页 -->
     <div class="dataTables_paginate paging_full_numbers" id="pages">
    </div>
     <!--  -->
   </div> 
  </div>
 </body>
 <script type="text/javascript">
 // alert($);
 //全选
 $(".allchoose").click(function(){
  $("#DataTables_Table_1").find("tr").each(function(){
    // alert('ss');
    $(this).find(":checkbox").attr("checked",true);
  });
 });

//全不选
 $(".nochoose").click(function(){
  $("#DataTables_Table_1").find("tr").each(function(){
    // alert('ss');
    $(this).find(":checkbox").attr("checked",false);

  });
 });

 //反选
 $(".fchoose").click(function(){
  $("#DataTables_Table_1").find("tr").each(function(){
    //判断
    if($(this).find(":checkbox").attr("checked")){
      //设置为不选中
      $(this).find(":checkbox").attr("checked",false);
    }else{
      $(this).find(":checkbox").attr("checked",true);

    }
  });
 });

 //Ajax 批量删除数据
 $(".del").click(function(){
  a=[];
  //获取选中数据的id
  //遍历复选框
  $(":checkbox").each(function(){
    if($(this).attr("checked")){
      id=$(this).val();
      // alert(id);
      //元素添加到数组里
      a.push(id);
    }
  });
  // alert(a);
  //Ajax id
  $.get("/articledel",{a:a},function(data){
    // alert(data);
    if(data==1){
      alert("删 除 成 功");
      //遍历a
      for(var i=0;i<a.length;i++){
        //找tr标签,remove删除它
        $("input[value='"+a[i]+"']").parents("tr").remove();
      }

    }else{
      alert(data);
    }

  });
 });
 </script>
</html>
@endsection
@section('title','后台公告列表')