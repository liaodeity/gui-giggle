@extends('layouts.admin')

@section('style')

@endsection

@section('content')
<div class="layui-fluid">
    <x-menu-breadcrumb-path :menuId="$menuActiveId"/>
    <div class=" bg-white system-gui-show">
        <div class="layui-row">
        <div class="layui-tab layui-tab-brief">
            <div class="fr page-a-link">
                <span class="layui-breadcrumb" lay-separator="|">
                  <a class="btn-link" href="{{url('admin/plugin/create')}}">前往添加</a>
                  <a class="btn-link" href="{{url('admin/plugin/'.$plugin->id.'/edit')}}">前往编辑</a>
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
                    <th>插件标识</th>
                    <td>{{$plugin->name ?? ''}}</td>
                </tr>
<tr>
                    <th>当前版本号</th>
                    <td>{{$plugin->version ?? ''}}</td>
                </tr>
<tr>
                    <th>插件名称</th>
                    <td>{{$plugin->title ?? ''}}</td>
                </tr>
<tr>
                    <th>封面图片</th>
                    <td>{{$plugin->cover_img ?? ''}}</td>
                </tr>
<tr>
                    <th>插件详情</th>
                    <td>{{$plugin->content ?? ''}}</td>
                </tr>
<tr>
                    <th>依赖插件</th>
                    <td>{{$plugin->depend ?? ''}}</td>
                </tr>
<tr>
                    <th>插件文件树</th>
                    <td>{{$plugin->file_tree ?? ''}}</td>
                </tr>
<tr>
                    <th>是否安装</th>
                    <td>{{$plugin->isInstallItem($plugin->is_install ?? '')}}</td>
                </tr>
<tr>
                    <th>是否更新</th>
                    <td>{{$plugin->isUpdateItem($plugin->is_update ?? '')}}</td>
                </tr>
<tr>
                    <th>安装时间</th>
                    <td>{{$plugin->install_at ?? ''}}</td>
                </tr>
<tr>
                    <th>修改人</th>
                    <td>{{$plugin->user_id ?? ''}}</td>
                </tr>
<tr>
                    <th>DELETED_AT</th>
                    <td>{{$plugin->deleted_at ?? ''}}</td>
                </tr>
<tr>
                    <th>创建时间</th>
                    <td>{{$plugin->created_at ?? ''}}</td>
                </tr>
<tr>
                    <th>更新时间</th>
                    <td>{{$plugin->updated_at ?? ''}}</td>
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
