@extends('layouts.admin')
@section('style')
@endsection

@section('content')
    <div class="layui-fluid">
        <x-menu-breadcrumb-path :menuId="$menuActiveId"/>
        <div class="system-gui-main bg-white system-gui-add">
            <form class="layui-form" action="" lay-filter="currentForm" onsubmit="return false;">
                <div class="layui-tab layui-tab-brief">
                    <ul class="layui-tab-title">
                        <li class="layui-this">基本信息</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            @method($_method ?? '')
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id ?? ''}}">
                            <div class="layui-form-item">
                                <label class="layui-form-label">用户编号 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="User[user_no]" value="{{$user->user_no ?? ''}}" maxlength="20" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">用户手机号 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="User[mobile]" value="{{$user->mobile ?? ''}}" maxlength="20" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">用户邮箱 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="User[email]" value="{{$user->email ?? ''}}" maxlength="100" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">昵称 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="User[nickname]" value="{{$user->nickname ?? ''}}" maxlength="20" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">出生日期 <span class="color-red"></span></label>
                                    <div class="layui-input-inline ">
                                        <input type="text" id="birthday" name="User[birthday]" value="{{$user->birthday ?? ''}}" placeholder=""
                                               autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux"></div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">性别 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    @foreach($user->genderItem() as $ind=>$val)
                                        <input type="radio" name="User[gender]" value="{{$ind}}" title="{{$val}}"
                                               @if(isset($user->gender) && $user->gender==$ind ) checked @endif >
                                    @endforeach
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">注册时间 <span class="color-red"></span></label>
                                    <div class="layui-input-inline ">
                                        <input type="text" id="reg_date" name="User[reg_date]" value="{{$user->reg_date ?? ''}}" placeholder=""
                                               autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux"></div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">真实姓名 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="User[real_name]" value="{{$user->real_name ?? ''}}" maxlength="20" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">身份证号 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="User[id_number]" value="{{$user->id_number ?? ''}}" maxlength="18" autocomplete="off"
                                           placeholder=""
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">居住地址 <span class="color-red"></span></label>
                                <div class="layui-input-block">
                                    <input type="text" name="User[live_address]" value="{{$user->live_address ?? ''}}" maxlength="100"
                                           autocomplete="off"
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
            element.render();
            form.render();
            //监听提交
            //
            laydate.render({
                elem: '#birthday',
                trigger: 'click'
            });
            laydate.render({
                elem: '#reg_date',
                trigger: 'click'
            });

            //新建
            form.on('submit(formPOST)', function (data) {
                systemGui.createOrUpdate(data.field, 'POST', '{{url('admin/user')}}')
                return false;
            });
            //更新
            form.on('submit(formPUT)', function (data) {
                systemGui.createOrUpdate(data.field, 'PUT', '{{url('admin/user',$user->id)}}')

                return false;
            });
        });
    </script>
@endsection
