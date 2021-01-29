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
namespace App\Addons\Config\Models;

use App\Models\BaseModel;

class Config extends BaseModel
{
    const NUMBER_TYPE = 1;
    const STRING_TYPE = 2;
    const ARRAY_TYPE  = 3;
    const JSON_TYPE   = 4;
    protected $fillable = [
        'type',
        'name',
        'title',
        'context',
        'param_json',
        'desc',
        'created_at',
        'updated_at',
    ];

    /**
     * 配置类型[1=数字,2=字符串,3=数组,4=json] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function typeItem ($ind = 'all', $html = false)
    {
        return get_db_parameter (self::class, 'type', $ind, $html);
    }

    /**
     * add by gui
     * @param $name
     * @param $default
     * @return mixed
     */
    public function getConfig ($name, $default)
    {
        $config = $this->where ('name', $name)->first ();
        if (!$config) {
            $type       = 2;
            $param_json = '';
            if (is_null ($default)) {
                //尝试获取系统设置配置
                $default = config ($name);
            }
            if (!is_null ($default)) {
                //1=数字,2=字符串,3=数组,4=json
                if (is_numeric ($default)) {
                    $type = 1;
                } else if (is_array ($default)) {
                    $type       = 3;
                    $param_json = json_encode ($default, JSON_UNESCAPED_UNICODE);
                } else if (json_decode ($default)) {
                    $type = 4;
                }
            }
            $insArr = [
                'type'       => $type,
                'name'       => $name,
                'title'      => $name,
                'context'    => $default,
                'param_json' => $param_json
            ];
            $config = $this->create ($insArr);
        }

        return $config ? $config->context : $default;
    }
    /**
     * 获取配置内容信息 add by gui
     * @param Config $config
     * @return mixed|string
     */
    public function getContextValue (Config $config)
    {
        $context  =$config->context;
        if($config->name == 'wx_menu'){
            $context = '<i style="color: #d2d6de;">--内容过多无法显示，请查看或编辑--</i>';
        }
        switch($config->type){
            case self::ARRAY_TYPE:
                $arr = $this->getParamItem ($config);
                foreach ($arr as $item){
                    if($item->value == $config->context){
                        $context = $item->label;
                        break;
                    }
                }
                break;
        }
        return $context;
    }
    public function getParamItem (Config $config)
    {
        $json = $config->param_json ?? '';
        switch ($config->type) {
            case self::ARRAY_TYPE;

                if ($json) {
                    return json_decode ($json);
                } else {
                    return [];
                }
                break;
            default:
                return $json;
                break;
        }


    }
}
