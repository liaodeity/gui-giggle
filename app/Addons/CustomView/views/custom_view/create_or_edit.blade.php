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
                        @if(isset($customView->id))
                          <a class="btn-link" href="{{url('admin/custom_view/create')}}">{{__('message.tab.go_create')}}</a>
                          <a class="btn-link" href="{{url('admin/custom_view/'.$customView->id)}}">{{__('message.tab.go_view')}}</a>
                          @else
                          <a class="btn-link" href="{{url('admin/custom_view')}}">{{__('message.tab.back_list')}}</a>
                        @endif
                        </span>
                    </div>

                    <ul class="layui-tab-title">
                        <li class="layui-this">{{__('message.tab.base_info')}}</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            @method($_method ?? '')
                            @csrf
                            <input type="hidden" name="id" value="{{$customView->id ?? ''}}">
                            <div class="layui-form-item">
                    <label class="layui-form-label">自定义视图 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="CustomView[name]" value="{{$customView->name ?? ''}}" maxlength="50" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">自定义视图标题 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="CustomView[title]" value="{{$customView->title ?? ''}}" maxlength="100" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">是否默认视图 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($customView->isDefaultItem() as $ind=>$val)
                        <input type="radio" name="CustomView[is_default]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($customView->is_default) && $customView->is_default==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">状态 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($customView->statusItem() as $ind=>$val)
                        <input type="radio" name="CustomView[status]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($customView->status) && $customView->status==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block  padding-bottom-15">
                        <button class="layui-btn" lay-submit="" lay-filter="form{{$_method}}">{{__('message.buttons.save_submit')}}</button>
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

            

            //新建
            form.on('submit(formPOST)', function (data) {
                systemGui.createOrUpdate(data.field, 'POST','{{url('admin/custom_view')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT','{{url('admin/custom_view',$customView->id)}}')

                return false;
            });
        });
    </script>
@endsection
