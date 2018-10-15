@extends("Home.HomePublic.public")
@section("title","友情链接")
@section("home")
    <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
    <div style="background-color: dodgerblue; height: 124px;"></div>

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

    <h3 class="padding-top-2x">友情链接</h3>

    <!-- 遍历上架的友情链接开始 -->
    @if(!empty($data))
    @foreach($data as $row)
    <a href="{{$row->lurl}}" class="btn btn-link-info">{{$row->lname}}</a>
    @endforeach
    @endif
    <!-- 遍历上架的友情链接结束 -->

    <h3 class="padding-top-2x">申请友情链接</h3>

    <form action="/friendslinks" class="row" method="post">
        <div class="col-sm-4">
            <div class="form-group">
                <label>链接名</label>　<span id="checkExistlname"></span>
                <input class="form-control form-control-rounded" id="lname" type="text" name="lname" value="">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>链接URL地址</label>　<span id="checkExistURL"></span>
                <input class="form-control form-control-rounded" id="lurl" type="text" name="lurl">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>联系电话</label>　<span id="checkExistPhone"></span>
                <input class="form-control form-control-rounded" id="phone" type="text" name="phone" maxlength="11">
            </div>
        </div>
        <!-- <div class="col-sm-6">
            <div class="form-group">
                <label for="help_category">Category</label>
                <select class="form-control form-control-rounded" id="help_category">
                    <option>Category 1</option>
                    <option>Category 2</option>
                    <option>Category 3</option>
                    <option>Category 4</option>
                    <option>Category 5</option>
                </select>
            </div>
        </div> -->
        <div class="col-12">
            <div class="form-group">
                <label>网站描述</label>　<span id="checkExistInfo"></span>
                <textarea class="form-control form-control-rounded" id="linfo" name="linfo" maxlength="80"></textarea>
            </div>
        </div>
        {{csrf_field()}}
        <div class="col-12 text-right">
            <button class="btn btn-outline-info" type="submit">提交申请</button>
        </div>
        
    </form>
    <script type="text/javascript">

        // 正则验证链接名
        function isChinaName(name) {
            var pattern = /^([\u4e00-\u9fa5]|\w){1,6}$/;
            return pattern.test(name);
        }

        // 正则验证链接URL
        function isURL(url) {
            var pattern = /^((ht|f)tps?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/;
            return pattern.test(url);
        }

        // 正则验证手机号
        function isPhoneNo(phone) {
            var pattern = /^1[34578]\d{9}$/;
            return pattern.test(phone);
        }

        //验证连接名
        function checkName(){

            //判断链接名是否填写
            if ($.trim($('#lname').val()).length == 0) {
                //链接名为空 提示用户并组织表单提交
                $('#checkExistlname').html("<font style='color:#f00'>链接名没有输入!</font>");
                return false;
            } else {
                //判断链接名是否符合规则
                if (isChinaName($.trim($('#lname').val())) == false) {
                    //链接名不符合规则 提示用户并组织表单提交
                    $('#checkExistlname').html("<font style='color:#f00'>链接名不能大于6位!</font>");
                    return false;
                }else{

                    // //判断链接名是否存在
                    // $.get('/verifyflink',{lname:$('#lname').val()},function(data){

                    //     if(data == 1){

                    //         //链接名已存在 提示用户并阻止表单提交
                    //         $('#checkExistlname').html("<font style='color:#f00'>链接名已存在!</font>");
                    //         return false;

                    //     }else{

                    //         //链接名符合规则 提示用户
                    //         $('#checkExistlname').html("<font style='color:green'>链接名可以使用!</font>");
                    //         return true;
                    //     }
                    // });

                    var str;

                    $.ajax({

                        async: false,
                        url: '/verifyflink?lname='+$('#lname').val(),
                        success: function(data){

                            if(data == 1){

                                //链接名已存在 提示用户并阻止表单提交
                                $('#checkExistlname').html("<font style='color:#f00'>链接名已存在!</font>");
                                str = false;

                            }else{

                                //链接名符合规则 提示用户
                                $('#checkExistlname').html("<font style='color:green'>链接名可以使用!</font>");
                                str = true;
                            }
                        }

                    });

                    return str;

                }
            }
        }

        //验证URL
        function checkURL(){

            //判断链接URL是否填写
            if ($.trim($('#lurl').val()).length == 0) {
                //链接URL为空 提示用户并组织表单提交
                $('#checkExistURL').html("<font style='color:#f00'>链接URL没有输入!</font>");
                return false;
            } else {
                //判断链接URL是否符合规则
                if (isURL($.trim($('#lurl').val())) == false) {
                    //链接URL不符合规则 提示用户并组织表单提交
                    $('#checkExistURL').html("<font style='color:#f00'>示例 http://www.baidu.com</font>");
                    return false;
                }else{

                    // //判断URL是否存在
                    // $.get('/verifyflink',{lurl:$('#lurl').val()},function(data){

                    //     if(data == 2){

                    //         //链接URL已存在 提示用户并最终表单提交
                    //         $('#checkExistURL').html("<font style='color:#f00'>链接URL已存在!</font>");
                    //         return false;

                    //     }else{

                    //         //链接URL符合规则 提示用户
                    //         $('#checkExistURL').html("<font style='color:green'>链接URL可以使用!</font>");
                    //         return true;
                    //     }
                    // });
                    
                    var str;

                    $.ajax({

                        async: false,
                        url: '/verifyflink?lurl='+$('#lurl').val(),
                        success: function(data){

                            if(data == 2){

                                //链接URL已存在 提示用户并最终表单提交
                                $('#checkExistURL').html("<font style='color:#f00'>链接URL已存在!</font>");
                                str = false;

                            }else{

                                //链接URL符合规则 提示用户
                                $('#checkExistURL').html("<font style='color:green'>链接URL可以使用!</font>");
                                str = true;
                            }
                        }

                    });

                    return str;
                }
            }
        }

        //验证手机号
        function checkPhone(){

            //判断联系电话是否填写
            if ($.trim($('#phone').val()).length == 0) {
                //联系电话为空 提示用户并组织表单提交
                $('#checkExistPhone').html("<font style='color:#f00'>联系电话没有输入!</font>");
                return false;
            } else {
                //判断联系电话是否符合规则
                if (isPhoneNo($.trim($('#phone').val())) == false) {
                    //联系电话不符合规则 提示用户并组织表单提交
                    $('#checkExistPhone').html("<font style='color:#f00'>该号码不存在</font>");
                    return false;
                }else{

                    // //判断联系电话是否存在
                    // $.get('/verifyflink',{phone:$('#phone').val()},function(data){

                    //     if(data == 3){

                    //         //联系电话已存在 提示用户并阻止表单提交
                    //         $('#checkExistPhone').html("<font style='color:#f00'>该号码已存在!</font>");
                    //         return false;

                    //     }else{

                    //         //联系电话符合规则 提示用户
                    //         $('#checkExistPhone').html("<font style='color:green'>该号码可以使用!</font>");
                    //         return true;
                    //     }
                        
                    // });

                    var str;

                    $.ajax({

                        async: false,
                        url: '/verifyflink?phone='+$('#phone').val(),
                        success: function(data){

                            if(data == 3){

                                //联系电话已存在 提示用户并阻止表单提交
                                $('#checkExistPhone').html("<font style='color:#f00'>该号码已存在!</font>");
                                str = false;

                            }else{

                                //联系电话符合规则 提示用户
                                $('#checkExistPhone').html("<font style='color:green'>该号码可以使用!</font>");
                                str = true;
                            }
                        }

                    });

                    return str;
                }
            }
        }

        //验证网站信息
        function checkLinfo(){

            //判断网站描述是否填写
            if ($.trim($('#linfo').val()).length == 0) {
                //联系电话为空 提示用户并组织表单提交
                $('#checkExistInfo').html("<font style='color:#f00'>网站描述没有填写!</font>");
                return false;
            }else{

                $('#checkExistInfo').html("<font style='color:green'>网站描述可以使用!</font>");
                return true;
            }
        }


        
        //点击申请友情链接时校验
        function tijiao() {
            
            //判断是否所有校验都通过验证
            if(checkName() && checkURL() && checkPhone() && checkLinfo()){

                return true;
            }else{

                return false;
            }
        }
        
        $(':submit').click(function(){

            return tijiao();
            
        });

        //页面加载完成自动调用
        $(function(){  

            //链接名失去焦点触发事件
            $('#lname').blur(function(){
                //判断链接名是否为空
                if ($.trim($('#lname').val()).length == 0) {
                    //链接名为空 提示用户
                    $('#checkExistlname').html("<font style='color:#f00'>链接名没有输入!</font>");

                } else {
                    //判断链接名是否符合规则
                    if (isChinaName($.trim($('#lname').val())) == false) {
                        //链接名不符合规则 提示用户
                        $('#checkExistlname').html("<font style='color:#f00'>链接名不能大于6位!</font>");

                    }else{

                        //判断链接名是否存在
                        $.get('/verifyflink',{lname:$('#lname').val()},function(data){

                            if(data == 1){

                                //链接名已存在 提示用户
                                $('#checkExistlname').html("<font style='color:#f00'>链接名已存在!</font>");

                            }else{

                                //链接名符合规则 提示用户
                                $('#checkExistlname').html("<font style='color:green'>链接名可以使用!</font>");
                            }
                        });    
                    }
                }
            });

            //链接URL失去焦点触发事件
            $('#lurl').blur(function(){
                //判断链接URL是否为空
                if ($.trim($('#lurl').val()).length == 0) {
                    //链接URL为空 提示用户
                    $('#checkExistURL').html("<font style='color:#f00'>链接URL没有输入!</font>");
                    
                } else {
                    //判断链接URL是否符合规则
                    if (isURL($.trim($('#lurl').val())) == false) {
                        //链接URL不符合规则 提示用户
                        $('#checkExistURL').html("<font style='color:#f00'>示例 http://www.baidu.com</font>");

                    }else{

                        //判断URL是否存在
                        $.get('/verifyflink',{lurl:$('#lurl').val()},function(data){

                            if(data == 2){

                                //链接URL已存在 提示用户
                                $('#checkExistURL').html("<font style='color:#f00'>链接URL已存在!</font>");

                            }else{

                                //链接URL符合规则 提示用户
                                $('#checkExistURL').html("<font style='color:green'>链接URL可以使用!</font>");
                            }
                        });
                    }
                }
            });

            //联系电话失去焦点触发事件
            $('#phone').blur(function(){

                //判断联系电话是否填写
                if ($.trim($('#phone').val()).length == 0) {
                    //联系电话为空 提示用户
                    $('#checkExistPhone').html("<font style='color:#f00'>联系电话没有输入!</font>");

                } else {
                    //判断联系电话是否符合规则
                    if (isPhoneNo($.trim($('#phone').val())) == false) {
                        //联系电话不符合规则 提示用户
                        $('#checkExistPhone').html("<font style='color:#f00'>该号码不存在</font>");

                    }else{

                        //判断联系电话是否存在
                        $.get('/verifyflink',{phone:$('#phone').val()},function(data){

                            if(data == 3){

                                //联系电话已存在 提示用户
                                $('#checkExistPhone').html("<font style='color:#f00'>该号码已存在!</font>");

                            }else{

                                //联系电话符合规则 提示用户
                                $('#checkExistPhone').html("<font style='color:green'>该号码可以使用!</font>");
                            }
                            
                        });
                    }
                }
            });

            //网站描述失去焦点触发事件
            $('#linfo').blur(function(){

                //判断网站描述是否填写
                if($.trim($('#linfo').val()).length == 0) {
                    //网站描述为空 提示用户
                    $('#checkExistInfo').html("<font style='color:#f00'>网站描述没有填写!</font>");

                }else{

                    $('#checkExistInfo').html("<font style='color:green'>网站描述可以使用!</font>");
                }
            });

        }); 
    </script>
    
@endsection