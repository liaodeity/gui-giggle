<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>建百站后台管理</title>
    <link rel="stylesheet" href="{{asset('static/layui@2.5.6/css/layui.css')}}">
    <link rel="stylesheet" href="{{asset('static/admin/iconfont/iconfont.css')}}">
    <link rel="stylesheet" href="{{ asset('static/webuploader/webuploader.css') }}">
    <link rel="stylesheet" href="{{asset ('static/umeditor/themes/default/css/umeditor.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('static/admin/css/public.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('static/admin/css/style.css')}}">--}}
    <link rel="stylesheet" href="{{mix_build_dist('/css/admin/vendor.css')}}">
    <link rel="stylesheet" href="{{mix_build_dist('/css/admin/app.css')}}">
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        var _LIAO_TOKEN = '{{csrf_token()}}';
        LIAO = {
            _TOKEN: '{{csrf_token ()}}',
            BASE_URL: '{{url('/')}}'
        }
        SYSTEM_GUI = @json(\App\Libs\SystemGui\ClassNameParse::config ());
    </script>
    @yield('head')
</head>
<body>
<!--顶部-->
<div class="header">
    <div class="header-con">
        <div class="logo">
            <a href="{{route ('admin-index')}}">
                <img src="{{asset('static/admin/images/logo-img.png')}}">
                <span class="logo-txt">建百站后台管理</span>
            </a>
        </div>
        <div class="header-right">
            <div class="account-msg">
                <i class="iconfont icon-youxiang1 ico-msg"></i>
            </div>
            <x-console-main-account-group/>
        </div>
    </div>
</div>
<!--内容-->
<div class="container-box">
    <!--左侧栏-->
    <div class="sidebar">
        <x-menu-nav-menu/>
    </div>
    <div class="main-content" id="pjax-container">
        <!-- 主体 -->
    @yield('content')
    <!-- /主体 -->
    </div>
</div>

<!-- 底部 -->
<script type="text/javascript" src="{{mix_build_dist('js/manifest.js')}}"></script>
<script type="text/javascript" src="{{mix_build_dist('js/vendor.js')}}"></script>
<script type="text/javascript" src="{{mix_build_dist('js/admin.js')}}"></script>
<script src="{{asset('js/admin/lang.js')}}?v={{get_version()}}" charset="utf-8"></script>
{{--<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>--}}
<script src="{{asset('static/layui@2.5.6/layui.js')}}"></script>
<script type="text/javascript" src="{{ asset('static/admin/js/lay-config.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{asset('static/umeditor/umeditor.config.js')}}"></script>
<script type="text/javascript" charset="utf-8" src="{{asset('static/umeditor/umeditor.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('static/webuploader/webuploader.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    layui.use('element', function () {
        var element = layui.element;
    })
</script>
@yield('footer')
{{--百度统计--}}
{{--置顶按钮效果--}}
<script type="text/javascript">
    $(function () {
        var b = $(window);
        var a = '<div id="topcontrol"><a href="javascript:void(0);" class="top_stick"><i class="fa fa-angle-double-up"></i></a></div>';
        $("body").append(a);
        $("#topcontrol").css({display: "none", "margin-left": "auto", "margin-right": "auto", width: 1000});
        $("#topcontrol").find(".top_stick").css({position: "fixed", bottom: 180, right: 40, "z-index": 999999});
        b.scroll(function () {
            var c = b.scrollTop();
            if (c > 100) {
                $("#topcontrol").fadeIn()
            } else {
                $("#topcontrol").fadeOut()
            }
        });
        $("#topcontrol").click(function () {
            $("body,html").animate({scrollTop: 0}, 500)
        });
        $("#nav-menu li a").click(function () {
            var menuId = $(this).data('id');
            console.log(menuId);
            if(menuId) {
                sessionStorage.setItem('menuActiveId', menuId);
            }
        });
        var menuId = '{{$menuActiveId ?? ''}}';
        if (!menuId) {
            menuId = sessionStorage.getItem('menuActiveId')
        }
        $("#nav-menu li a").each(function (ind, val) {
            if ($(this).data('id') == menuId) {
                $("#nav-menu li").removeClass('cu')
                $(this).parent('li').addClass('cu');
            }
        });
    });
</script>
<!-- /底部 -->

</body>
</html>
