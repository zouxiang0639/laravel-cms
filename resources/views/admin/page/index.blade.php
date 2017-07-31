@extends($layout)

@section('style')

@stop
@section('content')
    {!! Menu::adminMenuBls()->pageMenu(Input::get()) !!}
    <div class="layui-form">
        <blockquote class="layui-elem-quote">
            <a href="javascript:;" class="layui-btn layui-btn-small" id="search">
                <i class="layui-icon">&#xe615;</i> 搜索
            </a>
        </blockquote>
        <div class="layui-form">
            <table class="layui-table">
                <colgroup>
                    <col width="60">
                    <col width="150">
                    <col width="150">
                    <col width="200">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th>编号</th>
                    <th>名称</th>
                    <th>模版类型</th>
                    <th>模版页面</th>
                    <th>模板详情</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($list as $value)
                    <tr>
                        <td>{{ $value->getKey() }}</td>
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->templateTypeName }}</td>
                        <td>{{ $value->templatePageName }}</td>
                        <td>{{ $value->templateInfoName }}</td>
                        <td>
                            <a href="javascript:;" class="layui-btn layui-btn-normal layui-btn-mini show-page">预览</a>
                            <a href="{!! route('admin.page.edit', ['id' => $value->getKey()]) !!}" class="layui-btn layui-btn-mini">编辑</a>
                            <a href="javascript:;" data-id="{{ $value->getKey() }}"  class="layui-btn layui-btn-danger layui-btn-mini delete-page">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="layui-laypage">
            {!! $list->appends(Input::get())->render() !!}
        </div>
    </div>
@stop

@section('script')
    @parent
    <script>

        layui.use('layer', function() {
            var $ = layui.jquery,
                    layer = layui.layer;

            $('.show-page').on('click', function() {
                layer.open({
                    title: '浏览',
                    maxmin: true,
                    type: 2,
                    content: 'video.html',
                    area: ['800px', '500px']
                });
            });

            //删除提交
            $('.delete-page').click(function () {
                var id = $(this).attr('data-id');
                var data = {
                    'id':id,
                    '_method':'DELETE',
                    '_token':'{!! csrf_token() !!}'
                };

                $.ajax({
                    url: '{!! route('admin.page.destroy') !!}',
                    data: data,
                    type:'POST',
                    cache: false,
                    dataType:'json',
                    success:function(res) {
                        if(res.code != 0) {
                            alert(res.msg)
                        }
                        else {
                            alert(res.data);
                            window.location.href = '{!! route('admin.page.list') !!}' ;
                        }
                    }
                });
            })

        });


    </script>

@stop
