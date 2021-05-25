<div class="quick-search-result">
    @if ($menus->count() == 0)

    <div class="text-muted">
        No record found
    </div>

    @else
    <div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
        Search Result: <span class="badge badge-success">{{ $menus->count() }}
            record{{ $menus->count() > 1 ? 's':'' }} found</span>
    </div>
    <div class="mb-10">
        @foreach ($menus as $item)
        <div class="d-flex align-items-center flex-grow-1 mb-2">
            <div class="symbol symbol-30  flex-shrink-0">
                <div class="symbol-label">
                    <i class="{{ $item->icon ?? 'flaticon2-paperplane' }}"></i>
                </div>
            </div>
            <div class="d-flex flex-column ml-3 mt-2 mb-2">
                <a href="{{ url($item->page) }}" class="font-weight-bold text-dark text-hover-primary">
                    {{ $item->title }}
                </a>
                <span class="font-size-sm font-weight-bold text-muted">
                    {{ $item->parent_title ??''  }}
                </span>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
