<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Schedulist</title>
        <meta name="theme-color" content="#0180FF">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('/site.webmanifest') }}">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/bundle.css?v=5') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css?v=5') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css?v=5') }}">
        @if(($theme != "auto") || Request::is('user/theme'))
          <style>
          .theme-div, .class-card, .options_card {
            transition: background-color 0.6s ease, color 0.7s ease, border-color 0.6s ease;
          }
          </style>
        @endif
        <!-- Scripts -->
        <script src="{{ mix('js/scripts.js') }}" defer></script>
        <script src="{{ mix('js/bundle.js') }}" defer></script>
        <script src="{{ mix('js/turbo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpine-turbo-drive-adapter@1.0.x/dist/alpine-turbo-drive-adapter.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
        <script src="{{ mix('js/theme-engine.js') }}"></script>
    </head>
    <body class="antialiased mdc-typography theme-div @if($theme == "dark") theme-dark @endif" id="themer" style="width: 100vw; height: 100vh">
        <header>
          @livewire('navigation-menu')
        </header>
        <!--
          <div id="g_id_onload"
               data-client_id="827540481261-uhs04f4uecph0vpigh7tcek6jdfp7ggl.apps.googleusercontent.com"
               data-login_uri="https://schedulist.xyz/login/google/onetap">
          </div>
        -->
        <div class="content-div py-12 welcome_container">
            <img src="{{ asset('images/branding/branding_1.svg') }}" width="200px" style="position: absolute; right: 10%; z-index: -1; top: 130px">
            <img src="{{ asset('images/branding/branding_2.svg') }}" width="400px" style="position: absolute; left: -20px; z-index: -3; top: 480px">
            <img src="{{ asset('images/branding/branding_3.svg') }}" width="400px" style="position: absolute; left: 110px; z-index: -5; top: 370px">
            <div class="max-w-7x ml-auto mr-auto welcome-div">
                <br>
                <h1 class="mdc-typography--headline2 mt-10" style="font-family: 'Nunito';">Welcome to <div class="logoimage" style="height: 60px; display: inline-block;"></div></h1>
                <p class="mdc-typography--headline5 mdc-typography text-gray-700 mt-4" style="text-align: center;">Helpful organization for online classes</p>
                @auth
                  <a href="{{route('dashboard') }}">
                    <button class="mdc-button mdc-button--raised mdc-button-ripple mt-80 lowercase-text welcome_button fs-20">
                      <div class="mdc-button__ripple"></div>
                      <span class="mdc-button__label">Go to dashboard</span>
                    </button>
                  </a>
                @endauth
                @guest
                  <a href="{{route('register') }}">
                    <button class="mdc-button mdc-button--raised mdc-button-ripple mt-80 lowercase-text welcome_button fs-20">
                      <div class="mdc-button__ripple"></div>
                      <span class="mdc-button__label">Sign Up</span>
                    </button>
                  </a>
                @endguest
            </div>
        </div>

        @livewireScripts
        <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
    </body>
</html>
