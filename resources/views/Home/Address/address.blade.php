@extends("Home.HomePublic.public")
@section("title","收货地址")
@section("home")
<div style="background-color: #36414F;height: 124px;"></div>

  <!-- 添加成功与否信息显示开始 -->
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x">
      <span class="alert-close" data-dismiss="alert"></span>
      <p>{{session('success')}}</p>
  </div>
  @endif

  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x">
      <span class="alert-close" data-dismiss="alert"></span>
      <p>{{session('error')}}</p>
  </div>
  @endif
  <!-- 添加成功与否信息显示结束 -->

  <!-- Start Contacts & Shipping Address -->
  <div class="container padding-top-1x padding-bottom-3x"> 
   <div class="row"> 

    <h3>管理收货地址</h3>

    <!-- 遍历收货地址开始 --> 
    <div class="table-responsive shopping-cart"> 
     <table class="table"> 
      <thead> 
       <tr>

        <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">收件人</font></font></th>

        <!-- <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">所在地区</font></font></th> -->

        <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">详细地址</font></font></th>

        <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">邮政编码</font></font></th>

        <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">联系电话</font></font></th>

        <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">操作</font></font></a> </th> 
        <th class="text-center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">设为默认</font></font></a> </th> 

       </tr> 
      </thead> 

      <tbody> 

       @if(!empty($data))
       @foreach($data as $row)
       <tr> 
        <td class="text-center text-lg text-medium">{{$row->aname}}</td>
        <!-- <td class="text-center text-lg text-medium">{{$row->path}}</td>  -->
        <td class="text-center text-lg text-medium">{{$row->address}}</td>
        <td class="text-center text-lg text-medium">{{$row->postalcode}}</td>
        <td class="text-center text-lg text-medium">{{$row->phone}}</td> 
        <td class="text-center text-lg text-medium">
          
          <form action="/homeaddress/{{$row->id}}/edit" method="get">
            <button type="submit" class="btn btn-link-danger" title="编辑"><i class="icon-tag"></i></button>
            {{csrf_field()}}
          </form> 
          
          <form action="/homeaddress/{{$row->id}}" method="post">
            <button type="submit" class="btn btn-link-danger" title="移除" onclick="return confirm('确定删除该地址吗?');"><i class="icon-cross"></i></button>
            {{method_field("DELETE")}}
            {{csrf_field()}}
          </form> 
        </td> 
        @if($row->isdefault == 1)
        <td class="text-center text-lg text-medium">
          <a href="/homeaddresssetdefault/{{$row->id}}" title="设为默认" class="btn btn-sm btn-info">设为默认</a>
        </td>
        @else
        <td class="text-center text-lg text-medium">
          <a href="/homeaddresssetdefault/{{$row->id}}" title="设为默认" class="btn btn-sm btn-link-primary">设为默认</a>
        </td>
        @endif
       </tr> 
       @endforeach
       @endif
      </tbody> 
     </table> 
    </div> 
    <!-- 遍历收货地址结束 --> 

    <div class="col-md-12">
      <div class="padding-top-3x hidden-md-up"></div>
      <h3 class="margin-bottom-1x padding-top-1x">新增收货地址</h3>

      <form action="/homeaddress" class="row" method="post">

        <!-- <div class="col-sm-3">
            <div class="form-group">
                <label>所在地区</label>
                <select class="form-control" name="path">
                 <option>请选择</option>
                </select> 
            </div>
        </div> -->

        

        <div class="col-sm-6">
            <div class="form-group">
                <label>收件人</label>
                <input class="form-control" type="text" name="aname">
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>邮编</label>
                <input class="form-control" type="text" name="postalcode" maxlength="6" />
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>联系电话</label>
                <input class="form-control" type="text" name="phone" />
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>详细地址</label>
                <input class="form-control" type="text" name="address" />
            </div>
        </div>

        <div class="col-12 text-center text-sm-right">
            <button class="btn btn-outline-success margin-bottom-none" type="submit">添加</button>
        </div>
        {{csrf_field()}}
      </form>
    </div>

    
   </div> 
  </div> 
  <!-- End Contacts & Shipping Address -->
@endsection