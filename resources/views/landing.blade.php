<!DOCTYPE html>
<html>
  <head lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark light">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">
    <meta name="theme-color" content="#0180FF">

    <script src="{{ mix('js/theme-engine.js') }}"></script>

    @stack('meta')

    <title>Schedulist</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
    @stack('fonts')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/bundle.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/turbo.js') }}"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
  </head>
  <body class="font-sans antialiased theme-div mdc-typography @if($theme == "dark") theme-dark @endif" id="themer"
  x-data="landing()"
  @scroll.window="scrolled()">
    <header>
      <nav class="nav-border base-bg fixed z-10 w-screen py-4" x-bind:class="{'border-b': aboveContent}">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
          <div class="relative flex items-center justify-between" style="height: 4.2rem">
            <div class="schedulist-logo-nav absolute flex flex-1 items-center justify-center sm:items-stretch sm:justify-start md:relative">
              <div class="flex-shrink-0">
                <div class="logo-image mt-6 mb-3 -ml-10 border-none sm:ml-0" style="width: 160px"></div>
              </div>
            </div>
            <div class="absolute w-full">
              <a href="{{ route('themes') }}" class="mdc-icon-button material-icons float-right ml-4" @click="profileMenu = false">
                <div class="mdc-icon-button__ripple"></div>
                <span class="mdc-icon-button__focus-ring"></span>
                <span x-text="themeIcon"></span>
              </a>
              @if(Auth::check())
                <a href="{{ route('profile') }}"class="float-right mt-1.5 max-w-xs rounded-full bg-gray-800 text-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                aria-label="User menu" aria-haspopup="true">
                  <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::User()->profile_photo_url }}" alt="{{Auth::User()->firstname}}" />
                </a>
              @else
                <a class="w-22 mdc-button mdc-button--raised float-right h-11 text-lg" href="{{route('login')}}" wire:ignore>
                  <span class="mdc-button__ripple"></span>
                  <span class="mdc-button__focus-ring"></span>
                  <span class="mdc-button__label font-medium normal-case tracking-normal">Sign In</span>
                </a>
              @endif
            </div>
          </div>
        </div>
      </nav>
    </header>

    <x-ui.snackbar/>
    <x-pwa-snackbar/>

    <main class="min-h-screen overflow-y-auto overflow-x-hidden pt-40 pl-8 md:pl-20">
      <div class="xl:flex">
        <div class="mb-12 max-w-xl pr-2 2xl:max-w-3xl">
          <div class="mt-12 text-6xl font-bold md:text-7xl">School organization made easy</div>
          <p class="mt-6 text-2xl text-gray-600">There are enough things to worry about when it comes to school, without having to figure out how to keep track of it all.</p>
          <p class="mt-6 text-2xl text-gray-600">Meet Schedulist: A convenient location to store all of your classes, assignments, events, and more.</p>
          <a class="mdc-button mdc-button--raised mdc-button--icon-trailing mt-10 h-14 w-72 text-xl" href="{{Auth::check() ? route('dashboard') : route('register')}}" wire:ignore>
            <span class="mdc-button__ripple"></span>
            <span class="mdc-button__focus-ring"></span>
            <span class="mdc-button__label font-medium normal-case tracking-normal">
              @if(Auth::check())
                Go to Dashboard
              @else
                Create an Account
              @endif
            </span>
            <i class="material-icons mdc-button__icon" aria-hidden="true">arrow_forward</i>
          </a>
        </div>
        <div class="float-right -mr-12 h-fit pb-12 xl:mr-0 xl:-mt-6 xl:h-auto">
          <img src="{{ asset('images/landing/landing.png')}}" class="show-light" height="1071" width="787"/>
          <img src="{{ asset('images/landing/landing-dark.png')}}" class="show-dark" height="1071" width="787"/>
        </div>
      </div>
    </main>

    @if (! Auth::check())
      <div id="g_id_onload"
       data-client_id="827540481261-uhs04f4uecph0vpigh7tcek6jdfp7ggl.apps.googleusercontent.com"
       data-login_uri="login/callback/onetap"
       data-auto_select="true"
       data-prompt_parent_id="g_id_onload"
       style="position: absolute; top: 70px; right: 400px;
            width: 0; height: 0; z-index: 1001;">
     </div>
    @endif

    <x-footer/>

    @livewireScripts

    <script src="{{ mix('js/scripts.js') }}" defer></script>
    <script src="{{ mix('js/bundle.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
    @stack('scripts')

    <script>
        Livewire.on('toastMessage', message => {
          snack(message);
        });
    </script>
    <script>
      function landing(){
        return {
          aboveContent: false,
          scrolled: function(){
            if (window.scrollY > 57) 
              this.aboveContent = true
            else
              this.aboveContent = false
          },
          get theme() {
            if (getCookieValue('theme') != undefined)
              return getCookieValue('theme');
            return 'auto';
          },
          get themeIcon() {
            if (this.theme == 'dark')
              return 'dark_mode';
            else if (this.theme == 'light')
              return 'light_mode';
            return 'brightness_auto';
          }
        }
      }
    </script>
  </body>
</html>
