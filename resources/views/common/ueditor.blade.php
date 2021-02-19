{{--<script type="text/javascript" charset="utf-8" src="{{asset('static/ueditor/lang/zh-cn/zh-cn.js')}}"></script>--}}
<script type="text/javascript">
    {{--$('#{{$name}}').attr('id', 'editor_id_{{$name}}');--}}
    {{--window.UEDITOR_HOME_URL = "{{asset('static/ueditor')}}";--}}
    {{--window.UEDITOR_CONFIG.initialFrameHeight = parseInt('350px');--}}
    {{--window.UEDITOR_CONFIG.scaleEnabled = true;--}}
    {{--window.UEDITOR_CONFIG.imageUrl = '{{route('admin_upload_editor')}}?_token={{csrf_token()}}';--}}
    {{--window.UEDITOR_CONFIG.imagePath = '';--}}
    {{--window.UEDITOR_CONFIG.imageFieldName = 'imgFile';--}}
    {{--UE.getEditor('{{$name or 'editor'}}');--}}

    {{--window.UMEDITOR_CONFIG.imageUrl = '{{route('admin_upload_editor')}}?_token={{csrf_token()}}&type={{isset($access) && $access ? urlencode (get_class ($access)) : ''}}&id={{$access->id ?? ''}}';--}}
    {{--window.UMEDITOR_CONFIG.imagePath = '';--}}
    {{--UM.delEditor('{{$name ?? 'editor'}}Editor')--}}
    {{--var um = UM.getEditor ('{{$name ?? 'editor'}}Editor');--}}
    {{--um.ready(function(){--}}
    {{--    um.addListener("blur",function(){--}}
    {{--        var content=UM.getEditor('{{$name ?? 'editor'}}Editor').getContent();--}}
    {{--        document.getElementById('{{$name ?? 'editor'}}').value = content;--}}
    {{--    })--}}
    {{--});--}}

    var {{$name ?? 'editor'}}Editor = new WE('#{{$name ?? 'editor'}}Editor');
    {{$name ?? 'editor'}}Editor.config.uploadImgServer ='{{route('admin_upload_editor')}}?_token={{csrf_token()}}&type={{isset($access) && $access ? urlencode (get_class ($access)) : ''}}&id={{$access->id ?? ''}}';
    {{$name ?? 'editor'}}Editor.config.uploadFileName = 'upfile'
    var ${{$name ?? 'editor'}}Textarea = $('#{{$name ?? 'editor'}}Textarea');
    {{$name ?? 'editor'}}Editor.config.onchange = function (html) {
        // 第二步，监控变化，同步更新到 textarea
        ${{$name ?? 'editor'}}Textarea.val(html)
    }
    {{$name ?? 'editor'}}Editor.create()
</script>
