@extends('layouts.admin')
@section('style')

@endsection

@section('content')
    <div class="main-inner layui-fluid">
        <x-menu-breadcrumb-path :menuId="$menuActiveId"/>
        <div class="main-layout main-order">
            <fieldset class="layui-elem-field">
                <legend>{{__('message.lists.search_info')}}</legend>
                <div style="margin: 10px 10px 10px 10px">
                    <form class="layui-form layui-form-pane" action="">
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">字段名称</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="parameters[name]" autocomplete="off" class="layui-input">
                                </div>
                            </div><div class="layui-inline">
                                <label class="layui-form-label">所属模型</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="parameters[model]" autocomplete="off" class="layui-input">
                                </div>
                            </div><div class="layui-inline">
                                <label class="layui-form-label">类型名称</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="parameters[title]" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <button type="submit" class="layui-btn layui-btn-primary" lay-submit
                                        lay-filter="data-search-btn"><i
                                        class="layui-icon"></i>{{__('message.buttons.search')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </fieldset>
            <div class="layui-tab order-content layuiwdl-tab-card">
                <div class="layui-tab-item layui-show">
                    <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>
                </div>
            </div>
        </div>


    </div>
    <script type="text/html" id="toolbarDemo">
        <div class="layui-btn-container">
            <a href="{{url('admin/parameter/create')}}" class="layui-btn layui-btn-sm data-add-btn"> {{__('message.buttons.create')}}
            </a>
            <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn"
                    lay-event="delete"> {{__('message.buttons.delete')}}
            </button>
        </div>
    </script>
    <script type="text/html" id="operateTableBar">
        @{{# if (d._show_url) { }}
        <a class="layui-btn layui-btn-xs data-count-show" href="@{{d._show_url}}" lay-event="show">{{__('message.buttons.show')}}</a>
        @{{# } }}
        @{{# if (d._edit_url) { }}
        <a class="layui-btn layui-btn-xs data-count-edit" href="@{{d._edit_url}}" lay-event="edit">{{__('message.buttons.edit')}}</a>
        @{{# } }}
        @{{# if (d._delete_url) { }}
        <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">{{__('message.buttons.delete')}}</a>
        @{{# } }}
    </script>
@endsection

@section('footer')
    <script>
        layui.use(['form', 'table', 'laydate', 'systemGui'], function () {
            var $ = layui.jquery,
                element = layui.element,
                form = layui.form,
                table = layui.table,
                miniPage = layui.miniPage,
                systemGui = layui.systemGui,
                laydate = layui.laydate;
            element.render();
            form.render();


            table.render({
                elem: '#currentTableId',
                url: '{{url('admin/parameter')}}',
                toolbar: '#toolbarDemo',
                parseData: function (res) {
                    return {
                        "code": res.code,
                        "msg": res.message,
                        "count": res.result.meta.pagination.total,
                        "data": res.result.data
                    };
                },
                defaultToolbar: ['filter', 'exports', 'print', {
                    title: '{{__('message.buttons.tips')}}',
                    layEvent: 'LAYTABLE_TIPS',
                    icon: 'layui-icon-tips'
                }],
                cols: [[
                    {type: "checkbox", width: 50, fixed: "left"},
                   {field: 'id', title: '编号', sort: true,hide:true},
{field: 'name', title: '字段名称', sort: true,hide:false},
{field: 'model', title: '所属模型', sort: true,hide:true},
{field: 'title', title: '类型名称', sort: true,hide:true},
{field: 'created_at', title: '创建时间', sort: true,hide:false},
{field: 'updated_at', title: '更新时间', sort: true,hide:true},

                    {
                        title: '{{__('message.buttons.operate')}}',
                        minWidth: 200,
                        field: '_operate',
                        sort: false,
                        templet: '#operateTableBar',
                        fixed: "right",
                        align: "left"
                    }
                ]],
                limits: [10, 15, 20, 25, 50, 100],
                limit: '{{get_config_value ('system_gui.page.limit')}}',
                page: true
            });

            // 监听搜索操作
            form.on('submit(data-search-btn)', function (data) {
                var result = data.field ? data.field : [];
                //执行搜索重载
                table.reload('currentTableId', {
                    page: {
                        curr: 1
                    }
                    , where: result
                }, 'data');

                return false;
            });

            //监听表格复选框选择
            table.on('checkbox(currentTableFilter)', function (obj) {
                console.log(obj)
            });
            table.on('toolbar(currentTableFilter)', function (obj) {
                var checkStatus = table.checkStatus('currentTableId')
                data = checkStatus.data;
                switch (obj.event) {
                    case 'create':

                        break;
                    case 'delete':
                        //先获取数据，判断是否已选中数据
                        var ids = []
                        if (data.length === 0) {
                            top.layer.msg(GUI_LANG.NO_SELECT_DATA, {
                                icon: 2,
                                time: GUI_LANG.ERROR_TIP_TIME,
                                shade: 0.3
                            });
                            return false;
                        }
                        var delete_url = '';
                        data.forEach(function (val, ind) {
                            ids.push(val.id)
                            delete_url = val._batch_delete
                        });
                        systemGui.deleteRaw('{{__('message.confirms.delete',['name'=>''])}}', delete_url + '/' + ids.splice(','));

                        break;
                }
                return false;
            });
            table.on('tool(currentTableFilter)', function (obj) {
                var data = obj.data;
                switch (obj.event) {
                    case 'edit':
                        break;
                    case 'show':
                        break;
                    case 'delete':
                        systemGui.deleteRaw('{{__('message.confirms.delete',['name'=>''])}}', data._delete_url);
                        break;

                }
                return false;
            });
            //监听排序事件
            table.on('sort(currentTableFilter)', function (obj) { //注：sort 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
                // console.log(obj.field); //当前排序的字段名
                // console.log(obj.type); //当前排序类型：desc（降序）、asc（升序）、null（空对象，默认排序）
                // console.log(this); //当前排序的 th 对象

                //尽管我们的 table 自带排序功能，但并没有请求服务端。
                //有些时候，你可能需要根据当前排序的字段，重新向服务端发送请求，从而实现服务端排序，如：
                table.reload('currentTableId', {
                    initSort: obj //记录初始排序，如果不设的话，将无法标记表头的排序状态。
                    , where: { //请求参数（注意：这里面的参数可任意定义，并非下面固定的格式）
                        order_by: obj.field + ' ' + obj.type //排序字段排序方式
                    }
                });
            });
        });
    </script>
@endsection
