@extends('layouts.admin')
@section('style')
@endsection

@section('content')
    <div class="layuimini-container">
        <div class="layuimini-main">
            <form class="layui-form" action="" lay-filter="currentForm">
                @method($_method ?? '')
                <input type="hidden" name="id" value="{{$user->id ?? ''}}">
                <div class="layui-form-item">
                    <label class="layui-form-label">路由地址</label>
                    <div class="layui-input-block">
                        <input type="text" name="User[user_no]" value="{{$menu->user_no ?? ''}}" autocomplete="off"
                               placeholder=""
                               class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="saveForm">立即提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        layui.use ([ 'form', 'layedit', 'laydate' ], function () {
            var form = layui.form
                , layer = layui.layer
                , layedit = layui.layedit
                , laydate = layui.laydate;
            //监听提交

            form.on ('submit(saveForm)', function (data) {
                console.log (data);
                if ($ ("input[name='_method']").val () === 'PUT') {
                    id = $ ("input[name='id']").val ();
                    _url = '/' + M_NAME + '/' + C_NAME + '/' + id;
                } else {
                    _url = '/' + M_NAME + '/' + C_NAME;
                }

                $.ajax ({
                    type: 'POST',
                    url: _url,
                    data: data.field,
                    dataType: 'json',
                    beforeSend: function () {
                        loading = list_loading ()
                    },
                    complete: function () {
                        $ ("#form-iframe-add button[type='submit']").removeClass ('disabled').prop ('disabled', false);
                        layer.close (loading)
                    },
                    error: function () {
                        top.layer.msg ('访问失败', {
                            icon: 2,
                            time: ERROR_TIP_TIME,
                            shade: 0.3
                        });
                    },
                    success: function (data) {
                        if (data.code === 0) {
                            layer.msg (data.msg, {icon: 6, time: SUCCESS_TIME, shade: 0.2});
                            setTimeout (function () {
                                var index = parent.layer.getFrameIndex (window.name); //先得到当前iframe层的索引
                                parent.$ ('button[lay-filter="data-search-btn"]').click ();//刷新列表
                                parent.layer.close (index); //再执行关闭

                            }, SUCCESS_TIME);
                        }

                    }
                });

                return false;
            });
        });
    </script>
@endsection
