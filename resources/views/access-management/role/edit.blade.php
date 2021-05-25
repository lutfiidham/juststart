@extends('layout.default')

@section('content')
<form class="form" id="form" action="{{ route('access_management.roles.update',['role' => $role->id]) }}" method="PUT">
    <x-card>
        <x-slot name="title">
            <h3 class="card-title">{{ __('Form') }}</h3>
        </x-slot>

        @csrf
        @method('PUT')

        <input type="hidden" name="id" id="id" value="{{ $role->id }}">
        <x-inputs.form-group for="name" label="{{ __('Name') }}" required="true">
            <x-inputs.text id="name" name="name" type="text" value="{{ $role->name }}" />
        </x-inputs.form-group>
        @include('access-management.role.include._menu-permission-table')
        @include('access-management.role.include._additional-permission-table')

        <x-slot name="footerLeft">
            <button id="btn-submit" type="button" class="btn btn-primary font-weight-bolder">{{ __('Update') }}</button>
            <span class="ml-2">{{ __('or') }} <a href="{{ route('access_management.roles.index') }}"
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
{!! JsValidator::formRequest('App\Http\Requests\AccessManagement\Role\UpdateRoleRequest', '#form'); !!}

<script>
    $(document).ready(function () {
        $('#btn-submit').on('click', () => update());
        $('#btn-delete').on('click', () => destroy());
    });

    function update() {
        if (!$('#form').validate().form()) {
            return false;
        }

        let menuPermissions = getCheckedPermissions();
        let additionalPermissions = getCheckedAdditionalPermissions();
        let data = {
            id: $('#id').val(),
            name: $('#name').val(),
            menus: getCheckedMenus(),
            permissions: menuPermissions.concat(additionalPermissions),
        };
        MyApp.ajaxPut("{{ route('access_management.roles.update',['role' => $role->id]) }}", data, function (response) {
            MyApp.alert("{{ __('Update') }}","{{ __('Data updated successfully.') }}","success", () => {
                location.href="{{ route('access_management.roles.index') }}";
            });
        });
    }

    function destroy() {
        MyApp.confirm("{{ __('Delete') }}","{{ __('Are you sure you delete this data?') }}", "warning", () => {
            MyApp.ajaxDelete("{{ route('access_management.roles.destroy',['role' => $role->id]) }}", null, function (response) {
                MyApp.alert("{{ __('Delete') }}","{{ __('Data deleted successfully.') }}","success", () => {
                    location.href="{{ route('access_management.roles.index') }}";
                });
            });
        })
    }
</script>
@endpush
