@props(['id','name','value','label','disabled' => null])
<label class="checkbox">
    <input type="checkbox" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" {{ $attributes }} {{ $disabled }}>
    <span></span>{{ $label }}
</label>
