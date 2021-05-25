@php
$direction = config('layout.extras.user.offcanvas.direction', 'right');
@endphp
{{-- User Panel --}}
<div id="kt_quick_user" class="offcanvas offcanvas-{{ $direction }} p-10">
    {{-- Header --}}
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">
            {{ __('User Profile') }}
        </h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>

    {{-- Content --}}
    <div class="offcanvas-content pr-5 mr-n5">
        {{-- Header --}}
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url('{{ asset('media/users/default.jpg') }}')"></div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                    {{ $logged_in_user->name }}
                </a>
                <div class="text-muted mt-1">
                    {{ $logged_in_user->email }}
                </div>
                {{-- <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-icon mr-1">
                                {{ Metronic::getSVG("media/svg/icons/Communication/Mail-notification.svg", "svg-icon-lg svg-icon-primary") }}
                </span>
                <span class="navi-text text-muted text-hover-primary">{{ $logged_in_user->email }}</span>
                </span>
                </a>
            </div> --}}
        </div>
    </div>

    {{-- Separator --}}
    <div class="separator separator-dashed mt-8 mb-5"></div>

    {{-- Nav --}}
    <div class="navi navi-spacer-x-0 p-0">
        {{-- Item --}}
        @if (auth()->user()->can('profile.update') || auth()->user()->can('profile.change-password'))
        <a href="{{ auth()->user()->can('profile.update') ? route('account.profile') : route('account.change_password') }}"
            class="navi-item">
            <div class="navi-link">
                <div class="symbol symbol-40 bg-light mr-3">
                    <div class="symbol-label">
                        {{ Metronic::getSVG("media/svg/icons/General/Notification2.svg", "svg-icon-md svg-icon-success") }}
                    </div>
                </div>
                <div class="navi-text">
                    <div class="font-weight-bold">
                        {{ __('My Account') }}
                    </div>
                    <div class="text-muted">
                        {{ __('Setting your account here') }}
                    </div>
                </div>
            </div>
        </a>
        @endif

        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="navi-item">
            <div class="navi-link">
                <div class="symbol symbol-40 bg-light mr-3">
                    <div class="symbol-label">
                        {{ Metronic::getSVG("media/svg/icons/Navigation/Sign-out.svg", "svg-icon-md svg-icon-danger") }}
                    </div>
                </div>
                <div class="navi-text">
                    <div class="font-weight-bold">
                        {{ __('Sign Out') }}
                    </div>
                </div>
            </div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

</div>
</div>
