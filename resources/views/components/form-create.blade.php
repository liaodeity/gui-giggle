@extends('layouts.admin')
@section('style')
@endsection

@section('content')
    <div class="layui-fluid">
        <x-menu-breadcrumb-path :menuId="$createData->getMenuActiveId()"/>
        <div class="system-gui-main bg-white system-gui-add">
            <form class="layui-form" action="" lay-filter="currentForm" onsubmit="return false;">
                <div class="layui-tab layui-tab-brief">

                    <div class="fr page-a-link">
                        <span class="layui-breadcrumb" lay-separator="|">
                        @if(isset($createData->model()->id))
                                <a class="btn-link" href="{{$createData->getCreateUrl()}}">{{__('message.tab.go_create')}}</a>
                                <a class="btn-link" href="{{$createData->getShowUrl()}}">{{__('message.tab.go_view')}}</a>
                            @else
                                <a class="btn-link" href="{{$createData->getListUrl()}}">{{__('message.tab.back_list')}}</a>
                            @endif
                        </span>
                    </div>

                    <ul class="layui-tab-title">
                        <li class="layui-this">{{__('message.tab.base_info')}}</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            @method($createData->getMethod())
                            @csrf
                            <div class="layui-form-item">
                                <label class="layui-form-label">所属分类 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="Article[category_id]" value="{{$createData->model()->category_id ?? ''}}" maxlength="36" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">标题 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <textarea placeholder="" class="layui-textarea" name="Article[title]" maxlength="200" >{{$createData->model()->title ?? ''}}</textarea>
                                </div>
                            </div><div class="layui-form-item">
                                <label class="layui-form-label">封面图片 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="Article[cover_id]" value="{{$createData->model()->cover_id ?? ''}}" maxlength="36" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">副标题 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="Article[sub_title]" value="{{$createData->model()->sub_title ?? ''}}" maxlength="100" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">来源名称 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="Article[source]" value="{{$createData->model()->source ?? ''}}" maxlength="100" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">来源地址 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="Article[source_link]" value="{{$createData->model()->source_link ?? ''}}" maxlength="150" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">浏览次数 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="Article[view_number]" value="{{$createData->model()->view_number ?? ''}}" maxlength="" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">是否置顶 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    @foreach($createData->model()->isTopItem() as $ind=>$val)
                                        <input type="radio" name="Article[is_top]" value="{{$ind}}" title="{{$val}}"
                                               @if(isset($createData->model()->is_top) && $createData->model()->is_top==$ind ) checked @endif >
                                    @endforeach
                                </div>
                            </div><div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">简要描述 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <textarea placeholder="" class="layui-textarea" name="Article[description]" maxlength="500" >{{$createData->model()->description ?? ''}}</textarea>
                                </div>
                            </div><div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">内容 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <textarea placeholder="" class="layui-textarea" name="Article[content]" maxlength="4294967295" >{{$createData->model()->content ?? ''}}</textarea>
                                </div>
                            </div><div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">发布时间 <span class="color-red"></span></label>
                                    <div class="layui-input-inline ">
                                        <input type="text" id="release_at" name="Article[release_at]" value="{{$createData->model()->release_at ?? ''}}" placeholder="" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux"></div>
                                </div>
                            </div><div class="layui-form-item">
                                <label class="layui-form-label">发布人 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="Article[user_id]" value="{{$createData->model()->user_id ?? ''}}" maxlength="36" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">状态 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    @foreach($createData->model()->statusItem() as $ind=>$val)
                                        <input type="radio" name="Article[status]" value="{{$ind}}" title="{{$val}}"
                                               @if(isset($createData->model()->status) && $createData->model()->status==$ind ) checked @endif >
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block  padding-bottom-15">
                        <button class="layui-btn" lay-submit="" lay-filter="formPOST">{{__('message.buttons.save_submit')}}</button>
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
                systemGui.createOrUpdate(data.field, 'POST','{{$createData->getPostUrl()}}')
                return false;
            });
        });
    </script>
@endsection
