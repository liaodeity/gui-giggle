@extends('layouts.main')
@section('style')
    <style>
        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden
        }

        body {
            background: #009688;
        }

        body:after {
            content: '';
            background-repeat: no-repeat;
            background-size: cover;
            -webkit-filter: blur(3px);
            -moz-filter: blur(3px);
            -o-filter: blur(3px);
            -ms-filter: blur(3px);
            filter: blur(3px);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }

        .layui-container {
            width: 100%;
            height: 100%;
            overflow: hidden
        }

        .admin-login-background {
            width: 360px;
            height: 300px;
            position: absolute;
            left: 50%;
            top: 40%;
            margin-left: -180px;
            margin-top: -100px;
        }

        .logo-title {
            text-align: center;
            letter-spacing: 2px;
            padding: 14px 0;
        }

        .logo-title h1 {
            color: #009688;
            font-size: 25px;
            font-weight: bold;
        }

        .login-form {
            background-color: #fff;
            border: 1px solid #fff;
            border-radius: 3px;
            padding: 14px 20px;
            box-shadow: 0 0 8px #eeeeee;
        }

        .login-form .layui-form-item {
            position: relative;
        }

        .login-form .layui-form-item label {
            position: absolute;
            left: 1px;
            top: 1px;
            width: 38px;
            line-height: 36px;
            text-align: center;
            color: #d2d2d2;
        }

        .login-form .layui-form-item input {
            padding-left: 36px;
        }

        .captcha {
            width: 60%;
            display: inline-block;
        }

        .captcha-img {
            display: inline-block;
            width: 34%;
            float: right;
        }

        .captcha-img img {
            height: 34px;
            border: 1px solid #e6e6e6;
            height: 36px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="layui-container">
        <div class="admin-login-background">
            <div class="layui-form login-form">
                <form id="login-form" class="layui-form" action="{{route ('admin-login-check')}}">
                    <input type="hidden" name="loginType" value="admin">
                    <input type="hidden" name="rememberToken" value="{{$remember->token ?? ''}}">
                    <div class="layui-form-item logo-title">
                        <h1>{{get_config_value('system_title','Laravel Gui')}}后台登录</h1>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-icon layui-icon-username" for="username"></label>
                        <input type="text" name="username" placeholder="用户名或者邮箱"
                               autocomplete="off" class="layui-input" value="{{$remember->username ?? ''}}">
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-icon layui-icon-password" for="password"></label>
                        <input type="password" name="password" placeholder="密码"
                               autocomplete="off" class="layui-input" value="{{$remember->en_password ?? ''}}">
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-icon layui-icon-vercode" for="captcha"></label>
                        <input type="text" name="captcha" placeholder="图形验证码"
                               autocomplete="off" class="layui-input verification captcha" value="">
                        <div class="captcha-img">
                            <img id="captcha" src="{{route ('admin-login-captcha')}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <input type="checkbox" name="rememberMe" value="1" lay-skin="primary" @if(isset($remember->check) && $remember->check) checked @endif title="记住密码">
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn layui-btn-fluid" lay-submit="" lay-filter="login">{{__('message.buttons.login')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        layui.use ([ 'form' ], function () {
            var form = layui.form,
                layer = layui.layer;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 登录过期的时候，跳出ifram框架
            if (top.location != self.location) top.location = self.location;

            $("#captcha").click(function () {
                url = '{{ route('admin-login-captcha')}}';
                $("#captcha").attr("src",url+'?t='+Math.random());
            });

            // 进行登录操作
            form.on ('submit(login)', function (data) {
                data = data.field;
                login_url = $("#login-form").attr('action')
                query = $("#login-form").serialize();
                $("#login-form button[type='submit']").addClass('disabled').prop('disabled', true);
                $.ajax({
                    type: 'post',
                    url: login_url,
                    data: query,
                    dataType: 'json',
                    error: function () {
                        top.layer.msg('{{__ ('message.fail.access')}}', {
                            icon: 2,
                            time: 3000,
                            shade: 0.3
                        });
                    },
                    complete: function () {
                        $("#login-form button[type='submit']").removeClass('disabled').prop('disabled', false);
                    },
                    success: function (result) {

                        if (result.code === 0) {
                            top.layer.msg(result.message, {
                                icon: 1,
                                time: 2000,
                                shade: 0.3
                            });
                            setTimeout(function () {
                                top.window.location.href = result.result.url;
                            }, 2000);

                        } else {
                            top.layer.msg(result.message, {
                                icon: 5,
                                time: 3000,
                                shade: 0.3
                            });
                            if(result.refresh){
                                //刷新验证码
                                $("#captcha").click();
                            }
                        }
                    }
                })

                return false;
            });
        });
    </script>
@endsection
