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
namespace App\Addons\Menu\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Addons\Menu\Repositories\MenuRepository;
use App\Addons\Menu\Transformers\MenuTransformer;
use App\Addons\Menu\Validators\MenuValidator;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MenuController extends Controller
{
    /**
     * @var MenuRepository
     */
    private $repository;
    /**
     * @var MenuTransformer
     */
    private $transformer;

    public function __construct (MenuRepository $repository, MenuTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveId', Menu::where('menu_name','menu')->value('id') );
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
            QueryWhere::setRequest ($request->all ());
            $M = $this->repository->makeModel ()->select ('menus.*');
            QueryWhere::eq ($M, 'status');
            QueryWhere::like ($M, 'title');
            QueryWhere::orderBy ($M, 'menus.sort ASC');
            $list = $M->get ();
            foreach ($list as $key => $item) {
                if ($request->input ('title') || $request->input ('status') != '') {
                    //进行了搜索，不进行上下级显示
                    $list[ $key ]['pid'] = 0;
                }
                $list[$key]['_edit_url'] = url ('admin/menu/' . $item->id . '/edit');
            }
            $result = [
                'code'  => 0,
                'count' => count ($list),
                'data'  => $list,
            ];

            return response ()->json ($result);
        }
        $menu = $this->repository->makeModel ();

        return view ('menu::menu.index', compact ('menu'));
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
        QueryWhere::like ($M, 'menus.id');
        QueryWhere::like ($M, 'menus.category_id');
        QueryWhere::like ($M, 'menus.title');
        QueryWhere::like ($M, 'menus.cover_id');
        QueryWhere::like ($M, 'menus.sub_title');
        QueryWhere::like ($M, 'menus.source');
        QueryWhere::like ($M, 'menus.source_link');
        QueryWhere::eq ($M, 'menus.is_top');
        QueryWhere::like ($M, 'menus.description');
        QueryWhere::like ($M, 'menus.user_id');
        QueryWhere::eq ($M, 'menus.status');

        QueryWhere::orderBy ($M, 'menus.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new MenuTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $this->repository->checkPermission ();
        $menu = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('menu::menu.create_or_edit', compact ('menu', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //dd(config ()->all ());
        //echo trans ('menu::message.title');
        //$config = config('menu.addons_name');
        //var_dump ($config);
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('Menu');
            $this->repository->makeValidator ()->with ($input)->passes (MenuValidator::RULE_CREATE);
            $menu = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($menu, new MenuTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/menu/' . $menu->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, Menu $menu)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($menu, new MenuTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('menu::menu.show', compact ('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, Menu $menu)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($menu, new MenuTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('menu::menu.create_or_edit', compact ('menu', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param Menu                  $menu
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Menu $menu)
    {
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('Menu');
            $this->repository->makeValidator ()->with ($input)->passes (MenuValidator::RULE_UPDATE);
            $input['pid'] = (string)$input['pid'];
            $input['route_url'] = (string)$input['route_url'];
            $menu = $this->repository->update ($input, $menu->id);
            $result  = $this->repository->transformerItem ($menu, new MenuTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/menu/' . $menu->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, Menu $menu)
    {
        $this->repository->checkPermission ();
        try {
            $check = $this->repository->allowDelete ($menu);
            if ($check) {
                $deleted = $this->repository->delete ($menu->id);
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
                $menu = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($menu);
                if ($check) {
                    $deleted = $this->repository->delete ($menu->id);
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

