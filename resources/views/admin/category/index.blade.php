<?php
use App\Library\Trees\Tree;
?>
@extends($layout)

@section('style')
    <link rel="stylesheet" href="{!! lib_asset('nestable-lists/nestedSortable.css') !!}" media="all"/>
@stop

@section('content')

    {!! Menu::adminMenuBls()->categoryMenu(Input::get()) !!}
    @include($prefix.'.category.form.seach')

    <ol class="sortable">
        {!! (new Tree('parent_id'))->create($list, function($date) {
            function recursion($date){
                $html = '';
                foreach ($date as $value) {
                    $html .= '<li id="list_'.$value->id.'"><div>
                        <span class="disclose"><span>
                        </span></span>
                        '.$value->titleName.'
                        <span style="float: right">
                            <a href="'.route('admin.category.edit', ['id' => $value->id]).'" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                            <a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
                        </span>
                    </div>';

                    $child = count($value->child);
                    if($child > 0) {
                        $html .= '<ol>';
                        $html .= recursion($value->child);
                        $html .= '</ol>';
                    }
                    $html .= '</li>';
                }
                return $html;
            };
            return recursion($date->getItems());
        }) !!}
    </ol>


@stop

@section('script')
    <script src="{!! lib_asset('jquery/1.8.16/jquery-ui.min.js') !!}"></script>
    <script src="{!! lib_asset('jquery/1.8.16/jquery.ui.touch-punch.js') !!}"></script>
    <script src="{!! lib_asset('nestable-lists/jquery.nestedSortable.js') !!}"></script>
    <script>

        $(document).ready(function(){

            $('ol.sortable').nestedSortable({
                forcePlaceholderSize: true,
                handle: 'div',
                helper: 'clone',
                items: 'li',
                opacity: .6,
                placeholder: 'placeholder',
                revert: 250,
                tabSize: 25,
                tolerance: 'pointer',
                toleranceElement: '> div',
                maxLevels: 3,

                isTree: true,
                expandOnHover: 700,
                startCollapsed: true
            });

            $('.disclose').on('click', function() {
                $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
            });

        });
    </script>
@stop



