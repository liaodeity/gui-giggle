@extends('layouts.admin')
@section('style')
@endsection

@section('content')
    <div class="layui-fluid">
        <x-menu-breadcrumb-path :menuId="$menuActiveId"/>
        <div class="system-gui-main bg-white system-gui-add">
            <form class="layui-form" action="" lay-filter="currentForm" onsubmit="return false;">
                <div class="layui-tab layui-tab-brief">

                    <div class="fr page-a-link">
                        <span class="layui-breadcrumb" lay-separator="|">
                        @if(isset($plugin->id))
                          <a class="btn-link" href="{{url('admin/plugin/create')}}">前往添加</a>
                          <a class="btn-link" href="{{url('admin/plugin/'.$plugin->id)}}">前往查看</a>
                          @else
                          <a class="btn-link" href="{{url('admin/plugin')}}">返回列表</a>
                        @endif
                        </span>
                    </div>

                    <ul class="layui-tab-title">
                        <li class="layui-this">基本信息</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            @method($_method ?? '')
                            @csrf
                            <input type="hidden" name="id" value="{{$plugin->id ?? ''}}">
                            <div class="layui-form-item">
                    <label class="layui-form-label">插件标识 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Plugin[name]" value="{{$plugin->name ?? ''}}" maxlength="36" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">当前版本号 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Plugin[version]" value="{{$plugin->version ?? ''}}" maxlength="100" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">插件名称 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Plugin[title]" value="{{$plugin->title ?? ''}}" maxlength="100" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">封面图片 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Plugin[cover_img]" value="{{$plugin->cover_img ?? ''}}" maxlength="100" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">插件详情 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Plugin[content]" value="{{$plugin->content ?? ''}}" maxlength="65535" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">依赖插件 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Plugin[depend]" value="{{$plugin->depend ?? ''}}" maxlength="65535" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">插件文件树 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Plugin[file_tree]" value="{{$plugin->file_tree ?? ''}}" maxlength="65535" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">是否安装 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($plugin->isInstallItem() as $ind=>$val)
                        <input type="radio" name="Plugin[is_install]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($plugin->is_install) && $plugin->is_install==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">是否更新 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($plugin->isUpdateItem() as $ind=>$val)
                        <input type="radio" name="Plugin[is_update]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($plugin->is_update) && $plugin->is_update==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">安装时间 <span class="color-red"></span></label>
                        <div class="layui-input-inline ">
                            <input type="text" id="install_at" name="Plugin[install_at]" value="{{$plugin->install_at ?? ''}}" placeholder="" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux"></div>
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">修改人 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Plugin[user_id]" value="{{$plugin->user_id ?? ''}}" maxlength="36" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>

                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block  padding-bottom-15">
                        <button class="layui-btn" lay-submit="" lay-filter="form{{$_method}}">立即提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    @include('common/ueditor',['name'=>'content'])
    <script type="text/javascript">
        layui.use(['element', 'form', 'jquery', 'layedit', 'laydate', 'systemGui'], function () {
            var form = layui.form
                , element = layui.element
                , layer = layui.layer
                , $ = layui.jquery
                , layedit = layui.layedit
                , systemGui = layui.systemGui
                , laydate = layui.laydate;
            LayerPageIndex = layer.index;
            form.render();
            //监听提交

            //安装时间
            laydate.render({
                elem: '#install_at',
                type: 'date',
                trigger: 'click'
            });

            //新建
            form.on('submit(formPOST)', function (data) {
                systemGui.createOrUpdate(data.field, 'POST','{{url('admin/plugin')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT','{{url('admin/plugin',$plugin->id)}}')

                return false;
            });
        });
    </script>
@endsection
