<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <!-- Custom fonts for this template-->
        <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    
        <!-- Custom styles for this template-->
        <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /*Code to change color of active link*/
        .navbar-nav > .active > a, .navbar-nav > .active > a > i{
            color: rgb(223, 71, 89)!important;
        }
        .navbar-nav .nav-item .nav-link span, .navbar-nav .nav-item .nav-link i{
            font-size: 0.9rem;
        }
        .navbar-nav .nav-item .nav-link span:hover{
            color: black;
        }
        .fa-shopping-cart:hover{
            color: rgb(223, 71, 89)!important;
        }
        .ad-img {
            position: relative;
        }
        .text-overlay {
            position: absolute;
            bottom: 35%;
            left: 4%;
        }
        .text-decoration-none {
            text-decoration: none;
        }
        .hot-product-img {
            width: 30%;
            height: 13vh;
            object-fit: cover;
            overflow: hidden;
        }
        .hot-product-desc {
            width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .hot-product:hover {
            background-color: rgb(250, 242, 242);
        }
        
    </style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
</head>
<body>
    <div id="app">
        
        <main>
            @yield('content')
        </main>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("ul.navbar-nav > li").click(function (e) {
             $("ul.navbar-nav > li").removeClass("active");
             $(this).addClass("active");
              });
          });
      </script>
</body>
</html>
