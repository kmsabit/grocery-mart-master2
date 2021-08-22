@extends('layouts.admin-app')

@section('title')

    Edit a Category

@endsection

@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Category</h4>
                    @if(\Illuminate\Support\Facades\Session::has('alert'))
                        <div class="alert alert-danger">{{\Illuminate\Support\Facades\Session::get('alert')}}</div>
                        {{\Illuminate\Support\Facades\Session::put(null)}}
                    @endif
                    {!!Form::open(['action' => 'CategoryController@editCategory', 'class' => 'cmxform', 'method' => 'PATCH' , 'id' => 'commentForm'])!!}
                    <fieldset>
                        {{Form::hidden('id', $category->id)}}
                        <div class="form-group">
                            {{Form::label('category_name', 'Category Name (required)')}}
                            {{Form::text('category_name',$category->category_name, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('category_description', 'Category Description (required)')}}
                            {{Form::textarea('category_description',$category->category_description, ['class' => 'form-control'])}}
                        </div>
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    </fieldset>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection

