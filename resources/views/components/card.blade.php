<div class="card card-custom" {{ $attributes }}>
    @if (isset($title) || isset($toolbar))
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title align-items-start flex-column">
            @if (isset($title))
            {{ $title }}
            @endif
        </div>
        <div class="card-toolbar">
            @if(isset($toolbar))
            {{ $toolbar }}
            @endif
        </div>
    </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
    @if (isset($footerLeft) || isset($footerRight))
    <div class="card-footer">
        <div class="row">
            @if (isset($footerLeft))
            <div class="col text-left">
                {{ $footerLeft }}
            </div>
            @endif

            @if (isset($footerRight))
            <div class="col text-right">
                {{ $footerRight }}
            </div>
            @endif
        </div>
    </div>
    @endif
</div>
