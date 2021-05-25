@extends('metronic-auth.layout')

@section('content')
<!--begin::Login Sign in form-->
<div class="login-signin">
    <div class="mb-20">
        <h3>{{ __('Verify Your Email Address') }}</h3>
        <div class="text-muted font-weight-bold">
            {{ __('Before proceeding, please check your email for a verification link.') }}
        </div>
        <div class="text-muted font-weight-bold">
            {{ __('If you did not receive the email, ') }}
            <form class="form" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit"
                    class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>
</div>
<!--end::Login Sign in form-->
@endsection
