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
                        @if(isset($parameterItem->id))
                          <a class="btn-link" href="{{url('admin/parameter_item/create')}}">前往添加</a>
                          <a class="btn-link" href="{{url('admin/parameter_item/'.$parameterItem->id)}}">前往查看</a>
                          @else
                          <a class="btn-link" href="{{url('admin/parameter_item')}}">返回列表</a>
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
                            <input type="hidden" name="id" value="{{$parameterItem->id ?? ''}}">
                            <div class="layui-form-item">
                    <label class="layui-form-label">PARAMETER_ID <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="ParameterItem[parameter_id]" value="{{$parameterItem->parameter_id ?? ''}}" maxlength="36" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">键 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($parameterItem->keyItem() as $ind=>$val)
                        <input type="radio" name="ParameterItem[key]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($parameterItem->key) && $parameterItem->key==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">名称 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="ParameterItem[item]" value="{{$parameterItem->item ?? ''}}" maxlength="191" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">状态 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($parameterItem->statusItem() as $ind=>$val)
                        <input type="radio" name="ParameterItem[status]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($parameterItem->status) && $parameterItem->status==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">颜色 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="ParameterItem[color]" value="{{$parameterItem->color ?? ''}}" maxlength="50" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">排序 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="ParameterItem[sort]" value="{{$parameterItem->sort ?? ''}}" maxlength="" autocomplete="off"
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
            element.render();
            form.render();
            //监听提交



            //新建
            form.on('submit(formPOST)', function (data) {
                systemGui.createOrUpdate(data.field, 'POST','{{url('admin/parameter_item')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT','{{url('admin/parameter_item',$parameterItem->id)}}')

                return false;
            });
        });
    </script>
@endsection
