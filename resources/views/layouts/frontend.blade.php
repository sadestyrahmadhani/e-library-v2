<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="base-url" content="{{ url('/') }}">
    <meta name="asset-url" content="{{ asset('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}} | E - Library Apps</title>

    <link rel="apple-touch-icon" href="{{ asset('storage/images/favicon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
</head>
<body>
    {{-- Begin Top Bar --}}
    <div class="container">
        <div class="row">
            <div class="col-6 py-3">
                <img src="{{ asset('storage/images/Logo.png') }}" alt="" height="50">
            </div>
            <div class="col-6 align-items-center d-flex">
                <div class="col-md-6 ms-auto d-none d-md-block">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-search" placeholder="Search...">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-search"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                @if(!is_null(getInfoLogin()))
                <div class="ms-auto">
                    <a class="nav-link text-muted" href="#" data-bs-toggle="dropdown">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="me-3 d-none d-md-block">
                                <strong class="p-0 m-0">{{ ucfirst(getInfoLogin()->name) }}</strong>
                                <p class="p-0 m-0 small text-muted">{{ getInfoLogin()->role }}</p>
                            </div>
                            <span><img class="round" src="{{ 'https://ui-avatars.com/api/?name=' . getInfoLogin()->name . '&&background=random' }}" alt="avatar" height="40" width="40"></span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="page-user-profile.html"><i class="feather icon-user"></i> Edit Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('auth.logout') }}"><i class="feather icon-power"></i> Logout</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupport"><span class="navbar-toggler-icon"></span></button>
            <div class="navbar-collapse collapse" id="navbarSupport">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">Contact Us</a>
                    </li>
                </ul>
            </div>
            @if(is_null(getInfoLogin()))
                <div class="ms-auto">
                    <a href="{{ route('auth') }}" class="btn btn-primary btn-custom-left">Login</a>
                    <a href="{{ route('auth.register') }}" class="btn btn-primary btn-custom-right">Register</a>
                </div>
            @endif
        </div>
    </nav>
    {{-- End Top Bar --}}
    
    @yield('content')

    {{-- footer --}}
    <footer class="page-footer bg-primary p-5 text-center text-light">
        Copyright&copy; 2022 | E - Library Apps
    </footer>

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    @yield('_js')
</body>
</html>