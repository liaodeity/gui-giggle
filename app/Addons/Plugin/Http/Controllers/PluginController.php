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
namespace App\Addons\Plugin\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Addons\Plugin\Models\Plugin;
use App\Addons\Plugin\Repositories\PluginRepository;
use App\Addons\Plugin\Transformers\PluginTransformer;
use App\Addons\Plugin\Validators\PluginValidator;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PluginController extends Controller
{
    /**
     * @var PluginRepository
     */
    private $repository;
    /**
     * @var PluginTransformer
     */
    private $transformer;

    public function __construct (PluginRepository $repository, PluginTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveId', Menu::where('menu_name','plugin')->value('id') );
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \App\Exceptions\PermissionCheckException
     */
    public function index (Request $request)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {
            $result = $this->getData ($request, false);

            return ajax_success_message (__ ('message.controller.success.search'), $result);
        }
        $plugin = $this->repository->makeModel ();

        return view ('plugin::plugin.index', compact ('plugin'));
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

        QueryWhere::orderBy ($M, 'plugins.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new PluginTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $this->repository->checkPermission ();
        $plugin = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('plugin::plugin.create_or_edit', compact ('plugin', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //dd(config ()->all ());
        //echo trans ('plugin::message.title');
        //$config = config('plugin.addons_name');
        //var_dump ($config);
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('Plugin');
            $this->repository->makeValidator ()->with ($input)->passes (PluginValidator::RULE_CREATE);
            $plugin = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($plugin, new PluginTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/plugin/' . $plugin->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param Plugin $plugin
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, Plugin $plugin)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($plugin, new PluginTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('plugin::plugin.show', compact ('plugin'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Plugin $plugin
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, Plugin $plugin)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($plugin, new PluginTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('plugin::plugin.create_or_edit', compact ('plugin', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param Plugin                  $plugin
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Plugin $plugin)
    {
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('Plugin');
            $this->repository->makeValidator ()->with ($input)->passes (PluginValidator::RULE_UPDATE);
            $plugin = $this->repository->update ($input, $plugin->id);
            $result  = $this->repository->transformerItem ($plugin, new PluginTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/plugin/' . $plugin->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, Plugin $plugin)
    {
        $this->repository->checkPermission ();
        try {
            $check = $this->repository->allowDelete ($plugin);
            if ($check) {
                $deleted = $this->repository->delete ($plugin->id);
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
        $this->repository->checkPermission ();
        try {
            foreach ($idArr as $id){
                $plugin = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($plugin);
                if ($check) {
                    $deleted = $this->repository->delete ($plugin->id);
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
     * add by gui
     * @param Request $request
     */
    public function export (Request $request)
    {
        $this->repository->checkPermission ();
    }
}

