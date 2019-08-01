<!DOCTYPE html>
<html>
<head>
    <meta charset="gb2312">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>白菜拼拼</title>
</head>
<body>
<table>
    <tr>
        <th>ID</th>
        <th>商品名</th>
        <th>市场价</th>
        <th>实时价</th>
    </tr>
@foreach($goods as $good)
    <tr>
        <td>{{$good->id}}</td>
        <td>{{$good->goodsname}}</td>
        <td>{{$good->productprice}}</td>
        <td>{{$good->price}}</td>
    </tr>
@endforeach
</table>
</body>
</html>
