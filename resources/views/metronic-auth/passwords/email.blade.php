@extends('metronic-auth.layout')

@section('content')
<!--begin::Login Sign in form-->
<div class="login-signin">
    <div class="mb-10">
        <h3>{{ __('Reset Password') }}</h3>
        <div class="text-muted font-weight-bold">{{ __('Enter your email to reset your password') }}</div>
    </div>
    @if (session('status'))
    <div class="alert alert-custom alert-success fade show mb-10" role="alert">
        <div class="alert-text">{{ session('status') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
    @endif
    <form class="form" id="kt_login_signin_form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror"
                type="email" placeholder="{{ __('Email') }}" name="email" id="email" autocomplete="off"
                value="{{ old('email') }}" />
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button id="kt_login_signin_submit" type="submit"
            class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">{{ __('Send Password Reset Link') }}</button>

    </form>
</div>
<!--end::Login Sign in form-->
@endsection
