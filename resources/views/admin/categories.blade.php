@extends('layouts.admin-app')

@section('title')

    Categories

@endsection

@section('content')
    {{Form::hidden('', $sl=1)}}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Categories</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Category Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$sl}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->category_description}}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{\Illuminate\Support\Facades\URL::to('editcategory/'.$category->id.'')}}">Edit</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-danger" href="{{\Illuminate\Support\Facades\URL::to('deletecategory/'.$category->id.'')}}">Delete</a>
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
    <script src="{{asset('backend/js/data-table.js')}}"></script>
@endsection
