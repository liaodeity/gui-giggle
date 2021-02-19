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
                                <label class="layui-form-label">标题</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="articles[title]" autocomplete="off" class="layui-input">
                                </div>
                            </div><div class="layui-inline">
                                <label class="layui-form-label">副标题</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="articles[sub_title]" autocomplete="off" class="layui-input">
                                </div>
                            </div><div class="layui-inline">
                                <label class="layui-form-label">来源名称</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="articles[source]" autocomplete="off" class="layui-input">
                                </div>
                            </div><div class="layui-inline">
                                <label class="layui-form-label">来源地址</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="articles[source_link]" autocomplete="off" class="layui-input">
                                </div>
                            </div><div class="layui-inline">
                        <label class="layui-form-label">是否置顶</label>
                        <div class="layui-input-inline">
                            <select name="articles[is_top]" lay-filter="is_top">
                                <option value=""></option>
                                @foreach($article->isTopItem() as $ind=>$val)
                                <option value="{{$ind}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="layui-inline">
                                <label class="layui-form-label">简要描述</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="articles[description]" autocomplete="off" class="layui-input">
                                </div>
                            </div><div class="layui-inline">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-inline">
                            <select name="articles[status]" lay-filter="status">
                                <option value=""></option>
                                @foreach($article->statusItem() as $ind=>$val)
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
            <a href="{{url('admin/article/create')}}" class="layui-btn layui-btn-sm data-add-btn"
               > {{__('message.buttons.create')}}
            </a>
            <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn"
                    > {{__('message.buttons.delete')}}
            </button>
        </div>
    </script>
    <script type="text/html" id="operateTableBar">
        @{{# if (d._show_url) { }}
        <a class="layui-btn layui-btn-xs data-count-show" href="@{{d._show_url}}" >{{__('message.buttons.show')}}</a>
        @{{# } }}
        @{{# if (d._edit_url) { }}
        <a class="layui-btn layui-btn-xs data-count-edit" href="@{{d._edit_url}}" >{{__('message.buttons.edit')}}</a>
        @{{# } }}
        @{{# if (d._delete_url) { }}
        <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">{{__('message.buttons.delete')}}</a>
        @{{# } }}
    </script>
@endsection

@section('footer')
    <script>
        layui.use(['element', 'form', 'table', 'laydate', 'systemGui'], function () {
            var $ = layui.jquery,
                form = layui.form,
                element = layui.element,
                table = layui.table,
                miniPage = layui.miniPage,
                systemGui = layui.systemGui,
                laydate = layui.laydate;
                element.render();
            form.render();


            table.render({
                elem: '#currentTableId',
                url: '{{url('admin/article')}}',
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
{field: 'category_id', title: '所属分类', sort: true,hide:false},
{field: 'title', title: '标题', sort: true,hide:true},
{field: 'cover_id', title: '封面图片', sort: true,hide:false},
{field: 'sub_title', title: '副标题', sort: true,hide:false},
{field: 'source', title: '来源名称', sort: true,hide:false},
{field: 'source_link', title: '来源地址', sort: true,hide:false},
{field: 'view_number', title: '浏览次数', sort: true,hide:false},
{field: '_is_top', title: '是否置顶', sort: true,hide:false},
{field: 'description', title: '简要描述', sort: true,hide:true},
{field: 'content', title: '内容', sort: true,hide:false},
{field: 'release_at', title: '发布时间', sort: true,hide:false},
{field: 'user_id', title: '发布人', sort: true,hide:false},
{field: '_status', title: '状态', sort: true,hide:false},
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
