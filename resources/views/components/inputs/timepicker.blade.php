@props([
'id',
'name',
'disabled' => null,
'value' => null,
'minDate' => null, //// format YYYY-MM-DD HH:mm:ss
'maxDate' => null, //// format YYYY-MM-DD HH:mm:ss
])
<div class="input-group date" id="{{ $id.'-element' }}" data-target-input="nearest">
    <input type="text" class="form-control datetimepicker-input" data-target="#{{ $id.'-element' }}" id="{{ $id }}"
        name="{{ $name }}" value="{{ $value }}" {{ $disabled }} />
    <div class="input-group-append" data-target="#{{ $id.'-element' }}" data-toggle="datetimepicker">
        <span class="input-group-text">
            <i class="ki ki-clock"></i>
        </span>
    </div>
    @push('page_script')
    <script>
        $(document).ready(function () {
            $("#{{ $id.'-element' }}").datetimepicker({
                format: "HH:mm",
                buttons: {
                    showToday: true,
                    showClear: true,
                },
                @if($minDate)
                minDate: "{{ $minDate }}",
                @endif
                @if($maxDate)
                maxDate: "{{ $maxDate }}",
                @endif
            });
        });
    </script>
    @endpush
</div>
