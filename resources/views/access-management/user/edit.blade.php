@extends('layout.default')

@section('content')
<form class="form" id="form" action="{{ route('access_management.users.update',['user'=> $user]) }}" method="PUT">
    <x-card>
        <x-slot name="title">
            <h3 class="card-title">{{ __('Form') }}</h3>
        </x-slot>
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="id" value="{{ $user->id }}">
        <x-inputs.form-group for="name" label="{{ __('Name') }}" required="true">
            <x-inputs.text id="name" name="name" type="text" value="{{ $user->name }}" />
        </x-inputs.form-group>

        <x-inputs.form-group for="email" label="{{ __('Email') }}" required="true">
            <x-inputs.text id="email" name="email" type="email" value="{{ $user->email }}" />
        </x-inputs.form-group>

        <x-inputs.form-group for="roles" label="{{ __('Roles') }}" required="true">
            <x-inputs.select2 id="roles" name="roles[]" multiple>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ in_array($role->id, $grantedRoles) ? 'selected' : '' }}>
                    {{ $role->name }}</option>
                @endforeach
            </x-inputs.select2>
        </x-inputs.form-group>

        <x-slot name="footerLeft">
            <button id="btn-submit" type="submit" class="btn btn-primary font-weight-bolder">{{ __('Update') }}</button>
            <span class="ml-2">{{ __('or') }} <a href="{{ route('access_management.users.index') }}"
                    class="font-weight-bold ml-2">{{ __('Cancel') }}</a></span>
        </x-slot>

        @can('access-management.roles.delete')
        <x-slot name="footerRight">
            <button id="btn-delete" type="button" class="btn btn-danger font-weight-bold">{{ __('Delete') }}</button>
        </x-slot>
        @endcan
    </x-card>
</form>
@endsection

@push('page_script')
{!! JsValidator::formRequest('App\Http\Requests\AccessManagement\User\UpdateUserRequest', '#form'); !!}

<script>
    $(document).ready(function () {
        $('#btn-submit').on('click', function(e) { update(); });
        $('#btn-delete').on('click', () => destroy());
    });

    function update() {
        if (!$('#form').validate().form()) {
            return false;
        }
        MyApp.ajaxPut("{{ route('access_management.users.update',['user' => $user->id]) }}", $('#form').serialize(), function (response) {
            MyApp.alert("{{ __('Update') }}","{{ __('Data updated successfully.') }}","success", () => {
                location.href="{{ route('access_management.users.index') }}";
            });
        });
    }

    function destroy() {
        MyApp.confirm("{{ __('Delete') }}","{{ __('Are you sure you delete this data?') }}", "warning", () => {
            MyApp.ajaxDelete("{{ route('access_management.users.destroy',['user' => $user->id]) }}", null, function (response) {
                MyApp.alert("{{ __('Delete') }}","{{ __('Data deleted successfully.') }}","success", () => {
                    location.href="{{ route('access_management.users.index') }}";
                });
            });
        })
    }
</script>

@endpush
