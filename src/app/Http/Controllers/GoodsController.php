<?php
/**
 * Created by PhpStorm.
 * User: jackie
 * Date: 2019/7/31
 * Time: 6:42 AM
 */

namespace App\Http\Controllers;


use App\Models\ComshopGoods;

class GoodsController extends Controller
{
    public function index() {
        $goods = ComshopGoods::where('grounding', 1)->get();
        $ids = $goods->implode('id', ',');

        dump($ids);

        return view('goods', [
            'goods' => $goods
        ]);
    }
}