@extends('layout.default')

@section('content')
<form class="form" id="form" action="{{ route('access_management.users.update_password',['user'=> $user]) }}"
    method="POST">
    <x-card>
        <x-slot name="title">
            <h3 class="card-title">{{ __('Change '.$user->name.' Password') }}</h3>
        </x-slot>

        @csrf
        <input type="hidden" name="id" id="id" value="{{ $user->id }}">

        <x-inputs.form-group for="password" label="{{ __('New Password') }}" required="true">
            <x-inputs.input-group id="password" name="password" type="password" icon="fa fa-eye-slash" />
        </x-inputs.form-group>
        <x-inputs.form-group for="confirm_password" label="{{ __('Confirm New Password') }}" required="true">
            <x-inputs.input-group id="confirm_password" name="confirm_password" type="password"
                icon="fa fa-eye-slash" />
        </x-inputs.form-group>

        <x-slot name="footerLeft">
            <button id="btn-submit" type="submit"
                class="btn btn-primary font-weight-bolder">{{ __('Change Password') }}</button>
            <span class="ml-2">{{ __('or') }} <a href="{{ route('access_management.users.index') }}"
                    class="font-weight-bold ml-2">{{ __('Cancel') }}</a></span>
        </x-slot>

    </x-card>
</form>
@endsection

@push('page_script')
{!! JsValidator::formRequest('App\Http\Requests\AccessManagement\User\ChangePasswordRequest', '#form'); !!}

<script>
    $(document).ready(function () {
        $('#input-group-password, #input-group-confirm_password').on('click', function(e){
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
        $('#btn-delete').on('click', () => destroy());
    });

    function update() {
        if (!$('#form').validate().form()) {
            return false;
        }
        MyApp.ajaxPost("{{ route('access_management.users.update_password',['user' => $user->id]) }}", $('#form').serialize(), function (response) {
            MyApp.alert("{{ __('Change Password') }}","{{ __('User password has been changed successfully.') }}","success", () => {
                location.href="{{ route('access_management.users.index') }}";
            });
        });
    }

</script>

@endpush
