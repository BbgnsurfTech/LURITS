@extends('layouts.app')
@section('content')
<div class="login-page-wrap">
        <div class="login-page-content">
            <div class="login-box">
                <div class="item-logo">
                    <img src="{{asset('img/logo2.png')}}" alt="logo">
                </div>
            <a href="{{ route('admin.home') }}">
                {{ trans('panel.site_title') }}
            </a>
            <p class="login-box-msg">
                {{ trans('global.login') }}
            </p>

            @if(session()->has('message'))
                <p class="alert alert-info">
                    {{ session()->get('message') }}
                </p>
            @endif

            <form action="{{ route('login') }}" method="POST" class="login-form">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}"><i class="far fa-envelope"></i>

                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ trans('global.login_password') }}"><i class="fas fa-lock"></i>

                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>


                <div class="form-group d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember-me">
                            <label for="remember">{{ trans('global.remember_me') }}</label>
                        </div>
                </div>
                    <!-- /.col -->
                <div class="form-group">
                    <button type="submit" class="btn-fill-xl radius-30 text-light shadow-orange-peel bg-orange-peel">
                            {{ trans('global.login') }}
                    </button>
                </div>
            </form>


            @if(Route::has('password.request'))
                <p class="mb-1">
                    <a class="forgot-btn" href="{{ route('password.request') }}">
                        {{ trans('global.forgot_password') }}
                    </a>
                </p>
            @endif
            <p class="mb-1">

            </p>
        
        </div>
    </div>
</div>
@endsection

