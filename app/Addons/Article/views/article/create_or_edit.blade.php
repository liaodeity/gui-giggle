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
                        @if(isset($article->id))
                          <a class="btn-link" href="{{url('admin/article/create')}}">前往添加</a>
                          <a class="btn-link" href="{{url('admin/article/'.$article->id)}}">前往查看</a>
                          @else
                          <a class="btn-link" href="{{url('admin/article')}}">返回列表</a>
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
                            <input type="hidden" name="id" value="{{$article->id ?? ''}}">
                            <div class="layui-form-item">
                    <label class="layui-form-label">所属分类 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Article[category_id]" value="{{$article->category_id ?? ''}}" maxlength="36" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">标题 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <textarea placeholder="" class="layui-textarea" name="Article[title]" maxlength="200" >{{$article->title ?? ''}}</textarea>
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">封面图片 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Article[cover_id]" value="{{$article->cover_id ?? ''}}" maxlength="36" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">副标题 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Article[sub_title]" value="{{$article->sub_title ?? ''}}" maxlength="100" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">来源名称 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Article[source]" value="{{$article->source ?? ''}}" maxlength="100" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">来源地址 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Article[source_link]" value="{{$article->source_link ?? ''}}" maxlength="150" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">浏览次数 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Article[view_number]" value="{{$article->view_number ?? ''}}" maxlength="" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">是否置顶 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($article->isTopItem() as $ind=>$val)
                        <input type="radio" name="Article[is_top]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($article->is_top) && $article->is_top==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div><div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">简要描述 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <textarea placeholder="" class="layui-textarea" name="Article[description]" maxlength="500" >{{$article->description ?? ''}}</textarea>
                    </div>
                </div><div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">内容 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <textarea placeholder="" class="layui-textarea" name="Article[content]" maxlength="4294967295" >{{$article->content ?? ''}}</textarea>
                    </div>
                </div><div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">发布时间 <span class="color-red"></span></label>
                        <div class="layui-input-inline ">
                            <input type="text" id="release_at" name="Article[release_at]" value="{{$article->release_at ?? ''}}" placeholder="" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux"></div>
                    </div>
                </div><div class="layui-form-item">
                    <label class="layui-form-label">发布人 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Article[user_id]" value="{{$article->user_id ?? ''}}" maxlength="36" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">状态 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($article->statusItem() as $ind=>$val)
                        <input type="radio" name="Article[status]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($article->status) && $article->status==$ind ) checked @endif >
                        @endforeach
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

            //发布时间
            laydate.render({
                elem: '#release_at',
                type: 'date',
                trigger: 'click'
            });

            //新建
            form.on('submit(formPOST)', function (data) {
                systemGui.createOrUpdate(data.field, 'POST','{{url('admin/article')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT','{{url('admin/article',$article->id)}}')

                return false;
            });
        });
    </script>
@endsection
