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
namespace App\Addons\CustomView\Models;

use App\Models\BaseModel;


class BlockField extends BaseModel
{


    protected $table = 'block_fields';

    protected $fillable = ['block_id','field_id','typeof_data','is_hidden','is_create','is_quick_create','is_edit','is_view','is_require','is_foreign_key','ui_type','created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];


    /**
     * 是否隐藏字段 add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function isHiddenItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'is_hidden', $ind, $html);
    }

    /**
     * 是否允许创建 add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function isCreateItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'is_create', $ind, $html);
    }

    /**
     * 是否允许快速创建 add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function isQuickCreateItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'is_quick_create', $ind, $html);
    }

    /**
     * 是否允许修改 add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function isEditItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'is_edit', $ind, $html);
    }

    /**
     * 是否允许查看 add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function isViewItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'is_view', $ind, $html);
    }

    /**
     * 是否必填 add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function isRequireItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'is_require', $ind, $html);
    }

    /**
     * 是否关键外键字段 add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function isForeignKeyItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'is_foreign_key', $ind, $html);
    }

    /**
     * 视图显示类型[1=文本,2=链接,3=邮箱,4=电话号码,5=复选框,6=文本区域,7=多选组合框,8=日期,9=时间,10=小数,11=整数,12=百分数,13=货币,14=选择列表] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function uiTypeItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'ui_type', $ind, $html);
    }


}
