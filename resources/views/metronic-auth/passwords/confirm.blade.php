@extends('metronic-auth.layout')

@section('content')
<!--begin::Login Sign in form-->
<div class="login-signin">
    <div class="mb-20">
        <h3>{{ __('Confirm Password') }}</h3>
        <div class="text-muted font-weight-bold">{{ __('Please confirm your password before continuing.') }}</div>
    </div>
    <form class="form" id="kt_login_signin_form" method="POST" action="{{ route('password.confirm') }}">
        @csrf
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
        <div class="form-group d-flex flex-wrap align-items-right">
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" id="kt_login_forgot"
                class="text-muted text-hover-primary">{{ __('Forgot Your Password?') }}</a>
            @endif
        </div>
        <button id="kt_login_signin_submit" type="submit"
            class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">{{ __('Confirm Password') }}</button>
    </form>
</div>
<!--end::Login Sign in form-->
@endsection
