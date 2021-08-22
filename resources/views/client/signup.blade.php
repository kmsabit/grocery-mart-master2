@extends('client.include.login')

@section('title')
    Sign Up
@endsection

@section('content')
    <div class="limiter">
        <div class="container-login100" style="background-image: url('frontend/login/images/bg-01.jpg');">
            <div class="wrap-login100">
                <form action="{{URL::to('/signup')}}" method="post" class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-logo">
						<a href="{{URL::to('/')}}" class="zmdi zmdi-landscape"></a>
					</span>

                    <span class="login100-form-title p-b-34 p-t-27">
						Sign Up
					</span>
                    @if(\Illuminate\Support\Facades\Session::has('status'))
                        <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get('status')}}</div>
                        {{\Illuminate\Support\Facades\Session::put(null)}}
                    @endif
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <input class="input100" type="email" name="email" placeholder="email">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Sign Up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>
@endsection
