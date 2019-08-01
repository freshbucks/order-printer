<!DOCTYPE html>
<html>
<head>
    <meta charset="gb2312">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>白菜拼拼</title>
    <style>
        body{ text-align: left; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; color: #000; width: 960px; margin:0 auto;}
        table{ width: 100% }
        td, th { border-bottom: 1px dashed #cccccc; padding: 0 .5em;  text-align: left;}
        p{ margin: 0; padding: 0; }
        /*.half{ width: 960px; margin:0 auto;}*/
        .container{ padding: 0 1.5em;}
        .right{ float: right }
        .center{ text-align: center}
        .header{background: #eeeeee}
        .page{clear: both; page-break-after: always;}
        /*tr:nth-child(2n){background: #f7f7f7}*/
    </style>
    <script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=VWQBZ-2G3KX-ZLM4G-TJ7XC-3JARF-RDB5Q"></script>
</head>
<body onload="init()">
<div id="map" style="width: 960px; height: 600px; page-break-after: always;"></div>
<h2>配送路线</h2>
<div id="routes"></div>
<script>
    function init() {
        let qq = window.qq || {};
        let center = new qq.maps.LatLng(36.749441,119.121108);
        let map = new qq.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center
        });
        new qq.maps.Marker({ map, position: center });
        new qq.maps.Label({ map, position: center, content: '<b>仓库</b>' });


        let addresses = {!! $heads !!}, path = [ center ], routes = '<b>仓库</b>';
        addresses.forEach(function (address) {
            let position = address.position = new qq.maps.LatLng(address.lat, address.lon);
            new qq.maps.Label({
                map,
                position,
                content: address.community_name
            });
            path.push(position);
            routes += ' - ' + (address.route.distance/1000).toFixed(1)
                + 'km(' + (address.route.duration/60).toFixed(2) + 'min)'
                + ' -> <b>' + address.community_name + '</b>';
        });
        new qq.maps.Polyline({map, path});
        document.getElementById('routes').innerHTML = routes;
    }
</script>
@foreach($data as $item)
    <div class="page">
        <div class="half">
            <div class="container">
                <div class="center">
                    <h1>白菜拼拼配送单</h1>
                    <h2>{{substr($today, 0, 10)}}</h2>
                </div>
                <div>
                    <p><b>团长信息：</b> <b>{{$item['head_name']}}</b> {{$item['head_mobile']}}</p>
                    <p><b>提货地址：</b>{{$item['head_address']}}</p>
                </div>
                <h3>商品汇总</h3>
                <table>
                    <tr class="header">
                        <th width="8%">序</th>
                        <th width="60%"><span class="right">数量</span>商品</th>
                        <th width="25%"></th>
                        <th width="7%">核对</th>
                    </tr>
                    @foreach($item->goods as $key => $good)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td><span class="right">{{$good['goods_count']}}</span>{{$good['goods_name']}}</td>
                            <td></td>
                            <td class="center">□</td>
                        </tr>
                    @endforeach
                </table>
                <h3>订单列表</h3>
                <table>
                    <tr class="header">
                        <th width="8%">序</th>
                        <th width="60%"><span class="right">数量</span>商品</th>
                        <th width="25%">收件人</th>
                        <th width="7%">签收</th>
                    </tr>
                    @foreach($item->orders as $key => $order)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>
                                @foreach($order->detail->goods as $good)
                                    <p><span class="right">{{$good['quantity']}}</span>{{$good['name']}}</p>
                                @endforeach
                            </td>
                            <td>{{$order->detail['shipping_name']}} {{$order->detail['shipping_tel']}}</td>
                            <td class="center">□</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endforeach
</body>
</html>
