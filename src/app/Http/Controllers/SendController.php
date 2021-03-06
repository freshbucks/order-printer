<?php
/**
 * Created by PhpStorm.
 * User: jackie
 * Date: 2019/7/26
 * Time: 5:34 PM
 */

namespace App\Http\Controllers;


use App\Models\ComshopOrder;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class SendController extends Controller
{
    private $uri;
    private $client;
    private $auth;
    private $appId = '8aaf07086bfdc83a016c2802ae6f1ac6';

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://app.cloopen.com:8883']);

        $accountSid = 'aaf98fda4582119f014583d7d6ba021a';
        $now = Carbon::now('Asia/Shanghai')->format('YmdHms');
        $this->auth = base64_encode("$accountSid:$now");

        $authToken = 'bab9367715c547f9b201cf0031e7dad4';
        $SigParameter = strtoupper(md5($accountSid.$authToken.$now));
        $this->uri = "/2013-12-26/Accounts/$accountSid/SMS/TemplateSMS?sig=$SigParameter";
    }

    public function leader() {
        $leaders = [
//            ['Jackie', '13110445803'],
            ['王春香', '18853625161'],
            ['窦志杰', '15315262181'],
            ['南波', '15689835820'],
            ['王爱霞', '18265678105'],
            ['冯国龙', '18953696613'],
            ['张翠芬', '15216469707'],
            ['张黎明', '15650266007'],
            ['牟洪杰', '18678083308'],
            ['孙女士', '18653644689'],
            ['金宏建', '13176065100'],
            ['陈继百', '18653652290'],
            ['陈翠霞', '18053674854'],
            ['刘淑敏', '15965365528'],
            ['王光明', '15269601700'],
            ['王鹏', '18953619697'],
            ['刘小雪', '17865658150'],
            ['栾庆华', '18653627596'],
            ['伦学敏', '15263610123'],
            ['刘海龙', '18053698084'],
            ['辛文青', '13002781907'],
            ['王汶汶', '15762551139'],
            ['于萌', '13356798382'],
            ['孙俊萍', '18653600053'],
            ['王惠媛', '15966095596'],
            ['李倩', '13070773229'],
            ['高娟', '15553603892'],
            ['姚灵珍', '13863606064'],
            ['韩连强', '15169497125']
        ];
        ob_end_clean();
        collect($leaders)->each(function($leader, $index) {
            $datas = [$leader[0], '附近', '微信 13110445803'];
            $response = $this->send($leader[1], '459517', $datas); // 459517
            dump($leader[0], $response);
            flush();
            sleep(1);
        });
    }

    public function goods() {
//        $orders = ComshopOrder::distinct('shipping_tel')
//            ->get(['shipping_tel as tel', 'ziti_mobile as mobile', 'ziti_name as name']);
        $orders = DB::table('ims_lionfish_comshop_order as o')
            ->distinct('o.shipping_tel')
            ->select('o.shipping_tel as tel', 'm.username as name', 'o.ziti_mobile as mobile')
            ->leftJoin('ims_lionfish_comshop_member as m', 'o.head_id', '=', 'm.member_id')
            ->where('o.shipping_tel', '<>', 0)
            ->whereNotIn('o.ziti_mobile', [13110445803, 13869660377, 15763649985, 15053668097, 18563066252, 18010375803])
            ->orderBy('o.ziti_mobile')
            ->get();
//        dump($orders);

        $grouped = $orders->groupBy('mobile');

//        ob_end_clean();
        $grouped->each(function ($item) {
            $data = [':贝贝南瓜2个 约2.5斤', '14.98元', "8.98元~ 下单请联系微信: {$item[0]->name}"];
            $tels = $item->implode('tel', ',');
//            $this->send($tels, '459314', $data);
            dump($item[0]->mobile, $data);
//            flush();
//            sleep(1);
        });
    }

    private function send($to, $templateId, $datas = []) {
        $params = compact('to', 'templateId', 'datas');
        $params['appId'] = $this->appId;
        $body = \GuzzleHttp\json_encode($params);
        $length = strlen($body);

        return $this->client->post($this->uri, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json;charset=utf-8',
                'Content-Length' => $length,
                'Authorization' => $this->auth
            ],
            'body' => $body
        ]);
    }
}
