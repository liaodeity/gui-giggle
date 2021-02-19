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
namespace App\Addons\CustomModule\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use App\Addons\CustomModule\Models\Tab;
use App\Addons\CustomModule\Transformers\TabTransformer;
use App\Addons\CustomModule\Repositories\TabRepository;
use App\Addons\CustomModule\Validators\TabValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TabController extends Controller
{
    /**
     * @var TabRepository
     */
    private $repository;
    /**
     * @var TabTransformer
     */
    private $transformer;

    public function __construct (TabRepository $repository, TabTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveName', 'tab' );
        View::share ('menuActiveId', Menu::where('menu_name','tab')->value('id') );
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
        $tab = $this->repository->makeModel ();

        return view ('custom_module::tab.index', compact ('tab'));
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

        QueryWhere::orderBy ($M, 'tabs.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new TabTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $tab = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('custom_module::tab.create_or_edit', compact ('tab', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        try {
            $input = $request->input ('Tab');
            $this->repository->makeValidator ()->with ($input)->passes (TabValidator::RULE_CREATE);
            $tab = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($tab, new TabTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/tab/' . $tab->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param Tab $tab
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, Tab $tab)
    {
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($tab, new TabTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('custom_module::tab.show', compact ('tab'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Tab $tab
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, Tab $tab)
    {
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($tab, new TabTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('custom_module::tab.create_or_edit', compact ('tab', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param Tab                  $tab
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Tab $tab)
    {
        try {
            $input = $request->input ('Tab');
            $this->repository->makeValidator ()->with ($input)->passes (TabValidator::RULE_UPDATE);
            $tab = $this->repository->update ($input, $tab->id);
            $result  = $this->repository->transformerItem ($tab, new TabTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/tab/' . $tab->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, Tab $tab)
    {
        try {
            $check = $this->repository->allowDelete ($tab);
            if ($check) {
                $deleted = $this->repository->delete ($tab->id);
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
                $tab = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($tab);
                if ($check) {
                    $deleted = $this->repository->delete ($tab->id);
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

