@extends('layouts.admin-app')

@section('title')

    Brands

@endsection

@section('content')
    {{Form::hidden('', $sl=1)}}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Brands</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Brand Name</th>
                                <th>Brand Image</th>
                                <th>Brand Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{$sl}}</td>
                                    <td>{{$brand->brand_name}}</td>
                                    <td>
                                        <img src="{{URL::asset('storage/brand_images/'.$brand->brand_image.'')}}">
                                    </td>
                                    <td>{{$brand->brand_description}}</td>
                                    <td>
                                        <a class="btn btn-outline-primary"
                                           href="{{\Illuminate\Support\Facades\URL::to('editbrand/'.$brand->id.'')}}">Edit</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-danger"
                                           href="{{\Illuminate\Support\Facades\URL::to('deletebrand/'.$brand->id.'')}}">Delete</a>
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
