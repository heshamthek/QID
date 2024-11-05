<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>QID</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        /* Custom navbar styles */
        .navbar {
            background-color: #ffffff; /* White background */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }
        .navbar-brand, .nav-link {
            color: black; /* Blue text color */
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #51eaea; /* Darker blue on hover */
        }
        .dropdown-menu {
            background-color: #ffffff; /* White dropdown background */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }
        .dropdown-item {
            color: black; /* Blue text color */
        }
        .dropdown-item:hover {
            background-color: #f8f9fa; /* Light gray on hover */
            color: #51eaea; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm"> <!-- Change navbar-dark to navbar-light -->
            <div class="container">
            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="10%" height="auto" viewBox="0 0 1500 559" preserveAspectRatio="xMidYMid meet">
                <g data-padding="20">
                    <g transform="translate(10 11.622)scale(.95842)">
                        <path fill="#212121" d="M847.344 496.705q-59.4 0-80.19-41.09-41.58-1.48-71.04-24.75-29.45-23.26-29.45-72.27v-159.39q0-50.98 27.97-77.22 27.97-26.23 76.97-26.23 49.01 0 75.98 27.72 26.98 27.72 26.98 76.23v158.89q0 43.07-22.52 66.08-22.52 23.02-57.17 28.96 13.86 16.83 52.47 16.34Zm0-301.95q0-36.14-21.04-54.45-21.04-18.32-55.69-18.32t-55.44 18.32q-20.79 18.31-20.79 54.45v163.35q0 31.68 17.57 49.74 17.58 18.07 46.29 21.04-1.98-11.88-1.98-28.71v-36.13h27.72v35.64q0 20.29 1.48 28.71 28.22-3.47 45.05-21.04t16.83-49.75Z"/>
                        <rect width="481.2" height="559.35" x="129.184" y="-402.165" fill="none" rx="0" ry="0" transform="translate(402.32 401.99)"/>
                        <path fill="#51eaea" d="M733.5 234.557a22.542 22.542 0 1 0-22.528 39.04l29.069 16.79 22.542-39.04Zm5.431 51.713L712.461 271a19.42 19.42 0 0 1-9.08-11.87 19.42 19.42 0 0 1 1.956-14.819 19.61 19.61 0 0 1 26.674-7.154l26.47 15.286Zm96.453-44.126a22.54 22.54 0 0 0-30.791-8.25l-29.054 16.79 22.528 39.027 29.054-16.79a22.54 22.54 0 0 0 8.263-30.777m-18.425-4.804c-4.526-.335-8.79 3.826-13.17.876l-.291-.233 2.599-1.49c6.073-3.503 13.242-3.357 19.009-.262-.701 2.336-4.76 1.372-8.147 1.11"/>
                        <circle cx="253.277" cy="-70.301" r="3.4" fill="#51eaea" transform="translate(398.12 412.77)scale(1.46)"/>
                        <circle cx="253.277" cy="-72.301" r="2.9" fill="#51eaea" transform="translate(409.88 425.55)scale(1.46)"/>
                        <circle cx="253.277" cy="-69.401" r="2.9" fill="#51eaea" transform="translate(411.65 404.26)scale(1.46)"/>
                        <circle cx="253.277" cy="-83.901" r="2.4" fill="#51eaea" transform="translate(395.1 427.8)scale(1.46)"/>
                        <path fill="#51eaea" d="M773.203 311.82a3.504 3.504 0 1 0 0 7.008 3.504 3.504 0 0 0 0-7.008"/>
                        <circle cx="253.277" cy="-83.901" r="2.4" fill="#51eaea" transform="translate(385.1 425.28)scale(1.46)"/>
                        <circle cx="253.277" cy="-83.901" r="2.4" fill="#51eaea" transform="translate(391.27 441.37)scale(1.46)"/>
                        <circle cx="253.277" cy="-83.901" r="2.4" fill="#51eaea" transform="translate(387.1 405.25)scale(1.46)"/>
                        <circle cx="253.277" cy="-83.901" r="2.4" fill="#51eaea" transform="translate(396.12 393.73)scale(1.46)"/>
                    </g>
                    <path fill="transparent" stroke="transparent" d="M509.5 0h481v559h-481z"/>
                </g>
            </svg>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <!-- Add additional items if needed -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
