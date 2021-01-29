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
                  <a class="btn-link" href="{{url('admin/field_item/create')}}">{{__('message.tab.go_create')}}</a>
                  <a class="btn-link" href="{{url('admin/field_item/'.$fieldItem->id.'/edit')}}">{{__('message.tab.go_edit')}}</a>
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
                    <th>FIELD_ID</th>
                    <td>{{$fieldItem->field_id ?? ''}}</td>
                </tr>
<tr>
                    <th>键值</th>
                    <td>{{$fieldItem->valueItem($fieldItem->value ?? '')}}</td>
                </tr>
<tr>
                    <th>名称</th>
                    <td>{{$fieldItem->label ?? ''}}</td>
                </tr>
<tr>
                    <th>状态</th>
                    <td>{{$fieldItem->statusItem($fieldItem->status ?? '')}}</td>
                </tr>
<tr>
                    <th>颜色</th>
                    <td>{{$fieldItem->color ?? ''}}</td>
                </tr>
<tr>
                    <th>排序</th>
                    <td>{{$fieldItem->sort ?? ''}}</td>
                </tr>
<tr>
                    <th>创建时间</th>
                    <td>{{$fieldItem->created_at ?? ''}}</td>
                </tr>
<tr>
                    <th>更新时间</th>
                    <td>{{$fieldItem->updated_at ?? ''}}</td>
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
