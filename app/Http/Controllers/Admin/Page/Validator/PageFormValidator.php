<?php
namespace App\Http\Controllers\Admin\Page\Validator;

use App\Library\Validators\JsonValidator;

/**
 * 页面表单验证器
 * @author zouxiang
 * Date 2017年6月8日
 */
class PageFormValidator extends JsonValidator
{

    public function rules()
    {

        return [
            'title' => 'required',
            'parent_id' => 'required',
            'template_type' => 'required',
            'template_page' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'parent_id.required' => '请选择上级分类',
            'template_type.required' => '请选择模版模型',
            'template_page.required' => '请选择默认模版'
        ];
    }


}