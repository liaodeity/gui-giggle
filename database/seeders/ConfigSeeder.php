<?php
namespace Database\Seeders;
use App\Addons\Config\Models\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $configs = [
            [
                'type'       => Config::STRING_TYPE,
                'name'       => 'system_title',
                'title'      => '系统标题名称',
                'context'    => 'Laravel Gui平台',
                'param_json' => '',
                'desc'       => ''
            ],
            [
                'type'       => Config::ARRAY_TYPE,
                'name'       => 'system_gui.captcha_type',
                'title'      => '验证码类型方式',
                'context'    => 'random',
                'param_json' => $this->getParamJson (['default'=>'简单模式', 'math' => '数字加法','mixing'=>'英文数字混合', 'random'=>'随机模式']),
                'desc'       => ''
            ],
            [
                'type'       => Config::ARRAY_TYPE,
                'name'       => 'system_gui.page.limit',
                'title'      => '列表分页默认条数',
                'context'    => 15,
                'param_json' => $this->getParamJson ([10 => 10, 15 => 15, 20 => 20, 25 => 25, 50 => 50, 100 => 100]),
                'desc'       => ''
            ],
        ];
        foreach ($configs as $config) {
            $info = Config::where ('name', $config['name'])->first ();
            if ($info) {
                $info->fill($config);
                $info->save();
            }else{
                Config::create ($config);
            }
        }
    }

    protected function getParamJson ($arr)
    {
        $param = [];
        foreach ($arr as $value => $label) {

            $param[] = [
                'value' => $value,
                'label' => $label
            ];

        }

        return json_encode ($param, JSON_UNESCAPED_UNICODE);
    }
}
