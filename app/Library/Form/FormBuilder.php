<?php

namespace App\Library\Form;

class FormBuilder extends \Collective\Html\FormBuilder
{

    /**
     * 单张图片上传
     * @param $name
     * @param $value
     * @param array $options
     * @return string
     */
    public function oneImage($name, $value, $options = [])
    {
        $options = array_merge(['callback-class' => $name, 'class'=>'layui-upload-file', 'lay-title'=>'上传封面'], $options);
        $image = empty($value) ? admin_asset(config('admin.image.default')) : $value;

        $html = $this->file('file', $options) . ' ';
        $html .= $this->html->image($image, null, ['class'=> $name.' show-image','height'=>'38']);
        $html .= $this->hidden($name, $value);

        return $html;
    }
}