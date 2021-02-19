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
use App\Addons\CustomModule\Models\ModuleTab;
use App\Addons\CustomModule\Transformers\ModuleTabTransformer;
use App\Addons\CustomModule\Repositories\ModuleTabRepository;
use App\Addons\CustomModule\Validators\ModuleTabValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ModuleTabController extends Controller
{
    /**
     * @var ModuleTabRepository
     */
    private $repository;
    /**
     * @var ModuleTabTransformer
     */
    private $transformer;

    public function __construct (ModuleTabRepository $repository, ModuleTabTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveName', 'module_tab' );
        View::share ('menuActiveId', Menu::where('menu_name','module_tab')->value('id') );
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
        $moduleTab = $this->repository->makeModel ();

        return view ('custom_module::module_tab.index', compact ('moduleTab'));
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

        QueryWhere::orderBy ($M, 'module_tabs.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new ModuleTabTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $moduleTab = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('custom_module::module_tab.create_or_edit', compact ('moduleTab', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        try {
            $input = $request->input ('ModuleTab');
            $this->repository->makeValidator ()->with ($input)->passes (ModuleTabValidator::RULE_CREATE);
            $moduleTab = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($moduleTab, new ModuleTabTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/module_tab/' . $moduleTab->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param ModuleTab $moduleTab
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, ModuleTab $moduleTab)
    {
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($moduleTab, new ModuleTabTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('custom_module::module_tab.show', compact ('moduleTab'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param ModuleTab $moduleTab
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, ModuleTab $moduleTab)
    {
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($moduleTab, new ModuleTabTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('custom_module::module_tab.create_or_edit', compact ('moduleTab', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param ModuleTab                  $moduleTab
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, ModuleTab $moduleTab)
    {
        try {
            $input = $request->input ('ModuleTab');
            $this->repository->makeValidator ()->with ($input)->passes (ModuleTabValidator::RULE_UPDATE);
            $moduleTab = $this->repository->update ($input, $moduleTab->id);
            $result  = $this->repository->transformerItem ($moduleTab, new ModuleTabTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/module_tab/' . $moduleTab->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, ModuleTab $moduleTab)
    {
        try {
            $check = $this->repository->allowDelete ($moduleTab);
            if ($check) {
                $deleted = $this->repository->delete ($moduleTab->id);
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
                $moduleTab = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($moduleTab);
                if ($check) {
                    $deleted = $this->repository->delete ($moduleTab->id);
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

