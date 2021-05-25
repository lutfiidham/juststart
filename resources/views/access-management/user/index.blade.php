@extends('layout.default')

@section('content')
<x-card>
    <x-slot name="title">
        <h3 class="card-label">{{ __('User List') }}
        </h3>
    </x-slot>
    <x-slot name="toolbar">

        @if (auth()->user()->can('access-management.users.delete') ||
        auth()->user()->can('access-management.users.deactivate') ||
        auth()->user()->can('access-management.users.reactivate'))

        <div class="dropdown dropdown-inline mr-2">
            <button id="other-action" type="button" class="btn btn-light-primary dropdown-toggle dropdown-toggle-split"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('Other Action') }} </button>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <ul class="navi flex-column navi-hover py-2">
                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                        {{ __('Choose an action:') }}</li>
                    <li class="navi-item">

                        @can('access-management.users.delete')
                        <a href="#" role="button" onclick="confirmDeleteMultiple()" class="navi-link">
                            <span class="navi-icon">
                                <i class="la la-trash"></i>
                            </span>
                            <span class="navi-text">{{ __('Delete Selected') }}</span>
                        </a>
                        @endcan

                        @can('access-management.users.reactivate')
                        <a href="#" role="button" onclick="confirmReactivateMultiple()" class="navi-link">
                            <span class="navi-icon">
                                <i class="la la-check-double"></i>
                            </span>
                            <span class="navi-text">{{ __('Reactivate Selected Users') }}</span>
                        </a>
                        @endcan

                        @can('access-management.users.deactivate')
                        <a href="#" role="button" onclick="confirmDeactivateMultiple()" class="navi-link">
                            <span class="navi-icon">
                                <i class="la la-times"></i>
                            </span>
                            <span class="navi-text">{{ __('Deactivate Selected Users') }}</span>
                        </a>
                        @endcan
                    </li>
                </ul>
            </div>
        </div>
        @endif

        @can('access-management.users.create')
        <a href="{{ route('access_management.users.create') }}" role="button"
            class="btn btn-primary font-weight-bolder mr-2">
            <i class="fas fa-plus icon-sm"></i> {{ __('New Data') }}</a>
        @endcan
    </x-slot>

    <div class="row align-items-center mb-5 mb-lg-12">
        <div class="col-md-10 my-2 my-md-0">
            <div class="input-icon">
                <input type="text" class="form-control" placeholder="{{ __('Search...') }}" id="search-table"
                    autofocus />
                <span><i class="flaticon2-search-1 text-muted"></i></span>
            </div>
        </div>
        <div class="col-md-2 my-2 my-md-0">
            <button class="btn btn-secondary btn-secondary--icon btn-block font-weight-bold"
                onclick="reloadTable()"><span><i class="la la-sync-alt"></i>{{ __('Reload') }}</span>
            </button>
        </div>
    </div>

    <table class="table table-hover rounded" id="table">
        <thead class="thead-light">
            <tr>
                <th></th>
                <th>#</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Roles') }}</th>
                <th>{{ __('Active') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <x-slot name="footerRight">
        @can('access-management.users.view-deleted')
        <a href="{{ route('access_management.users.deleted.index') }}" role="button"
            class="btn btn-text-danger btn-hover-light-danger font-weight-bold mr-2">{{ __('Deleted Users') }}</a>
        @endcan
    </x-slot>
</x-card>
@endsection

{{-- Styles Section --}}
@push('page_style')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('page_script')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    const table = $("#table");
    $(document).ready(function () {
        MyApp.initAjaxBlockPage();
        table.DataTable({
            ajax: {
                url: "{{ route('access_management.users.datatable') }}",
                type: "GET"
            },
            responsive: true,
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            lengthMenu: [10, 25, 50, 100],
            pageLength: 10,
            language: {
                lengthMenu: "Display _MENU_"
            },
            // scrollX: true,
            scrollCollapse: true,
            order: [[1, "asc"]],
            headerCallback: function(thead, data, start, end, display) {
                thead.getElementsByTagName('th')[0].innerHTML = `
                <label class="checkbox checkbox-single">
                    <input type="checkbox" value="" class="select-all-row" />
                    <span></span>
                </label>`;
            },
            columnDefs: [
                { orderable: false, targets: [0,-1,4]},
                {
                    targets: 0,
                    className: "dt-left",
                    render: function(data, type, row, meta) {
                        return `
                        <label class="checkbox checkbox-single">
                            <input type="checkbox" value="${data}" class="select-row"/>
                            <span></span>
                        </label>`;
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row, meta) {
                        const html = data.map(function(item){
                            return `<span class="label label-dark label-pill label-inline mr-2">${item.name}</span>`;
                        }).join('');
                        return html;
                    }
                },
                {
                    targets: 5,
                    render: function(data, type, row, meta) {
                        const labelType = data ? 'success' : 'danger';
                        const labelText = data ? "{{ __('Active') }}" : "{{ __('Non Active') }}";
                        return `<span class="label label-${labelType} label-pill label-inline">${labelText}</span>`;
                    }
                },
                {
                    targets: -1,
                    className: "dt-left",
                    render: function(data, type, row, meta) {
                        return `<a href="${row.edit_url}" title="{{ __('Edit') }}" data-toggle="tooltip" role="button" class="btn btn-sm btn-icon btn-light-primary mr-2">
                            <i class="fas fa-edit"></i>
                        </a> <a href="${row.show_url}" title="{{ __('View') }}" data-toggle="tooltip" role="button"
                            class="btn btn-sm btn-icon btn-light-primary mr-2">
                            <i class="fas fa-search"></i>
                        </a> @can('access-management.users.change-password') <a href="${row.change_password_url}" title="{{ __('Change Password') }}" data-toggle="tooltip" role="button"
                            class="btn btn-sm btn-icon btn-light-primary mr-2">
                            <i class="fas fa-key"></i>
                        </a> @endcan`;
                    }
                },
            ],
            columns: [
                { width: "5%", data: "id" },
                { width: "5%", data: "no" },
                { width: "20%", data: "name" },
                { width: "20%", data: "email" },
                { width: "15%", data: "roles" },
                { width: "15%", data: "active" },
                { width: "18%", data: null }
            ],
            drawCallback: function(){
                KTApp.initTooltips();
                otherActionState();
            },
        });

        table.on("click", ".select-all-row", function () {
            let isChecked = $(this).is(":checked");
            let childCheckbox = $(this).parents('table').find(".select-row");
            childCheckbox.prop("checked", isChecked);
            childCheckbox.each(function(){
                if (isChecked) {
                    $(this).parents('tr').addClass('active');
                } else {
                    $(this).parents('tr').removeClass('active');
                }
            });
            otherActionState();
        });

        table.on("click", ".select-row", function () {
            $(this).parents("tr").toggleClass("active");
            let isAllChecked = countChecked() == countRow();
            $(".select-all-row").prop("checked", isAllChecked);
            otherActionState();
        });

        $("#search-table").on("keyup", function () {
            table.DataTable().search($(this).val()).draw();
        });

    });

    function countChecked() {
        return table.find(".select-row:checked").length;
    }

    function countRow() {
        return table.find("tbody tr").length;
    }

    function reloadTable() {
        table.DataTable().ajax.reload();
    }

    function otherActionState() {
        $("#other-action").prop("disabled", countChecked() == 0);
    }

    function getSelectedData() {
        let selectedRow = [];
        table.find(".select-row:checked").each(function(){
            selectedRow.push($(this).val());
        });
        return selectedRow;
    }

    function confirmDeleteMultiple() {
        return MyApp.confirm("{{ __('Delete Confirmation') }}","{{ __('Are you sure you to delete selected data?') }}","warning",deleteMultiple);
    }

    function deleteMultiple() {
        let selectedRow = getSelectedData();
        let data = {
            users: selectedRow,
        };
        MyApp.ajaxPost("{{ route('access_management.users.destroy_multiple') }}", data, function (response) {
            MyApp.notify("{{ __('Delete') }}","{{ __('Selected data has been deleted successfully') }}","success");
            reloadTable();
        });
    }

    function confirmReactivateMultiple() {
        return MyApp.confirm("{{ __('Reactivate Confirmation') }}","{{ __('Are you sure you to reactivate selected users?') }}","question",reactivateMultiple);
    }

    function reactivateMultiple() {
        let selectedRow = getSelectedData();
        let data = {
            users: selectedRow,
        };
        MyApp.ajaxPost("{{ route('access_management.users.reactivate_multiple') }}", data, function (response) {
            MyApp.notify("{{ __('Delete') }}","{{ __('Selected users has been reactivated successfully') }}","success");
            reloadTable();
        });
    }

    function confirmDeactivateMultiple() {
        return MyApp.confirm("{{ __('Deactivate Confirmation') }}","{{ __('Are you sure you to deactivate selected users?') }}","warning",deactivateMultiple);
    }

    function deactivateMultiple() {
        let selectedRow = getSelectedData();
        let data = {
            users: selectedRow,
        };
        MyApp.ajaxPost("{{ route('access_management.users.deactivate_multiple') }}", data, function (response) {
            MyApp.notify("{{ __('Delete') }}","{{ __('Selected users has been deactivated successfully') }}","success");
            reloadTable();
        });
    }

</script>
@endpush
