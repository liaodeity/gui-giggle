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
                        @if(isset($roleInfo->id))
                          <a class="btn-link" href="{{url('admin/role_info/create')}}">前往添加</a>
                          <a class="btn-link" href="{{url('admin/role_info/'.$roleInfo->id)}}">前往查看</a>
                          @else
                          <a class="btn-link" href="{{url('admin/role_info')}}">返回列表</a>
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
                            <input type="hidden" name="id" value="{{$roleInfo->id ?? ''}}">
                            <div class="layui-form-item">
                    <label class="layui-form-label">角色id <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="RoleInfo[role_id]" value="{{$roleInfo->role_id ?? ''}}" maxlength="" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">角色名称 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="RoleInfo[name]" value="{{$roleInfo->name ?? ''}}" maxlength="50" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">角色说明 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="RoleInfo[desc]" value="{{$roleInfo->desc ?? ''}}" maxlength="65535" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">权限ID <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="RoleInfo[role_value]" value="{{$roleInfo->role_value ?? ''}}" maxlength="65535" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">状态 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($roleInfo->statusItem() as $ind=>$val)
                        <input type="radio" name="RoleInfo[status]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($roleInfo->status) && $roleInfo->status==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">创建人 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="RoleInfo[user_id]" value="{{$roleInfo->user_id ?? ''}}" maxlength="36" autocomplete="off"
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
                systemGui.createOrUpdate(data.field, 'POST','{{url('admin/role_info')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT','{{url('admin/role_info',$roleInfo->id)}}')

                return false;
            });
        });
    </script>
@endsection
