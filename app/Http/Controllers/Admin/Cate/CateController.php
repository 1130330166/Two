<?php

namespace App\Http\Controllers\Admin\Cate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入表单校验请求类
use App\Http\Requests\AdminCateInsert;
use App\Http\Requests\AdminCateUpdate;
use DB;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //获取搜索的关键词
        $k = $request->input('keywords');

        //连贯方法获取分类数据 排序 分页
        $cate  = DB::table("mall_cates")->select(DB::raw("*,concat(path,',',id) as paths"))->where('name','like',"%".$k."%")->orderBy("paths")->paginate(5);
        // dd($cate);
        
        //遍历 为子级分类名加分隔符
        foreach($cate as $key => $value){

            //转换为数组
            $arr = explode(",",$value->path);
            // 分类的等级为数组长度-1
            $len = count($arr)-1;
            // 给当前分类添加分割符 str_repeat(被重复的字符串,重复次数)重复一个字符串
            $cate[$key]->name = str_repeat("---|",$len).$value->name;
        }
        // dd($cate);

        //加载分类列表 分配数据到模板
        return view("Admin.Cate.index",["cate"=>$cate,"request"=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //获取分类信息
        $cate = DB::table("mall_cates")->get();

        //加载分类添加模板 分配数据
        return view("Admin.Cate.add",["cate"=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCateInsert $request)
    {

        //后台执行分类添加
        // dd($request->all());
        // 获取传递过来的数据
        $data = $request->except('_token');
        //获取pid
        $pid = $request->input("pid");
        //判断$pid是否等于0 以此判断是否为顶级分类 0为顶级分类
        if($pid == 0){

            //给path字段赋值 字符串
            $data['path']='0';
            // dd($data);

        }else{
            //添加的不是顶级分类
            //获取父类的信息
            $info = DB::table("mall_cates")->where('id','=',$pid)->first();
            //拼接path path=父级path,父级id
            $data['path'] = $info->path.",".$info->id;
            

        }

        // dd($data);

        //入库
        if(DB::table("mall_cates")->insert($data)){

            return redirect("/admincate")->with('success','分类添加成功');
        }else{

            return redirect("/admincate/create")->with('error','分类添加失败');
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
        //根据id获取要被修改的分类信息
        $data = DB::table('mall_cates')->where('id','=',$id)->first();
        //获取除自己外所有分类信息,用作修改时的父类
        // $res = DB::table('mall_cates')->where('id','!=',$id)->get();
        $res = DB::table('mall_cates')->select(DB::raw("*,concat(path,',',id) as paths"))->where('id','!=',$id)->orderBy("paths")->get();

        //遍历 为子级分类名加分隔符
        foreach($res as $key => $value){

            //转换为数组
            $arr = explode(",",$value->path);
            // 分类的等级为数组长度-1
            $len = count($arr)-1;
            // 给当前分类添加分割符 str_repeat(被重复的字符串,重复次数)重复一个字符串
            $res[$key]->name = str_repeat("---|",$len).$value->name;
        }

        // dd($data);
        // dd($res);
        //加载修改分类模板 分配数据
        return view("Admin.Cate.edit",['data'=>$data,'res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminCateUpdate $request, $id)
    {

        
        //根据id查询要被修改的信息
        $data = DB::table('mall_cates')->where('id','=',$id)->first();
        /*echo '<pre>';
        var_dump($data);*/

        //判断管理员是否两项值都没有修改就提交
        if($request->input('name') == null && $request->input('pid') == null){

            return redirect("/admincate/".$id."/edit")->with('error','没有内容被修改哦,再仔细看看吧!');
        }

        //判断管理员是否有对分类名进行修改
        if($request->input('name') == null){

            //没有分类名传递过来 用户没有对分类名进行修改,保留原有分类名
            $arr['name'] = $data->name;
        }else{

            //有分类名传递过来 将传递过来的分类名赋值给数组
            $arr['name'] = $request->input('name');
        }

        // 查看传递过来的父类id的类型 数据库为整型 传递过来的为字符串要进行类型转换
        // var_dump($request->input('pid'));
        //判断用户是否对父类进行修改
        if($request->input('pid') == null){

            //没有父类id传递过来 将原有的父类id赋值给数组
            $arr['pid'] = $data->pid;
            //将原有的路径赋值给数组
            $arr['path'] = $data->path;
        }else{

            //有字符串类型的父类id传递过来 将其转换为整型[数据库中的类型]后赋值给数组 (int)(字符串)-->将字符串转换为整型
            $arr['pid'] = (int)$request->input('pid');
            //判断父类是否为顶级分类 pid=0为顶级分类
            if($request->input('pid') == '0'){

                //该分类被修改为顶级分类 将path赋值为'0'[数据库中path类型为字符串]字符串类型后赋值给数组
                $arr['path'] = '0';
            }else{

                //该分类被修改,但不是顶级分类,拼接其path赋值给数组
                $arr['path'] = DB::table('mall_cates')->where('id','=',$request->input('pid'))->first()->path.','.$request->input('pid');
            }
            
        }

        /*echo '<pre>';
        var_dump($arr);*/
        
        //更新数据
        $res = DB::table('mall_cates')->where('id','=',$id)->update($arr);
        //判断该分类下是否有子级分类
        if(DB::table('mall_cates')->where('pid','=',$id)->count() > 0){

            //该分类下有子级分类 调用updateCatesByPid方法更新子级分类的path
            self::updateCatesByPid($id);
        }

        //判断更新是否成功
        if($res){

            return redirect('/admincate')->with('success','分类更新成功!');
        }else{

            return redirect("/admincate/".$id."/edit")->with('error','分类更新失败!');
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
        //查看想要删除的分类下是否有子类 count()
        $res = DB::table("mall_cates")->where("pid","=",$id)->count();
        // echo $res;
        if($res>0){

            return redirect('/admincate')->with("error","该分类下还有子级分类,请先删除子级分类!");
        }

        if(DB::table("mall_cates")->where('id','=',$id)->delete()){

            return redirect('/admincate')->with('success','分类删除成功!');
        }else{

            return redirect('/admincate')->with('error','分类删除失败!');
        }
                    
    }

    //无限分类递归更新子级path
    public static function updateCatesByPid($pid){

        //①先更新子级的path
        //根据$pid查询父级分类信息
        $data = DB::table('mall_cates')->where('id','=',$pid)->first();
        //根据父级分类信息拼接其子级分类的path
        $path = $data->path.','.$data->id;
        //更新子级path
        DB::table('mall_cates')->where('pid','=',$pid)->update(['path' => $path]);
        //查询所有pid = $pid的分类
        $son = DB::table('mall_cates')->where('pid','=',$pid)->get();
        //②遍历子级分类更新path 递归
        foreach($son as $value){
            //判断该子级下是否还有分类
            if(DB::table('mall_cates')->where('pid','=',$value->id)->count() > 0){
                //递归调用方法更新path
                self::updateCatesByPid($value->id);
            }
        }

    }

}