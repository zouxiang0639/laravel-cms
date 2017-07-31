<?php
use App\Consts\Admin\Category\CategoryGroupConst;
?>

<blockquote class="layui-elem-quote">
    {!! Form::open(['method' => 'get', 'class'=>'layui-form layui-form-pane']) !!}
        <a href="javascript:;" class="layui-btn layui-btn-small" id="category-sort" >
            <i class="layui-icon">&#xe63c;</i> 排序
        </a>
        <div class="layui-inline">
            {!! Form::select('group', CategoryGroupConst::desc(), Input::get('group'), ['class'=>'form-control','lay-ignore']) !!}
        </div>
    {!! Form::close() !!}
</blockquote>

@section('script')
    @parent
    <script>
        $(document).ready(function(){

            $('#category-sort').click(function(e){
                hiered = $('ol.sortable').nestedSortable('toHierarchy', {startDepthCount: 0});

                var data = {
                    'date':hiered,
                    '_token':'{!! csrf_token() !!}'
                };

                $.ajax({
                    url: '{!! route('admin.category.sort') !!}',
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
                            window.location.href = '{!! route('admin.category.list', Input::get()) !!}' ;
                        }
                    }
                });

            });

            $("select[name=group]").change(function(){
                $('.layui-form').submit();
            })
        });
    </script>
@stop