@extends('metronic-auth.layout')

@section('content')
<!--begin::Login Sign in form-->
<div class="login-signin">
    <div class="mb-20">
        <h3>{{ __('Reset Password') }}</h3>
        <div class="text-muted font-weight-bold">{{ __('Enter your new password to reset your password:') }}</div>
    </div>
    <form class="form" id="kt_login_signin_form" method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror"
                type="email" placeholder="{{ __('Email') }}" name="email" id="email" autocomplete="email"
                value="{{ $email ?? old('email') }}" readonly />
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('password') is-invalid @enderror"
                type="password" placeholder="{{ __('Password') }}" name="password" id="password"
                autocomplete="new-password" />
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8" type="password"
                placeholder="{{ __('Confirm Password') }}" name="password_confirmation" id="password-confirm"
                autocomplete="new-password" />
        </div>
        <button id="kt_login_signin_submit" type="submit"
            class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">{{ __('Reset Password') }}</button>
    </form>
</div>
<!--end::Login Sign in form-->
@endsection
