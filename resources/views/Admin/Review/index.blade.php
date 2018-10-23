@extends("Admin.AdminPublics.public")
@section('admin')
<html>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>后台评论列表__(此处运用了_ajax分页)</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
      <div id="uid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">用户名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 300px;">评论内容</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 300px;">所属商品</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 300px;">评论日期</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $v)
       <tr class="odd">
        <td class="  sorting_1">{{$v->id}}</td> 
        <td class=" ">{{$v->username}}</td> 
        <td class=" ">{{$v->content}}</td>
        <td class=" ">{{$v->goodsname}}</td>
        <td class=" ">{{$v->time}}</td>
        <td class=" ">
        <form action="" method="post">
            <button class="btn btn-success" onclick="return confirm('确 定 删 除 此 用 户 评 论 吗 ?');">删除</button>
            {{method_field("DELETE")}}
            {{csrf_field()}}
          </form>
        </td>
      </tr>
      @endforeach
      </tbody>
     </table>
   </div>
     <!-- 分页开始 -->
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      @foreach($pp as $v)
      <a class=" btn btn-success page" href="javascript:void(0);" onclick="page({{$v}})">{{$v}}</a>
      @endforeach
    </div>
     <!-- /分页结束 -->
   </div> 
  </div>
</div>
</div>
 </body>
 <script type="text/javascript">
  // alert($);
  function page(page){
    // alert(page);
    // 触发Ajax
    $.get("/adminreview",{page:page},function(data){
    // alert(data);
    //赋值给id值为 uid的div
    $("#uid").html(data);
    });
  }
  // 设置样式  当前页为红色
  $(".page").click(function(){
    $(this).attr("class","btn btn-danger page")
  });
  $(".page").blur(function(){
    $(this).attr("class","btn btn-success page")
  });
 </script>
</html>
@endsection
@section('title','后台列表')