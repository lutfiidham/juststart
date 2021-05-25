<table class="table table-hover" width="100%" id="table-additional-permission">
    <thead>
        <tr>
            <th width="100%" scope="col">{{ __('Additional Permissions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($additionalPermissions as $item)
        <tr>
            <td>
                <x-inputs.checkbox-group>
                    <x-inputs.checkbox id="permission-{{ $item->id }}" name="permission-{{ $item->id }}"
                        value="{{ $item->id }}" label="{{ $item->description }}" class="permission-checkbox" />
                </x-inputs.checkbox-group>
            </td>
        </tr>
        @empty
        <tr>
            <td class="text-center">{{ __('No additional permission available') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>

@push('page_script')
<script>
    const tableAdditionalPermisson = $('#table-additional-permission');

    function getCheckedAdditionalPermissions(params) {
        let result = [];
        tableAdditionalPermisson.find('.permission-checkbox:checked').each(function(e){
            result.push($(this).val());
        });
        return result;
    }
</script>
@endpush
