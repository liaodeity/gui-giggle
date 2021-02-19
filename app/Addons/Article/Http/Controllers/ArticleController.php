<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( MIT )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: 廖春贵 < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/
namespace App\Addons\Article\Http\Controllers;

use App\Addons\Menu\Models\Menu;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use App\Addons\Article\Models\Article;
use App\Addons\Article\Transformers\ArticleTransformer;
use App\Addons\Article\Repositories\ArticleRepository;
use App\Addons\Article\Validators\ArticleValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $repository;
    /**
     * @var ArticleTransformer
     */
    private $transformer;
    private $menuActiveId;

    public function __construct (ArticleRepository $repository, ArticleTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->transformer = $transformer;
        $this->menuActiveId = Menu::where('menu_name','article')->value('id');

        View::share ('menuActiveName', 'article' );
        View::share ('menuActiveId', $this->menuActiveId );
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
        $article = $this->repository->makeModel ();

        return view ('article::article.index', compact ('article'));
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

        QueryWhere::orderBy ($M, 'articles.created_at desc');
        if ($export) {
            $data = $M->get ();
        } else {
            $data = $M->paginate ($request->input ('limit'));
        }

        return $this->repository->transformerCollection ($data, new ArticleTransformer);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $article = $this->repository->makeModel ();
        if ($request->wantsJson ()) {
            $result = [];

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'POST';
        $menuPath = __('message.buttons.create');

        return view ('article::article.create_or_edit', compact ('article', '_method', 'menuPath'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        try {
            $input = $request->input ('Article');
            $this->repository->makeValidator ()->with ($input)->passes (ArticleValidator::RULE_CREATE);
            $article = $this->repository->create ($input);
            $result  = $this->repository->transformerItem ($article, new ArticleTransformer);

            return ajax_success_message (__ ('message.controller.success.create'), $result, url ('admin/article/' . $article->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Display the specified resource.
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function show (Request $request, Article $article)
    {
        $result = $this->repository->transformerItem ($article, new ArticleTransformer);
        if ($request->wantsJson ()) {
            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }

        return view ('article::article.show', compact ('article'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, Article $article)
    {
        if ($request->wantsJson ()) {

            $result = $this->repository->transformerItem ($article, new ArticleTransformer);

            return ajax_success_message (__ ('message.controller.success.get'), $result);
        }
        $_method = 'PUT';
        $menuPath = __('message.buttons.show');

        return view ('article::article.create_or_edit', compact ('article', '_method', 'menuPath'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param Article                  $article
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Article $article)
    {
        try {
            $input = $request->input ('Article');
            $this->repository->makeValidator ()->with ($input)->passes (ArticleValidator::RULE_UPDATE);
            $article = $this->repository->update ($input, $article->id);
            $result  = $this->repository->transformerItem ($article, new ArticleTransformer);

            return ajax_success_message (__ ('message.controller.success.update'), $result, url ('admin/article/' . $article->id));
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy (Request $request, Article $article)
    {
        try {
            $check = $this->repository->allowDelete ($article);
            if ($check) {
                $deleted = $this->repository->delete ($article->id);
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
                $article = $this->repository->find ($id);
                $check = $this->repository->allowDelete ($article);
                if ($check) {
                    $deleted = $this->repository->delete ($article->id);
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

