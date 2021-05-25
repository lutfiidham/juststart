@props([
'id',
'name',
'placeholder' => null,
'remoteUrl' => null,
'allowClear' => 'false',
'maximumSelection' => null,
'dependOn' => null, //other element value, write element id here, separate by ','. Ex: province_id,regency_id
'disabled' => null
])
<select {{ $attributes->merge(['class' => 'form-control']) }} id="{{ $id }}" name="{{ $name }}" {{ $attributes }}>
    <option></option>
    {{ $slot }}
    @push('page_script')
    <script>
        $(document).ready(function () {
            $("#{{ $id }}").select2({
                placeholder: "{{ $placeholder? $placeholder : (!$attributes->has('multiple') ? __('Please select one item') : __('Please select at least one item')) }}",
                allowClear: {{ $allowClear }},
                @if($attributes->has('multiple') && $maximumSelection)
                maximumSelectionLength: {{ $maximumSelection }},
                @endif
                @if($remoteUrl)
                ajax: {
                    url: "{{ $remoteUrl }}",
                    dataType: 'json',
                    delay: 200,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                            @php
                            $elements = explode(',', $dependOn);
                            @endphp
                            @foreach($elements as $el)
                            {{ $el }}: $('#{{ $el }}').val(),
                            @endforeach
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.map(function(item){
                                return {
                                    id: item.id,
                                    text: item.text,
                                };
                            }),
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            },
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
                @endif
            });
        });
    </script>
    @endpush
</select>
