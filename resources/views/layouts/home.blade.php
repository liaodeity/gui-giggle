<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    @yield('style')
</head>
<body>
@yield('content')

<script type="text/javascript" src="{{asset('static/echarts/echarts.min.js')}}"></script>
@yield('footer')
</body>
</html>
