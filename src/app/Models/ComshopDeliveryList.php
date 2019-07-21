<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $uniacid
 * @property string $list_sn
 * @property int $head_id
 * @property string $head_name
 * @property string $head_mobile
 * @property string $head_address
 * @property int $line_id
 * @property string $line_name
 * @property int $clerk_id
 * @property string $clerk_name
 * @property string $clerk_mobile
 * @property boolean $state
 * @property int $goods_count
 * @property int $express_time
 * @property int $head_get_time
 * @property int $create_time
 * @property int $addtime
 */
class ComshopDeliveryList extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ims_lionfish_comshop_deliverylist';

    /**
     * @var array
     */
    protected $fillable = ['uniacid', 'list_sn', 'head_id', 'head_name', 'head_mobile', 'head_address', 'line_id', 'line_name', 'clerk_id', 'clerk_name', 'clerk_mobile', 'state', 'goods_count', 'express_time', 'head_get_time', 'create_time', 'addtime'];

    public function goods() {
        return $this->hasMany('App\Models\ComshopDeliveryListGoods', 'list_id', 'id');
    }

    public function orders() {
        return $this->hasMany('App\Models\ComshopDeliveryListOrder', 'list_id', 'id');
    }

    public function head() {
        return $this->belongsTo('App\Models\CommunityHead', 'head_id', 'id');
    }
}
