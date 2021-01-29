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
namespace App\Addons\Parameter\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Addons\Parameter\Models\ParameterItem;
use App\Addons\Parameter\Repositories\ParameterItemRepository;
use App\Addons\Parameter\Transformers\ParameterItemTransformer;
use App\Addons\Plugin\Validators\ParameterItemValidator;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ParameterItemController extends Controller
{
    /**
     * @var ParameterItemRepository
     */
    private $repository;
    /**
     * @var ParameterItemTransformer
     */
    private $transformer;

    public function __construct (ParameterItemRepository $repository, ParameterItemTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveId', Menu::where('menu_name','parameter_item')->value('id') );
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
        $parameterItem = $this->repository->makeModel ();

        return view ('parameter::parameter_item.index', compact ('parameterItem'));
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

        QueryWhere::orderBy ($M, 'parameter_items.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new ParameterItemTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $this->repository->checkPermission ();
        $parameterItem = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('parameter::parameter_item.create_or_edit', compact ('parameterItem', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //dd(config ()->all ());
        //echo trans ('parameter::message.title');
        //$config = config('parameterItem.addons_name');
        //var_dump ($config);
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('ParameterItem');
            $this->repository->makeValidator ()->with ($input)->passes (ParameterItemValidator::RULE_CREATE);
            $parameterItem = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($parameterItem, new ParameterItemTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/parameter_item/' . $parameterItem->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param ParameterItem $parameterItem
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, ParameterItem $parameterItem)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($parameterItem, new ParameterItemTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('parameter::parameter_item.show', compact ('parameterItem'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param ParameterItem $parameterItem
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, ParameterItem $parameterItem)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($parameterItem, new ParameterItemTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('parameter::parameter_item.create_or_edit', compact ('parameterItem', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param ParameterItem                  $parameterItem
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, ParameterItem $parameterItem)
    {
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('ParameterItem');
            $this->repository->makeValidator ()->with ($input)->passes (ParameterItemValidator::RULE_UPDATE);
            $parameterItem = $this->repository->update ($input, $parameterItem->id);
            $result  = $this->repository->transformerItem ($parameterItem, new ParameterItemTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/parameter_item/' . $parameterItem->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, ParameterItem $parameterItem)
    {
        $this->repository->checkPermission ();
        try {
            $check = $this->repository->allowDelete ($parameterItem);
            if ($check) {
                $deleted = $this->repository->delete ($parameterItem->id);
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
                $parameterItem = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($parameterItem);
                if ($check) {
                    $deleted = $this->repository->delete ($parameterItem->id);
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

