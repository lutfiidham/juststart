@extends('layout.default')

@section('content')
<x-card>
    <div class="form-group row my-2">
        <label class="col-4 col-form-label">{{ __('Name') }}:</label>
        <div class="col-8">
            <span class="form-control-plaintext font-weight-bolder">{{ $user->name }}</span>
        </div>
    </div>
    <div class="form-group row my-2">
        <label class="col-4 col-form-label">{{ __('Email') }}:</label>
        <div class="col-8">
            <span class="form-control-plaintext font-weight-bolder">{{ $user->email }}</span>
        </div>
    </div>
    <div class="form-group row my-2">
        <label class="col-4 col-form-label">{{ __('Roles') }}:</label>
        <div class="col-8">
            <span class="form-control-plaintext font-weight-bolder">
                @foreach ($user->roles as $item)
                <span class="label label-dark label-pill label-inline mr-2">{{ $item->name }}</span>
                @endforeach
            </span>
        </div>
    </div>
    <div class="form-group row my-2">
        <label class="col-4 col-form-label">{{ __('Active') }}:</label>
        <div class="col-8">
            <span class="form-control-plaintext font-weight-bolder"><span
                    class="label label-{{ $user->active?'success':'danger' }} label-pill label-inline">{{ $user->active?'Active':'Non Active' }}</span></span>
        </div>
    </div>
    <div class="form-group row my-2">
        <label class="col-4 col-form-label">{{ __('Last Login At') }}:</label>
        <div class="col-8">
            <span
                class="form-control-plaintext font-weight-bolder">{{ $user->last_login_at ? $user->last_login_at->format('l, j F Y H:i') : '-' }}
                @if($user->last_login_at) <span
                    class="font-weight-lighter">({{ $user->last_login_at->diffForHumans() }})</span> @endif</span>
        </div>
    </div>
    <div class="form-group row my-2">
        <label class="col-4 col-form-label">{{ __('Last Login IP') }}:</label>
        <div class="col-8">
            <span class="form-control-plaintext font-weight-bolder">{{ $user->last_login_ip??'-' }}</span>
        </div>
    </div>
    <div class="form-group row my-2">
        <label class="col-4 col-form-label">{{ __('Created At') }}:</label>
        <div class="col-8">
            <span class="form-control-plaintext font-weight-bolder">{{ $user->created_at->format('l, j F Y H:i') }}
                <span class="font-weight-lighter">({{ $user->created_at->diffForHumans() }})</span></span>
        </div>
    </div>
    <div class="form-group row my-2">
        <label class="col-4 col-form-label">{{ __('Last Updated') }}:</label>
        <div class="col-8">
            <span class="form-control-plaintext font-weight-bolder">{{ $user->updated_at->format('l, j F Y H:i') }}
                <span class="font-weight-lighter">({{ $user->updated_at->diffForHumans() }})</span></span>
        </div>
    </div>

    <x-slot name="footerLeft">
        <a href="{{ route('access_management.users.index') }}" role="button"
            class="btn btn-light-primary font-weight-bolder">
            <i class="fa fa-chevron-left icon-sm"></i> {{ __('Back') }}</a>
    </x-slot>
</x-card>
@endsection
