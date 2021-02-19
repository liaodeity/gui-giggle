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

require_once "functions.php";

//系统基础函数库，本文件只存储系统级函数，请不要自行添加函数，自行函数请添加到function.php
if (!function_exists ('modify_env')) {
    /**
     * 修改配置文件.env add by gui
     * @param array $data
     */
    function modify_env (array $data)
    {
        $envPath = base_path () . DIRECTORY_SEPARATOR . '.env';

        $contentArray = collect (file ($envPath, FILE_IGNORE_NEW_LINES));

        $contentArray->transform (function ($item) use ($data) {
            foreach ($data as $key => $value) {
                if (str_contains ($item, $key)) {
                    $key   = trim ($key);
                    $value = trim ($value);

                    return $key . '=' . $value;
                }
            }

            return $item;
        });

        $content = implode ($contentArray->toArray (), "\n");

        \Illuminate\Support\Facades\File::put ($envPath, $content);
    }
}
if (!function_exists ('debug_log')) {
    /**
     * 记录调试日志输出，只有在开发环境才输出到log add by gui
     * @param       $message
     * @param array $context
     */
    function debug_log ($message, array $context = [])
    {
        if (config ('app.debug')) {
            \Illuminate\Support\Facades\Log::debug ($message, $context);
        }
    }
}
if (!function_exists ('asset_version')) {
    /**
     * 获取静态路径，并携带版本号 add by gui
     * @param      $path
     * @param null $secure
     * @return string
     */
    function asset_version ($path, $secure = null)
    {
        $path .= '?v=' . get_version ();

        return asset ($path, $secure);
    }
}

if (!function_exists ('get_version')) {
    /**
     * 获取版本信息
     * add by gui
     * @return string
     */
    function get_version ($cache = false)
    {
        $version = config ('system_gui.version');
        if (config ('app.debug') && $cache) {
            //开发环境下，防止静态文件缓存
            $version .= '.' . time ();
        }

        return $version;
    }
}
if (!function_exists ('get_user_login_id')) {
    /**
     * 获取当前登录的用户ID add by gui
     * @return mixed
     */
    function get_user_login_id ()
    {
        return session ()->get ('LOGIN_USER_UID', 0);
    }
}
if (!function_exists ('get_user_x_token')) {
    /**
     * 获取当前用户登录的X-Token add by gui
     * @return mixed
     */
    function get_user_x_token ()
    {
        return session ()->get ('LOGIN_X_TOKEN', 0);
    }
}

