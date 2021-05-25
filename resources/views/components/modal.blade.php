@props(
['id',
'title',
'type' => 'default', //sm,default, lg, xl
'closeLabel' => __('Close'),
'submitLabel' => __('Submit'),
'static' => 'false']
)

<div class="modal fade" id="{{ $id }}" @if ($static=='true' ) data-backdrop="static" aria-labelledby="staticBackdrop"
    @endif tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog @if ($type != 'default') model-{{ $type }} @endif" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button id="btn-close-{{ $id }}" type="button" class="btn btn-light-primary font-weight-bold"
                    data-dismiss="modal">{{ $closeLabel }}</button>
                <button id="btn-submit-{{ $id }}" type="button"
                    class="btn btn-primary font-weight-bold">{{ $submitLabel }}</button>
            </div>
        </div>
    </div>
</div>
