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
                        @if(isset($blockField->id))
                          <a class="btn-link" href="{{url('admin/block_field/create')}}">{{__('message.tab.go_create')}}</a>
                          <a class="btn-link" href="{{url('admin/block_field/'.$blockField->id)}}">{{__('message.tab.go_view')}}</a>
                          @else
                          <a class="btn-link" href="{{url('admin/block_field')}}">{{__('message.tab.back_list')}}</a>
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
                            <input type="hidden" name="id" value="{{$blockField->id ?? ''}}">
                            <div class="layui-form-item">
                    <label class="layui-form-label">视图块ID <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="BlockField[block_id]" value="{{$blockField->block_id ?? ''}}" maxlength="36" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">字段ID <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="BlockField[field_id]" value="{{$blockField->field_id ?? ''}}" maxlength="36" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">数据类型 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <textarea placeholder="" class="layui-textarea" name="BlockField[typeof_data]" maxlength="200" >{{$blockField->typeof_data ?? ''}}</textarea>
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">是否隐藏字段 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($blockField->isHiddenItem() as $ind=>$val)
                        <input type="radio" name="BlockField[is_hidden]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($blockField->is_hidden) && $blockField->is_hidden==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">是否允许创建 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($blockField->isCreateItem() as $ind=>$val)
                        <input type="radio" name="BlockField[is_create]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($blockField->is_create) && $blockField->is_create==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">是否允许快速创建 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($blockField->isQuickCreateItem() as $ind=>$val)
                        <input type="radio" name="BlockField[is_quick_create]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($blockField->is_quick_create) && $blockField->is_quick_create==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">是否允许修改 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($blockField->isEditItem() as $ind=>$val)
                        <input type="radio" name="BlockField[is_edit]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($blockField->is_edit) && $blockField->is_edit==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">是否允许查看 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($blockField->isViewItem() as $ind=>$val)
                        <input type="radio" name="BlockField[is_view]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($blockField->is_view) && $blockField->is_view==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">是否必填 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($blockField->isRequireItem() as $ind=>$val)
                        <input type="radio" name="BlockField[is_require]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($blockField->is_require) && $blockField->is_require==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">是否关键外键字段 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($blockField->isForeignKeyItem() as $ind=>$val)
                        <input type="radio" name="BlockField[is_foreign_key]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($blockField->is_foreign_key) && $blockField->is_foreign_key==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">视图显示类型 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($blockField->uiTypeItem() as $ind=>$val)
                        <input type="radio" name="BlockField[ui_type]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($blockField->ui_type) && $blockField->ui_type==$ind ) checked @endif >
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
                systemGui.createOrUpdate(data.field, 'POST','{{url('admin/block_field')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT','{{url('admin/block_field',$blockField->id)}}')

                return false;
            });
        });
    </script>
@endsection
