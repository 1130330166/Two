<?php

namespace App\Http\Controllers\Admin\FriendsLink;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引用DB类;
use DB;

class FriendsLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //后台显示审核的友情链接
    public function index()
    {
        
        //后台遍历通过审核状态的友情链接
        $data = DB::table('mall_flink')->where('status','=',1)->get();
        //处理display字段的显示 0->下架 1->上架
        $arr = array('下架','上架');
        // 遍历处理display字段
        foreach($data as $value){

            $value->display = $arr[$value->display];
        }

        // var_dump($data);exit;

        //加载模板分配数据
        return view("Admin.FriendsLink.index",['data'=>$data]); 
    }

    //后台显示未审核状态的链接
    public function adminFlink(){

        //查询未审核状态链接数据
        $data = DB::table('mall_flink')->where('status','=',0)->get();
        //处理status字段显示 0->待审核 1->已通过
        $arr = array('待审核','已通过');

        foreach($data as $value){

            $value->status = $arr[$value->status];
        }

        // var_dump($data);exit;

        //加载模板 分配数据
        return view('Admin.FriendsLink.noverify',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
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
    //修改友情链接上架下架状态
    public function edit($id)
    {
        //获取链接信息
        $data = DB::table('mall_flink')->where('id','=',$id)->first();
        //判断该链接是上架状态还是下架状态 0为下架 1为上架
        if($data->display == 0){

            //当前链接属于下架状态,更新状态为上架并判断是否成功
            if(DB::table('mall_flink')->where('id','=',$id)->update(['display'=>1])){

                return redirect('/friendslink')->with('success','ID为'.$id.'的链接上架成功!');
            }else{

                return redirect('/friendslink')->with('success','ID为'.$id.'的链接上架失败!');
            }
        }

        //判断该链接是上架状态还是下架状态 0为下架 1为上架
        if($data->display == 1){

            //当前链接属于上架状态,更新状态为下架并判断是否成功
            if(DB::table('mall_flink')->where('id','=',$id)->update(['display'=>0])){

                return redirect('/friendslink')->with('success','ID为'.$id.'的链接下架成功!');
            }else{

                return redirect('/friendslink')->with('success','ID为'.$id.'的链接下架失败!');
            }
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //修改友情链接审核状态
    public function update(Request $request, $id)
    {
        //更新状态并判断是否更新成功
        if(DB::table('mall_flink')->where('id','=',$id)->update(['status'=>1])){

            //审核状态更新成功 提示后台管理员
            return redirect('/friendslinknoverify')->with('success','ID为'.$id.'的链接已通过审核!');
        }else{

            //审核状态更新失败 提示后台管理员
            return redirect('/friendslinknoverify')->with('error','ID为'.$id.'的链接审核失败!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //删除未审核列表的链接
    public function destroy($id)
    {
        //删除链接申请并判断是否删除成功
        if(DB::table('mall_flink')->where('id','=',$id)->delete()){

            //链接删除成功 提示后台管理员
            return redirect('/friendslinknoverify')->with('success','ID为'.$id.'的链接申请已成功删除!');
        }else{

            //链接删除失败 提示后台管理员
            return redirect('/friendslinknoverify')->with('error','Id为'.$id.'的链接申请删除失败!');
        }
    }

    //删除已审核列表的链接
    public function destroyPass($id)
    {
        // echo 'this is delete'.$id;exit;
        //删除链接申请并判断是否删除成功
        if(DB::table('mall_flink')->where('id','=',$id)->delete()){

            //链接删除成功 提示后台管理员
            return redirect('/friendslink')->with('success','ID为'.$id.'的链接申请已成功删除!');
        }else{

            //链接删除失败 提示后台管理员
            return redirect('/friendslink')->with('error','Id为'.$id.'的链接申请删除失败!');
        }
    }


}
