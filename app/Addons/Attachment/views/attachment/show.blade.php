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
                  <a class="btn-link" href="{{url('admin/attachment/create')}}">前往添加</a>
                  <a class="btn-link" href="{{url('admin/attachment/'.$attachment->id.'/edit')}}">前往编辑</a>
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
                    <th>附件唯一码</th>
                    <td>{{$attachment->uuid ?? ''}}</td>
                </tr>
<tr>
                    <th>路径</th>
                    <td>{{$attachment->path ?? ''}}</td>
                </tr>
<tr>
                    <th>名称</th>
                    <td>{{$attachment->title ?? ''}}</td>
                </tr>
<tr>
                    <th>MD5值</th>
                    <td>{{$attachment->md5 ?? ''}}</td>
                </tr>
<tr>
                    <th>SHA1值</th>
                    <td>{{$attachment->sha1 ?? ''}}</td>
                </tr>
<tr>
                    <th>文件类型</th>
                    <td>{{$attachment->mine_type ?? ''}}</td>
                </tr>
<tr>
                    <th>后缀名</th>
                    <td>{{$attachment->suffix ?? ''}}</td>
                </tr>
<tr>
                    <th>附件大小byte</th>
                    <td>{{$attachment->size ?? ''}}</td>
                </tr>
<tr>
                    <th>使用次数</th>
                    <td>{{$attachment->use_number ?? ''}}</td>
                </tr>
<tr>
                    <th>最后使用时间</th>
                    <td>{{$attachment->last_at ?? ''}}</td>
                </tr>
<tr>
                    <th>状态</th>
                    <td>{{$attachment->statusItem($attachment->status ?? '')}}</td>
                </tr>
<tr>
                    <th>上传人</th>
                    <td>{{$attachment->user_id ?? ''}}</td>
                </tr>
<tr>
                    <th>DELETED_AT</th>
                    <td>{{$attachment->deleted_at ?? ''}}</td>
                </tr>
<tr>
                    <th>创建时间</th>
                    <td>{{$attachment->created_at ?? ''}}</td>
                </tr>
<tr>
                    <th>更新时间</th>
                    <td>{{$attachment->updated_at ?? ''}}</td>
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
