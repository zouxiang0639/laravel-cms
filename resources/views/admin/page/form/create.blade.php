<?php
use App\Consts\Admin\Page\PageTemplateConst;
use App\Consts\Admin\Category\CategoryStatusConst;
?>

{!! Form::open(['method' => 'post', 'class'=>'layui-form layui-form-pane']) !!}
<div class="layui-form-item">
    <label class="layui-form-label">标题</label>
    <div class="layui-input-inline title">
        <input type="text" name="title" value="{!! isset($info) ? $info->title : '' !!}" placeholder="请输入标题" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">上级分类</label>
    <div class="layui-input-inline parent_id">
        {!! Form::select('parent_id', [0=>'/'], isset($info) ? $info->parent_id : '' , ['class'=>'', 'placeholder'=>'请选择']) !!}
    </div>
</div>
<div class="layui-form-item">
    <div class="layui-inline">
        <label class="layui-form-label">模版模型</label>
        <div class="layui-input-inline template_type">
            {!! Form::select('parent_id', [0=>'/'], isset($info) ? $info->parent_id : '' , ['class'=>'', 'placeholder'=>'请选择']) !!}
        </div>
    </div>

    <div class="layui-inline">
        <label class="layui-form-label">默认模版</label>
        <div class="layui-input-inline template_page">
            <select name="template_page" lay-filter="city">
                <option></option>
            </select>
        </div>
    </div>

    <div class="layui-inline">
        <label class="layui-form-label">详情模板</label>
        <div class="layui-input-inline template_info">
            <select name="template_info" lay-filter="area">
                <option></option>
            </select>
        </div>
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">状态</label>
    <div class="layui-input-inline">
        {!! Form::select('status', CategoryStatusConst::desc(), isset($info) ? $info->status : '', ['class'=>'', 'placeholder'=>'请选择']) !!}
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">上传封面</label>
    <div class="layui-input-block">
        {!! Form::oneImage('picture', isset($info) ? $info->picture : '') !!}
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

@section('script')
    <script src="{!! admin_asset('js/citys.js') !!}"></script>
    <script src="{!! admin_asset('lib/layui/lay/dest/layui.all.js') !!}"></script>
    @parent
    <script type="text/javascript">
        var citys = {!! PageTemplateConst::getJson() !!};
        pca.init('select[name=template_type]', 'select[name=template_page]', 'select[name=template_info]',
                '{!! isset($info) ? $info->template_type : '' !!}',
                '{!! isset($info) ? $info->template_page : '' !!}',
                '{!! isset($info) ? $info->template_info : '' !!}');

        layui.use(['form', 'layedit', 'laydate'], function() {

            var form = layui.form(),
                    layer = layui.layer,
                    layedit = layui.layedit,
                    laydate = layui.laydate;

            layedit.set({
                uploadImage: {
                    url: _upload_url //接口url
                }
            });
            //创建一个编辑器
            var editIndex = layedit.build('LAY_demo_editor', {

            });

            //监听提交
            form.on('submit(demo1)', function(data) {
                var _this = $(this);
                buttonDisabledTrue(_this);

                $('.layui-input-inline').removeClass('error-prompt');

                $.ajax({
                    url: '{!! $route !!}',
                    data: data.field,
                    type:'POST',
                    cache: false,
                    dataType:'json',
                    success:function(res) {
                        if(res.code != 0) {
                            var error = res.data;
                            for ( var i in error ) {
                                $('.'+i).after(formMidError(error[i]));
                            }
                            buttonDisabledFalse(_this);
                        }
                        else {
                            alert(res.data);
                            window.location.href = '{!! route('admin.page.list') !!}' ;
                        }
                    }
                });
                return false;
            });

        });

    </script>
@stop