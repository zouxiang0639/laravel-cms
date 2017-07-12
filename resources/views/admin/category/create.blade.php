<?php
use App\Consts\Admin\Category\CategoryTemplateConst;
use App\Consts\Admin\Category\CategoryStatusConst;
?>

@extends($layout)

@section('content')
    {!! Menu::adminMenuBls()->categoryMenu(Input::get()) !!}

    {!! Form::open(['method' => 'post', 'class'=>'layui-form layui-form-pane', 'route'=>'admin.category.store']) !!}
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-block">
            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">上级分类</label>
        <div class="layui-input-block">
            {!! Form::select('parent_id', [0=>'/'], '', ['class'=>'', 'placeholder'=>'请选择']) !!}
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">模版模型</label>
            <div class="layui-input-inline">
                <select name="template_type" lay-filter="province">
                    <option></option>
                </select>
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">默认模版</label>
            <div class="layui-input-block">
                <select name="template_page" lay-filter="city">
                    <option></option>
                </select>
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">详情模板</label>
            <div class="layui-input-block">
                <select name="template_info" lay-filter="area">
                    <option></option>
                </select>
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            {!! Form::select('status', CategoryStatusConst::desc(), '', ['class'=>'', 'placeholder'=>'请选择']) !!}
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">上传封面</label>
        <div class="layui-input-block">
            {!! Form::oneImage('picture', '') !!}
        </div>
    </div>


    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">编辑器</label>
        <div class="layui-input-block">
            <textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="LAY_demo_editor"></textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    <script src="{!! admin_asset('js/citys.js') !!}"></script>
    <script src="{!! admin_asset('lib/layui/lay/dest/layui.all.js') !!}"></script>
    @parent
    <script type="text/javascript">
        var citys = {!! CategoryTemplateConst::getJson() !!};
        pca.init('select[name=template_type]', 'select[name=template_page]', 'select[name=template_info]', 2, 11);

        layui.use(['form', 'layedit', 'laydate'], function() {

            var form = layui.form(),
                    layer = layui.layer,
                    layedit = layui.layedit,
                    laydate = layui.laydate;

            //创建一个编辑器
            var editIndex = layedit.build('LAY_demo_editor', {

            });

            //自定义验证规则
            form.verify({
                title: function(value) {
                    if(value.length < 5) {
                        return '标题至少得5个字符啊';
                    }
                }
            });

            //监听提交
            form.on('submit(demo1)', function(data) {
                //$(this).attr('disabled',true);
                $.ajax( {
                    url: '{!! route('admin.category.store') !!}',
                    data: data.field,
                    type:'POST',
                    cache: false,
                    dataType:'json',
                    success:function(res) {

                    }
                });
                return false;
            });

        });

    </script>
@stop