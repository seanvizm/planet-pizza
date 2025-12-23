<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>PizzaPlanet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <link rel="stylesheet" href="{{asset('css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <script>
        // Set theme immediately before page renders to prevent flash
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>

    <style>
        /* Light Theme Styles - Default theme */
        body {
            background-color: #ffffff !important;
            background-image: none !important;
            color: #212529 !important;
            transition: background-color 0.3s ease;
        }

        [data-theme="light"] body {
            background-color: #ffffff !important;
            background-image: none !important;
            color: #212529 !important;
        }

        /* Dark Theme Styles */
        [data-theme="dark"] body {
            background-color: #121618 !important;
            background-image: none !important;
            color: gray !important;
        }

        /* Dark Theme - Navbar */
        [data-theme="dark"] .ftco_navbar {
            background-color: #1a1d21 !important;
        }

        [data-theme="dark"] .navbar-brand,
        [data-theme="dark"] .navbar-brand span {
            color: #ffffff !important;
        }

        [data-theme="dark"] .nav-link {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        [data-theme="dark"] .nav-link:hover {
            color: #ff6b35 !important;
        }

        /* Dark Theme - Footer */
        [data-theme="dark"] .ftco-footer {
            background-color: #121618 !important;
            color: gray !important;
        }

        [data-theme="dark"] .ftco-footer .ftco-heading-2 {
            color: #ffffff !important;
        }

        [data-theme="dark"] .ftco-footer p,
        [data-theme="dark"] .ftco-footer a {
            color: gray !important;
        }

        [data-theme="dark"] .ftco-footer a:hover {
            color: #ff6b35 !important;
        }

        /* Dark Theme - Sections */
        [data-theme="dark"] .ftco-section {
            background-color: #121618;
        }

        [data-theme="dark"] h1, 
        [data-theme="dark"] h2, 
        [data-theme="dark"] h3, 
        [data-theme="dark"] h4, 
        [data-theme="dark"] h5, 
        [data-theme="dark"] h6 {
            color: #ffffff;
        }

        [data-theme="dark"] p {
            color: gray;
        }

        [data-theme="dark"] .container {
            background-color: transparent;
        }

        [data-theme="dark"] .Appcontainer {
            background-color: #121618 !important;
        }

        /* Dark Theme - Dropdowns */
        [data-theme="dark"] .dropdown-menu {
            background-color: #1a1d21;
            border: 1px solid rgba(255,255,255,.15);
        }

        [data-theme="dark"] .dropdown-item {
            color: rgba(255,255,255,0.7);
        }

        [data-theme="dark"] .dropdown-item:hover {
            background-color: #2c3e50;
            color: #ff6b35;
        }

        /* Dark Theme - Cart */
        [data-theme="dark"] .cartown {
            background-color: #1a1d21;
            color: #ffffff;
        }

        [data-theme="dark"] .cart-detail {
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        /* Dark Theme - Forms */
        [data-theme="dark"] input,
        [data-theme="dark"] textarea,
        [data-theme="dark"] select {
            background-color: #2c3e50;
            color: #ffffff;
            border-color: #444;
        }

        [data-theme="dark"] input:focus,
        [data-theme="dark"] textarea:focus,
        [data-theme="dark"] select:focus {
            background-color: #2c3e50;
            border-color: #ff6b35;
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        }

        [data-theme="dark"] #theme-toggle {
            color: rgba(255, 255, 255, 0.7);
        }

        [data-theme="dark"] #theme-toggle:hover {
            color: #ff6b35;
        }

        /* Navbar Light Theme */
        [data-theme="light"] .ftco_navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        [data-theme="light"] .navbar-brand {
            color: #212529 !important;
        }

        [data-theme="light"] .navbar-brand span {
            color: #212529 !important;
        }

        [data-theme="light"] .nav-link {
            color: #495057 !important;
        }

        [data-theme="light"] .nav-link:hover {
            color: #ff6b35 !important;
        }

        /* Ensure nav links stay visible on scroll in light theme */
        [data-theme="light"] .ftco_navbar.scrolled .nav-link,
        [data-theme="light"] .ftco-navbar-light.scrolled .nav-link {
            color: #495057 !important;
        }

        [data-theme="light"] .ftco_navbar.scrolled .navbar-brand,
        [data-theme="light"] .ftco-navbar-light.scrolled .navbar-brand {
            color: #212529 !important;
        }

        [data-theme="light"] .ftco_navbar.scrolled .navbar-brand span,
        [data-theme="light"] .ftco-navbar-light.scrolled .navbar-brand span {
            color: #212529 !important;
        }

        [data-theme="light"] .navbar-toggler {
            border-color: rgba(0,0,0,.1);
        }

        /* Content areas */
        [data-theme="light"] .container {
            background-color: transparent;
        }

        [data-theme="light"] .Appcontainer {
            background-color: #ffffff !important;
        }

        [data-theme="light"] .alert-success {
            background-color: #d1e7dd;
            border-color: #badbcc;
            color: #0f5132;
        }

        [data-theme="light"] .btn-primary {
            background-color: #ff6b35;
            border-color: #ff6b35;
            color: #ffffff;
        }

        [data-theme="light"] .btn-primary:hover {
            background-color: #e55a2a;
            border-color: #e55a2a;
        }

        /* Dropdown menu */
        [data-theme="light"] .dropdown-menu {
            background-color: #ffffff;
            border: 1px solid rgba(0,0,0,.15);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        [data-theme="light"] .dropdown-item {
            color: #212529;
        }

        [data-theme="light"] .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #ff6b35;
        }

        /* Cart dropdown */
        [data-theme="light"] .cartown {
            background-color: #ffffff;
            color: #212529;
        }

        [data-theme="light"] .cart-detail {
            border-bottom: 1px solid #dee2e6;
        }

        [data-theme="light"] .price,
        [data-theme="light"] .text-info {
            color: #ff6b35 !important;
        }

        /* Footer Light Theme */
        [data-theme="light"] .ftco-footer {
            background-color: #ffffff !important;
            color: #212529 !important;
        }

        [data-theme="light"] .ftco-footer .ftco-heading-2 {
            color: #212529 !important;
        }

        [data-theme="light"] .ftco-footer p,
        [data-theme="light"] .ftco-footer a {
            color: #495057 !important;
        }

        [data-theme="light"] .ftco-footer a:hover {
            color: #ff6b35 !important;
        }

        /* Sections and blocks */
        [data-theme="light"] .ftco-section {
            background-color: #f8f9fa;
        }

        [data-theme="light"] h1, 
        [data-theme="light"] h2, 
        [data-theme="light"] h3, 
        [data-theme="light"] h4, 
        [data-theme="light"] h5, 
        [data-theme="light"] h6 {
            color: #212529;
        }

        [data-theme="light"] p {
            color: #495057;
        }

        /* Badge */
        [data-theme="light"] .badge-danger {
            background-color: #dc3545;
        }

        /* Form elements */
        [data-theme="light"] input,
        [data-theme="light"] textarea,
        [data-theme="light"] select {
            background-color: #ffffff;
            color: #212529;
            border-color: #ced4da;
        }

        [data-theme="light"] input:focus,
        [data-theme="light"] textarea:focus,
        [data-theme="light"] select:focus {
            background-color: #ffffff;
            border-color: #ff6b35;
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        }

        /* Theme toggle button */
        #theme-toggle {
            transition: all 0.3s ease;
        }

        #theme-toggle:hover {
            transform: scale(1.1);
        }

        [data-theme="light"] #theme-toggle {
            color: #495057;
        }

        [data-theme="light"] #theme-toggle:hover {
            color: #ff6b35;
        }

        /* Cards and content blocks */
        [data-theme="light"] .block-21,
        [data-theme="light"] .ftco-footer-widget {
            background-color: transparent;
        }

        [data-theme="light"] .meta a {
            color: #6c757d !important;
        }

        [data-theme="light"] .heading a {
            color: #212529 !important;
        }

        [data-theme="light"] .heading a:hover {
            color: #ff6b35 !important;
        }

        /* Menu pricing entry backgrounds */
        [data-theme="dark"] .pricing-entry .text h3 span,
        [data-theme="dark"] .pricing-entry .text .price {
            background-color: #121618 !important;
        }

        [data-theme="light"] .pricing-entry .text h3 span,
        [data-theme="light"] .pricing-entry .text .price {
            background-color: #f5f5f5 !important;
        }

        /* Services section background - hide/adjust pattern for themes */
        [data-theme="dark"] .pizza-services {
            background-color: #f4c430 !important;
            background-image: none !important;
            opacity: 1;
        }

        [data-theme="light"] .pizza-services {
            background-image: none !important;
            background-color: #ffffff !important;
        }

        [data-theme="light"] .pizza-services .heading-section h2 {
            color: #212529 !important;
        }

        [data-theme="light"] .services .icon span {
            color: #495057 !important;
        }

        [data-theme="light"] .services h3 {
            color: #212529 !important;
        }

        [data-theme="light"] .services .media-body {
            color: #495057 !important;
        }

        /* Smooth transitions */
        body,
        .ftco_navbar,
        .nav-link,
        .dropdown-menu,
        .ftco-footer {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Footer minimal margins */
        .ftco-footer {
            margin-top: 0.5rem;
            margin-bottom: 0;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        /* Order Now menu gold background */
        .order-now-link {
            background: linear-gradient(135deg, #d4af37 0%, #f4c430 100%) !important;
            color: #000 !important;
            font-weight: 600 !important;
            padding: 8px 20px !important;
            border-radius: 25px !important;
            transition: all 0.3s ease !important;
            margin-top: 12px !important;
            margin-bottom: 0 !important;
            display: inline-block !important;
            line-height: 1.5 !important;
        }

        .order-now-link:hover {
            background: linear-gradient(135deg, #f4c430 0%, #d4af37 100%) !important;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(244, 196, 48, 0.4);
        }

        /* Ensure consistent styling on scroll */
        .ftco-navbar-light.scrolled .order-now-link,
        .ftco_navbar.scrolled .order-now-link {
            padding: 8px 20px !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        [data-theme="light"] .order-now-link {
            background: #ff6b35 !important;
            color: #ffffff !important;
        }

        [data-theme="light"] .order-now-link:hover {
            background: #e55a2a !important;
            color: #ffffff !important;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                  <a class="navbar-brand" href="{{ url('/') }}" style="display: flex; align-items: center; gap: 10px;">
                      <div style="position: relative; width: 50px; height: 50px;">
                          <div style="position: absolute; top: 0; left: 0; width: 50px; height: 50px; background: linear-gradient(135deg, #c81f05 0%, #d4af37 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(244, 196, 48, 0.4);">
                              <span style="font-size: 28px; transform: rotate(-15deg);">🍕</span>
                          </div>
                      </div>
                      <div style="display: flex; flex-direction: column; line-height: 1;">
                          <span style="font-size: 24px; font-weight: 700; letter-spacing: -1px; background: linear-gradient(135deg, #c81f05 0%, #d4af37 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">PIZZA</span>
                          <span style="font-size: 18px; font-weight: 300; letter-spacing: 3px; color: #fff; text-transform: uppercase;">Planet</span>
                      </div>
                  </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                  </button>
              <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
                  <li class="nav-item"><a href="/pizzas/menu" class="nav-link order-now-link">Order Now</a></li>
                  <li class="nav-item"><a href="/about" class="nav-link">About</a></li>
                  {{-- @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest --}}

                        <li class="nav-item dropdown active">

                            <a data-toggle="dropdown" class="nav-link dropdown-toggle" href="/pizzas/cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span></a>

                            <div class="dropdown-menu cartown">
                                <div class="row total-header-section">
                                    <div class="col-lg-6 col-sm-6 col-6">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                    </div>
                                    @php $total = 0 @endphp
                                    @foreach((array) session('cart') as $id => $details)
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                    @endforeach
                                    <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                        <p>Total: <span class="text-info">£ {{ $total }}</span></p>
                                    </div>
                                </div>
                                @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                        <div class="row cart-detail">
                                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                <img src="{{ url('images/'.$details['image']) }}"  />
                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                <p>{{ $details['name'] }}</p>
                                                <span class="price text-info"> £{{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                        <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                                    </div>
                                </div>
                            </div>

                        </li>

                        <li class="nav-item">
                            <button id="theme-toggle" class="nav-link" style="background: none; border: none; cursor: pointer; display: flex; align-items: center; gap: 5px;" title="Toggle theme">
                                <i class="fa fa-sun-o" id="theme-icon" aria-hidden="true"></i>
                                <span id="theme-text">Light</span>
                            </button>
                        </li>
                </ul>
              </div>
              </div>
        </nav>
        <div class="container">

            @if(session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
            @endif

            @if(session('ordered'))
                <div class="alert alert-success">
                  {{ session('ordered') }}
                </div>
            @endif

        </div>

        @yield('content')
    </div>
</body>

<footer class="ftco-footer ftco-section img">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
            <p style="margin: 0; padding: 10px 0; font-size: 14px;">
                &copy; {{ date('Y') }} PizzaPlanet. All rights reserved. | Crafted with passion for delicious pizzas.
            </p>
            </div>
        </div>
    </div>
</footer>

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/aos.js')}}"></script>
<script src="{{asset('js/jquery.animateNumber.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('js/jquery.timepicker.min.js')}}"></script>
<script src="{{asset('js/scrollax.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{asset('js/google-map.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

<script>
    // Theme switcher functionality
    (function() {
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const themeText = document.getElementById('theme-text');
        const root = document.documentElement;
        
        // Get current theme (already set in head, but update button)
        const currentTheme = localStorage.getItem('theme') || 'light';
        updateThemeButton(currentTheme);
        
        themeToggle.addEventListener('click', function() {
            const theme = root.getAttribute('data-theme');
            const newTheme = theme === 'light' ? 'dark' : 'light';
            
            root.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeButton(newTheme);
        });
        
        function updateThemeButton(theme) {
            if (theme === 'light') {
                themeIcon.className = 'fa fa-sun-o';
                themeText.textContent = 'Light';
            } else {
                themeIcon.className = 'fa fa-moon-o';
                themeText.textContent = 'Dark';
            }
        }
    })();
</script>

</html>
