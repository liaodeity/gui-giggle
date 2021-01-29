<?php

namespace App\Addons\User\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Addons\User\Models\UserAdmin;
use App\Addons\User\Repositories\UserAdminRepository;
use App\Addons\User\Transformers\UserAdminTransformer;
use App\Addons\User\Validators\UserAdminValidator;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserAdminController extends Controller
{
    /**
     * @var UserAdminRepository
     */
    private $repository;
    /**
     * @var UserAdminTransformer
     */
    private $transformer;

    public function __construct (UserAdminRepository $repository, UserAdminTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;

        View::share ('menuActiveId', Menu::where('menu_name','user_admin')->value('id') );
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
        $userAdmin = $this->repository->makeModel ();

        return view ('user::user_admin.index', compact ('userAdmin'));
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

        QueryWhere::orderBy ($M, 'user_admins.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new UserAdminTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $this->repository->checkPermission ();
        $userAdmin = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('user::user_admin.create_or_edit', compact ('userAdmin', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //dd(config ()->all ());
        //echo trans ('user::message.title');
        //$config = config('userAdmin.addons_name');
        //var_dump ($config);
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('UserAdmin');
            $this->repository->makeValidator ()->with ($input)->passes (UserAdminValidator::RULE_CREATE);
            $userAdmin = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($userAdmin, new UserAdminTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/userAdmin/' . $userAdmin->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param UserAdmin $userAdmin
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, UserAdmin $userAdmin)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {
            $result = $this->repository->transformerItem ($userAdmin, new UserAdminTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('user::user_admin.show', compact ('userAdmin'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param UserAdmin $userAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, UserAdmin $userAdmin)
    {
        $this->repository->checkPermission ();
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($userAdmin, new UserAdminTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('user::user_admin.create_or_edit', compact ('userAdmin', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param UserAdmin                  $userAdmin
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, UserAdmin $userAdmin)
    {
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('UserAdmin');
            $this->repository->makeValidator ()->with ($input)->passes (UserAdminValidator::RULE_UPDATE);
            $userAdmin = $this->repository->update ($input, $userAdmin->id);
            $result  = $this->repository->transformerItem ($userAdmin, new UserAdminTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/userAdmin/' . $userAdmin->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, UserAdmin $userAdmin)
    {
        $this->repository->checkPermission ();
        try {
            $check = $this->repository->allowDelete ($userAdmin);
            if ($check) {
                $deleted = $this->repository->delete ($userAdmin->id);
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
                $userAdmin = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($userAdmin);
                if ($check) {
                    $deleted = $this->repository->delete ($userAdmin->id);
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

