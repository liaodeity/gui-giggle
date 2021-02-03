<?php

namespace App\Addons\User\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Addons\User\Models\User;
use App\Addons\User\Repositories\UserRepository;
use App\Addons\User\Transformers\UserTransformer;
use App\Addons\User\Validators\UserValidator;
use App\Exceptions\SystemGuiException;
use App\Libs\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct (UserRepository $repository)
    {
        $this->repository = $repository;
        View::share ('menuActiveId', Menu::where('menu_name','user')->value('id') );
    }


    public function info (Request $request)
    {
        $user           = User::find (get_user_login_id ());
        $result['data'] = [
            'name'         => 'Super Admin',
            'roles'        => [
                'admin'
            ],
            'avatar'       => 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
            'introduction' => 'i am a super administrator',
            'user'         => $user
        ];

        return ajax_success_message ('', $result);
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
        $user = $this->repository->makeModel ();

        return view ('user::user.index', compact ('user'));
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
        QueryWhere::like ($M, 'users.user_no');
        QueryWhere::like ($M, 'users.mobile');
        QueryWhere::like ($M, 'users.nickname');
        QueryWhere::like ($M, 'users.password');
        QueryWhere::date ($M, 'users.birthday');
        QueryWhere::eq ($M, 'users.gender');
        QueryWhere::date ($M, 'users.reg_date');
        QueryWhere::eq ($M, 'users.status');

        QueryWhere::orderBy ($M, 'users.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $limit = $request->input ('limit');
            //debug_log ('limit' . $M->toSql ());
            $data = $M->paginate ($limit);
        }

        return $this->repository->transformerCollection ($data, new UserTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \App\Exceptions\PermissionCheckException
     */
    public function create (Request $request)
    {
        $this->repository->checkPermission ();
        $user = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [
                'statusItem' => ArrayHelper::selectValueLabel ($user->statusItem ())
            ];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';

        return view ('user::user.create_or_edit', compact ('user', '_method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('User');
            $this->repository->makeValidator ()->with ($input)->passes (UserValidator::RULE_CREATE);
            $user   = $this->repository->create ($input);
            $result = $this->repository->transformerItem ($user, new UserTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url('admin/user/'.$user->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \App\Exceptions\PermissionCheckException
     */
    public function show (Request $request, User $user)
    {
        $this->repository->checkPermission ();
        if($request->wantsJson ())
        {
            $result = $this->repository->transformerItem ($user, new UserTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view('user::user.show',compact ('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function edit ($id)
    {
        $this->repository->checkPermission ();
        $_method = 'PUT';
        $user    = $this->repository->find ($id);

        return view ('user::user.create_or_edit', compact ('user', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, $id)
    {
        try {
            $this->repository->checkPermission ();
            $input = $request->input ('User');
            $this->repository->makeValidator ()->with ($input)->passes (UserValidator::RULE_UPDATE);
            $user   = $this->repository->update ($input, $id);
            $result = $this->repository->transformerItem ($user, new UserTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url('admin/user/'.$user->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, User $user)
    {
        try {
            $check = $this->repository->allowDelete ($user);
            if ($check) {
                $deleted = $this->repository->delete ($user->id);
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
                $user = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($user);
                if ($check) {
                    $deleted = $this->repository->delete ($user->id);
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

