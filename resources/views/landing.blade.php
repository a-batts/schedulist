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
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
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
  <body class="font-sans antialiased theme-div mdc-typography @if($theme == "dark") theme-dark @endif overflow-x-hidden" id="themer"
  x-data="landing()"
  @scroll.window="scrolled()">
    <header>
      @if (! Auth::check())
        <div id="g_id_onload"
        data-client_id="827540481261-uhs04f4uecph0vpigh7tcek6jdfp7ggl.apps.googleusercontent.com"
        data-login_uri="login/callback/onetap"
        data-auto_select="true"
        data-prompt_parent_id="g_id_onload"
        style="position: fixed; top: 70px; right: 400px;
              width: 0; height: 0; z-index: 1001;">
        </div>
      @endif

      <nav class="fixed z-10 w-screen py-4 nav-border base-bg" x-bind:class="{'border-b': aboveContent}">
        <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div class="relative flex items-center justify-between" style="height: 4.2rem">
            <div class="absolute flex items-center justify-center flex-1 schedulist-logo-nav sm:items-stretch sm:justify-start md:relative">
              <div class="flex-shrink-0">
                <div class="mt-6 mb-3 -ml-10 border-none logo-image sm:ml-0" style="width: 160px"></div>
              </div>
            </div>
            <div class="absolute w-full">
              <a href="{{ route('themes') }}" class="float-right ml-4 mdc-icon-button material-icons" @click="profileMenu = false">
                <div class="mdc-icon-button__ripple"></div>
                <span class="mdc-icon-button__focus-ring"></span>
                <span x-text="themeIcon"></span>
              </a>
              @if(Auth::check())
                <a href="{{ route('profile') }}"class="float-right mt-1.5 max-w-xs rounded-full bg-gray-800 text-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                aria-label="User menu" aria-haspopup="true">
                  <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::User()->profile_photo_url }}" alt="{{Auth::User()->firstname}}" />
                </a>
              @else
                <a class="float-right text-lg w-22 mdc-button mdc-button--raised h-11" href="{{route('login')}}" wire:ignore>
                  <span class="mdc-button__ripple"></span>
                  <span class="mdc-button__focus-ring"></span>
                  <span class="font-medium tracking-normal normal-case mdc-button__label">Sign In</span>
                </a>
              @endif
            </div>
          </div>
        </div>
      </nav>
    </header>

    <x-ui.snackbar/>
    <x-pwa-snackbar/>

    <main class="min-h-screen pt-40 pl-8 overflow-x-hidden overflow-y-auto md:pl-20">
      <div class="xl:flex">
        <div class="max-w-xl pr-2 mb-12 2xl:max-w-3xl">
          <div class="mt-12 text-6xl font-bold md:text-7xl">School organization made easy</div>
          <p class="mt-6 text-2xl text-gray-600">You have enough to worry about during the school year. Don't make keeping track of everything more stressful then it already is.</p>
          <p class="mt-6 text-2xl text-gray-600">Meet Schedulist: The easiest way to organize all of your classes, assignments, events, and more.</p>
          <a class="mt-10 text-xl mdc-button mdc-button--raised mdc-button--icon-trailing h-14 w-72" href="{{Auth::check() ? route('dashboard') : route('register')}}" wire:ignore>
            <span class="mdc-button__ripple"></span>
            <span class="mdc-button__focus-ring"></span>
            <span class="font-medium tracking-normal normal-case mdc-button__label">
              {{Auth::check() ? 'Go to Dashboard' : 'Create an Account'}}
            </span>
            <i class="material-icons mdc-button__icon" aria-hidden="true">arrow_forward</i>
          </a>
        </div>
        <div class="float-right pb-12 -mr-12 h-fit xl:mr-0 xl:-mt-6 xl:h-auto">
          <img src="{{ asset('images/landing/landing.png')}}" class="show-light" height="1071" width="787"/>
          <img src="{{ asset('images/landing/landing-dark.png')}}" class="show-dark" height="1071" width="787"/>
        </div>
      </div>
    </main>

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
