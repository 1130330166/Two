<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCateInsert extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //添加校验规则
    public function rules()
    {
        return [
            //name--->校验的参数 required[不能为空]--->校验的规则
            'name' => 'required|unique:mall_cates',
        ];
    }

    //自定义错误信息
    public function messages()
    {
        return [

            'name.required' => '分类名不能为空!',
            'name.unique' => '分类名已存在!',
        ];
    }
}
