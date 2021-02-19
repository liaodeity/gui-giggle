@extends('layouts.admin')

@section('style')

@endsection

@section('content')
<div class="layui-fluid">
    <x-menu-breadcrumb-path :menuId="$menuActiveId" />
    <div class=" bg-white system-gui-show">
        <div class="layui-row">
        <div class="layui-tab layui-tab-brief">
            <div class="fr page-a-link">
                <span class="layui-breadcrumb" lay-separator="|">
                  <a class="btn-link" href="{{url('admin/article/create')}}">{{__('message.tab.go_create')}}</a>
                  <a class="btn-link" href="{{url('admin/article/'.$article->id.'/edit')}}">{{__('message.tab.go_edit')}}</a>
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
                    <th>所属分类</th>
                    <td>{{$article->category_id ?? ''}}</td>
                </tr>
<tr>
                    <th>标题</th>
                    <td>{{$article->title ?? ''}}</td>
                </tr>
<tr>
                    <th>封面图片</th>
                    <td>{{$article->cover_id ?? ''}}</td>
                </tr>
<tr>
                    <th>副标题</th>
                    <td>{{$article->sub_title ?? ''}}</td>
                </tr>
<tr>
                    <th>来源名称</th>
                    <td>{{$article->source ?? ''}}</td>
                </tr>
<tr>
                    <th>来源地址</th>
                    <td>{{$article->source_link ?? ''}}</td>
                </tr>
<tr>
                    <th>浏览次数</th>
                    <td>{{$article->view_number ?? ''}}</td>
                </tr>
<tr>
                    <th>是否置顶</th>
                    <td>{{$article->isTopItem($article->is_top ?? '')}}</td>
                </tr>
<tr>
                    <th>简要描述</th>
                    <td>{{$article->description ?? ''}}</td>
                </tr>
<tr>
                    <th>内容</th>
                    <td>{{$article->content ?? ''}}</td>
                </tr>
<tr>
                    <th>发布时间</th>
                    <td>{{$article->release_at ?? ''}}</td>
                </tr>
<tr>
                    <th>发布人</th>
                    <td>{{$article->user_id ?? ''}}</td>
                </tr>
<tr>
                    <th>状态</th>
                    <td>{{$article->statusItem($article->status ?? '')}}</td>
                </tr>
<tr>
                    <th>创建时间</th>
                    <td>{{$article->created_at ?? ''}}</td>
                </tr>
<tr>
                    <th>更新时间</th>
                    <td>{{$article->updated_at ?? ''}}</td>
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
