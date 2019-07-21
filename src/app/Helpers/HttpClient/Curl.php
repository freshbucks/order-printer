<?php
/**
 * Created by PhpStorm.
 * User: jackie
 * Date: 2019/7/21
 * Time: 4:14 PM
 */
namespace App\Helpers\HttpClient;

class Curl
{
    public function get($url, $params = false, $https = 1) {
        return $this->curl($url, $params, 0, $https);
    }
    public function post($url, $params = false, $https = 1) {
        return $this->curl($url, $params, 1, $https);
    }

    private function curl($url, $params, $ispost, $https) {
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