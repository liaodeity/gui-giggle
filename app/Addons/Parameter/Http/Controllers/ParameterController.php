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
namespace App\Addons\Parameter\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Addons\Parameter\Models\Parameter;
use App\Addons\Parameter\Repositories\ParameterRepository;
use App\Addons\Parameter\Transformers\ParameterTransformer;
use App\Addons\Plugin\Validators\ParameterValidator;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ParameterController extends Controller
{
    /**
     * @var ParameterRepository
     */
    private $repository;
    /**
     * @var ParameterTransformer
     */
    private $transformer;

    public function __construct (ParameterRepository $repository, ParameterTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveId', Menu::where('menu_name','parameter')->value('id') );
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
        $parameter = $this->repository->makeModel ();

        return view ('parameter::parameter.index', compact ('parameter'));
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

        QueryWhere::orderBy ($M, 'parameters.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new ParameterTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $this->repository->checkPermission ();
        $parameter = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('parameter::parameter.create_or_edit', compact ('parameter', '_method'));
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
        //$config = config('parameter.addons_name');
        //var_dump ($config);
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('Parameter');
            $this->repository->makeValidator ()->with ($input)->passes (ParameterValidator::RULE_CREATE);
            $parameter = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($parameter, new ParameterTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/parameter/' . $parameter->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param Parameter $parameter
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, Parameter $parameter)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($parameter, new ParameterTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('parameter::parameter.show', compact ('parameter'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Parameter $parameter
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, Parameter $parameter)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($parameter, new ParameterTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('parameter::parameter.create_or_edit', compact ('parameter', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param Parameter                  $parameter
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Parameter $parameter)
    {
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('Parameter');
            $this->repository->makeValidator ()->with ($input)->passes (ParameterValidator::RULE_UPDATE);
            $parameter = $this->repository->update ($input, $parameter->id);
            $result  = $this->repository->transformerItem ($parameter, new ParameterTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/parameter/' . $parameter->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, Parameter $parameter)
    {
        $this->repository->checkPermission ();
        try {
            $check = $this->repository->allowDelete ($parameter);
            if ($check) {
                $deleted = $this->repository->delete ($parameter->id);
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
                $parameter = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($parameter);
                if ($check) {
                    $deleted = $this->repository->delete ($parameter->id);
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

