@props([
'id',
'name',
'disabled' => null,
'startDate' => null, //format YYYY-MM-DD
'endDate' => null, //format YYYY-MM-DD
'withPredefinedRange' => null,
])
<div class="input-group">
    <input type="text" class="form-control" readonly="readonly" {{ $attributes }} id="{{ $id }}" name="{{ $name }}"
        {{ $disabled }} />
    <div class="input-group-append">
        <span class="input-group-text">
            <i class="la la-calendar-check-o"></i>
        </span>
    </div>
    @push('page_script')
    <script>
        $(document).ready(function () {
            $('#{{ $id }}').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
                buttonClasses: 'btn',
                applyClass: 'btn-primary',
                cancelClass: 'btn-secondary',
                linkedCalendars: false,
                @if($startDate)
                startDate: moment("{{ $startDate }}"),
                @endif
                @if($endDate)
                endDate: moment("{{ $endDate }}"),
                @endif
                @if($withPredefinedRange)
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                @endif
            });
        });
    </script>
    @endpush
</div>
