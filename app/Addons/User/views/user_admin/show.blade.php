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
                  <a class="btn-link" href="{{url('admin/user_admin/create')}}">前往添加</a>
                  <a class="btn-link" href="{{url('admin/user_admin/'.$userAdmin->id.'/edit')}}">前往编辑</a>
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
                    <th>所属用户</th>
                    <td>{{$userAdmin->user_id ?? ''}}</td>
                </tr>
<tr>
                    <th>登录名称</th>
                    <td>{{$userAdmin->username ?? ''}}</td>
                </tr>
<tr>
                    <th>密码</th>
                    <td>{{$userAdmin->password ?? ''}}</td>
                </tr>
<tr>
                    <th>状态</th>
                    <td>{{$userAdmin->statusItem($userAdmin->status ?? '')}}</td>
                </tr>
<tr>
                    <th>创建时间</th>
                    <td>{{$userAdmin->created_at ?? ''}}</td>
                </tr>
<tr>
                    <th>更新时间</th>
                    <td>{{$userAdmin->updated_at ?? ''}}</td>
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
    <script>
        layui.use(['element'], function () {
            var $ = layui.jquery,
                element = layui.element;
            element.render()
        })
    </script>
@endsection
