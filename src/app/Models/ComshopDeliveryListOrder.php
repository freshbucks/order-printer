<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $uniacid
 * @property int $list_id
 * @property int $order_id
 * @property int $addtime
 */
class ComshopDeliveryListOrder extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ims_lionfish_comshop_deliverylist_order';

    /**
     * @var array
     */
    protected $fillable = ['uniacid', 'list_id', 'order_id', 'addtime'];

    public function delivery() {
        return $this->belongsTo('App\Models\ComshopDeliveryList', 'id', 'list_id');
    }

    public function detail() {
        return $this->belongsTo('App\Models\ComshopOrder', 'order_id');
    }
}
