<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Booleat</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md  pl-0 pr-0 sticky-top t4-bg-nav">
            <div class="container-fluid t4-10vh">
                {{-- Logo --}}




                <div class="col-xl-1 t4-logo t4-h100 p-0">
                    <a class="navbar-brand" href="{{ url('/admin/user') }}">
                        <img src="/images/logo.png" alt="Booleat">
                    </a>
                </div>



                {{-- /Logo --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <ul class="navbar-nav ml-auto col-xl-2 col-md-3 t4-5vh align-items-center justify-content-evenly">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item t4-3vh mb-2 fs-6">
                                <a class=" t4-orange-text " href="{{ route('login') }}"><img src="/images/user.png"
                                        alt="Login Booleat"> {{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item t4-3vh fs-6">
                                    <a class=" t4-orange-text" href="{{ route('register') }}"><img
                                            src="/images/register.png" alt="Register Booleat"> {{ __('Iscriviti') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown t4-orange-text">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle t4-orange-text" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item t4-name-login" href="{{ route('logout') }}"
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
                </button>
                {{-- NAVBAR ADMIN --}}
                <div>
                    @yield('navcategory')
                </div>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto col-xl-2 col-md-3 t4-5vh align-items-center justify-content-evenly">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item t4-3vh">
                                <a class=" t4-orange-text " href="{{ route('login') }}"><img src="/images/user.png"
                                        alt="Login Booleat"> {{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item t4-3vh">
                                    <a class=" t4-orange-text" href="{{ route('register') }}"><img
                                            src="/images/register.png" alt="Register Booleat"> {{ __('Iscriviti') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle t4-orange-text" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>
