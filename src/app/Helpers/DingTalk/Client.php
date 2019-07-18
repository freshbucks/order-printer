<?php
/**
 * Created by PhpStorm.
 * User: jackie
 * Date: 2019/7/18
 * Time: 4:18 PM
 */
namespace App\Helpers\DingTalk;



class Client {
    private $appKey;
    private $appSecret;
    private $chatId;
    private $token;

    public function __construct()
    {
        $this->appKey = config('dt.appKey');
        $this->appSecret = config('dt.appSecret');
        $this->chatId = config('dt.chatId');
    }

    public function sendSalesReport($title, $text) {
        $token = $this->getToken();
        $url = 'https://oapi.dingtalk.com/chat/send?access_token=' . urlencode($token);

        $params = [
            'chatid' => $this->chatId,
            'msg' => [
                'msgtype' => 'markdown',
                'markdown' => [
                    'title' => $title,
                    'text' => $text
                ]
            ]
        ];

        $response = $this->post($url, $params);

        return $response;
    }

    private function getToken() {
        if (!$this->token) {
            $params = [
                'appkey' => $this->appKey,
                'appsecret' => $this->appSecret
            ];
            $response = $this->curl('https://oapi.dingtalk.com/gettoken', $params);

            $this->token = $response->access_token;
        }
        return $this->token;
    }

    private function post($url, $params = false, $https = 1) {
        return $this->curl($url, $params, 1, $https);
    }

    private function curl($url, $params = false, $ispost = 0, $https = 1) {
//        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            $fields = json_encode($params);
            $header = $header = ["Content-Type: application/json; charset=utf-8", "Content-Length:".strlen($fields)];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else if ($params){
            if (is_array($params)) {
                $params = http_build_query($params);
            }

            $url .= '?' . $params;
        }
        curl_setopt($ch, CURLOPT_URL, $url);

        $response = curl_exec($ch);

        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
//        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return json_decode($response);
    }
}