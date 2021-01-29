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
namespace App\Addons\CustomView\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use App\Addons\CustomView\Models\BlockField;
use App\Addons\CustomView\Transformers\BlockFieldTransformer;
use App\Addons\CustomView\Repositories\BlockFieldRepository;
use App\Addons\CustomView\Validators\BlockFieldValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BlockFieldController extends Controller
{
    /**
     * @var BlockFieldRepository
     */
    private $repository;
    /**
     * @var BlockFieldTransformer
     */
    private $transformer;

    public function __construct (BlockFieldRepository $repository, BlockFieldTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveName', 'block_field' );
        View::share ('menuActiveId', Menu::where('menu_name','block_field')->value('id') );
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
        $blockField = $this->repository->makeModel ();

        return view ('custom_view::block_field.index', compact ('blockField'));
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

        QueryWhere::orderBy ($M, 'block_fields.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new BlockFieldTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $blockField = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('custom_view::block_field.create_or_edit', compact ('blockField', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        try {
            $input = $request->input ('BlockField');
            $this->repository->makeValidator ()->with ($input)->passes (BlockFieldValidator::RULE_CREATE);
            $blockField = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($blockField, new BlockFieldTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/block_field/' . $blockField->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param BlockField $blockField
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, BlockField $blockField)
    {
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($blockField, new BlockFieldTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('custom_view::block_field.show', compact ('blockField'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param BlockField $blockField
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, BlockField $blockField)
    {
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($blockField, new BlockFieldTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('custom_view::block_field.create_or_edit', compact ('blockField', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param BlockField                  $blockField
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, BlockField $blockField)
    {
        try {
            $input = $request->input ('BlockField');
            $this->repository->makeValidator ()->with ($input)->passes (BlockFieldValidator::RULE_UPDATE);
            $blockField = $this->repository->update ($input, $blockField->id);
            $result  = $this->repository->transformerItem ($blockField, new BlockFieldTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/block_field/' . $blockField->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, BlockField $blockField)
    {
        try {
            $check = $this->repository->allowDelete ($blockField);
            if ($check) {
                $deleted = $this->repository->delete ($blockField->id);
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
                $blockField = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($blockField);
                if ($check) {
                    $deleted = $this->repository->delete ($blockField->id);
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

