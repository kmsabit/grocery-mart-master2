@extends('layouts.admin-app')

@section('title')

    Add a Product

@endsection

@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Product</h4>
                    @if(\Illuminate\Support\Facades\Session::has('status'))
                        <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get('status')}}</div>
                        {{\Illuminate\Support\Facades\Session::put(null)}}
                    @endif
                    @if(\Illuminate\Support\Facades\Session::has('alert'))
                        <div class="alert alert-danger">{{\Illuminate\Support\Facades\Session::get('alert')}}</div>
                        {{\Illuminate\Support\Facades\Session::put(null)}}
                    @endif
                    {!!Form::open(['action' => 'ProductController@addProduct', 'class' => 'cmxform', 'method' => 'POST' , 'id' => 'commentForm', 'enctype' => 'multipart/form-data'])!!}
                    <fieldset>
                        <div class="form-group">
                            {{Form::label('product_name', 'Product Name (required)')}}
                            {{Form::text('product_name','', ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('product_description', 'Product Description')}}
                            {{Form::textarea('product_description',null, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('product_price', 'Product Price (required)')}}
                            {{Form::number('product_price','', ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('product_category', 'Product Category')}}
                            {{Form::select('product_category',$categories,'', ['placeholder' => 'Select Category', 'class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('product_brand', 'Product Brand')}}
                            {{Form::select('product_brand',$brands,'', ['placeholder' => 'Select Brand', 'class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('product_image', 'Product Image 500x500 File Size: Max 2MB')}}
                            {{Form::file('product_image', ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('product_status', 'Product Status')}}
                            {{Form::checkbox('product_status','active', true, ['class' => 'form-control'])}}
                        </div>
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    </fieldset>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
