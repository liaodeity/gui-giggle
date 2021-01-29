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
namespace App\Addons\Role\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Addons\Role\Models\RoleInfo;
use App\Addons\Role\Repositories\RoleInfoRepository;
use App\Addons\Role\Transformers\RoleInfoTransformer;
use App\Addons\Role\Validators\RoleInfoValidator;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RoleInfoController extends Controller
{
    /**
     * @var RoleInfoRepository
     */
    private $repository;
    /**
     * @var RoleInfoTransformer
     */
    private $transformer;

    public function __construct (RoleInfoRepository $repository, RoleInfoTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveId', Menu::where('menu_name','role_info')->value('id') );
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
        $roleInfo = $this->repository->makeModel ();

        return view ('role::role_info.index', compact ('roleInfo'));
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

        QueryWhere::orderBy ($M, 'role_infos.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new RoleInfoTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $this->repository->checkPermission ();
        $roleInfo = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('role::role_info.create_or_edit', compact ('roleInfo', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //dd(config ()->all ());
        //echo trans ('role::message.title');
        //$config = config('roleInfo.addons_name');
        //var_dump ($config);
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('RoleInfo');
            $this->repository->makeValidator ()->with ($input)->passes (RoleInfoValidator::RULE_CREATE);
            $roleInfo = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($roleInfo, new RoleInfoTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/role_info/' . $roleInfo->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param RoleInfo $roleInfo
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, RoleInfo $roleInfo)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($roleInfo, new RoleInfoTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('role::role_info.show', compact ('roleInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param RoleInfo $roleInfo
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, RoleInfo $roleInfo)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($roleInfo, new RoleInfoTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('role::role_info.create_or_edit', compact ('roleInfo', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param RoleInfo                  $roleInfo
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, RoleInfo $roleInfo)
    {
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('RoleInfo');
            $this->repository->makeValidator ()->with ($input)->passes (RoleInfoValidator::RULE_UPDATE);
            $roleInfo = $this->repository->update ($input, $roleInfo->id);
            $result  = $this->repository->transformerItem ($roleInfo, new RoleInfoTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/role_info/' . $roleInfo->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, RoleInfo $roleInfo)
    {
        $this->repository->checkPermission ();
        try {
            $check = $this->repository->allowDelete ($roleInfo);
            if ($check) {
                $deleted = $this->repository->delete ($roleInfo->id);
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
                $roleInfo = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($roleInfo);
                if ($check) {
                    $deleted = $this->repository->delete ($roleInfo->id);
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

