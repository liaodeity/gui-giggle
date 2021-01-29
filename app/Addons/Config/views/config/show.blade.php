@extends('layouts.admin')

@section('style')

@endsection

@section('content')
    <div class="layui-fluid">
        <x-menu-breadcrumb-path :menuId="$menuActiveId"/>
        <div class=" bg-white  system-gui-show">
            <div class="layui-row">
                <div class="layui-tab layui-tab-brief">
                    <div class="fr page-a-link">
                <span class="layui-breadcrumb" lay-separator="|">
                  <a class="btn-link" href="{{url('admin/config/'.$config->id.'/edit')}}">前往编辑</a>
                </span>
                    </div>
                    <ul class="layui-tab-title">
                        <li class="layui-this">基本信息</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <table class="layui-table table-show">
                                <colgroup>
                                    <col width="12%">
                                    <col width="">
                                    <col>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>配置类型</th>
                                    <td>{{$config->typeItem($config->type ?? '')}}</td>
                                </tr>
                                <tr>
                                    <th>配置名称</th>
                                    <td>{{$config->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>配置标题</th>
                                    <td>{{$config->title ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>配置内容</th>
                                    <td>{{$config->context ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>说明</th>
                                    <td>{{$config->desc ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>创建时间</th>
                                    <td>{{$config->created_at ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>更新时间</th>
                                    <td>{{$config->updated_at ?? ''}}</td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection
