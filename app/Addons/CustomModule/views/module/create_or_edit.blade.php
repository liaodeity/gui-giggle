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
                        @if(isset($module->id))
                          <a class="btn-link" href="{{url('admin/module/create')}}">{{__('message.tab.go_create')}}</a>
                          <a class="btn-link" href="{{url('admin/module/'.$module->id)}}">{{__('message.tab.go_view')}}</a>
                          @else
                          <a class="btn-link" href="{{url('admin/module')}}">{{__('message.tab.back_list')}}</a>
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
                            <input type="hidden" name="id" value="{{$module->id ?? ''}}">
                            <div class="layui-form-item">
                    <label class="layui-form-label">模块名称 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Module[name]" value="{{$module->name ?? ''}}" maxlength="191" autocomplete="off"
                               placeholder=""
                               class="layui-input">
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
                systemGui.createOrUpdate(data.field, 'POST','{{url('admin/module')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT','{{url('admin/module',$module->id)}}')

                return false;
            });
        });
    </script>
@endsection
