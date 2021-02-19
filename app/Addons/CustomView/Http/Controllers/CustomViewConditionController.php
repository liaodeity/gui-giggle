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
namespace App\Addons\CustomView\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use App\Addons\CustomView\Models\CustomViewCondition;
use App\Addons\CustomView\Transformers\CustomViewConditionTransformer;
use App\Addons\CustomView\Repositories\CustomViewConditionRepository;
use App\Addons\CustomView\Validators\CustomViewConditionValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CustomViewConditionController extends Controller
{
    /**
     * @var CustomViewConditionRepository
     */
    private $repository;
    /**
     * @var CustomViewConditionTransformer
     */
    private $transformer;

    public function __construct (CustomViewConditionRepository $repository, CustomViewConditionTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveName', 'custom_view_condition' );
        View::share ('menuActiveId', Menu::where('menu_name','custom_view_condition')->value('id') );
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
        $customViewCondition = $this->repository->makeModel ();

        return view ('custom_view::custom_view_condition.index', compact ('customViewCondition'));
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

        QueryWhere::orderBy ($M, 'custom_view_conditions.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new CustomViewConditionTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $customViewCondition = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('custom_view::custom_view_condition.create_or_edit', compact ('customViewCondition', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        try {
            $input = $request->input ('CustomViewCondition');
            $this->repository->makeValidator ()->with ($input)->passes (CustomViewConditionValidator::RULE_CREATE);
            $customViewCondition = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($customViewCondition, new CustomViewConditionTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/custom_view_condition/' . $customViewCondition->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param CustomViewCondition $customViewCondition
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, CustomViewCondition $customViewCondition)
    {
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($customViewCondition, new CustomViewConditionTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('custom_view::custom_view_condition.show', compact ('customViewCondition'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param CustomViewCondition $customViewCondition
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, CustomViewCondition $customViewCondition)
    {
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($customViewCondition, new CustomViewConditionTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('custom_view::custom_view_condition.create_or_edit', compact ('customViewCondition', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param CustomViewCondition                  $customViewCondition
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, CustomViewCondition $customViewCondition)
    {
        try {
            $input = $request->input ('CustomViewCondition');
            $this->repository->makeValidator ()->with ($input)->passes (CustomViewConditionValidator::RULE_UPDATE);
            $customViewCondition = $this->repository->update ($input, $customViewCondition->id);
            $result  = $this->repository->transformerItem ($customViewCondition, new CustomViewConditionTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/custom_view_condition/' . $customViewCondition->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, CustomViewCondition $customViewCondition)
    {
        try {
            $check = $this->repository->allowDelete ($customViewCondition);
            if ($check) {
                $deleted = $this->repository->delete ($customViewCondition->id);
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
                $customViewCondition = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($customViewCondition);
                if ($check) {
                    $deleted = $this->repository->delete ($customViewCondition->id);
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

