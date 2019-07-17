<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $uniacid
 * @property int $list_id
 * @property int $goods_id
 * @property string $goods_name
 * @property string $rela_goodsoption_valueid
 * @property string $sku_str
 * @property string $goods_image
 * @property int $addtime
 * @property int $goods_count
 */
class ComshopDeliveryListGoods extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ims_lionfish_comshop_deliverylist_goods';

    /**
     * @var array
     */
    protected $fillable = ['uniacid', 'list_id', 'goods_id', 'goods_name', 'rela_goodsoption_valueid', 'sku_str', 'goods_image', 'addtime', 'goods_count'];

    public function delivery() {
        return $this->belongsTo('App\Models\ComshopDeliveryList', 'id', 'list_id');
    }

}