if (!function_exists ('get_db_parameter')) {
    /**
     * 获取参数你列表内容 add by gui
     * @param string $model 模型
     * @param string $name  字段名称
     * @param string $ind   标签键值
     * @param bool   $html  是否进行html渲染
     * @return array|string
     */
    function get_db_parameter ($model, $name, $ind = 'all', $html = false)
    {
        $M       = app ($model);
        $tabName = $M->getTable ();
        $field   = \App\Models\SystemGui\Field::where ('tab_name', $tabName)->where ('field_name', $name)->first ();
        //var_dump($field);
        //
        //$parameter = \App\Addons\Parameter\Models\Parameter::where ('name', $name)
        //    ->where ('model', $model)
        //    ->first ();
        if (!$field) {
            return $ind == 'all' ? [] : '';
        }
        // 获取参数列表内容，请进行缓存处理
        //$items    = $parameter->parameterItems ();
        $items    = $field->fieldItems ();
        $list     = $items->where ('status', 1)->orderBy ('sort', 'DESC')->get ();
        $arr      = [];
        $colorArr = [];
        foreach ($list as $item) {
            $arr[ $item->value ]      = $item->label;
            $colorArr[ $item->value ] = $item->color;
        }
        if ($ind !== 'all') {
            $text = array_key_exists ($ind, $arr) ? $arr[ $ind ] : null;

            if ($html === true) {
                $color = array_key_exists ($ind, $colorArr) ? $colorArr[ $ind ] : '';
                if ($color) {
                    $color = 'layui-badge  layui-bg-' . $color;
                } else {
                    $color = 'layui-badge  layui-bg-gray';
                }
                $text = '<span class="' . $color . '">' . $text . '</span>';
            }

            return $text;
            //if(isset($arr[$ind])){
            //    return '<em class="color-level' . $item->color . '">' . ($item->item) . '</em>';
            //}
            //foreach ($list as $item) {
            //    if ($item->key == $ind) {
            //        if ($html) {
            //
            //        } else {
            //            return $item->item ?? '';
            //        }
            //    }
            //}
            //
            //return '';
        }

        return $arr;
    }
}
if (!function_exists ('get_item_parameter')) {
    /**
     * 获取键值对配置值 add by gui
     * @param        $key
     * @param string $ind
     * @param bool   $html
     * @return array|\Illuminate\Contracts\Translation\Translator|mixed|string|null
     */
    function get_item_parameter ($key, $ind = 'all', $html = false)
    {
        $arr = __ ('parameter.' . $key);
        if ($ind !== 'all') {
            $text = array_key_exists ($ind, $arr) ? $arr[ $ind ] : null;

            if ($html === true) {
                if ($text) {
                    //特殊情况
                    $text = trans ($text);
                }
            }

            return $text;
        }

        return $arr;
    }
}
if (!function_exists ('get_config_value')) {
    /**
     * 获取SystemGui系统配置表配置信息 add by gui
     * @param      $name
     * @param null $default
     * @return null
     */
    function get_config_value ($name, $default = null)
    {
        $config = new \App\Addons\Config\Models\Config();
        $value  = $config->getConfig ($name, $default);

        return $value;
    }
}
if (!function_exists ('ajax_error_message')) {
    /**
     * 错误返回JSON add by gui
     * @param string $message
     * @param null   $result
     * @return \Illuminate\Http\JsonResponse
     */
    function ajax_error_message ($message, $result = null)
    {
        $ResultData = new \App\Libs\ResultData();
        $arr        = $ResultData->setError (true)->setMessage ($message)->setResult ($result)->toArray ();

        return response ()->json ($arr);
    }
}
if (!function_exists ('ajax_success_message')) {
    /**
     * 成功返回JSON add by gui
     * @param string $message
     * @param null   $result
     * @return \Illuminate\Http\JsonResponse
     */
    function ajax_success_message ($message, $result = null, $url = '')
    {
        $ResultData = new \App\Libs\ResultData();
        $arr        = $ResultData->setError (false)->setUrl ($url)->setMessage ($message)->setResult ($result)->toArray ();

        return response ()->json ($arr);
    }
}
if (!function_exists ('json_to_result_format')) {
    /**
     * 将json解析成JsonResult add by gui
     * @param $json
     * @return \App\Libs\SystemGui\JsonResultFormat
     */
    function json_to_result_format ($json)
    {
        $JsonResult = new \App\Libs\SystemGui\JsonResultFormat();

        return $JsonResult->format ($json);
    }
}
if (!function_exists ('get_uuid')) {
    /**
     * 获取UUID add by gui
     * @return string
     */
    function get_uuid ()
    {
        $uuid = \Illuminate\Support\Str::uuid ();
        if ($uuid instanceof \Ramsey\Uuid\UuidInterface) {
            return $uuid->toString ();
        } else {
            $str  = md5 (uniqid (mt_rand (), true));
            $uuid = substr ($str, 0, 8) . '-';
            $uuid .= substr ($str, 8, 4) . '-';
            $uuid .= substr ($str, 12, 4) . '-';
            $uuid .= substr ($str, 16, 4) . '-';
            $uuid .= substr ($str, 20, 12);

            return $uuid;
        }
    }
}

if (!function_exists ('addons_path')) {
    function addons_path ($path = '')
    {
        //public_path ()
        $path = $path ? DIRECTORY_SEPARATOR . ltrim ($path, DIRECTORY_SEPARATOR) : $path;

        return app_path ('Addons/' . $path);
    }
}

if (!function_exists ('array_null_to_string')) {
    /**
     * 将数组的值null转换成string'' add by gui
     * @param $data
     * @param $key
     */
    function array_null_to_string (&$data, $key = null)
    {
        if (is_null ($key)) {
            foreach ($data as $key => $item) {
                if (array_key_exists ($key, $data) && is_null ($data[ $key ])) {
                    $data[ $key ] = '';
                }
            }
        } else {
            if (array_key_exists ($key, $data) && is_null ($data[ $key ])) {
                $data[ $key ] = '';
            }
        }
    }
}
if (!function_exists ('file_size_format_unit')) {
    /**
     * 格式化文件大小单位 add by gui
     * @param $size
     * @return string
     */
    function file_size_format_unit ($size)
    {
        $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
        if ($size == 0) {
            return ('n/a');
        } else {
            return (round ($size / pow (1024, ($i = floor (log ($size, 1024)))), 2) . $sizes[ $i ]);
        }
    }
}

if (!function_exists ('mix_build_dist')) {
    /**
     * mix资源路径 add by gui
     * @param $path
     * @return \Illuminate\Support\HtmlString|string
     * @throws Exception
     */
    function mix_build_dist ($path)
    {
        $dir = config ('app.debug') ? 'build' : 'dist';

        return mix ($path, $dir);
    }
}
