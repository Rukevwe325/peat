<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">

    <!-- Menu Toggle (Mobile) -->
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center w-100">

        <!-- Search Bar -->
        <div class="navbar-nav align-items-center d-none d-md-flex">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." />
            </div>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- 🔔 Notifications -->
            {{-- <li class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle hide-arrow" href="#" data-bs-toggle="dropdown">
                    <i class="bx bx-bell bx-sm"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">3</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header fw-semibold">Notifications</li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="bx bx-user-plus bx-sm"></i>
                                </div>
                                <div>
                                    <span>New user registered</span><br>
                                    <small class="text-muted">2 mins ago</small>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="bx bx-error-circle bx-sm"></i>
                                </div>
                                <div>
                                    <span>Server alert</span><br>
                                    <small class="text-muted">1 hr ago</small>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li><div class="dropdown-divider"></div></li>

                    <li><a class="dropdown-item text-center" href="#">View All</a></li>
                </ul>
            </li> --}}

            <!-- 👤 User Dropdown -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="#" data-bs-toggle="dropdown">

                    @php
                        $admin = Auth::guard('admin')->user();
                    @endphp

                    <div class="avatar avatar-online">
                        <img
                            src="{{ $admin->profile_photo ? asset('storage/' . $admin->profile_photo) : asset('assets/img/default-avatar.png') }}"
                            alt="Profile"
                            class="w-px-40 h-auto rounded-circle"
                        />
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img
                                            src="{{ $admin->profile_photo ? asset('storage/' . $admin->profile_photo) : asset('assets/img/default-avatar.png') }}"
                                            alt="Profile"
                                            class="w-px-40 h-auto rounded-circle"
                                        />
                                    </div>
                                </div>

                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ $admin->user_name }}</span>
                                    <small class="text-muted">{{ $admin->email }}</small>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li><div class="dropdown-divider"></div></li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>

                    <li><div class="dropdown-divider"></div></li>

                    <li>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
