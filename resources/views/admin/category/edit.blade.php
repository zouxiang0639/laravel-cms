@extends($layout)

@section('content')
    {!! Menu::adminMenuBls()->categoryMenu(Input::get()) !!}

    <fieldset class="layui-elem-field" style="margin: 20px;">
        <legend>省市联动</legend>
        <div class="layui-field-box">
            <form class="layui-form layui-form-pane" action="javascript:;">
                <div class="layui-form-item">
                    <label class="layui-form-label">选择地区</label>
                    <div class="layui-input-inline">
                        <select name="P1" lay-filter="province">
                            <option></option>
                        </select>
                    </div>
                    <label class="layui-form-label">选择地区</label>
                    <div class="layui-input-inline">
                        <select name="C1" lay-filter="city">
                            <option></option>
                        </select>
                    </div>
                    <label class="layui-form-label">选择地区</label>
                    <div class="layui-input-inline">
                        <select name="A1" lay-filter="area">
                            <option></option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </fieldset>


@stop

@section('script')

    <script src="{!! admin_asset('js/citys.js') !!}"></script>
    <script src="{!! admin_asset('lib/layui/lay/dest/layui.all.js') !!}"></script>
    <script type="text/javascript">
        var citys =
                [
                    {"name":"北京","value":"1","city":[
                        {"name":"北京","value":"21" ,"area":[
                            {"name":"西城区","value":"3"}, {"name":"天津2","value":"4"}
                        ]}
                    ]},
                    {"name":"宁夏","value":"7","city":[
                        {"name":"石嘴山","value":"11","area":[
                            {"name":"大武口区","value":"13"}, {"name":"惠农区","value":"14"}
                        ]},{"name":"吴忠","value":"12","area":[
                            {"name":"利通区","value":"15"}, {"name":"青铜峡市","value":"16"}
                        ]}
                    ]},
                    {"name":"天津", "value":"5" ,"city":[
                        {"name":"天津", "value":"6" ,"area":[
                            {"name":"和平区","value":"7"}, {"name":"河东区","value":"8"}
                        ]}
                    ]}
                ];
        pca.init('select[name=P1]', 'select[name=C1]', 'select[name=A1]', 1, 11);
    </script>
@stop