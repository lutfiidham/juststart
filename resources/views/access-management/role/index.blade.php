@extends('layout.default')

@section('content')
<x-card>
    <x-slot name="title">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder">{{ __('Role List') }}</span>
        </h3>
    </x-slot>
    <x-slot name="toolbar">
        @can('access-management.roles.delete')
        <button onclick="confirmDeleteMultiple()" type="button"
            class="btn btn-danger font-weight-bold mr-2 other-actions" disabled>
            <i class="fa fa-trash icon-sm"></i> {{ __('Delete Selected') }}</button>
        @endcan
        @can('access-management.roles.create')
        <a href="{{ route('access_management.roles.create') }}" role="button"
            class="btn btn-primary font-weight-bolder">
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
                <th>{{ __('Role Name') }}</th>
                <th>{{ __('Number of Users') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
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
                url: "{{ route('access_management.roles.datatable') }}",
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
                { orderable: false, targets: [0,-1]},
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
                    targets: -1,
                    className: "dt-left",
                    render: function(data, type, row, meta) {
                        const showButton = `<a href="${row.show_url}" title="{{ __('Show') }}" data-toggle="tooltip" role="button"
                            class="btn btn-sm btn-icon btn-light-primary mr-2">
                            <i class="fas fa-eye"></i>
                        </a>`;
                        return `<a href="${row.edit_url}" title="{{ __('Edit') }}" data-toggle="tooltip" role="button" class="btn btn-sm btn-icon btn-light-primary mr-2">
                            <i class="fas fa-edit"></i>
                        </a>`;
                    }
                },
            ],
            columns: [
                { width: "5%", data: "id" },
                { width: "10%", data: "no" },
                { width: "50%", data: "name" },
                { width: "20%", data: "users_count" },
                { width: "15%", data: null }
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
        $(".other-actions").prop("disabled", countChecked() == 0);
    }

    function confirmDeleteMultiple() {
        return MyApp.confirm("{{ __('Delete Confirmation') }}","{{ __('Are you sure you to delete selected data?') }}","warning",deleteMultiple);
    }

    function deleteMultiple() {
        let selectedRow = [];
        table.find(".select-row:checked").each(function(){
            selectedRow.push($(this).val());
        });
        let data = {
            roles: selectedRow,
        };
        MyApp.ajaxPost("{{ route('access_management.roles.destroy_multiple') }}", data, function (response) {
            MyApp.notify("{{ __('Delete') }}","{{ __('Selected data has been deleted successfully') }}","success");
            reloadTable();
        });
    }

</script>
@endpush
