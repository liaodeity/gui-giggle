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
namespace App\Addons\Article\Listeners;


use App\Addons\Article\Events\ArticlePublish;
use Illuminate\Support\Facades\Log;

class PublishNotification
{
    public function __construct ()
    {

    }

    public function handle (ArticlePublish $event)
    {
        $article = $event->article;
        Log::info ('事件消息通知', $article->toArray ());
    }
}
