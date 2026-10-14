<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- SB Admin CSS -->
    <link href="{{ asset('assets/users/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="{{ asset('assets/users/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

        {{-- Sidebar --}}
        @include('users.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                {{-- Topbar --}}
                @include('users.topbar')

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('assets/users/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/users/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/users/assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
