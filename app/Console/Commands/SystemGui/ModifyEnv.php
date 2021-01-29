<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: 廖春贵 < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/
namespace App\Console\Commands\SystemGui;

use Illuminate\Console\Command;

class ModifyEnv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gui:env {key} {value}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '修改配置.env的键值对信息';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct ()
    {
        parent::__construct ();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle ()
    {
        $key   = $this->argument ('key');
        $value = $this->argument ('value');
        $data  = [
            $key => $value
        ];
        modify_env ($data);
        $new_value = env ($key);
        if ($new_value == $value) {
            return true;
        } else {
            return false;
        }
    }
}
