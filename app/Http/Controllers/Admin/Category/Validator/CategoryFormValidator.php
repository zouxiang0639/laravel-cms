<?php
namespace App\Http\Controllers\Admin\Category\Validator;

use App\Consts\Admin\Category\CategoryBindPageConst;
use App\Library\Validators\JsonValidator;

/**
 * 导航表单验证器
 */
class CategoryFormValidator extends JsonValidator
{

    public function rules()
    {
        return [
            'title'     => 'required_if:bind_page,'.CategoryBindPageConst::LINKS,
            'status'    => 'required',
            'parent_id' => 'required',
            'bind_page' => 'required',
            'page_id'   => 'required_if:bind_page,'.CategoryBindPageConst::PAGE,
            'links'     => 'required_if:bind_page,'.CategoryBindPageConst::LINKS,
        ];
    }

    public function messages()
    {
        return [
            'title.required_if'     => '标题不能为空',
            'status.required'       => '请选择状态',
            'parent_id.required'    => '请选择父级导航',
            'bind_page.required'    => '请选择绑定页面',
            'page_id.required_if'   => '请选择本地链接',
            'links.required_if'     => '本地链接不能为空'
        ];
    }


}