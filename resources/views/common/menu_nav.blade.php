{{--<div class="main-title">--}}
{{--    <span class="layui-breadcrumb">--}}
{{--      <a href="{{route ('admin-index')}}">首页</a>--}}
{{--        @foreach(\App\Services\SystemGui\AdminService::getMenuNav ($menuActiveId ?? '') as $_menu)--}}
{{--            @if( $menuActiveId == $_menu->id || empty($_menu->route_url))--}}
{{--                <a><cite>{{$_menu->title ?? ''}}</cite></a>--}}
{{--            @else--}}
{{--                <a href="{{url($_menu->route_url ?? '')}}">{{$_menu->title ?? ''}}</a>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    </span>--}}
{{--</div>--}}


