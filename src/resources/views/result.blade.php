<!DOCTYPE html>
<html>
<head>
    <meta charset="gi">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>友家铺子</title>
    <style>
        body{ text-align: left; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; color: #000; }
        td, th { border-bottom: 1px dashed #cccccc; padding: 0 .5em; }
        .half{ width: 50%; float: left; overflow: hidden}
        .container{ padding: 0 1.5em;}
    </style>
</head>
<body>
<div>
    @foreach($data as $store)
        <div class="main">
            <div class="half">
                <div class="container">
                    <h3>友家铺子 - 交接单</h3>
                    <p>
                        <b>店主:</b>
                        <span>{{$store['name']}}</span>
                        <span>-</span><span>{{$store['phone']}}</span> </p>
                    <p>
                        <b>地址:</b>
                        <span>{{$store['address']}}</span>
                    </p>

                    <table>
                        <tr>
                            <th>下单账号</th>
                            <th>【数量】商品名称</th>
                            <th>金额</th>
                        </tr>
                        @foreach($store['orders'] as $order)
                            <tr>
                                <td>j***{{substr($order[0],-4)}}</td>
                                <td>【{{$order[2]}}】{{$order[1]}}</td>
                                <td>{{$order[3]}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <p>售后电话：18018018011</p>
                </div>
            </div>
            <div class="half">
                <div class="container">
                    <h3>友家铺子 - 交接单(底联)</h3>
                    <p>
                        <b>店主:</b>
                        <span>{{$store['name']}}</span>
                        <span>-</span><span>{{$store['phone']}}</span> </p>
                    <p>
                        <b>地址:</b>
                        <span>{{$store['address']}}</span>
                    </p>

                    <table>
                        <tr>
                            <th>下单账号</th>
                            <th>【数量】商品名称</th>
                            <th>金额</th>
                        </tr>
                        @foreach($store['orders'] as $order)
                            <tr>
                                <td>j***{{substr($order[0],-4)}}</td>
                                <td>【{{$order[2]}}】{{$order[1]}}</td>
                                <td>{{$order[3]}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <p>售后电话：18018018011</p>
                </div>
            </div>
        </div>
        <p style="page-break-after: always;">&nbsp;</p>
    @endforeach
</div>
</body>
</html>
