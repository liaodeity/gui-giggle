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
namespace App\Addons\Attachment\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use App\Addons\Attachment\Models\Attachment;
use App\Addons\Attachment\Transformers\AttachmentTransformer;
use App\Addons\Attachment\Repositories\AttachmentRepository;
use App\Addons\Attachment\Validators\AttachmentValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AttachmentController extends Controller
{
    /**
     * @var AttachmentRepository
     */
    private $repository;
    /**
     * @var AttachmentTransformer
     */
    private $transformer;

    public function __construct (AttachmentRepository $repository, AttachmentTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveName', 'attachment' );
        View::share ('menuActiveId', Menu::where('menu_name','attachment')->value('id') );
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
        $attachment = $this->repository->makeModel ();

        return view ('attachment::attachment.index', compact ('attachment'));
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

        QueryWhere::orderBy ($M, 'attachments.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new AttachmentTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $attachment = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('attachment::attachment.create_or_edit', compact ('attachment', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        try {
            $input = $request->input ('Attachment');
            $this->repository->makeValidator ()->with ($input)->passes (AttachmentValidator::RULE_CREATE);
            $attachment = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($attachment, new AttachmentTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/attachment/' . $attachment->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param Attachment $attachment
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, Attachment $attachment)
    {
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($attachment, new AttachmentTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('attachment::attachment.show', compact ('attachment'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Attachment $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, Attachment $attachment)
    {
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($attachment, new AttachmentTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('attachment::attachment.create_or_edit', compact ('attachment', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param Attachment                  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Attachment $attachment)
    {
        try {
            $input = $request->input ('Attachment');
            $this->repository->makeValidator ()->with ($input)->passes (AttachmentValidator::RULE_UPDATE);
            $attachment = $this->repository->update ($input, $attachment->id);
            $result  = $this->repository->transformerItem ($attachment, new AttachmentTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/attachment/' . $attachment->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, Attachment $attachment)
    {
        try {
            $check = $this->repository->allowDelete ($attachment);
            if ($check) {
                $deleted = $this->repository->delete ($attachment->id);
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
                $attachment = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($attachment);
                if ($check) {
                    $deleted = $this->repository->delete ($attachment->id);
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
}

