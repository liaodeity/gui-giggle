<div class="account-group">
    <div class="top">
        <div class="head-img">
            <img src="{{asset('static/admin/images/logo-img.png')}}">
        </div>
        <div class="head-info" style="    min-width: 120px;">
            <div class="title">{{$user_name ?? ''}}</div>
            <div class="data">
                <span>欢迎登陆后台</span>
            </div>
        </div>
        <i class="iconfont icon-xiaojiantou arrowB"></i>
    </div>
    <div class="account-show">
        <ul>
            <li>
                <a href="{{url('/')}}">
                    <i class="iconfont icon- ico-account"></i>
                    <span class="txt-account">前台首页</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin-logout')}}">
                    <i class="iconfont icon-yonghu ico-log"></i>
                    <span>退出登录</span>
                </a>
            </li>
        </ul>
    </div>
</div>
