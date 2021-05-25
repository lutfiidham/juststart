@extends('layout.default')

@section('content')
<form class="form" id="form" action="{{ route('access_management.users.store') }}" method="POST">
    <x-card>
        <x-slot name="title">
            <h3 class="card-title">{{ __('Form') }}</h3>
        </x-slot>

        @csrf
        <x-inputs.form-group for="name" label="{{ __('Name') }}" required="true">
            <x-inputs.text id="name" name="name" type="text" />
        </x-inputs.form-group>

        <x-inputs.form-group for="email" label="{{ __('Email') }}" required="true">
            <x-inputs.text id="email" name="email" type="email" />
        </x-inputs.form-group>

        <x-inputs.form-group for="password" label="{{ __('Password') }}" required="true">
            <x-inputs.input-group id="password" name="password" type="password" icon="fa fa-eye-slash" />
        </x-inputs.form-group>

        <x-inputs.form-group for="confirm_password" label="{{ __('Confirm Password') }}" required="true">
            <x-inputs.input-group id="confirm_password" name="confirm_password" type="password"
                icon="fa fa-eye-slash" />
        </x-inputs.form-group>

        <x-inputs.form-group for="roles" label="{{ __('Roles') }}" required="true">
            <x-inputs.select2 id="roles" name="roles[]" multiple>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </x-inputs.select2>
        </x-inputs.form-group>

        <x-slot name="footerLeft">
            <button id="btn-submit" type="button" class="btn btn-primary font-weight-bolder">{{ __('Save') }}</button>
            <button id="btn-submit-add-new" type="button"
                class="btn btn-secondary font-weight-bold ml-2">{{ __('Save and Add New') }}</button>
            <span class="ml-2">{{ __('or') }} <a href="{{ route('access_management.users.index') }}"
                    class="font-weight-bold ml-2">{{ __('Cancel') }}</a></span>
        </x-slot>
    </x-card>
</form>
@endsection

@push('page_script')
{!! JsValidator::formRequest('App\Http\Requests\AccessManagement\User\StoreUserRequest', '#form'); !!}

<script>
    $(document).ready(function () {
        $('#btn-submit').on('click', function(e) { store(); });
        $('#btn-submit-add-new').on('click', function(e) { store(true); });

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
    });

    function store(addNew = false) {
        if (!$('#form').validate().form()) {
            return false;
        }
        MyApp.ajaxPost("{{ route('access_management.users.store') }}", $('#form').serialize(), function (response) {
            if (addNew) {
                $('#form')[0].reset();
                $('#form select').val(null).trigger('change');
                MyApp.notify("{{ __('Save') }}","{{ __('Data saved successfully.') }}","success");
                return true;
            }
            MyApp.alert("{{ __('Save') }}","{{ __('Data saved successfully.') }}","success", () => {
                location.href="{{ route('access_management.users.index') }}";
            });
        });
    }
</script>

@endpush
