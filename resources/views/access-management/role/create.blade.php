@extends('layout.default')

@section('content')
<form class="form" id="form" action="{{ route('access_management.roles.store') }}" method="POST">
    <x-card>
        <x-slot name="title">
            <h3 class="card-title">{{ __('Form') }}</h3>
        </x-slot>

        @csrf
        <x-inputs.form-group for="name" label="{{ __('Name') }}" required="true">
            <x-inputs.text id="name" name="name" type="text" />
        </x-inputs.form-group>

        @include('access-management.role.include._menu-permission-table')
        @include('access-management.role.include._additional-permission-table')

        <x-slot name="footerLeft">
            <button id="btn-submit" type="button" class="btn btn-primary font-weight-bolder">{{ __('Save') }}</button>
            <button id="btn-submit-add-new" type="button"
                class="btn btn-secondary font-weight-bold ml-2">{{ __('Save and Add New') }}</button>
            <span class="ml-2">{{ __('or') }} <a href="{{ route('access_management.roles.index') }}"
                    class="font-weight-bold ml-2">{{ __('Cancel') }}</a></span>
        </x-slot>
    </x-card>
</form>
@endsection

@push('page_script')
{!! JsValidator::formRequest('App\Http\Requests\AccessManagement\Role\StoreRoleRequest', '#form'); !!}

<script>
    $(document).ready(function () {
        $('#btn-submit').on('click', function(e) { store(); });
        $('#btn-submit-add-new').on('click', function(e) { store(true); });
    });

    function store(addNew = false) {
        if (!$('#form').validate().form()) {
            return false;
        }

        let menuPermissions = getCheckedPermissions();
        let additionalPermissions = getCheckedAdditionalPermissions();
        let data = {
            name: $('#name').val(),
            menus: getCheckedMenus(),
            permissions: menuPermissions.concat(additionalPermissions),
        };
        MyApp.ajaxPost("{{ route('access_management.roles.store') }}", data, function (response) {
            if (addNew) {
                $('#form')[0].reset();
                MyApp.notify("{{ __('Save') }}","{{ __('Data saved successfully.') }}","success");
                return true;
            }
            MyApp.alert("{{ __('Save') }}","{{ __('Data saved successfully.') }}","success", () => {
                location.href="{{ route('access_management.roles.index') }}";
            });
        });
    }
</script>
@endpush
