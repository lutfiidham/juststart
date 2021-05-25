@extends('metronic-auth.layout')

@section('content')
<!--begin::Login Sign in form-->
<div class="login-signin">
    <div class="mb-20">
        <h3>{{ __('Login') }}</h3>
        <div class="text-muted font-weight-bold">{{ __('Enter your details to login to your account:') }}</div>
    </div>
    <form class="form" id="kt_login_signin_form" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror"
                type="email" placeholder="{{ __('Email') }}" name="email" id="email" autocomplete="email"
                value="{{ old('email') }}" required />
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('password') is-invalid @enderror"
                type="password" placeholder="{{ __('Password') }}" name="password" id="password"
                autocomplete="current-password" required />
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
            <div class="checkbox-inline">
                <label class="checkbox m-0 text-muted">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                    <span></span>{{ __('Remember Me') }}</label>
            </div>
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" id="kt_login_forgot"
                class="text-muted text-hover-primary">{{ __('Forgot Your Password?') }}</a>
            @endif
        </div>
        <button id="kt_login_signin_submit" type="submit"
            class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">{{ __('Login') }}</button>
    </form>
    @if (Route::has('register'))
    <div class="mt-10">
        <span class="opacity-70 mr-4">{{ __('Don\'t have an account yet?') }}</span>
        <a href="{{ route('register') }}" id="kt_login_signup"
            class="text-muted text-hover-primary font-weight-bold">{{ __('Register') }}</a>
    </div>
    @endif
</div>
<!--end::Login Sign in form-->
@endsection
