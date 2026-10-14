<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- LEFT: Logo -->
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ asset('assets/img/peatechlogo.png') }}" alt="Peatech Logo" width="120">
        </a>

        <!-- TOGGLER (Mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarFlex">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- CENTER + RIGHT -->
        <div class="collapse navbar-collapse" id="navbarFlex">

            <!-- CENTER: Nav Links -->
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link active">Home</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="shopsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Auto Shops Nearby
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="shopsDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ url('/shops') }}">Shops near you</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/cars-for-sale') }}">Cars for Sale</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- RIGHT: Account Button -->
           <div class="d-flex justify-content-center justify-content-lg-end mt-3 mt-lg-0">
                <div class="dropdown">
                    <button 
                        class="btn btn-primary px-4 py-2 dropdown-toggle" 
                        type="button" 
                        id="accountDropdown" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                        Account
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ url('/userregister') }}">
                                Register
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/login') }}">
                                Login
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>

    </div>
</nav>
