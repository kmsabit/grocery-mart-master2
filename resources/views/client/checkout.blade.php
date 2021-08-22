@extends('layouts.app')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('frontend/images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span>
                    </p>
                    <h1 class="mb-0 bread">Checkout</h1>
                </div>
            </div>
        </div>
    </div>

    @php
        $first_name = null;
        $last_name = null;
        $street_address_one = null;
        $street_address_two = null;
        $town = null;
        $zip = null;
        $phone = null;
        $email = null;
        foreach ($informations as $information){
            $first_name = $information->first_name;
            $last_name = $information->last_name;
            $street_address_one = $information->street_address_one;
            $street_address_two = $information->street_address_two;
            $town = $information->town;
            $zip = $information->zip;
            $phone = $information->phone;
            $email = $information->email;
        }
    @endphp

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">
                    <form action="{{URL::to('/orderplace')}}" method="POST" class="billing-form">
                        @csrf
                        <h3 class="mb-4 billing-heading">Billing Details</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="{{$first_name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{$last_name}}">
                                </div>
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="streetaddress">Street Address</label>
                                    <input type="text" class="form-control" placeholder="House number and street name"
                                           name="street_address_one" value="{{$street_address_one}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           placeholder="Appartment, suite, unit etc: (optional)"
                                           name="street_address_two" value="{{$street_address_two}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="towncity">Town / City</label>
                                    <input type="text" class="form-control" placeholder="" name="town" value="{{$town }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postcodezip">Postcode / ZIP *</label>
                                    <input type="text" class="form-control" placeholder="" name="zip" value="{{$zip}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" placeholder="" name="phone" value="{{$phone}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">Email Address</label>
                                    <input type="text" class="form-control" placeholder="" name="email" value="{{$email}}">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-xl-5">
                    <div class="row mt-5 pt-3">
                        <div class="col-md-12 d-flex mb-5">
                            <div class="cart-detail cart-total p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Cart Total</h3>
                                <p class="d-flex total-price">
                                    <span>Total Bill</span>
                                    <span>Tk. {{\Gloudemans\Shoppingcart\Facades\Cart::total()}}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="cart-detail p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Payment Method</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="payment" class="mr-2"
                                                          value="Cash On Delivery"> Cash On Delivery</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="payment" class="mr-2"
                                                          value="Bkash/Rocket/Nagad"> Bkash/Rocket/Nagad</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="payment" class="mr-2"
                                                          value="Paypal/Visa Card/MasterCard"> Paypal/Visa
                                                Card/MasterCard</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary py-3 px-4">Place an Order</button>
                            </div>
                        </div>
                    </div>
                </div><!-- .col-md-8 -->
                </form><!-- END -->
            </div>
        </div>
    </section> <!-- .section -->
@endsection

{{--Aditonal Scripts--}}

@section('scripts')
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

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
