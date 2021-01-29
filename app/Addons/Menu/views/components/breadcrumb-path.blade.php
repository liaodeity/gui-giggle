<div class="main-title">
    <span class="layui-breadcrumb">
      <a href="{{route ('admin-index')}}">首页</a>
        @foreach($menus as $_menu)
            @if( empty($_menu->route_url) )
                <a><cite>{{$_menu->title ?? ''}}</cite></a>
            @else
                <a href="{{url($_menu->route_url ?? '')}}">{{$_menu->title ?? ''}}</a>
            @endif
        @endforeach
        @foreach($pathArr as $_path)
            <a><cite>{{$_path ?? ''}}</cite></a>
        @endforeach
    </span>
</div>
