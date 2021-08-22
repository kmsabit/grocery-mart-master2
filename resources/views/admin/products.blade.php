@extends('layouts.admin-app')

@section('title')

    Products

@endsection

@section('content')
    {{Form::hidden('', $sl=1)}}
    {{Form::hidden('', $badge=null)}}
    {{Form::hidden('', $write=null)}}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Products</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Product Description</th>
                                <th>Product Price</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$sl}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>
                                        <img src="{{URL::asset('storage/product_images/'.$product->product_image.'')}}">
                                    </td>
                                    <td>{{$product->product_description}}</td>
                                    <td>{{$product->product_price}}</td>
                                    <td>
                                        @if($product->product_status == 1)
                                            {{Form::hidden('', $badge="success")}}
                                            {{Form::hidden('', $write="Active")}}
                                        @endif
                                        @if($product->product_status == 0)
                                            {{Form::hidden('', $badge='danger')}}
                                            {{Form::hidden('', $write='Inactive')}}
                                        @endif
                                        <a class="badge badge-{{$badge}}"
                                           href="{{\Illuminate\Support\Facades\URL::to('changestatusproduct/'.$product->id.'')}}">{{$write}}</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-primary"
                                           href="{{\Illuminate\Support\Facades\URL::to('editproduct/'.$product->id.'')}}">Edit</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-danger"
                                           href="{{\Illuminate\Support\Facades\URL::to('deleteproduct/'.$product->id.'')}}">Delete</a>
                                    </td>
                                </tr>
                                {{Form::hidden('', $sl=$sl+1)}}
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="backend/js/data-table.js"></script>
@endsection
