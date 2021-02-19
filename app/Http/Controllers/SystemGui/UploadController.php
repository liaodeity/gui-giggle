<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( MIT )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: Gui < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/

namespace App\Http\Controllers\SystemGui;


use App\Http\Controllers\Controller;
use App\Models\SystemGui\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * 上传图片 add by gui
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function image (Request $request)
    {
        set_time_limit (0);
        $name        = $request->input ('name', 'upfile');
        $access_id   = $request->input ('id', '');
        $access_type = $request->input ('type', '');
        if ($access_type) {
            $access_type = urldecode ($access_type);
        }
        $images     = $request->file ($name);
        $filedir    = "upload/" . date ('Ym') . '/';
        $imagesName = $images->getClientOriginalName ();
        $mine_type  = $images->getMimeType ();
        $size       = $images->getSize ();
        $extension  = $images->getClientOriginalExtension ();
        if (!in_array ($extension, ['jpeg', 'jpg', 'png', 'gif'])) {
            return ['status' => 0, 'info' => '.' . $extension . '的后缀不允许上传'];
        }
        $tmp_md5       = md5_file ($images->getRealPath ());
        $newImagesName = $tmp_md5 . "." . $extension;

        $images->move ($filedir, $newImagesName);
        $path       = $filedir . $newImagesName;
        $insArr     = [
            'title'       => $imagesName,
            'mine_type'   => $mine_type,
            'suffix'      => $extension,
            'size'        => $size,
            'path'        => $path,
            'md5'         => md5_file ($path),
            'sha1'        => sha1_file ($path),
            'access_id'   => $access_id,
            'access_type' => $access_type,
            'status'      => 1
        ];
        $Attachment = Attachment::addFile ($insArr);
        if (!$Attachment) {
            return ajax_error_message ('上传失败');
        }
        $data['id']           = $Attachment->id;
        $data['size']         = $size;
        $data['state']        = 'SUCCESS';
        $data['name']         = $newImagesName;
        $data['url']          = '/' . $Attachment->path;
        $data['type']         = '.' . $extension;
        $data['originalName'] = $Attachment->name;

        // 图片水印
        $watermark = get_config_value ('watermark_text', '');
        if ($watermark) {
            $img = \Intervention\Image\Facades\Image::make ($Attachment->path);
            $img->text ($watermark, $img->width () - 10, $img->height () - 10, function ($font) {
                $font_dir = public_path ('fonts/msyh.ttf');
                $font->file ($font_dir);
                $font->size (14);
                $font->color ('#FFFFFF');
                $font->align ('right');
                $font->valign ('bottom');
            });
            $img->save ($Attachment->path);
        }

        $data['src']  = $data['url'];
        $data['code'] = 0;

        //Log::createLog (Log::INFO_TYPE, '上传图片记录', '', $Attachment->id, Attachment::class);

        return json_encode ($data);
    }

    /**
     * 上传表格 add by gui
     * @param Request $request
     * @param string  $name
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function excel (Request $request, $name = 'file')
    {
        set_time_limit (0);
        $files      = $request->file ($name);
        $filedir    = "upload/excel/" . date ('Ymd') . '/';
        $imagesName = $files->getClientOriginalName ();
        $extension  = $files->getClientOriginalExtension ();
        $size       = $files->getSize ();
        $extension  = strtolower ($extension);
        if (!in_array ($extension, ['xls', 'xlsx'])) {
            return ['status' => 0, 'info' => '.' . $extension . '的后缀不允许上传'];
        }

        $newImagesName = get_uuid () . "." . $extension;

        $files->move ($filedir, $newImagesName);
        $path       = $filedir . $newImagesName;
        $insArr     = [
            'name'   => $imagesName,
            'path'   => $path,
            'md5'    => md5_file ($path),
            'sha1'   => sha1_file ($path),
            'status' => 1
        ];
        $attachment = Attachment::addFile ($insArr);

        $result = [
            'data' => [
                'id'    => $attachment->id,
                'name'  => $attachment->name,
                'title' => str_replace ('.' . $extension, '', $attachment->name),
                'src'   => asset ($attachment->path)
            ]
        ];

        //Log::createLog (Log::INFO_TYPE, '上传附件记录', '', $attachment->id, Attachment::class);

        return ajax_success_message ('上传成功', $result);
    }
}
