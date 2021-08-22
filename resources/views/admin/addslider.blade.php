@extends('layouts.admin-app')

@section('title')

    Add a Slider

@endsection

@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Slider</h4>
                    @if(\Illuminate\Support\Facades\Session::has('status'))
                        <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get('status')}}</div>
                        {{\Illuminate\Support\Facades\Session::put(null)}}
                    @endif
                    {!!Form::open(['action' => 'SliderController@addSlider', 'class' => 'cmxform', 'method' => 'POST' , 'id' => 'commentForm', 'enctype' => 'multipart/form-data'])!!}
                    <fieldset>
                        <div class="form-group">
                            {{Form::label('description_one', 'Description One (required)')}}
                            {{Form::text('slider_description_one','', ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('description_two', 'Description Two (required)')}}
                            {{Form::text('slider_description_two','', ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('slider_image', 'Slider Image 2000x1350 Size: Max 7MB (required)')}}
                            {{Form::file('slider_image', ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('slider_status', 'Slider Status (required)')}}
                            {{Form::checkbox('slider_status','active', true, ['class' => 'form-control'])}}
                        </div>
                        {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
                    </fieldset>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@endsection
