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
                  <a class="btn-link" href="{{url('admin/tab/create')}}">{{__('message.tab.go_create')}}</a>
                  <a class="btn-link" href="{{url('admin/tab/'.$tab->id.'/edit')}}">{{__('message.tab.go_edit')}}</a>
                </span>
            </div>
          <ul class="layui-tab-title">
            <li class="layui-this">{{__('message.tab.base_info')}}</li>
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
                    <th>表名称</th>
                    <td>{{$tab->name ?? ''}}</td>
                </tr>
<tr>
                    <th>表标题</th>
                    <td>{{$tab->title ?? ''}}</td>
                </tr>
<tr>
                    <th>创建时间</th>
                    <td>{{$tab->created_at ?? ''}}</td>
                </tr>
<tr>
                    <th>更新时间</th>
                    <td>{{$tab->updated_at ?? ''}}</td>
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
