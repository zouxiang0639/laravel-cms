<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="__ROOT__/static/manage/favicon.ico">
    <link rel="Shortcut Icon" href="__ROOT__/static/manage/favicon.ico"/>
    <title>管理登录-管理中心</title>
    <meta name="keywords" content="管理登录-管理中心">
    <meta name="description" content="管理登录-管理中心">

    @include($prefix.'.partials.style')

    <style>
        .beg-login-bg {
            width: 100%;
            height: 100%;
            position: fixed;
            background: #56abe4;
            top: 0px;
            z-index: -1;
        }

        .beg-login-box {
            min-width: 400px;
            max-width: 450px;
            height: 330px;
            margin: 10% auto;
            background-color: rgba(255, 255, 255, 0.407843);
            border-radius: 10px;
            color: aliceblue;
        }

        .beg-login-box header {
            height: 39px;
            padding: 10px;
            border-bottom: 1px dotted #fff;
        }

        .beg-login-box header h1 {
            text-align: center;
            font-size: 25px;
            line-height: 40px;
            color: #ffffff;
        }

        .beg-login-box .beg-login-main {
            height: 164px;
            padding: 30px 90px 0;
        }

        .beg-login-main .layui-form-item {
            position: relative;
        }

        .beg-login-main .layui-form-item .beg-login-icon {
            position: absolute;
            color: #0a2b1d;
            top: 10px;
            left: 10px;
        }

        .beg-login-main .layui-form-item input {
            padding-left: 34px;
        }

        .footer {
            text-align: center;
            line-height: 54px;
        }

        .captcha {
            width: 53%;
            float: left;
        }

    </style>
</head>
<body>
<div class="beg-login-bg">
    <img src="{!! admin_asset('images/login_background.jpg') !!}" alt="登陆背景图片" height="100%" width="100%">
</div>
<div class="beg-login-box">

    {!! Form::open(['route' => 'admin.login.store', 'class'=>'layui-form']) !!}
        <header>
            <h1>管理登录</h1>
        </header>
        <div class="beg-login-main">
            <div class="layui-form-item">
                <label class="beg-login-icon">
                    <i class="layui-icon">&#xe612;</i>
                </label>
                <input type="text" name="email" lay-verify="required" placeholder="请输入账号" autocomplete="off"
                       class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="beg-login-icon">
                    <i class="layui-icon">&#xe642;</i>
                </label>
                <input type="password" name="password" lay-verify="required" placeholder="请输入密码"
                       autocomplete="off"
                       class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="beg-login-icon">
                    <i class="layui-icon">&#xe600;</i>
                </label>
                <input type="text" name="captcha" lay-verify="required" maxlength="5" placeholder="请输入验证码"
                       autocomplete="off" class="layui-input captcha">
                <img id="captcha_img" alt="验证码" class="code" style="width:42%;height: 38px;margin-left:5%;"
                     onclick="load_captcha()"/>
            </div>
        </div>
        <footer class="layui-form-item footer">
            <button type="reset" id="reset" class="layui-btn layui-btn-primary">重置</button>
            <button type="submit" lay-submit lay-filter="form_submit" class="layui-btn">登陆</button>
        </footer>
    {!! Form::close() !!}
</div>

@include($prefix.'.partials.script')

<script type="text/javascript">
    load_captcha();
    function load_captcha() {
        document.getElementById("captcha_img").src = '{!! captcha_src() !!}?' + Math.random();
    }
    layui.use('form', function () {
        var form = layui.form();
        form.on('submit(form_submit)', function (data) {
            $.ajax({
                type: "POST",
                url: document.getElementById('layui-form').attributes['action'].value=url,
                data: data.field,
                async: true,
                dataType: "json",
                success: function (result) {
                    if (1 == result.code) {
                        layer.msg(result.msg, {icon: 6, time: 800});
                        setTimeout(function () {
                            top.document.location.href = result.url;
                        }, 800);
                    } else {
                        load_captcha();
                        layer.msg(result.msg, {icon: 5, time: 1000});
                    }
                }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.msg('服务器未正常响应，请稍后重试', {icon: 5, time: 1000});
                }
            });
            return false;
        });

        @if(Session::has('flash_message'))
               layer.msg('{{ Session::get('flash_message') }}', {icon: 5, time: 1000});
        @endif
    });
</script>
</body>

</html>

