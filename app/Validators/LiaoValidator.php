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

namespace App\Validators;


use App\Exceptions\SystemGuiException;
use Illuminate\Support\Facades\Validator;

class LiaoValidator
{
    const RULE_CREATE = 'create';
    const RULE_UPDATE = 'update';
    /**
     * @var Validator
     */
    protected $validator;
    /**
     * 验证规则
     * @var array
     */
    protected $rules = [];
    /**
     * 验证字段
     * @var array
     */
    protected $attributes = [];
    /**
     * 验证信息
     * @var array
     */
    protected $messages = [];
    protected $data     = [];
    private   $errors;

    /**
     * BaseValidator constructor.
     */
    public function __construct ()
    {
        $this->validator = new Validator();
    }

    public function with (array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     *  add by gui
     * @param null $action
     * @return bool
     * @throws SystemGuiException
     */
    public function passes ($action = null)
    {
        $rules      = array_get ($this->rules, $action, []);
        $messages   = $this->messages;
        $attributes = $this->attributes;
        $validator  = Validator::make ($this->data, $rules, $messages, $attributes);
        if ($validator->fails ()) {
            $this->errors = $validator->getMessageBag ();
            throw new SystemGuiException($validator->getMessageBag ()->first ());
        }

        return true;
    }

    /**
     * 获取验证规则 add by gui
     * @return array
     */
    public function getRules ()
    {
        return $this->rules;
    }

    /**
     * 设置验证规则 add by gui
     * @param $rules
     * @return LiaoValidator
     */
    public function setRules ($rules): LiaoValidator
    {
        $this->rules = $rules;

        return $this;
    }
}
