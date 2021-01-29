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
                        @if(isset($parameter->id))
                          <a class="btn-link" href="{{url('admin/parameter/create')}}">前往添加</a>
                          <a class="btn-link" href="{{url('admin/parameter/'.$parameter->id)}}">前往查看</a>
                          @else
                          <a class="btn-link" href="{{url('admin/parameter')}}">返回列表</a>
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
                            <input type="hidden" name="id" value="{{$parameter->id ?? ''}}">
                            <div class="layui-form-item">
                    <label class="layui-form-label">字段名称 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Parameter[name]" value="{{$parameter->name ?? ''}}" maxlength="100" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">所属模型 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <textarea placeholder="" class="layui-textarea" name="Parameter[model]" maxlength="200" >{{$parameter->model ?? ''}}</textarea>
                    </div>
                </div><div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">类型名称 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <textarea placeholder="" class="layui-textarea" name="Parameter[title]" maxlength="200" >{{$parameter->title ?? ''}}</textarea>
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



            //新建
            form.on('submit(formPOST)', function (data) {
                systemGui.createOrUpdate(data.field, 'POST','{{url('admin/parameter')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT','{{url('admin/parameter',$parameter->id)}}')

                return false;
            });
        });
    </script>
@endsection
