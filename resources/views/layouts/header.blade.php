<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>History</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->



    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a href="index.html" class="logo"><img src="{{ asset('assets/images/logo.png') }}" height="60" width="150" alt="logo"></a>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ url('/') }}">{{Auth::user()->name}}
                            Your History
                        </a>
                    </li>
                    <li class="nav-item ml-2">
                        <a href=" {{route('welcome_library')}}"><button id="history" type="submit" class="btn btn-primary">Back
                            </button></a>
                    </li>

                </ul>



        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

@stack('page_scripts')



</html>