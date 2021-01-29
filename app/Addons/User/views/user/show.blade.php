@extends('layouts.admin')

@section('style')

@endsection

@section('content')
    <div class="layui-fluid">
        <x-menu-breadcrumb-path :menuId="$menuActiveId"/>
        <div class=" system-gui-show bg-white">

            <div class="layui-row">
                <div class="layui-tab layui-tab-brief">
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
                                    <th>用户编号</th>
                                    <td>{{$user->user_no ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>用户手机号</th>
                                    <td>{{$user->mobile ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>用户邮箱</th>
                                    <td>{{$user->email ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>昵称</th>
                                    <td>{{$user->nickname ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>出生日期</th>
                                    <td>{{$user->birthday ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>性别</th>
                                    <td>{{$user->genderItem($user->gender ?? '')}}</td>
                                </tr>
                                <tr>
                                    <th>注册时间</th>
                                    <td>{{$user->reg_date ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>真实姓名</th>
                                    <td>{{$user->real_name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>身份证号</th>
                                    <td>{{$user->id_number ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>居住地址</th>
                                    <td>{{$user->live_address ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>DELETED_AT</th>
                                    <td>{{$user->deleted_at ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>创建时间</th>
                                    <td>{{$user->created_at ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>更新时间</th>
                                    <td>{{$user->updated_at ?? ''}}</td>
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
