@extends('metronic-auth.layout')

@section('content')
<div>
    <div class="mb-20">
        <h3>{{ __('Register') }}</h3>
        <div class="text-muted font-weight-bold">Enter your details to create your account</div>
    </div>
    <form class="form" id="kt_login_signup_form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('name') is-invalid @enderror"
                type="text" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" autocomplete="name"
                autofocus required />
            @error('name')
            <div class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror"
                type="email" placeholder="{{ __('Email') }}" name="email" autocomplete="off" value="{{ old('email') }}"
                autocomplete="email" required />
            @error('email')
            <div class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('password') is-invalid @enderror"
                type="password" placeholder="{{ __('Password') }}" name="password" required
                autocomplete="new-password" />
            @error('password')
            <div class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input
                class="form-control h-auto form-control-solid py-4 px-8 @error('password_confirmation') is-invalid @enderror"
                type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required
                autocomplete="new-password" />
            @error('password_confirmation')
            <div class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group d-flex flex-wrap flex-center mt-10">
            <button id="kt_login_signup_submit"
                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('Register') }}</button>
        </div>
    </form>
    <div class="mt-10">
        <span class="opacity-70 mr-4">{{ __('Already have an account?') }}</span>
        <a href="{{ route('login') }}" id="kt_login_signup"
            class="text-muted text-hover-primary font-weight-bold">{{ __('Login') }}</a>
    </div>
</div>
@endsection
