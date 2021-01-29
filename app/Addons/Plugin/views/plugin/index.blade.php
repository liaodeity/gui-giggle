@extends('layouts.admin')
@section('style')

@endsection

@section('content')
    <div class="main-inner layui-fluid">
        <x-menu-breadcrumb-path :menuId="$menuActiveId"/>
        <div class="main-layout main-plug">
            <div class="plug-title">你可以添加列表需要的功能，丰富公众号的能力和体验 <a class="link" target="_blank" href="{{$plugin_url ?? ''}}">更多应用市场插件&gt;</a></div>
            <div class="layui-row layui-col-space24">
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box">
                            <i class="iconfont plugin-erweima menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">留言管理</div>
                            <div class="msg">
                                此功能可以允许公众号的文章被关注用户留<br>言，加强彼此之间的互动。
                            </div>
                        </div>
                        <div class="addRight">
                            <span>已添加</span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box">
                            <i class="iconfont plugin-shangcheng menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">自定义菜单</div>
                            <div class="msg">
                                公众号可以在会话界面底部设置各式各样的<br>自定义菜单，并可为其设置响应动作。
                            </div>
                        </div>
                        <div class="addRight">
                            <span>已添加</span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box">
                            <i class="iconfont icon-gongzhonghao-zidonghuifu menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">自动回复</div>
                            <div class="msg">
                                公众号可以针对用户的行为来设置特定的回<br>复内容和丰富的关键字回复规则。
                            </div>
                        </div>
                        <div class="addRight">
                            <span>已添加</span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box">
                            <i class="iconfont icon-yuanchuang menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">原创管理</div>
                            <div class="msg">
                                申请成功后可以对内容进行原创声明。
                            </div>
                        </div>
                        <div class="addRight">
                            <span>已添加</span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box ico-box-bg76CAC3">
                            <i class="iconfont icon-zanshangshouyi menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">赞赏功能</div>
                            <div class="msg">
                                用户阅读完文章后，可通过该功能自愿向公<br>众号赠予赏金。
                            </div>
                        </div>
                        <div class="addRight">
                            <span>已添加</span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box">
                            <i class="iconfont icon-moban menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">页面模板</div>
                            <div class="msg">
                                页面模板功能，是给公众号创建行业网页的<br>功能插件。
                            </div>
                        </div>
                        <div class="addRight">
                            <span>已添加</span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box">
                            <i class="iconfont icon-toupiao menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">投票管理</div>
                            <div class="msg">
                                投票管理可允许公众账号对投票进行新增、<br>删除和查看的操作。
                            </div>
                        </div>
                        <div class="addRight">
                            <span>已添加</span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box ico-box-bg76CAC3">
                            <i class="iconfont icon-xiaodian menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">微信小店</div>
                            <div class="msg">
                                一站式的微信开店，帮助已开通微信支付的<br>公众号实现快速便捷的开店和管理商品。
                            </div>
                        </div>
                        <div class="addRight">
                            <span></span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box ico-box-bg76CAC3">
                            <i class="iconfont icon-kefu menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">客服功能</div>
                            <div class="msg">
                                为公众号提供客服服务，支持多人同时为一<br>个公众号提供客服服务，实时回复粉丝咨询。
                            </div>
                        </div>
                        <div class="addRight">
                            <span></span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box ico-box-bg76CAC3">
                            <i class="iconfont icon-kaquan menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">卡券功能</div>
                            <div class="msg">
                                该功能向公众号提供卡券管理、推广、经营<br>分析的整套解决方案。
                            </div>
                        </div>
                        <div class="addRight">
                            <span></span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box ico-box-bg76CAC3">
                            <i class="iconfont icon-xiaochengxu menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">门店小程序</div>
                            <div class="msg">
                                管理配置门店可以用于卡券、广告、WIFI等<br>业务。
                            </div>
                        </div>
                        <div class="addRight">
                            <span></span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box ico-box-bg76CAC3">
                            <i class="iconfont icon-shiliangzhinengduixiang- menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">电子发票</div>
                            <div class="msg">
                                提供电子发票的标准化接入流程、开票接口<br>和发票递送方案。
                            </div>
                        </div>
                        <div class="addRight">
                            <span></span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="flex-plug">
                        <div class="ico-box ico-box-bg76CAC3">
                            <i class="iconfont icon-erweima menu-ico"></i>
                        </div>
                        <div class="info-box">
                            <div class="title">一物一码</div>
                            <div class="msg">
                                安全赋予每件商品唯一码，消费者扫码后进<br>入小程序与品牌互动并获得其他服务。
                            </div>
                        </div>
                        <div class="addRight">
                            <span></span>
                            <i class="iconfont icon-chevron-right arrowR-ico"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <script type="text/html" id="toolbarDemo">
        <div class="layui-btn-container">
            <a href="{{url('admin/plugin/create')}}" class="layui-btn layui-btn-sm data-add-btn"
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
                url: '{{url('admin/plugin')}}',
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
{field: 'name', title: '插件标识', sort: true,hide:false},
{field: 'version', title: '当前版本号', sort: true,hide:false},
{field: 'title', title: '插件名称', sort: true,hide:false},
{field: 'cover_img', title: '封面图片', sort: true,hide:false},
{field: 'content', title: '插件详情', sort: true,hide:false},
{field: 'depend', title: '依赖插件', sort: true,hide:false},
{field: 'file_tree', title: '插件文件树', sort: true,hide:false},
{field: '_is_install', title: '是否安装', sort: true,hide:false},
{field: '_is_update', title: '是否更新', sort: true,hide:false},
{field: 'install_at', title: '安装时间', sort: true,hide:false},
{field: 'user_id', title: '修改人', sort: true,hide:false},
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
                        systemGui.openIFrame(SYSTEM_GUI.ROUTE_PREFIX + '');
                        // layer.open({
                        //     type: 2 //Page层类型
                        //     ,area: ['500px', '300px']
                        //     ,title: false
                        //     ,shade: 0.6 //遮罩透明度
                        //     ,maxmin: false //允许全屏最小化
                        //     ,anim: 1 //0-6的动画形式，-1不开启
                        //     ,content: 'https://layer.layui.com/'
                        // });

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
                        systemGui.getHrefContentOpen(SYSTEM_GUI.ROUTE_PREFIX + '/' + data.id + '/edit');
                        break;
                    case 'show':
                        systemGui.getHrefContentOpen(SYSTEM_GUI.ROUTE_PREFIX + '/' + data.id);
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
