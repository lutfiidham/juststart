@extends('layout.default')

@section('content')
<div class="row">
    @include('account.include._sidebar')

    <div class="col-lg-8 col-sm-12">
        <form id="form" action="{{ route('account.update_profile') }}" method="POST">
            <x-card>
                <x-slot name="title">
                    <h3 class="card-label font-weight-bolder text-dark">{{ __('Personal Information') }}</h3>
                </x-slot>

                @csrf
                <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                <x-inputs.form-group for="name" label="{{ __('Name') }}" required="true">
                    <x-inputs.text id="name" name="name" type="text" value="{{ $user->name }}" />
                </x-inputs.form-group>
                <x-inputs.form-group for="email" label="{{ __('Email') }}" required="true">
                    <x-inputs.text id="email" name="email" type="email" value="{{ $user->email }}" />
                </x-inputs.form-group>

                <x-slot name="footerLeft">
                    <button id="btn-submit" type="button"
                        class="btn btn-primary font-weight-bolder">{{ __('Update') }}</button>
                </x-slot>
            </x-card>
        </form>
    </div>
</div>
@endsection

@push('page_script')
{!! JsValidator::formRequest('App\Http\Requests\Account\UpdateProfileRequest', '#form'); !!}

<script>
    $(document).ready(function () {
        $('#btn-submit').on('click', function(e) { update(); });
    });

    function update() {
        if (!$('#form').validate().form()) {
            return false;
        }
        MyApp.ajaxPost("{{ route('account.update_profile') }}", $('#form').serialize(), function (response) {
            MyApp.alert("{{ __('Update Profile') }}","{{ __('Your profile information has been updated successfully.') }}","success", () => {
                location.href="{{ route('account.profile') }}";
            });
        });
    }
</script>
@endpush
