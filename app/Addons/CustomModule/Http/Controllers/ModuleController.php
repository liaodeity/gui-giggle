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
use App\Addons\CustomModule\Models\Module;
use App\Addons\CustomModule\Transformers\ModuleTransformer;
use App\Addons\CustomModule\Repositories\ModuleRepository;
use App\Addons\CustomModule\Validators\ModuleValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ModuleController extends Controller
{
    /**
     * @var ModuleRepository
     */
    private $repository;
    /**
     * @var ModuleTransformer
     */
    private $transformer;

    public function __construct (ModuleRepository $repository, ModuleTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveName', 'module' );
        View::share ('menuActiveId', Menu::where('menu_name','module')->value('id') );
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
        $module = $this->repository->makeModel ();

        return view ('custom_module::module.index', compact ('module'));
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

        QueryWhere::orderBy ($M, 'modules.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new ModuleTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $module = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('custom_module::module.create_or_edit', compact ('module', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        try {
            $input = $request->input ('Module');
            $this->repository->makeValidator ()->with ($input)->passes (ModuleValidator::RULE_CREATE);
            $module = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($module, new ModuleTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/module/' . $module->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param Module $module
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, Module $module)
    {
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($module, new ModuleTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('custom_module::module.show', compact ('module'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Module $module
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, Module $module)
    {
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($module, new ModuleTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('custom_module::module.create_or_edit', compact ('module', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param Module                  $module
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Module $module)
    {
        try {
            $input = $request->input ('Module');
            $this->repository->makeValidator ()->with ($input)->passes (ModuleValidator::RULE_UPDATE);
            $module = $this->repository->update ($input, $module->id);
            $result  = $this->repository->transformerItem ($module, new ModuleTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/module/' . $module->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, Module $module)
    {
        try {
            $check = $this->repository->allowDelete ($module);
            if ($check) {
                $deleted = $this->repository->delete ($module->id);
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
                $module = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($module);
                if ($check) {
                    $deleted = $this->repository->delete ($module->id);
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

