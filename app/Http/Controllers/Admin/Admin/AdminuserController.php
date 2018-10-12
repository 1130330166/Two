<?php

namespace App\Http\Controllers\Admin\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\AdminUserEdit;
use App\Http\Requests\AdminUserInsert;
class AdminuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // 获取管理员列表
        $adminuser=DB::table('mall_admin_users')->paginate(3);
        // 加载模板
        return view("Admin.adminusers.index",['adminuser'=>$adminuser]);
    }
    // 分配角色
    public function rolelist($id){
        // 获取后台管理员id
        // echo $id;
        // 获取管理员信息
        $info=DB::table("mall_admin_users")->where("id",'=',$id)->first();
        // 获取角色信息
        $role=DB::table("mall_role")->get();
        // 获取当前管理员的角色信息
        $data=DB::table("mall_user_role")->where("uid",'=',$id)->get();
        // var_dump($data);die;
        // 判断
        if(count($data)){
            // 遍历
            foreach($data as $v){
                $rids[]=$v->rid;
            }
        // 加载分配角色的模版
        return view("Admin.adminusers.rolelist",['info'=>$info,'role'=>$role,'rids'=>$rids]);
        }else{
            // 加载分配角色的模板
            // 这里给没有分配角色的管理员做处理(给空数组不选中)
            return view("Admin.adminusers.rolelist",['info'=>$info,'role'=>$role,'rids'=>array()]);
        }
    }
    // 保存角色
    public function saverole(Request $request){
        // echo "这是保存角色";
        // 在用户角色表插入数据 用户id-uid 角色id-rid
        // 获取uid
        $uid=$request->input('uid');

        // 获取分配的角色信息
        @$rids=$_POST['rids'];
        // echo $uid;
        // var_dump($rids);
        // 删除当前用户以前的角色
        DB::table("mall_user_role")->where("uid","=",$uid)->delete();
        // 判断未选择角色分配不予提交
        if(empty($rids)){
            return redirect("/adminusers")->with('error','角色未分配');
        }
        // 数据遍历,录入数据库前的准备
        foreach($rids as $key=>$value){
            $data['rid']=$value;
            $data['uid']=$uid;
            // 录入数据库
            DB::table("mall_user_role")->insert($data);
        }
        return redirect("/adminusers")->with('success','角色分配成功');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加模板
        return view("Admin.adminusers.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserInsert $request){
        if(preg_match("/\s/",$request->name) && preg_match("/\s/",$request->password)){
            return back()->with("error",'用户名 和 密码不能为 空 或者 包含空格');
        }else{
        // 除去token添加进数据库
        $data=$request->except('_token');
        // 密码加密,引用Hash
        $data['password']=Hash::make($data['password']);
        // dd($data);
        // 写入数据库
        if(DB::table('mall_admin_users')->insert($data)){
            return redirect("adminusers")->with('success',"添加成功");
        }else{
       return redirect("/adminuser/create")->with('error','添加失败');
        }
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取id
        // echo $id;
        // 获取数据
        $info=DB::table("mall_admin_users")->where("id",'=',$id)->first();
         // 解析密码
        // dd($info->password);die;
        // var_dump($password)
        // dd($data);die;
       
        // dd($info1);die;
        return view("Admin.adminusers.edit",['info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserEdit $request,$id)
    {
        if(preg_match("/\s/",$request->password)){
            return back()->with("error",'密码不能包含空格');
        }else{
        //获取修改后的数据
        // dd($request->all());
        // 除去token和method添加进数据库
        $data=$request->except('_token','_method');
        // $data=$request->except('_method');
        $data['password']=Hash::make($data['password']);
        // dd($data);die;
        // 准备插入数据库
        DB::table("mall_admin_users")->where("id",'=',$id)->update($data);
        return redirect("/adminusers")->with("success",'密码修改成功');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 删除管理员所分配的角色信息
        DB::table("mall_user_role")->where("uid",'=',$id)->delete();
        //执行删除
        if(DB::table("mall_admin_users")->where("id",'=',$id)->delete()){
            return redirect("/adminusers")->with('success','删除成功');
        }else{
            return redirect("/adminusers")->with('error','删除失败');
        }
    }
}
