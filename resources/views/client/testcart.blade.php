@extends('layouts.app')

@section('title')
    Cart
@endsection

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get('success')}}</div>
                {{\Illuminate\Support\Facades\Session::put(null)}}
            @endif
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $product)
                                    @php
                                        $sub_total = $product['product_price']*$product['product_qty'];
                                    @endphp
                                    <tr class="text-center">
                                        <td class="product-remove"><a
                                                href="{{\Illuminate\Support\Facades\URL::to('addtocartremove/'.$product['product_id'])}}"><span
                                                    class="ion-ios-close"></span></a></td>
                                        <td class="image-prod">
                                            <div class="img"
                                                 style="background-image:url({{URL::asset('storage/product_images/'.$product['product_image'].'')}});"></div>
                                        </td>

                                        <td class="product-name">
                                            <h3>{{$product['product_name']}}</h3>
                                            <p>{{$product['product_description']}}</p>
                                        </td>

                                        <td class="price">Tk. {{$product['product_price']}}</td>
                                        <form action="{{URL::to('/addtocartupdate')}}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$product['product_id']}}" name="rowId">
                                            <td class="quantity">
                                                <div class="input-group mb-3">
                                                    <input type="number" name="quantity"
                                                           class="quantity form-control input-number"
                                                           value="{{$product['product_qty']}}">
                                                </div>
                                                <button type="submit" class="btn btn-primary py-3 px-4">Update</button>
                                        </form>
                                        </td>
                                        <td class="total">Tk. {{$sub_total}}</td>
                                    </tr><!-- END TR-->
                                    @php
                                        $total = $total+$sub_total;
                                    @endphp
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Total</h3>
                        <p class="d-flex total-price">
                            {{--<span>Subtotal</span>--}}
                            <span>Tk. {{$total}}</span>
                        </p>
                    </div>
                    <p><a href="{{URL::to('/checkout')}}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

{{--Aditonal Scripts--}}

@section('scripts')

    <script>
        $(document).ready(function () {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function (e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>

@endsection

