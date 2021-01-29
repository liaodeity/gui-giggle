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

namespace App\Addons\Article\Http\Controllers;

use App\Addons\Article\Repositories\ArticleRepository;
use App\Addons\Article\Transformers\ArticleTransformer;
use App\Addons\Article\Validators\ArticleValidator;
use App\Http\Controllers\AdminController;
use App\Libs\QueryWhere;
use Illuminate\Http\Request;

class ArticleController extends AdminController
{
    public function __construct (ArticleRepository $repository, ArticleTransformer $transformer, ArticleValidator $validator)
    {

        $this->repository  = $repository;
        $this->transformer = $transformer;
        $this->validator   = $validator;
        $this->moduleName  = 'Article';
        $this->modelName   = 'Article';
        parent::__construct ();
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
}

