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
                        @if(isset($field->id))
                          <a class="btn-link" href="{{url('admin/field/create')}}">{{__('message.tab.go_create')}}</a>
                          <a class="btn-link" href="{{url('admin/field/'.$field->id)}}">{{__('message.tab.go_view')}}</a>
                          @else
                          <a class="btn-link" href="{{url('admin/field')}}">{{__('message.tab.back_list')}}</a>
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
                            <input type="hidden" name="id" value="{{$field->id ?? ''}}">
                            <div class="layui-form-item">
                    <label class="layui-form-label">表ID <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Field[tab_id]" value="{{$field->tab_id ?? ''}}" maxlength="36" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">字段名称 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Field[name]" value="{{$field->name ?? ''}}" maxlength="100" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">字段中文名 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Field[title]" value="{{$field->title ?? ''}}" maxlength="50" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">字段类型 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Field[type]" value="{{$field->type ?? ''}}" maxlength="20" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">字段最大长度 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Field[max_length]" value="{{$field->max_length ?? ''}}" maxlength="" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">DEFAULT_VALUE <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <textarea placeholder="" class="layui-textarea" name="Field[default_value]" maxlength="200" >{{$field->default_value ?? ''}}</textarea>
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
                systemGui.createOrUpdate(data.field, 'POST','{{url('admin/field')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT','{{url('admin/field',$field->id)}}')

                return false;
            });
        });
    </script>
@endsection
