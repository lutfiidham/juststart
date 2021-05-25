@props([
'id',
'name',
'type',
'value' => null,
'groupType' => 'append',
'icon' => null,
])
<div class="input-group">
    @if ($groupType == 'prepend')
    <div class="input-group-prepend" id="input-group-{{ $id }}">
        <span class="input-group-text">
            <i class="{{ $icon }}"></i>
        </span>
    </div>
    @endif
    <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" {{ $attributes->merge(['class' => 'form-control']) }}
        {{ $attributes }}>
    @if ($groupType == 'append')
    <div class="input-group-append" id="input-group-{{ $id }}">
        <span class="input-group-text">
            <i class="{{ $icon }}"></i>
        </span>
    </div>
    @endif
</div>
