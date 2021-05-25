<div class="col-lg-4 col-sm-12">
    <x-card>
        <div class="d-flex align-items-center">
            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                <div class="symbol-label"
                    style="background-image:url('http://laravel-metronic-starter.site/media/users/default.jpg')">
                </div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div>
                <span class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ $user->name }}</span>
            </div>
        </div>
        <!--end::User-->
        <!--begin::Contact-->
        <div class="py-9">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">{{ __('Email') }}:</span>
                <span class="text-muted text-hover-primary">{{ $user->email }}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">{{ __('Roles') }}:</span>
                <span class="text-muted text-hover-primary">
                    @foreach ($user->roles as $item)
                    <span
                        class="label label-dark label-pill label-inline {{ !$loop->last ? 'mr-2' : '' }}">{{ $item->name }}</span>
                    @endforeach
                </span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">{{ __('Last Login') }}:</span>
                <span
                    class="text-muted text-hover-primary">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : '-' }}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">{{ __('Created at') }}:</span>
                <span class="text-muted text-hover-primary">{{ $user->updated_at->format('d/m/Y H:i:s') }}</span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold mr-2">{{ __('Last Updated') }}:</span>
                <span class="text-muted text-hover-primary">{{ $user->updated_at->diffForHumans() }}</span>
            </div>
        </div>
        <!--begin::Nav-->
        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
            <div class="navi-item mb-2">
                @can('profile.update')
                <a href="{{ route('account.profile') }}"
                    class="navi-link py-4 {{ request()->route()->getName() == 'account.profile' ? 'active' : '' }}">
                    <span class="navi-icon mr-2">
                        <span class="fas fa-user-edit"></span>
                    </span>
                    <span class="navi-text font-size-lg">{{ __('Personal Information') }}</span>
                </a>
                @endcan
                @can('profile.change-password')
                <a href="{{ route('account.change_password') }}"
                    class="navi-link py-4 {{ request()->route()->getName() == 'account.change_password' ? 'active' : '' }}">
                    <span class="navi-icon mr-2">
                        <span class="fas fa-user-shield"></span>
                    </span>
                    <span class="navi-text font-size-lg">{{ __('Change Password') }}</span>
                </a>
                @endcan
            </div>
        </div>
        <!--end::Nav-->
    </x-card>
</div>
