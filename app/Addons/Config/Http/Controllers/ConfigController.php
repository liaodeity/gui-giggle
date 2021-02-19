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
namespace App\Addons\Config\Http\Controllers;

use App\Addons\Config\Http\Requests\ConfigRequest;
use App\Addons\Config\Models\Config;
use App\Addons\Config\Repositories\ConfigRepository;
use App\Addons\Config\Transformers\ConfigTransformer;
use App\Addons\Config\Validators\ConfigValidator;
use App\Addons\Menu\Models\Menu;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ConfigController extends Controller
{
    /**
     * @var ConfigRepository
     */
    private $repository;
    /**
     * @var ConfigTransformer
     */
    private $transformer;

    public function __construct (ConfigRepository $repository, ConfigTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveId', Menu::where('menu_name','config')->value('id') );
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
        $config = $this->repository->makeModel ();

        return view ('config::config.index', compact ('config'));
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
        QueryWhere::like($M, 'configs.id');
        QueryWhere::eq($M, 'configs.type');
        QueryWhere::like($M, 'configs.name');
        QueryWhere::like($M, 'configs.title');
        QueryWhere::like($M, 'configs.desc');

        QueryWhere::orderBy ($M, 'configs.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new ConfigTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        throw new SystemGuiException('无法操作');
        $this->repository->checkPermission ();
        $config = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('config::config.create_or_edit', compact ('config', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        throw new SystemGuiException('无法操作');
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('Config');
            $this->repository->makeValidator ()->with ($input)->passes (ConfigValidator::RULE_CREATE);
            $config = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($config, new ConfigTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/config/' . $config->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param Config $config
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, Config $config)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($config, new ConfigTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('config::config.show', compact ('config'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Config $config
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, Config $config)
    {
        $this->repository->checkPermission ();
        $context = $this->repository->makeModel ()->getParamItem($config);
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($config, new ConfigTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('config::config.create_or_edit', compact ('config', '_method', 'context'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param Config                  $config
     * @return \Illuminate\Http\Response
     */
    public function update (ConfigRequest $request, Config $config)
    {
        try {
            $this->repository->checkPermission ();
            $input = $request->getFillData ();
            //dd($input);
            $this->repository->makeValidator ()->with ($input)->passes (ConfigValidator::RULE_UPDATE);

            $config = $this->repository->update ($input, $config->id);
            $result  = $this->repository->transformerItem ($config, new ConfigTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/config/' . $config->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, Config $config)
    {
        throw new SystemGuiException('无法操作');
        $this->repository->checkPermission ();
        try {
            $check = $this->repository->allowDelete ($config);
            if ($check) {
                $deleted = $this->repository->delete ($config->id);
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
        throw new SystemGuiException('无法操作');
        $idArr = explode (',', $ids);
        $this->repository->checkPermission ();
        try {
            foreach ($idArr as $id){
                $config = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($config);
                if ($check) {
                    $deleted = $this->repository->delete ($config->id);
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

