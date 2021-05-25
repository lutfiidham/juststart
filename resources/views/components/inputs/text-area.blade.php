@props([
'id',
'name',
'rows' => 3,
'readonly' => null,
'disabled' => null,
])
<textarea name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'form-control']) }} rows="{{ $rows }}"
    {{ $attributes }} {{ $readonly }} {{ $disabled }} />{{ $slot }}</textarea>
