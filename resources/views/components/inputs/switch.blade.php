@props([
'id',
'name',
'checked' => null,
'checkedLabel' => __('Yes'),
'uncheckedLabel' => __('No'),
'size' => 'medium',
'checkedColor' => 'primary',
'uncheckedColor' => null
])
<input id="{{ $id }}" name="{{ $name }}" type="checkbox" {{ $attributes }} data-on-text="{{ $checkedLabel }}"
    data-off-text="{{ $uncheckedLabel }}" data-on-color="{{ $checkedColor }}" data-of-color="{{ $uncheckedColor }}"
    data-size="{{ $size }}" {{ $checked == 'true' ? 'checked' : '' }} />
@push('page_script')
<script>
    $(document).ready(function () {
        $('#{{ $id }}').bootstrapSwitch().trigger('change');
    });
</script>
@endpush
