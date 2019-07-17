<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_goods_id
 * @property int $order_id
 * @property int $uniacid
 * @property int $goods_id
 * @property int $store_id
 * @property int $supply_id
 * @property boolean $is_pin
 * @property int $pin_id
 * @property float $shipping_fare
 * @property float $fare_shipping_free
 * @property string $name
 * @property int $head_disc
 * @property int $member_disc
 * @property string $level_name
 * @property string $goods_images
 * @property string $goods_type
 * @property string $model
 * @property int $quantity
 * @property float $price
 * @property float $changeprice
 * @property float $oldprice
 * @property float $fullreduction_money
 * @property float $voucher_credit
 * @property float $score_for_money
 * @property float $fenbi_li
 * @property float $total
 * @property string $rela_goodsoption_valueid
 * @property boolean $is_refund_state
 * @property string $comment
 * @property float $commiss_one_money
 * @property float $commiss_two_money
 * @property float $commiss_three_money
 * @property float $commiss_fen_one_money
 * @property float $commiss_fen_two_money
 * @property float $commiss_fen_three_money
 * @property int $addtime
 */
class ComshopOrderGoods extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ims_lionfish_comshop_order_goods';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'order_goods_id';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'uniacid', 'goods_id', 'store_id', 'supply_id', 'is_pin', 'pin_id', 'shipping_fare', 'fare_shipping_free', 'name', 'head_disc', 'member_disc', 'level_name', 'goods_images', 'goods_type', 'model', 'quantity', 'price', 'changeprice', 'oldprice', 'fullreduction_money', 'voucher_credit', 'score_for_money', 'fenbi_li', 'total', 'rela_goodsoption_valueid', 'is_refund_state', 'comment', 'commiss_one_money', 'commiss_two_money', 'commiss_three_money', 'commiss_fen_one_money', 'commiss_fen_two_money', 'commiss_fen_three_money', 'addtime'];

}
