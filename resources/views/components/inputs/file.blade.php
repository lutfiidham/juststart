@props([
'id',
'name',
'disabled' => null
])
<div>
    <div></div>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="{{ $id }}" name="{{ $name }}" {{ $attributes }}
            {{ $disabled }} />
        <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
</div>
