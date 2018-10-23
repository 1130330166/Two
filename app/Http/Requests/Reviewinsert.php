<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Reviewinsert extends FormRequest
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
    public function rules()
    {
        // 表单校验规则
        return [
            //评论内容不能包含空格
            'content'=>'required|regex:/\S/'
        ];
    }
    // 自定义错误信息
    public function messages(){
        return [
            'content.regex'=>'评论内容不能包含空格',
            'content.required'=>'评论内容不能为空,请认真填写后再次提交 !'
        ];
    }
}
