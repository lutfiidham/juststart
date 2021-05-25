@if(Breadcrumbs::has())
{{-- Separator --}}
{{-- <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div> --}}
{{-- Breadcrumb --}}
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="flaticon2-shelter text-muted icon-1x"></i></a></li>
    @foreach (Breadcrumbs::current() as $crumbs)
        @if ($crumbs->url() && !$loop->last)
            <li class="breadcrumb-item">
                <a href="{{ $crumbs->url() }}">
                    {{ $crumbs->title() }}
                </a>
            </li>
        @else
            <li class="breadcrumb-item active">
                {{ $crumbs->title() }}
            </li>
        @endif
    @endforeach
</ul>
@endif
