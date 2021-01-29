<?php
/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020/5/17
 */

namespace App\Services;


use App\Exceptions\SystemGuiException;
use Illuminate\Support\Facades\Log;

class ApiService
{
    /**
     * 发送消息到钉钉通知 add by gui
     * @param $message
     * @return array|bool|string
     */
    public function sendDingTalk ($message)
    {
        $remote_server = 'https://oapi.dingtalk.com/robot/send?access_token=fdff54caef385cd4d9493daf77a9d64d789bb3b9724be703cc6f13fedadc2b27';
        //$webhook = "https://oapi.dingtalk.com/robot/send?access_token=xxxxxx";
        //$message= $msg;
        $data        = array('msgtype' => 'text', 'text' => array('content' => $message));
        $data_string = json_encode ($data);

        $ch = curl_init ();
        curl_setopt ($ch, CURLOPT_URL, $remote_server);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
        // curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec ($ch);
        curl_close ($ch);

        return $data;
    }

    /**
     * 推送地址到百度 add by gui
     * @param $url
     */
    public function pushBaiduSEO ($url = null)
    {
        $urls = [];
        if ($url) {
            $urls[] = $url;
        }
        $pushList = PushSeo::where ('is_push', 0)->limit (1000)->get ();
        foreach ($pushList as $item) {
            if ($item->url)
                $urls[] = $item->url;
        }
        if(empty($urls)){
            return null;
        }
        $api     = 'http://data.zz.baidu.com/urls?site=https://www.jianbaizhan.com&token=Z0juLzTYmhZioX7t';
        $ch      = curl_init ();
        $options = array(
            CURLOPT_URL            => $api,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => implode ("\n", $urls),
            CURLOPT_HTTPHEADER     => array('Content-Type: text/plain'),
        );
        curl_setopt_array ($ch, $options);
        $result = curl_exec ($ch);
        Log::info ('百度提交SEO ' . $result);
        $data = json_decode ($result, true);
        if ($data['success']) {
            foreach ($pushList as $item) {
                PushSeo::where ('id', $item->id)->update (['is_push'=>1]);
            }
        }
    }
}
