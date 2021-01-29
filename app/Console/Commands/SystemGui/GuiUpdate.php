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

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use ZanySoft\Zip\Zip;

class GuiUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gui:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '在线远程更新SystemGui系统';

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
        //TODO 在线远程下载
        /**
         * 根据当前版本号从实现远程下载文件
         * 判断下载的压缩包签名是否正确
         * 根据压缩包文件，对涉及更新的文件备份
         * 进行文件解压
         * 对更新文件进行校验，判断是否已更新成功，失败则恢复备份文件
         * 校验成功，进行更新版本号以及版本签名
         *
         */
        $url      = 'https://www.jianbaizhan.com';
        $version  = get_version ();
        $Client   = new Client();
        $response = $Client->request ('get', $url . '?version=' . $version);
        $code     = $response->getStatusCode (); // 200
        if ($code != 200) {
            $this->error ('更新远程服务器异常 code :' . $code);

            return;
        }
        $json       = $response->getBody ();
        $updateFile = json_to_result_format ($json);
        //是否正常获取更新信息
        if ($updateFile->isFail ()) {
            $this->error ($updateFile->getMsg ());

            return;
        }

        $hasUpdate   = $updateFile->getResult ('has_update');
        $fileName    = $updateFile->getResult ('file_name');
        $fileUrl     = $updateFile->getResult ('file_url');
        $fileSign    = $updateFile->getResult ('file_sign');
        $files       = $updateFile->getResult ('files', []);
        $nextVersion = $updateFile->getResult ('next_version');

        //是否有更新
        if (!$hasUpdate) {
            $this->info ($updateFile->getMsg ());

            return;
        }
        //下载文件包
        $content = file_get_contents ($fileUrl);
        if (!$content) {
            $this->error ('下载文件失败');

            return;
        }
        //保存下载的更新文件包
        $path_file = 'gui-update/' . $fileName;
        $ret       = Storage::put ($path_file, $content);
        if (!$ret) {
            $this->error ('保存下载文件失败');
        }

        //判断压缩包签名
        $sha1 = sha1_file (storage_path ($path_file));
        if ($sha1 != $fileSign) {
            $this->error ('下载的更新文件，与签名不符');

            return;
        }

        //获取压缩文件名称，备份修改文件
        $bak_zip = storage_path ('gui-update/' . $version . '.bak.zip');
        $bakZip  = Zip::create ($bak_zip);
        foreach ($files as $file) {
            $bakZip->add ($file);
        }
        $bakZip->close ();

        if (!file_exists ($bak_zip)) {
            //备份文件失败
            $this->error ('没有进行文件的备份');

            return;
        }

        //进行解压
        $update_zip = storage_path ($path_file);
        $zip        = Zip::open ($update_zip);
        $zip->extract (base_path ());
        $zip->close ();

        //校验是否更新文件
        foreach ($files as $sign => $file) {
            $sha1 = sha1_file ($file);
            if ($sha1 != $sign) {
                //存在其中一个文件失败，使用备份文件恢复
                $zip = Zip::open ($bak_zip);
                $zip->extract (base_path ());
                $zip->close ();
                $this->error ('存在' . $file . '文件更新失败，恢复更新前文件');

                return;
            }
        }

        //校验成功，更新版本号
        $this->call ('gui:env SYSTEM_GUI_VERSION ' . $nextVersion);
        $currentVersion = get_version ();
        if ($currentVersion != $nextVersion) {
            //版本号更新失败，恢复备份文件
            $zip = Zip::open ($bak_zip);
            $zip->extract (base_path ());
            $zip->close ();

            return;
        }
        //TODO 记录系统更新日志及签名信息

        //更新完毕
        $this->info ('已更新为' . $currentVersion . '版本');
    }
}
