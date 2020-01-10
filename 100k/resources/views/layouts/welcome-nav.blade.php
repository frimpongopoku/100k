<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>100kChallenge</title>

    <!-- Scripts -->
   
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="module" src="{{asset('js/extra/Scanner.js')}}" defer></script>
    <script type="module" src="{{asset('js/extra/100k.js')}}" defer></script>
    <script src="{{ asset('js/extra/anime.js') }}" defer></script>

    <!-- Fonts -->

    <link rel='icon' href="{{asset('default-imgs/100k-footer.png')}}"/>
    {{-- <link rel="fav-ico" href="{{asset('default-imgs/100k-icon.png')}}"> --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Google+Sans:200,300,400,500,700,800,900" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/extra.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="phone-body-fix">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm stick-to-top" style="height:70px;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('default-imgs/100k-ico.png')}}" style="width:190px" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto phone-nav-tweak">
                      <li class="nav-item">
                        <a class="nav-link" href="/">HOME</a>
                     </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#about-anchor">ABOUT US</a>
                     </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#sponsor-anchor">SPONSORS</a>
                     </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#scanner">PLANT WITH US</a>
                     </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#map-anchor">MY TREES</a>
                     </li>

                     @if(Auth::user())
                        <li class="nav-item dropdown">
                          <a style="text-transform:uppercase" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              <b>{{ Auth::user()->name }}</b> <span class="caret"></span>
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
                     @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    {{-- <ul class="navbar-nav ml-auto">
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
                    </ul> --}}
                </div>
            </div>
        </nav>

        
            @yield('content')
      
    </div>

    @yield('custom-js')
  <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap"
    async defer></script>

    
</body>
</html>
