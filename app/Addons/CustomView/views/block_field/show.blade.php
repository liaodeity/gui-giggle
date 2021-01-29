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
                  <a class="btn-link" href="{{url('admin/block_field/create')}}">{{__('message.tab.go_create')}}</a>
                  <a class="btn-link" href="{{url('admin/block_field/'.$blockField->id.'/edit')}}">{{__('message.tab.go_edit')}}</a>
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
                    <th>视图块ID</th>
                    <td>{{$blockField->block_id ?? ''}}</td>
                </tr>
<tr>
                    <th>字段ID</th>
                    <td>{{$blockField->field_id ?? ''}}</td>
                </tr>
<tr>
                    <th>数据类型</th>
                    <td>{{$blockField->typeof_data ?? ''}}</td>
                </tr>
<tr>
                    <th>是否隐藏字段</th>
                    <td>{{$blockField->isHiddenItem($blockField->is_hidden ?? '')}}</td>
                </tr>
<tr>
                    <th>是否允许创建</th>
                    <td>{{$blockField->isCreateItem($blockField->is_create ?? '')}}</td>
                </tr>
<tr>
                    <th>是否允许快速创建</th>
                    <td>{{$blockField->isQuickCreateItem($blockField->is_quick_create ?? '')}}</td>
                </tr>
<tr>
                    <th>是否允许修改</th>
                    <td>{{$blockField->isEditItem($blockField->is_edit ?? '')}}</td>
                </tr>
<tr>
                    <th>是否允许查看</th>
                    <td>{{$blockField->isViewItem($blockField->is_view ?? '')}}</td>
                </tr>
<tr>
                    <th>是否必填</th>
                    <td>{{$blockField->isRequireItem($blockField->is_require ?? '')}}</td>
                </tr>
<tr>
                    <th>是否关键外键字段</th>
                    <td>{{$blockField->isForeignKeyItem($blockField->is_foreign_key ?? '')}}</td>
                </tr>
<tr>
                    <th>视图显示类型</th>
                    <td>{{$blockField->uiTypeItem($blockField->ui_type ?? '')}}</td>
                </tr>
<tr>
                    <th>创建时间</th>
                    <td>{{$blockField->created_at ?? ''}}</td>
                </tr>
<tr>
                    <th>更新时间</th>
                    <td>{{$blockField->updated_at ?? ''}}</td>
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
