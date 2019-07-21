<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $uniacid
 * @property int $member_id
 * @property int $agent_id
 * @property int $level_id
 * @property string $community_name
 * @property string $head_name
 * @property string $head_mobile
 * @property int $groupid
 * @property string $wechat
 * @property int $province_id
 * @property int $city_id
 * @property int $country_id
 * @property int $area_id
 * @property string $address
 * @property float $lon
 * @property float $lat
 * @property boolean $state
 * @property boolean $enable
 * @property boolean $rest
 * @property int $apptime
 * @property boolean $is_modify_shipping_method
 * @property boolean $is_modify_shipping_fare
 * @property float $shipping_fare
 * @property int $addtime
 */
class CommunityHead extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ims_lionfish_community_head';

    /**
     * @var array
     */
    protected $fillable = ['uniacid', 'member_id', 'agent_id', 'level_id', 'community_name', 'head_name', 'head_mobile', 'groupid', 'wechat', 'province_id', 'city_id', 'country_id', 'area_id', 'address', 'lon', 'lat', 'state', 'enable', 'rest', 'apptime', 'is_modify_shipping_method', 'is_modify_shipping_fare', 'shipping_fare', 'addtime'];

    public function deliveries() {
        return $this->hasMany('App\Models\ComshopDeliveryList', 'head_id', 'id');
    }
}
