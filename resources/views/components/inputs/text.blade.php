@props([
'id',
'name',
'type',
'readonly' => null,
'disabled' => null,
])
<input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'form-control']) }}
    {{ $attributes }} {{ $readonly }} {{ $disabled }} />
