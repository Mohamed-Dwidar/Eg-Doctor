<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header d-flex">
            <a href="{{ url('/') }}" target="_blank" class="b-brand text-primary d-inline-block">
                <img src="{{ asset('assets/admin/images/logo-h-dark.png') }}" alt="logo" class="logo"
                    style="height: 60px;">
            </a>
        </div>

        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label data-i18n="&nbsp;">&nbsp;</label>
                    <i class="ph-duotone ph-gauge"></i>
                </li>

                <li class="pc-item">
                    <a href="{{ route('dashboard.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-gauge"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="{{ __('messages.dashboard') }}">{{ __('messages.dashboard') }}</span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-files"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="{{ __('messages.pages') }}">{{ __('messages.pages') }}</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>

                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="{{ route('admin.pages') }}"
                                data-i18n="{{ __('messages.list_pages') }}">{{ __('messages.list_pages') }}</a>
                        </li>
                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-files"></i>
                        </span>
                        <span class="pc-mtext" data-i18n="{{ __('messages.blogs') }}">{{ __('messages.blogs') }}</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>

                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="{{ route('admin.blogs') }}"
                                data-i18n="{{ __('messages.list_blogs') }}">{{ __('messages.list_blogs') }}</a>
                        </li>
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>
