<ul id="nav-menu">
    @foreach($menus as $menu)
        <li>
            @if(isset($menu['child']) && count($menu['child']) > 0)
                <div class="menu-link">
                    <i class="{{$menu['icon'] ?? 'iconfont icon-gongneng'}}"></i><span>{{$menu['title'] ?? ''}}</span>
                </div>
                <ul class="menu-sub-main">
                    @foreach($menu['child'] as $child)
                        <li class="{{$child['active']}}-nav" >
                            <a data-id="{{$child['id']}}" href="{{url($child['href'] ?? '')}}">
                                <span>{{$child['title'] ?? ''}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <a data-id="{{$menu['id']}}" href="{{url($menu['href'] ?? '')}}">
                    <div class="menu-link">
                        <i class="{{$menu['icon'] ?? 'iconfont icon-gongneng'}}"></i><span>{{$menu['title'] ?? ''}}</span>
                    </div>
                </a>
            @endif
        </li>
    @endforeach
</ul>
