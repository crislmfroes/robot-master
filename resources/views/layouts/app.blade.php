<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if (!Request::is(['register', 'login']))

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @if (Request::is(['', 'robots/*', 'states/*', 'behaviors/*']))
                <li class="breadcrumb-item active">
                    @if (Request::is(''))
                    Home
                    @else
                    <a href="{{ route('home') }}">Home</a>
                    @endif
                </li>
                @endif
                @if (Request::is(['robots', 'robots/*']))
                <li class="breadcrumb-item active">
                    @if (Request::is('robots'))
                    Robots
                    @else
                    <a href="{{ route('robots.index') }}">Robots</a>
                    @endif
                </li>
                @endif
                @if(Request::is(['behaviors', 'behaviors/*']))
                <li class="breadcrumb-item active">
                    @if (Request::is('behaviors'))
                    Behaviors
                    @else
                    <a href="{{ route('behaviors.index') }}">Behaviors</a>
                    @endif
                </li>
                @endif
                @if(Request::is(['states', 'states/*']))
                <li class="breadcrumb-item active">
                    @if (Request::is('states'))
                    States
                    @else
                    <a href="{{ route('states.index') }}">States</a>
                    @endif
                </li>
                @endif
            </ol>
        </nav>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
