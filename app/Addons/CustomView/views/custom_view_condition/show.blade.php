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
                  <a class="btn-link" href="{{url('admin/custom_view_condition/create')}}">{{__('message.tab.go_create')}}</a>
                  <a class="btn-link" href="{{url('admin/custom_view_condition/'.$customViewCondition->id.'/edit')}}">{{__('message.tab.go_edit')}}</a>
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
                    <th>自定义视图ID</th>
                    <td>{{$customViewCondition->custom_view_id ?? ''}}</td>
                </tr>
<tr>
                    <th>字段ID</th>
                    <td>{{$customViewCondition->field_id ?? ''}}</td>
                </tr>
<tr>
                    <th>分组</th>
                    <td>{{$customViewCondition->group_type ?? ''}}</td>
                </tr>
<tr>
                    <th>连接类型</th>
                    <td>{{$customViewCondition->type ?? ''}}</td>
                </tr>
<tr>
                    <th>比较类型</th>
                    <td>{{$customViewCondition->comparator ?? ''}}</td>
                </tr>
<tr>
                    <th>内容</th>
                    <td>{{$customViewCondition->data_value ?? ''}}</td>
                </tr>
<tr>
                    <th>创建时间</th>
                    <td>{{$customViewCondition->created_at ?? ''}}</td>
                </tr>
<tr>
                    <th>更新时间</th>
                    <td>{{$customViewCondition->updated_at ?? ''}}</td>
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
