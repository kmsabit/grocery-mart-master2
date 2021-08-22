@extends('layouts.app')

@section('title')
    Shop
@endsection

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{URL::asset('frontend/images/bg_1.jpg')}});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{\Illuminate\Support\Facades\URL::to('home')}}">Home</a></span>
                        <span>Products</span>
                    </p>
                    <h1 class="mb-0 bread">Products</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mb-5 text-center">
                    <ul class="product-category">
                        <li><a href="{{\Illuminate\Support\Facades\URL::to('shopall')}}" class="">All</a></li>
                        @foreach($categoryThis as $categoryCurrent)
                            <li>
                                <a href="{{\Illuminate\Support\Facades\URL::to('shopcategory/'.$categoryCurrent->id.'')}}"
                                   class="active">{{$categoryCurrent->category_name}}</a></li>@endforeach
                        @foreach($categories as $category)
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('shopcategory/'.$category->id.'')}}"
                                   class="">{{$category->category_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="#" class="img-prod"><img class="img-fluid"
                                                              src="{{URL::asset('storage/product_images/'.$product->product_image.'')}}"
                                                              alt="Colorlib Template">
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="#">{{$product->product_name}}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>Tk. {{$product->product_price}}</span></p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="#"
                                           class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <a href="{{\Illuminate\Support\Facades\URL::to('addtocart/'.$product->id)}}"
                                           class="buy-now d-flex justify-content-center align-items-center mx-1">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                            <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$products->links()}}
        </div>
    </section>
@endsection
