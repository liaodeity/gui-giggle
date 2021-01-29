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
                                <label class="layui-form-label">视图块ID</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="block_fields[block_id]" autocomplete="off" class="layui-input">
                                </div>
                            </div><div class="layui-inline">
                                <label class="layui-form-label">字段ID</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="block_fields[field_id]" autocomplete="off" class="layui-input">
                                </div>
                            </div><div class="layui-inline">
                                <label class="layui-form-label">数据类型</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="block_fields[typeof_data]" autocomplete="off" class="layui-input">
                                </div>
                            </div><div class="layui-inline">
                        <label class="layui-form-label">是否隐藏字段</label>
                        <div class="layui-input-inline">
                            <select name="block_fields[is_hidden]" lay-filter="is_hidden">
                                <option value=""></option>
                                @foreach($blockField->isHiddenItem() as $ind=>$val)
                                <option value="{{$ind}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="layui-inline">
                        <label class="layui-form-label">是否允许创建</label>
                        <div class="layui-input-inline">
                            <select name="block_fields[is_create]" lay-filter="is_create">
                                <option value=""></option>
                                @foreach($blockField->isCreateItem() as $ind=>$val)
                                <option value="{{$ind}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="layui-inline">
                        <label class="layui-form-label">是否允许快速创建</label>
                        <div class="layui-input-inline">
                            <select name="block_fields[is_quick_create]" lay-filter="is_quick_create">
                                <option value=""></option>
                                @foreach($blockField->isQuickCreateItem() as $ind=>$val)
                                <option value="{{$ind}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="layui-inline">
                        <label class="layui-form-label">是否允许修改</label>
                        <div class="layui-input-inline">
                            <select name="block_fields[is_edit]" lay-filter="is_edit">
                                <option value=""></option>
                                @foreach($blockField->isEditItem() as $ind=>$val)
                                <option value="{{$ind}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="layui-inline">
                        <label class="layui-form-label">是否允许查看</label>
                        <div class="layui-input-inline">
                            <select name="block_fields[is_view]" lay-filter="is_view">
                                <option value=""></option>
                                @foreach($blockField->isViewItem() as $ind=>$val)
                                <option value="{{$ind}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="layui-inline">
                        <label class="layui-form-label">是否必填</label>
                        <div class="layui-input-inline">
                            <select name="block_fields[is_require]" lay-filter="is_require">
                                <option value=""></option>
                                @foreach($blockField->isRequireItem() as $ind=>$val)
                                <option value="{{$ind}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="layui-inline">
                        <label class="layui-form-label">是否关键外键字段</label>
                        <div class="layui-input-inline">
                            <select name="block_fields[is_foreign_key]" lay-filter="is_foreign_key">
                                <option value=""></option>
                                @foreach($blockField->isForeignKeyItem() as $ind=>$val)
                                <option value="{{$ind}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="layui-inline">
                        <label class="layui-form-label">视图显示类型</label>
                        <div class="layui-input-inline">
                            <select name="block_fields[ui_type]" lay-filter="ui_type">
                                <option value=""></option>
                                @foreach($blockField->uiTypeItem() as $ind=>$val)
                                <option value="{{$ind}}">{{$val}}</option>
                                @endforeach
                            </select>
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
            <a href="{{url('admin/block_field/create')}}" class="layui-btn layui-btn-sm data-add-btn"
               lay-event="create"> {{__('message.buttons.create')}}
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
                form = layui.form,
                table = layui.table,
                miniPage = layui.miniPage,
                systemGui = layui.systemGui,
                laydate = layui.laydate;
            form.render();


            table.render({
                elem: '#currentTableId',
                url: '{{url('admin/block_field')}}',
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
{field: 'block_id', title: '视图块ID', sort: true,hide:false},
{field: 'field_id', title: '字段ID', sort: true,hide:false},
{field: 'typeof_data', title: '数据类型', sort: true,hide:true},
{field: '_is_hidden', title: '是否隐藏字段', sort: true,hide:false},
{field: '_is_create', title: '是否允许创建', sort: true,hide:false},
{field: '_is_quick_create', title: '是否允许快速创建', sort: true,hide:false},
{field: '_is_edit', title: '是否允许修改', sort: true,hide:false},
{field: '_is_view', title: '是否允许查看', sort: true,hide:false},
{field: '_is_require', title: '是否必填', sort: true,hide:false},
{field: '_is_foreign_key', title: '是否关键外键字段', sort: true,hide:false},
{field: '_ui_type', title: '视图显示类型', sort: true,hide:false},
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
            table.on('sort(currentTableFilter)', function (obj) {
                table.reload('currentTableId', {
                    initSort: obj
                    , where: {
                        order_by: obj.field + ' ' + obj.type
                    }
                });
            });
        });
    </script>
@endsection
