<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ Auth::user()->first_name ?? 'User' }}
                </span>
                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
            </a>
        </li>

    </ul>

</nav>
