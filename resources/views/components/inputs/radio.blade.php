@props(['id','name','value','label','type' => 'primary', 'disabled' => null])
<label class="radio radio-{{ $type }}">
    <input type="radio" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" {{ $attributes }} {{ $disabled }}>
    <span></span>{{ $label }}
</label>
