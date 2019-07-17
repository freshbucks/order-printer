<!DOCTYPE html>
<html>
<head>
    <meta charset="gb2312">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>白菜拼拼</title>
    <style>
        body{ text-align: left; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; color: #000; }
        table{ width: 100% }
        td, th { border-bottom: 1px dashed #cccccc; padding: 0 .5em;  text-align: left;}
        p{ margin: 0; padding: 0; }
        /*.half{ width: 960px; margin:0 auto;}*/
        .container{ padding: 0 1.5em;}
        .right{ float: right }
        .center{ text-align: center}
        .header{background: #eeeeee}
        .page{clear: both; page-break-after: always; width: 960px; margin:0 auto;}
        /*tr:nth-child(2n){background: #f7f7f7}*/
    </style>
</head>
<body>
<div>
    @foreach($data as $item)
        <div class="page">
            <div class="half">
                <div class="container">
                    <h1>白菜拼拼配送单 {{substr($today, 0, 10)}}</h1>
                    <div>
                        <p><b>团长信息：</b> <b>{{$item['head_name']}}</b> {{$item['head_mobile']}}</p>
                        <p><b>提货地址：</b>{{$item['head_address']}}</p>
                    </div>
                    <h3>商品汇总</h3>
                    <table>
                        <tr class="header">
                            <th width="8%">序</th>
                            <th width="85%">商品</th>
                            <th width="7%">数量</th>
                        </tr>
                        @foreach($item->goods as $key => $good)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$good['goods_name']}}</td>
                                <td class="center">{{$good['goods_count']}}</td>
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
</div>
</body>
</html>
