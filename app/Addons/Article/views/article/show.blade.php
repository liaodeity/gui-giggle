@extends('layouts.admin')

@section('style')

@endsection

@section('content')
    <div class="layui-fluid">
        <x-menu-breadcrumb-path :menuId="$showData->getMenuActiveId()"/>
        <div class=" bg-white system-gui-show">
            <div class="layui-row">
                <div class="layui-tab layui-tab-brief">
                    <div class="fr page-a-link">
                <span class="layui-breadcrumb" lay-separator="|">
                  <a class="btn-link" href="{{$showData->getCreateUrl()}}">{{__('message.tab.go_create')}}</a>
                  <a class="btn-link" href="{{$showData->getEditUrl()}}">{{__('message.tab.go_edit')}}</a>
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
                                @foreach($showData->getData() as $item)
                                    <tr>
                                        <th>{{$item['label'] ?? ''}}</th>
                                        <td>{{$item['value'] ?? ''}}</td>
                                    </tr>
                                @endforeach
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
