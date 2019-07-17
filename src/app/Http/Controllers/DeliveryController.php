<?php
/**
 * Created by PhpStorm.
 * User: jackie
 * Date: 2019/7/1
 * Time: 11:50 AM
 */

namespace App\Http\Controllers;

use App\Models\ComshopDeliveryList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(Request $request) {

        $today = Carbon::today();
        $list = ComshopDeliveryList::with(['goods', 'orders'])->where('create_time', '>', $today->timestamp)->get();

        return view('baicai', [
            'data' => $list,
            'today' => $today
        ]);
    }
}