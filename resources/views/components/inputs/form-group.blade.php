@props([
'for',
'label',
'required' => false,
'helpText' => null,
])
<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <label for="{{ $for }}">{{ $label }} @if ($required)<span class="text-danger">*</span>@endif</label>
    {{ $slot }}
    <span class="form-text text-muted">{{ $helpText }}</span>
</div>
