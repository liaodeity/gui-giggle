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
                        @if(isset($customViewCondition->id))
                          <a class="btn-link" href="{{url('admin/custom_view_condition/create')}}">{{__('message.tab.go_create')}}</a>
                          <a class="btn-link" href="{{url('admin/custom_view_condition/'.$customViewCondition->id)}}">{{__('message.tab.go_view')}}</a>
                          @else
                          <a class="btn-link" href="{{url('admin/custom_view_condition')}}">{{__('message.tab.back_list')}}</a>
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
                            <input type="hidden" name="id" value="{{$customViewCondition->id ?? ''}}">
                            <div class="layui-form-item">
                    <label class="layui-form-label">自定义视图ID <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="CustomViewCondition[custom_view_id]" value="{{$customViewCondition->custom_view_id ?? ''}}" maxlength="36" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">字段ID <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="CustomViewCondition[field_id]" value="{{$customViewCondition->field_id ?? ''}}" maxlength="36" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">分组 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="CustomViewCondition[group_type]" value="{{$customViewCondition->group_type ?? ''}}" maxlength="" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">连接类型 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="CustomViewCondition[type]" value="{{$customViewCondition->type ?? ''}}" maxlength="10" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">比较类型 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="CustomViewCondition[comparator]" value="{{$customViewCondition->comparator ?? ''}}" maxlength="20" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">内容 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="CustomViewCondition[data_value]" value="{{$customViewCondition->data_value ?? ''}}" maxlength="191" autocomplete="off"
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
                systemGui.createOrUpdate(data.field, 'POST','{{url('admin/custom_view_condition')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT','{{url('admin/custom_view_condition',$customViewCondition->id)}}')

                return false;
            });
        });
    </script>
@endsection
