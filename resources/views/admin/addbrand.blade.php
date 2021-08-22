@extends('layouts.admin-app')

@section('title')

    Add a Brand

@endsection

@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Brand</h4>
                    @if(\Illuminate\Support\Facades\Session::has('status'))
                        <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get('status')}}</div>
                        {{\Illuminate\Support\Facades\Session::put(null)}}
                    @endif
                    @if(\Illuminate\Support\Facades\Session::has('alert'))
                        <div class="alert alert-danger">{{\Illuminate\Support\Facades\Session::get('alert')}}</div>
                        {{\Illuminate\Support\Facades\Session::put(null)}}
                    @endif
                    {!!Form::open(['action' => 'BrandController@addBrand', 'class' => 'cmxform', 'method' => 'POST' , 'id' => 'commentForm', 'enctype' => 'multipart/form-data'])!!}
                    <fieldset>
                        <div class="form-group">
                            {{Form::label('brand_name', 'Brand Name (required)')}}
                            {{Form::text('brand_name','', ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('brand_description', 'Brand Description (required)')}}
                            {{Form::textarea('brand_description',null, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('brand_image', 'Brand Image 350x100 Size: Max 2MB')}}
                            {{Form::file('brand_image', ['class' => 'form-control'])}}
                        </div>
                        {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
                    </fieldset>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
