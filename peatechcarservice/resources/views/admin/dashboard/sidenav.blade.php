
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
        <a href="{{ url('/dashboard') }}" class="navbar-brand">
            <img src="{{ asset('assets/img/peatechlogo.png') }}" alt="Peamech Logo" width="120">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">

            <li class="menu-item {{ Route::currentRouteName() === 'admin.dashboard.index' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
            @php
                $admin = auth('admin')->user();

                $settingsIncomplete = empty($admin?->start_datetime) || empty($admin?->end_datetime);
            @endphp

            <li class="menu-item {{ str_starts_with(Route::currentRouteName(), 'admin.settings') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.index') }}" class="menu-link position-relative">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div data-i18n="Analytics">Settings</div>

                    @if ($settingsIncomplete)
                        <span class="settings-ping"></span>
                    @endif
                </a>
            </li>

            <style>
                .settings-ping {
                    position: absolute;
                    right: 12px;
                    top: 50%;
                    transform: translateY(-50%);
                    width: 10px;
                    height: 10px;
                    background: #ff3b3b;
                    border-radius: 50%;
                    animation: ping 1.5s infinite;
                }

                @keyframes ping {
                    0% {
                        transform: translateY(-50%) scale(1);
                        opacity: 1;
                    }
                    75%, 100% {
                        transform: translateY(-50%) scale(2);
                        opacity: 0;
                    }
                }

            </style>


            <li class="menu-item {{ str_starts_with(Route::currentRouteName(), 'admin.store') ? 'active' : '' }}">
                <a href="{{ route('admin.store.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-store"></i>
                    <div data-i18n="Analytics">Store Settings</div>
                </a>
            </li>
            <li class="menu-item {{ str_starts_with(Route::currentRouteName(), 'admin.store') ? 'active' : '' }}">
                <a href="{{ route('admin.cars.create') }}" class="menu-link">
                   <i class="menu-icon tf-icons bx bx-car"></i>
                    <div data-i18n="Analytics">Car Sale</div>
                </a>
            </li>

        </ul>


    </aside>