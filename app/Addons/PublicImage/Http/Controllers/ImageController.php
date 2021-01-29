<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: Gui < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/
namespace App\Addons\PublicImage\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use App\Addons\PublicImage\Models\Image;
use App\Addons\PublicImage\Transformers\ImageTransformer;
use App\Addons\PublicImage\Repositories\ImageRepository;
use App\Addons\PublicImage\Validators\ImageValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ImageController extends Controller
{
    /**
     * @var ImageRepository
     */
    private $repository;
    /**
     * @var ImageTransformer
     */
    private $transformer;

    public function __construct (ImageRepository $repository, ImageTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveName', 'image' );
        View::share ('menuActiveId', Menu::where('menu_name','image')->value('id') );
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index (Request $request)
    {
        if ($request->wantsJson ()) {
            $result = $this->getData ($request, false);

            return ajax_success_message (__ ('message.controller.success.search'), $result);
        }
        $image = $this->repository->makeModel ();

        return view ('public_image::image.index', compact ('image'));
    }

    /**
     *  add by gui
     * @param Request $request
     * @param bool    $export 是否导出，获取全部数据
     * @return array
     */
    protected function getData (Request $request, $export = false)
    {
        QueryWhere::setRequest ();
        $M = $this->repository->makeModel ();
        //[where-query]

        QueryWhere::orderBy ($M, 'images.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new ImageTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $image = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('public_image::image.create_or_edit', compact ('image', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        try {
            $input = $request->input ('Image');
            $this->repository->makeValidator ()->with ($input)->passes (ImageValidator::RULE_CREATE);
            $image = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($image, new ImageTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/image/' . $image->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param Image $image
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, Image $image)
    {
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($image, new ImageTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('public_image::image.show', compact ('image'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Image $image
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, Image $image)
    {
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($image, new ImageTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('public_image::image.create_or_edit', compact ('image', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param Image                  $image
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Image $image)
    {
        try {
            $input = $request->input ('Image');
            $this->repository->makeValidator ()->with ($input)->passes (ImageValidator::RULE_UPDATE);
            $image = $this->repository->update ($input, $image->id);
            $result  = $this->repository->transformerItem ($image, new ImageTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/image/' . $image->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, Image $image)
    {
        try {
            $check = $this->repository->allowDelete ($image);
            if ($check) {
                $deleted = $this->repository->delete ($image->id);
                if (!$deleted) {
                    throw new SystemGuiException(__ ('message.controller.delete_fail'));
                }
            }

            return ajax_success_message (__ ('message.controller.success.delete'));
        } catch (SystemGuiException $e) {

            return ajax_error_message ($e->getMessage ());
        }
    }

    public function batchDestroy (Request $request ,$ids)
    {
        $idArr = explode (',', $ids);
        try {
            foreach ($idArr as $id){
                $image = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($image);
                if ($check) {
                    $deleted = $this->repository->delete ($image->id);
                    if (!$deleted) {
                        throw new SystemGuiException(__ ('message.controller.delete_fail'));
                    }
                }
            }


            return ajax_success_message (__ ('message.controller.success.delete'));
        } catch (SystemGuiException $e) {

            return ajax_error_message ($e->getMessage ());
        }

    }

    /**
     * @param Request $request
     */
    public function import (Request $request)
    {

    }

    /**
     * @param Request $request
     */
    public function export (Request $request)
    {

    }
    /**
     * 图片替换
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function image (Request $request)
    {
        $r_path = $request->input ('path');
        $files  = Storage::disk ('web_public')->allFiles ('images');
        $images = [];
        foreach ($files as $file) {
            if ($r_path) {
                //存在搜索
                if (!stristr ($file, $r_path) && !stristr (asset ($file), $r_path)) {
                    continue;
                }
            }
            $images[] = $this->getImage ($file);
        }
        $images = (object)$images;

        return view ('public_image::image.image', compact ('images'));

    }
    protected function getImage ($file)
    {
        $size   = Storage::disk ('web_public')->size ($file);
        $time   = Storage::disk ('web_public')->lastModified ($file);
        $img    = \Intervention\Image\Facades\Image::make ($file);
        $width  = $img->getWidth ();
        $height = $img->getHeight ();
        $image  = (object)[
            'path'         => $file,
            'url'          => asset ($file) . '?t=' . time (),
            'size'         => file_size_format_unit ($size),
            'time'         => Carbon::parse (date ('Y-m-d H:i:s', $time))->toDateTimeString (),
            'width_height' => $width . '*' . $height,
        ];

        return $image;
    }
    /**
     *
     * 图片替换
     *
     * @return \Illuminate\Http\Response
     */
    public function replace (Request $request)
    {
        $path    = $request->input ('path');
        $image   = $this->getImage ($path);
        $en_path = encrypt ($path);
        $en_path = base64_encode ($en_path);

        return view ('public_image::image.replace', compact ('image', 'en_path'));
    }
    /**
     * 上传图片 add by gui
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function upload (Request $request)
    {
        set_time_limit (0);
        $en_path = $request->input ('en_path');
        $en_path = base64_decode ($en_path);
        $path    = decrypt ($en_path);
        $exists  = Storage::disk ('web_public')->exists ($path);
        if (!$exists) {
            return ajax_error_message ('图片不存在，无法进行替换');
        }

        $name       = $request->input ('name', 'file');
        $images     = $request->file ($name);
        $imagesName = $images->getClientOriginalName ();
        $extension  = $images->getClientOriginalExtension ();
        $size       = $images->getSize ();
        $extension  = strtolower ($extension);
        if (!in_array ($extension, ['jpeg', 'jpg', 'png', 'gif'])) {
            return ajax_error_message ('.' . $extension . '的后缀不允许上传');
        }
        $real_path = $images->getRealPath ();
        $content   = file_get_contents ($real_path);
        //备份图片
        $t_dir = now ()->format ('YmdHis');
        $ret   = Storage::disk ('web_public')->copy ($path, 'bak/' . $t_dir . '/' . $path);
        if ($ret) {
            $ret = Storage::disk ('web_public')->put ($path, $content);
        }
        if ($ret) {
            //Log::createLog (Log::EDIT_TYPE, '图片替换管理替换图片[' . $path . ']记录', '');

            return ajax_success_message ('替换图片成功');
        } else {
            return ajax_error_message ('替换图片失败');
        }
    }
}

