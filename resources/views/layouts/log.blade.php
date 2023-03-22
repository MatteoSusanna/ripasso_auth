<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>

<body>
    
    <div id="app">
    </div>


        <nav class="navbar navbar-expand-md navbar-light my-header">
            <div class="container d-flex justify-content-between">
                <a class="navbar-brand logo-container" href="/"><img class="w-75" src="{{ asset('img/logo.jpeg') }}" alt="bdev logo"></a>
                @if (Auth::user())
                    <div>
                        <ul class="navbar-nav mr-auto">

                            @foreach ($key['linksHeader'] as $link)
                                <li class="nav-item">
                                    <a class="nav-link header-link" href="{{($link['url']=='#')?'#':route($link['url'])}}">{{$link['title']}}
                                        
                                        {{-- sezione notifiche messaggi e recensioni --}}
                                        @if (count(Auth::user()->message) && $link['notifiche'] == 1) 
                                            <div class="notification-container">{{count(Auth::user()->message)}}</div>
                                        @endif
                                        @if (count(Auth::user()->review) && $link['notifiche'] == 2) 
                                            <div class="notification-container">{{count(Auth::user()->review)}}</div>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                            
                        </ul>
                    </div>
                @endif
                

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse logout-container" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link header-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link header-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle header-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right logout-dropdown text-center" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item logout-link" href="{{ route('logout') }}"
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
        
    {{-- </div> --}}

</body>
</html>
