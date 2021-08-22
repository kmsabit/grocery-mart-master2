<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Grocery Mart</title>
</head>
@php
    foreach ($orderItems as $information){
        $fname = $information->first_name;
        $lname = $information->last_name;
        $add1 = $information->street_address_one;
        $add2 = $information->street_address_two;
        $town = $information->town;
        $zip = $information->zip;
        $phone = $information->phone;
        $email = $information->email;
        $order = $information->order_id;
        $date = $information->date;
        $payment = $information->payment;
    }
@endphp
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 class="card-title">GROCERY MART</h2>
            <p style="font-size: x-small">Address: 203 Fake St. Mountain View, San Francisco, California, USA<br>
            Phone: +23923929210 Email: info@farm.test</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h5 class="card-title">Invoice# {{'GMRT000'.$order}}</h5>
            <p style="font-size: x-small">Order Date: {{$date}}</p>
            <p style="font-size: x-small">Payment Method: {{$payment}}</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h5 class="card-title">Bill To</h5>
            <p style="font-size: x-small">Customer Name: {{$fname.' '.$lname}}<br>
                Address: {{$add1}}<br>
                {{$add2}}<br>
                Town/City: {{$town}}<br>
                Postal Code: {{$zip}}<br>
                Phone: {{$phone}} Email: {{$email}}</p>
        </div>
    </div>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Item Name</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Sub Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orderItems as $orderItem)
        <tr>
            <td><img src="{{URL::asset('storage/product_images/'.$orderItem->product_image.'')}}"
                     class="img-fluid img-thumbnail rounded"></td>
            <td>{{$orderItem->product_name}}</td>
            <td>{{$orderItem->product_price}}</td>
            <td>{{$orderItem->product_quantity}}</td>
            <td>{{$orderItem->cart_sub}}</td>
        </tr>
    @endforeach
    <tr>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>Total=</td>
        <td>{{'Tk.'.$orderItem->cart_total}}</td>
    </tr>
    </tbody>
</table>
</body>
</html>
