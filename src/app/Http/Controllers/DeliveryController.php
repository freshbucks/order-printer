<?php
/**
 * Created by PhpStorm.
 * User: jackie
 * Date: 2019/7/1
 * Time: 11:50 AM
 */

namespace App\Http\Controllers;

use App\Helpers\HttpClient\Curl;
use App\Models\ComshopDeliveryList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(Request $request) {

        $today = Carbon::today('PRC');
        $data = ComshopDeliveryList::with(['goods', 'orders', 'head'])->where('create_time', '>', $today->timestamp)->get();

        if (!$data->count()) {
            die('<h1 style="text-align: center">今天尚未生成配送单</h1>');
        }

        $heads = $data->map(function($item) {
            return $item->head->only(['lat', 'lon']);
        });

//        $http = new Curl();
//        $params = [
//            'from' => '36.749441,119.121108;' . join(';', $addresses->toArray()),
//            'to' => join(';', $addresses->toArray()),
//            'key' => 'VWQBZ-2G3KX-ZLM4G-TJ7XC-3JARF-RDB5Q',
//            'mode' => 'driving'
//        ];
//        $response = $http->get('https://apis.map.qq.com/ws/distance/v1/matrix', $params);
//        if ($response->status === 0) {
////            dump($response->result->rows);
////            $ss = ['仓', 'A', 'B', 'C', 'D', 'E'];
////            $ee = ['A', 'B', 'C', 'D', 'E'];
////            foreach ($response->result->rows as $s => $row) {
////                foreach ($row->elements as $e => $element) {
////                    $element->d = $ss[$s] . '->' . $ee[$e];
////                }
////            }
//            $result = $this->sorted($response->result->rows);
//            $heads = collect($result['sorted'])->map(function($key) use ($data, $result) {
//                $data[$key]->head->route = $result['data'][$key];
//                return $data[$key]->head->only('community_name', 'lat', 'lon', 'route');
//            })->toJson();
//        }

        return view('baicai', compact('today', 'data', 'heads'));
    }

    private function sorted($rows, $start = 0) {
        static $ends = [];
        static $data = [];

//        return compact('sorted', 'data');

        $elements = collect($rows[$start]->elements);

        $filtered = $elements->filter(function($item, $next) use ($ends, $start) {
            return ($start != $next + 1) && !in_array($next, $ends);
        });
        dump($filtered);
        if ($filtered->count() < 1) {
            return compact('ends', 'data');
        } else {
            $duration = $filtered->min('duration');
            $distance = $filtered->where('duration', $duration)->min('distance');
            $next = $elements->search(function ($item) use ($duration, $distance) {
                return $item->distance == $distance && $item->duration == $duration;
            });
            dump([$start, $next]);

            $ends[] = $next;
            $data[] = $rows[$start]->elements[$next];
            $this->sorted($rows, $next + 1);
        }
    }
}