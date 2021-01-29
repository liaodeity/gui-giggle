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
                  <a class="btn-link" href="{{url('admin/field/create')}}">{{__('message.tab.go_create')}}</a>
                  <a class="btn-link" href="{{url('admin/field/'.$field->id.'/edit')}}">{{__('message.tab.go_edit')}}</a>
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
                    <th>表ID</th>
                    <td>{{$field->tab_id ?? ''}}</td>
                </tr>
<tr>
                    <th>字段名称</th>
                    <td>{{$field->name ?? ''}}</td>
                </tr>
<tr>
                    <th>字段中文名</th>
                    <td>{{$field->title ?? ''}}</td>
                </tr>
<tr>
                    <th>字段类型</th>
                    <td>{{$field->type ?? ''}}</td>
                </tr>
<tr>
                    <th>字段最大长度</th>
                    <td>{{$field->max_length ?? ''}}</td>
                </tr>
<tr>
                    <th>DEFAULT_VALUE</th>
                    <td>{{$field->default_value ?? ''}}</td>
                </tr>
<tr>
                    <th>创建时间</th>
                    <td>{{$field->created_at ?? ''}}</td>
                </tr>
<tr>
                    <th>更新时间</th>
                    <td>{{$field->updated_at ?? ''}}</td>
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
