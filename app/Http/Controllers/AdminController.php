<?php
/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020/9/22
 */

namespace App\Http\Controllers;


use App\Addons\Menu\Models\Menu;
use App\Exceptions\SystemGuiException;
use App\Libs\Form\FormCreateData;
use App\Libs\Form\FormListData;
use App\Libs\Form\FormShowData;
use App\Repositories\BaseRepository;
use App\Validators\LiaoValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;

class AdminController extends Controller
{

    /**
     * @var BaseRepository
     */
    protected $repository;
    /**
     * @var TransformerAbstract
     */
    protected $transformer;
    /**
     * @var LiaoValidator
     */
    protected $validator;
    /**
     * @var integer 选中菜单ID
     */
    protected $menuActiveId;
    /**
     * @var string 模块名称
     */
    protected $moduleName;
    /**
     * @var string 模型名称
     */
    protected $modelName;
    /**
     * @var string 路由前缀
     */
    private $routePrefix;

    public function __construct ()
    {
        $this->menuActiveId = Menu::where ('menu_name', $this->getRoutePrefix ())->value ('id');
        View::share ('menuActiveName', $this->getModelName ());
        View::share ('menuActiveId', $this->getMenuActiveId ());
    }

    /**
     * @return mixed
     */
    public function getRoutePrefix ()
    {
        $this->routePrefix = Str::snake ($this->modelName);

        return $this->modelName;
    }

    /**
     * @return mixed
     */
    public function getModelName ()
    {
        return $this->modelName;
    }

    /**
     * @return mixed
     */
    public function getMenuActiveId ()
    {
        return $this->menuActiveId;
    }

    /**
     * @return mixed
     */
    public function getModuleName ()
    {
        return $this->moduleName;
    }

    /**
     * @return TransformerAbstract
     */
    public function getTransformer (): TransformerAbstract
    {
        return $this->transformer;
    }

    /**
     * @return BaseRepository
     */
    public function getRepository (): BaseRepository
    {
        return $this->repository;
    }

    /**
     *  add by gui
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function index (Request $request)
    {
        if ($request->wantsJson ()) {
            $result = $this->getData ($request, false);

            return ajax_success_message (__ ('message.controller.success.search'), $result);
        }
        $article  = $this->repository->makeModel ();
        $listData = new FormListData($article, null, $this->getRoutePrefix (), $this->getMenuActiveId ());

        return view ('common.lists', compact ('listData'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $modelInfo = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $createData = new FormCreateData($modelInfo,null,$this->getRoutePrefix (),$this->getMenuActiveId ());

        return view ('common.create', compact ('createData'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        try {
            $input = $request->input ($this->modelName);
            $this->repository->makeValidator ()->with ($input)->passes ($this->validator::RULE_CREATE);
            $article = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($article, $this->transformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/article/' . $article->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, $id)
    {
        $modelInfo = $this->repository->find ($id);
        $result    = $this->repository->transformerItem ($modelInfo, $this->transformer);

        if ($request->wantsJson ()) {
            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $showData = new FormShowData($modelInfo, $result, $this->getRoutePrefix (), $this->menuActiveId);

        return view ('common.show', compact ('showData'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, $id)
    {
        $modelInfo = $this->repository->find ($id);
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($modelInfo, $this->transformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';

        return view ('common.edit', compact ('article', '_method'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update (Request $request, $id)
    {
        $modelInfo = $this->repository->find ($id);
        try {
            $input = $request->input ($this->modelName);
            $this->repository->makeValidator ()->with ($input)->passes ($this->validator::RULE_UPDATE);
            $modelInfo = $this->repository->update ($input, $modelInfo->id);
            $result    = $this->repository->transformerItem ($modelInfo, $this->transformer);
            $showData  = new FormShowData($modelInfo, $result, $this->getRoutePrefix (), $this->menuActiveId);
            $showUrl   = $showData->getShowUrl ();

            return ajax_success_message (__ ('message.controller.success.update'), $result, $showUrl);
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, $id)
    {
        $modelInfo = $this->repository->find ($id);
        try {
            $check = $this->repository->allowDelete ($modelInfo);
            if ($check) {
                $deleted = $this->repository->delete ($modelInfo->id);
                if (!$deleted) {
                    throw new SystemGuiException(__ ('message.controller.delete_fail'));
                }
            }

            return ajax_success_message (__ ('message.controller.success.delete'));
        } catch (SystemGuiException $e) {

            return ajax_error_message ($e->getMessage ());
        }
    }

    public function batchDestroy (Request $request, $ids)
    {
        $idArr = explode (',', $ids);
        try {
            foreach ($idArr as $id) {
                $modelInfo = $this->repository->find ($id);
                $check     = $this->repository->allowDelete ($modelInfo);
                if ($check) {
                    $deleted = $this->repository->delete ($modelInfo->id);
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

    }
}
