@props(['id','name', 'disabled' => null])
<select {{ $attributes->merge(['class' => 'form-control']) }} id="{{ $id }}" name="{{ $name }}" {{ $attributes }}
    {{ $disabled }}>
    {{ $slot }}
</select>
