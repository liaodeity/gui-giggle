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
use App\Addons\CustomView\Models\CustomView;
use App\Addons\CustomView\Transformers\CustomViewTransformer;
use App\Addons\CustomView\Repositories\CustomViewRepository;
use App\Addons\CustomView\Validators\CustomViewValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CustomViewController extends Controller
{
    /**
     * @var CustomViewRepository
     */
    private $repository;
    /**
     * @var CustomViewTransformer
     */
    private $transformer;

    public function __construct (CustomViewRepository $repository, CustomViewTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveName', 'custom_view' );
        View::share ('menuActiveId', Menu::where('menu_name','custom_view')->value('id') );
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
        $customView = $this->repository->makeModel ();

        return view ('custom_view::custom_view.index', compact ('customView'));
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

        QueryWhere::orderBy ($M, 'custom_views.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new CustomViewTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $customView = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('custom_view::custom_view.create_or_edit', compact ('customView', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        try {
            $input = $request->input ('CustomView');
            $this->repository->makeValidator ()->with ($input)->passes (CustomViewValidator::RULE_CREATE);
            $customView = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($customView, new CustomViewTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/custom_view/' . $customView->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param CustomView $customView
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, CustomView $customView)
    {
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($customView, new CustomViewTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('custom_view::custom_view.show', compact ('customView'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param CustomView $customView
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, CustomView $customView)
    {
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($customView, new CustomViewTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('custom_view::custom_view.create_or_edit', compact ('customView', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param CustomView                  $customView
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, CustomView $customView)
    {
        try {
            $input = $request->input ('CustomView');
            $this->repository->makeValidator ()->with ($input)->passes (CustomViewValidator::RULE_UPDATE);
            $customView = $this->repository->update ($input, $customView->id);
            $result  = $this->repository->transformerItem ($customView, new CustomViewTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/custom_view/' . $customView->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, CustomView $customView)
    {
        try {
            $check = $this->repository->allowDelete ($customView);
            if ($check) {
                $deleted = $this->repository->delete ($customView->id);
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
                $customView = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($customView);
                if ($check) {
                    $deleted = $this->repository->delete ($customView->id);
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

