<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>LayuiMini - 基于Layui的后台管理系统前端模板</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <link href="{{asset ('static/umeditor/themes/default/css/umeditor.css')}}" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('static/layui@2.5.6/css/layui.css')}}">
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style id="layuimini-bg-color">

    </style>
    @yield('style')
</head>
<body class="@yield('body_class') ">
<!-- 主体 -->
@yield('content')
<!-- /主体 -->

<!-- 底部 -->
<script src="{{asset('js/admin/lang.js')}}?v={{get_version()}}" charset="utf-8"></script>
<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{asset('static/layui@2.5.6/layui.js')}}"></script>
<script type="text/javascript" src="{{ asset('static/admin/js/lay-config.js') }}"></script>
<script src="{{asset('js/units.js')}}?v={{get_version()}}" charset="utf-8"></script>
<script src="{{asset('js/admin/main.js')}}?v={{get_version()}}" charset="utf-8"></script>
<script src="{{asset('static/umeditor/umeditor.config.js')}}?v={{get_version()}}" charset="utf-8"></script>
<script src="{{asset('static/umeditor/umeditor.min.js')}}?v={{get_version()}}" charset="utf-8"></script>
@yield('footer')
</body>
</html>
