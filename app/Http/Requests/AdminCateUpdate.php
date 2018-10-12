<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCateUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //开启验证
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //验证规则
    public function rules()
    {

        //var_dump()打印$this->route获取所有信息,里面有 参数[这里的参数是id]
        $id = $this->route()->parameters['admincate'];

        return [
            //name--->校验的参数 unique[验证唯一字段]:表名,被验证的字段名[不写默认为前面的键],忽略指定id的数据--->校验的规则
            'name' => 'unique:mall_cates,name,'.$id,
        ];

    }

    //自定义错误信息
    public function messages()
    {
        return [

            'name.unique' => '分类名已存在!',
        ];
    }
}
