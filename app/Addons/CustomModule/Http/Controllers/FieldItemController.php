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
namespace App\Addons\CustomModule\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use App\Addons\CustomModule\Models\FieldItem;
use App\Addons\CustomModule\Transformers\FieldItemTransformer;
use App\Addons\CustomModule\Repositories\FieldItemRepository;
use App\Addons\CustomModule\Validators\FieldItemValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FieldItemController extends Controller
{
    /**
     * @var FieldItemRepository
     */
    private $repository;
    /**
     * @var FieldItemTransformer
     */
    private $transformer;

    public function __construct (FieldItemRepository $repository, FieldItemTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveName', 'field_item' );
        View::share ('menuActiveId', Menu::where('menu_name','field_item')->value('id') );
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
        $fieldItem = $this->repository->makeModel ();

        return view ('custom_module::field_item.index', compact ('fieldItem'));
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

        QueryWhere::orderBy ($M, 'field_items.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new FieldItemTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $fieldItem = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('custom_module::field_item.create_or_edit', compact ('fieldItem', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        try {
            $input = $request->input ('FieldItem');
            $this->repository->makeValidator ()->with ($input)->passes (FieldItemValidator::RULE_CREATE);
            $fieldItem = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($fieldItem, new FieldItemTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/field_item/' . $fieldItem->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param FieldItem $fieldItem
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, FieldItem $fieldItem)
    {
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($fieldItem, new FieldItemTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('custom_module::field_item.show', compact ('fieldItem'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param FieldItem $fieldItem
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, FieldItem $fieldItem)
    {
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($fieldItem, new FieldItemTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('custom_module::field_item.create_or_edit', compact ('fieldItem', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param FieldItem                  $fieldItem
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, FieldItem $fieldItem)
    {
        try {
            $input = $request->input ('FieldItem');
            $this->repository->makeValidator ()->with ($input)->passes (FieldItemValidator::RULE_UPDATE);
            $fieldItem = $this->repository->update ($input, $fieldItem->id);
            $result  = $this->repository->transformerItem ($fieldItem, new FieldItemTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/field_item/' . $fieldItem->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, FieldItem $fieldItem)
    {
        try {
            $check = $this->repository->allowDelete ($fieldItem);
            if ($check) {
                $deleted = $this->repository->delete ($fieldItem->id);
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
                $fieldItem = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($fieldItem);
                if ($check) {
                    $deleted = $this->repository->delete ($fieldItem->id);
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

