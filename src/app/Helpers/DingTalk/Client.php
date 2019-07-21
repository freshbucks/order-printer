<?php
/**
 * Created by PhpStorm.
 * User: jackie
 * Date: 2019/7/18
 * Time: 4:18 PM
 */
namespace App\Helpers\DingTalk;

use App\Helpers\HttpClient\Curl;

class Client {
    private $appKey;
    private $appSecret;
    private $chatId;
    private $token;
    private $http;

    public function __construct()
    {
        $this->appKey = config('dt.appKey');
        $this->appSecret = config('dt.appSecret');
        $this->chatId = config('dt.chatId');
        $this->http = new Curl();
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

        $response = $this->http->post($url, $params);

        return $response;
    }

    private function getToken() {
        if (!$this->token) {
            $params = [
                'appkey' => $this->appKey,
                'appsecret' => $this->appSecret
            ];
            $response = $this->http->get('https://oapi.dingtalk.com/gettoken', $params);

            $this->token = $response->access_token;
        }
        return $this->token;
    }
}