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
                        @if(isset($attachment->id))
                          <a class="btn-link" href="{{url('admin/attachment/create')}}">前往添加</a>
                          <a class="btn-link" href="{{url('admin/attachment/'.$attachment->id)}}">前往查看</a>
                          @else
                          <a class="btn-link" href="{{url('admin/attachment')}}">返回列表</a>
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
                            <input type="hidden" name="id" value="{{$attachment->id ?? ''}}">
                            <div class="layui-form-item">
                    <label class="layui-form-label">附件唯一码 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Attachment[uuid]" value="{{$attachment->uuid ?? ''}}" maxlength="36" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">路径 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <textarea placeholder="" class="layui-textarea" name="Attachment[path]" maxlength="200" >{{$attachment->path ?? ''}}</textarea>
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">名称 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Attachment[title]" value="{{$attachment->title ?? ''}}" maxlength="100" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">MD5值 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Attachment[md5]" value="{{$attachment->md5 ?? ''}}" maxlength="32" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">SHA1值 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Attachment[sha1]" value="{{$attachment->sha1 ?? ''}}" maxlength="42" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">文件类型 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Attachment[mine_type]" value="{{$attachment->mine_type ?? ''}}" maxlength="100" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">后缀名 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Attachment[suffix]" value="{{$attachment->suffix ?? ''}}" maxlength="10" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">附件大小byte <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Attachment[size]" value="{{$attachment->size ?? ''}}" maxlength="" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">使用次数 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Attachment[use_number]" value="{{$attachment->use_number ?? ''}}" maxlength="" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">最后使用时间 <span class="color-red"></span></label>
                        <div class="layui-input-inline ">
                            <input type="text" id="last_at" name="Attachment[last_at]" value="{{$attachment->last_at ?? ''}}" placeholder="" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux"></div>
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">状态 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($attachment->statusItem() as $ind=>$val)
                        <input type="radio" name="Attachment[status]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($attachment->status) && $attachment->status==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">上传人 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Attachment[user_id]" value="{{$attachment->user_id ?? ''}}" maxlength="36" autocomplete="off"
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

            //最后使用时间
            laydate.render({
                elem: '#last_at',
                type: 'date',
                trigger: 'click'
            });

            //新建
            form.on('submit(formPOST)', function (data) {
                systemGui.createOrUpdate(data.field, 'POST','{{url('admin/attachment')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT','{{url('admin/attachment',$attachment->id)}}')

                return false;
            });
        });
    </script>
@endsection
