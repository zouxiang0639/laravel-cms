layui.use(['form', 'layedit', 'laydate'], function() {

    /**
     * 上传文件
     */
    layui.upload({
        url: _upload_url,
        before:function(input) {
            var token = $('input[name = _token]').val();
            $(input).after('<input name="_token" type="hidden" value="' + token + '">');
        },
        success: function(res, input){
            var callback_class = $(input).attr('callback-class');
            $("." + callback_class).attr('src', res.data.src);
            $("input[name="+callback_class+"]").val(res.data.src);

            console.log(res); //上传成功返回值，必须为json格式

        }
    });

    /**
     * 放大图片 弹框
     */
    $('.show-image').on('click', function() {

        //边缘弹出
        var image = $(this).attr('src');
        layer.open({
            title:'图片信息',
            type: 1,
            offset: 't', //具体配置参考：offset参数项
            content: '<div style="padding: 20px 80px;"><img src="'+image+'" class="asdas"></div>',
            btn: '关闭',
            btnAlign: 'c', //按钮居中
            shade: 0.3,
            maxWidth:1000,
            yes: function(){
                layer.closeAll();
            }
        });
    });

});