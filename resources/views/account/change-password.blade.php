@extends('layout.default')

@section('content')
<div class="row">
    @include('account.include._sidebar')

    <div class="col-lg-8 col-sm-12">
        <form id="form" action="{{ route('account.update_password') }}" method="POST">
            <x-card>
                <x-slot name="title">
                    <h3 class="card-label font-weight-bolder text-dark">{{ __('Change Password') }}</h3>
                </x-slot>

                @csrf
                <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                <x-inputs.form-group for="old_password" label="{{ __('Old Password') }}" required="true">
                    <x-inputs.input-group id="old_password" name="old_password" type="password"
                        icon="fa fa-eye-slash" />
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm font-weight-bold">{{ __('Forgot your password ?') }}</a>
                    @endif
                </x-inputs.form-group>
                <x-inputs.form-group for="new_password" label="{{ __('New Password') }}" required="true">
                    <x-inputs.input-group id="new_password" name="new_password" type="password"
                        icon="fa fa-eye-slash" />
                </x-inputs.form-group>
                <x-inputs.form-group for="confirm_new_password" label="{{ __('Confirm New Password') }}"
                    required="true">
                    <x-inputs.input-group id="confirm_new_password" name="confirm_new_password" type="password"
                        icon="fa fa-eye-slash" />
                </x-inputs.form-group>

                <x-slot name="footerLeft">
                    <button id="btn-submit" type="button"
                        class="btn btn-primary font-weight-bolder">{{ __('Change Password') }}</button>
                </x-slot>
            </x-card>
        </form>
    </div>
</div>
@endsection

@push('page_script')
{!! JsValidator::formRequest('App\Http\Requests\Account\UpdatePasswordRequest', '#form'); !!}

<script>
    $(document).ready(function () {
        $('#input-group-old_password, #input-group-new_password, #input-group-confirm_new_password').on('click', function(e){
            let icon = $(this).find('i');
            let isObsecure = icon.hasClass('fa-eye-slash');
            if (isObsecure) {
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
                $(this).parents('div.input-group').find('input').attr('type','text');
                return;
            }
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
            $(this).parents('div.input-group').find('input').attr('type','password');
        });

        $('#btn-submit').on('click', function(e) { update(); });
    });

    function update() {
        if (!$('#form').validate().form()) {
            return false;
        }
        MyApp.ajaxPost("{{ route('account.update_password') }}", $('#form').serialize(), function (response) {
            MyApp.alert("{{ __('Change Password') }}","{{ __('Your password has been changed successfully.') }}","success", () => {
                location.href="{{ route('account.change_password') }}";
            });
        });
    }
</script>
@endpush
