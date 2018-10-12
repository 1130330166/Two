@extends("Admin.AdminPublics.public")
@section("title","友情链接管理")
@section("admin")

    <html>
     <head></head>
     <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
     <body>
      <div class="mws-panel grid_8"> 
       <div class="mws-panel-header"> 
        <span><i class="icon-table"></i>未审核友情链接列表</span> 
       </div> 
       <div class="mws-panel-body no-padding"> 
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">

        <!-- 搜索开始 -->
        <form action="/admincate" method="get">
         <div class="dataTables_filter" id="DataTables_Table_1_filter">
          <label><input type="text" aria-controls="DataTables_Table_1" name="keywords"  value="{{$request['keywords'] or ''}}"/></label>
          <!-- <input type="submit" value="搜索"> -->
          <button type="submit" class="btn btn-default">搜索</button>
         </div>
        </form>
        <!-- 搜索结束 -->

         <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
          <thead> 
           <tr role="row">

            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">ID</th>

            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">链接名</th>

            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 137px;">URL</th>

            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 137px;">网站信息</th>

            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 137px;">联系电话</th>

            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 137px;">审核状态</th>
             


            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">操作</th>
           </tr> 
          </thead> 
          <tbody role="alert" aria-live="polite" aria-relevant="all">

           @if(!empty($data))
           @foreach($data as $row)
           <tr class="odd"> 
            <td class="  sorting_1">{{$row->id}}</td> 
            <td class=" ">{{$row->lname}}</td> 
            <td class=" ">{{$row->lurl}}</td> 
            <td class=" ">{{$row->linfo}}</td> 
            <td class=" ">{{$row->phone}}</td> 
            <td class=" ">{{$row->status}}</td> 

            <td class=" ">
              <form action="/friendslink/{{$row->id}}" method="post">
                <button class="btn btn-inverse" title="删除数据" onclick="return confirm('确定删除该申请吗?');"><i class="icon-remove"></i></button>
                {{method_field("DELETE")}}
                {{csrf_field()}}
              </form>
              
              <form action="/friendslink/{{$row->id}}" method="post">
                <button class="btn btn-success" title="通过审核"><i class="icon-edit"></i></button>
                {{method_field('PUT')}}
                {{csrf_field()}}
              </form>
              
            </td> 
           </tr>
           @endforeach
           @endif
          </tbody>
         </table>

         <!-- 分页开始 -->
         <div class="dataTables_paginate paging_full_numbers" id="pages">

         </div>
         <!-- 分页结束 -->

        </div> 
       </div> 
      </div>
     </body>
     <script type="text/javascript">
     </script>
    </html>

@endsection