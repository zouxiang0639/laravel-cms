<?php
use App\Consts\Admin\Category\CategoryStatusConst;
use App\Consts\Admin\Category\CategoryBindPageConst;
use App\Consts\Admin\Category\CategoryGroupConst;
?>

@section('style')
    <link rel="stylesheet" href="{!! lib_asset('select2/select2.min.css') !!}" media="all">
@stop
{!! Form::open(['method' => 'post', 'class'=>'layui-form layui-form-pane']) !!}
<div class="layui-form-item">
    <label class="layui-form-label">导航分类</label>
    <div class="layui-input-inline status">
        {!! Form::select('group', CategoryGroupConst::desc(), isset($info) ? $info->group : Input::get('group'), ['class'=>'form-control','lay-ignore','disabled']) !!}
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">标题</label>
    <div class="layui-input-inline title">
        <input type="text" name="title" value="{!! isset($info) ? $info->title : '' !!}" placeholder="请输入标题" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">状态</label>
    <div class="layui-input-inline status">
        {!! Form::select('status', CategoryStatusConst::desc(), isset($info) ? $info->status : '', ['class'=>'form-control', 'placeholder'=>'请选择','lay-ignore']) !!}
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">父级导航</label>
    <div class="layui-input-block parent_id">
        {!! Form::select('parent_id', array_merge([0=>'/'], $category), isset($info) ? $info->parent_id : '', ['class'=>'form-control', 'placeholder'=>'请选择','id'=>'select2-parent-id','lay-ignore']) !!}
    </div>
</div>
<div class="layui-form-item">
    <div class="layui-inline">
        <label class="layui-form-label">绑定页面</label>
        <div class="layui-input-inline bind_page">
            {!! Form::select('bind_page', CategoryBindPageConst::desc(), isset($info) ? $info->bind_page : '', ['class'=>'form-control', 'placeholder'=>'请选择','lay-ignore']) !!}
        </div>
    </div>
</div>
<div class="layui-form-item hides" id="page" >
    <label class="layui-form-label">本地链接</label>
    <div class="layui-input-block page_id">
        {!! Form::select('page_id', $page, isset($info) ? $info->page_id : '', ['class'=>'form-control', 'placeholder'=>'请选择','id'=>'select2-page','lay-ignore']) !!}
    </div>
</div>
<div class="layui-form-item hides" id="template_info">
    <label class="layui-form-label">外部链接</label>
    <div class="layui-input-block links">
        <input type="text" name="links" value="{!! isset($info) ? $info->links : '' !!}" placeholder="请输入外部链接" class="form-control">
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
    @parent
    <script src="{!! lib_asset('select2/select2.min.js') !!}"></script>
    <script type="text/javascript">
        layui.use(['form', 'layedit', 'laydate'], function() {

            var form = layui.form();

            $("#select2-page").select2({
                placeholder: "请选择",
                allowClear: true
            });

            $("#select2-parent-id").select2({
                placeholder: "请选择",
                allowClear: true
            });

            $("select[name='bind_page']").on({
                change:function(){
                    var page = '{!! CategoryBindPageConst::PAGE !!}';
                    if ($(this).val() == page) {
                        $('#template_info').hide();
                        $('#page').show();
                    } else {
                        $('#template_info').show();
                        $('#page').hide();
                    }
                }
            }).trigger("change");

            //监听提交
            form.on('submit(demo1)', function(data) {

                var _this = $(this);
                //buttonDisabledTrue(_this);

                $('.error-prompt').removeClass('error-prompt');

                $.ajax({
                    url: '{!! $route !!}',
                    data: data.field,
                    type:'POST',
                    cache: false,
                    dataType:'json',
                    success:function(res) {
                        if(res.code != 0) {
                            errorPrompt(res.data);
                            buttonDisabledFalse(_this);
                        }
                        else {
                            alert(res.data);
                            window.location.href = '{!! route('admin.category.list', ['group' => Input::get('group')]) !!}';
                        }
                    }
                });
                return false;
            });

        });

    </script>
@stop