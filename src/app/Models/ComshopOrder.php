<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_id
 * @property int $uniacid
 * @property string $order_num_alias
 * @property int $member_id
 * @property int $store_id
 * @property int $head_id
 * @property int $supply_id
 * @property string $type
 * @property string $charge_mobile
 * @property boolean $is_pin
 * @property string $from_type
 * @property string $perpay_id
 * @property string $name
 * @property string $email
 * @property string $telephone
 * @property string $delivery
 * @property string $shipping_name
 * @property int $address_id
 * @property string $shipping_tel
 * @property int $shipping_city_id
 * @property int $shipping_country_id
 * @property int $shipping_stree_id
 * @property int $shipping_province_id
 * @property string $shipping_address
 * @property string $tuan_send_address
 * @property string $ziti_name
 * @property string $ziti_mobile
 * @property int $shipping_method
 * @property string $dispatchname
 * @property float $shipping_fare
 * @property boolean $is_free_shipping_fare
 * @property float $fare_shipping_free
 * @property float $man_e_money
 * @property float $old_shipping_fare
 * @property float $changedshipping_fare
 * @property string $shipping_no
 * @property string $shipping_traces
 * @property string $payment_code
 * @property float $score_for_money
 * @property string $transaction_id
 * @property string $comment
 * @property string $remarksaler
 * @property float $total
 * @property float $old_price
 * @property float $changedtotal
 * @property int $voucher_id
 * @property float $voucher_credit
 * @property float $fullreduction_money
 * @property int $order_status_id
 * @property int $last_refund_order_status_id
 * @property boolean $is_balance
 * @property boolean $lottery_win
 * @property string $ip
 * @property boolean $is_zhuli
 * @property boolean $is_commission
 * @property boolean $is_delivery_flag
 * @property boolean $is_print_suc
 * @property string $ip_region
 * @property string $user_agent
 * @property int $date_added
 * @property int $date_modified
 * @property int $pay_time
 * @property int $canceltime
 * @property int $receive_time
 * @property int $finishtime
 * @property int $express_time
 * @property int $express_tuanz_time
 * @property int $shipping_cha_time
 */
class ComshopOrder extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ims_lionfish_comshop_order';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'order_id';

    /**
     * @var array
     */
    protected $fillable = ['uniacid', 'order_num_alias', 'member_id', 'store_id', 'head_id', 'supply_id', 'type', 'charge_mobile', 'is_pin', 'from_type', 'perpay_id', 'name', 'email', 'telephone', 'delivery', 'shipping_name', 'address_id', 'shipping_tel', 'shipping_city_id', 'shipping_country_id', 'shipping_stree_id', 'shipping_province_id', 'shipping_address', 'tuan_send_address', 'ziti_name', 'ziti_mobile', 'shipping_method', 'dispatchname', 'shipping_fare', 'is_free_shipping_fare', 'fare_shipping_free', 'man_e_money', 'old_shipping_fare', 'changedshipping_fare', 'shipping_no', 'shipping_traces', 'payment_code', 'score_for_money', 'transaction_id', 'comment', 'remarksaler', 'total', 'old_price', 'changedtotal', 'voucher_id', 'voucher_credit', 'fullreduction_money', 'order_status_id', 'last_refund_order_status_id', 'is_balance', 'lottery_win', 'ip', 'is_zhuli', 'is_commission', 'is_delivery_flag', 'is_print_suc', 'ip_region', 'user_agent', 'date_added', 'date_modified', 'pay_time', 'canceltime', 'receive_time', 'finishtime', 'express_time', 'express_tuanz_time', 'shipping_cha_time'];

    public function goods() {
        return $this->hasMany('App\Models\ComshopOrderGoods', 'order_id', 'order_id');
    }
}
