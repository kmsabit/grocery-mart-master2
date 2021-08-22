@extends('client.include.login')

@section('title')
    Login
@endsection

@section('content')
<div class="limiter">
    <div class="container-login100" style="background-image: url('frontend/login/images/bg-01.jpg');">
        <div class="wrap-login100">
            <form action="{{URL::to('/login')}}" method="post" class="login100-form validate-form">
                @csrf
					<span class="login100-form-logo">
                        <a href="{{URL::to('/')}}" class="zmdi zmdi-landscape"></a>
					</span>

                <span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
                @if(\Illuminate\Support\Facades\Session::has('status'))
                    <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get('status')}}</div>
                    {{\Illuminate\Support\Facades\Session::forget('status')}}
                @endif
                @if(\Illuminate\Support\Facades\Session::has('alert'))
                    <div class="alert alert-danger">{{\Illuminate\Support\Facades\Session::get('alert')}}</div>
                    {{\Illuminate\Support\Facades\Session::forget('alert')}}
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
                <div class="wrap-input100 validate-input" data-validate="Enter Email">
                    <input class="input100" type="email" name="email" placeholder="email">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="pass" placeholder="Password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>
                </form>
                <div class="text-center p-t-90">
                    <a class="txt1" href="#">
                        Forgot Password?
                    </a>
                </div>

                <div class="text-center p-t-10">
                    <a class="txt1" href="{{URL::to('/signup')}}">
                        Not Registered? Click Here to Sign Up
                    </a>
                </div>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>
@endsection
