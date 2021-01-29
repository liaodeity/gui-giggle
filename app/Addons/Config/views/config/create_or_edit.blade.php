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
                  <a class="btn-link" href="{{url('admin/config/'.$config->id)}}">前往查看</a>
                </span>
                    </div>
                    <ul class="layui-tab-title">
                        <li class="layui-this">基本信息</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            @method($_method ?? '')
                            @csrf
                            <input type="hidden" name="id" value="{{$config->id ?? ''}}">
                            @if(!isset($config->id))
                           <div class="layui-form-item">
                    <label class="layui-form-label">配置类型 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @foreach($config->typeItem() as $ind=>$val)
                        <input type="radio" name="Config[type]" value="{{$ind}}" title="{{$val}}"
                         @if(isset($config->type) && $config->type==$ind ) checked @endif >
                        @endforeach
                    </div>
                </div>
                            <div class="layui-form-item">
                    <label class="layui-form-label">配置名称 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Config[name]" value="{{$config->name ?? ''}}" maxlength="50" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
                            @endif
<div class="layui-form-item">
                    <label class="layui-form-label">配置标题 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <input type="text" name="Config[title]" value="{{$config->title ?? ''}}" maxlength="100" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
<div class="layui-form-item">
                    <label class="layui-form-label">配置内容 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        @switch($config->type)
                            @case(\App\Addons\Config\Models\Config::NUMBER_TYPE)
                            <input type="number" name="Config[context]" value="{{$config->context ?? ''}}" onkeyup="keyupNumber(this.value)" maxlength="65535" autocomplete="off"
                                   placeholder=""
                                   class="layui-input">{{$config->typeItem($config->type)}}
                            @break
                            @case(\App\Addons\Config\Models\Config::ARRAY_TYPE)
                            <select name="Config[context]" id="" lay-filter="context">
                                <option value=""></option>
                                @foreach($config->getParamItem($config) as $item)
                                    <option value="{{$item->value}}" @if(isset($config->context) && $config->context == $item->value) selected @endif>{{$item->label ?? ''}}</option>
                                @endforeach
                            </select>
                            @break
                            @default
                            <textarea placeholder="" class="layui-textarea" name="Config[context]"
                                      maxlength="200">{{$config->context ?? ''}}</textarea>

                        @endswitch
                    </div>
                </div>
<div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">说明 <span class="color-red"></span></label>
                    <div class="layui-input-block">
                        <textarea placeholder="" class="layui-textarea" name="Config[desc]" maxlength="200" >{{$config->desc ?? ''}}</textarea>
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
                trigger: 'click'
            });

            //新建
            form.on('submit(formPOST)', function (data) {
                systemGui.createOrUpdate(data.field, 'POST','{{url('admin/config')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT','{{url('admin/config',$config->id)}}')

                return false;
            });
        });
    </script>
@endsection
