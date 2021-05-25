@php
$direction = config('layout.extras.search.offcanvas.direction', 'right');
@endphp
{{-- Search Panel --}}
<div id="kt_quick_search" class="offcanvas offcanvas-{{ $direction }} p-10">

    {{-- Header --}}
    <div class="offcanvas-header d-flex align-items-center justify-content-between mb-5">
        <h3 class="font-weight-bold m-0">
            Search Menu
            <small class="text-muted font-size-sm ml-2"></small>
        </h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_search_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>

    {{-- Content --}}
    <div class="offcanvas-content">
        {{-- Container --}}
        <div class="quick-search quick-search-offcanvas quick-search-has-result" id="kt_quick_search_offcanvas">
            {{-- Form --}}
            <form method="get" class="quick-search-form border-bottom pt-5 pb-1">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            {{ Metronic::getSVG("media/svg/icons/General/Search.svg", "svg-icon-lg") }}
                        </span>
                    </div>
                    <input type="text" class="form-control " placeholder="Search..." />
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="quick-search-close ki ki-close icon-sm text-muted"></i>
                        </span>
                    </div>
                </div>
            </form>

            {{-- Wrapper --}}
            <div class="quick-search-wrapper pt-5">
            </div>
        </div>
    </div>
</div>
