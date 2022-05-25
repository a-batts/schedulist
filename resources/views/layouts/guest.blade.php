<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(Request::is('privacy-policy')) style="scroll-behavior: smooth" @endif>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('/site.webmanifest') }}">
        <meta name="theme-color" content="#0180FF">

        <script src="{{ mix('js/theme-engine.js') }}"></script>

        @stack('meta')

        <title>{{$title ?? 'Schedulist'}}</title>
        <title>Schedulist</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wdth,wght@75,724&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/bundle.css') }}">
        <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/turbo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpine-turbo-drive-adapter@1.0.x/dist/alpine-turbo-drive-adapter.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
        <script src="{{ mix('js/scripts.js') }}" async></script>
    </head>
    <body class="theme-div @if($theme == "dark") theme-dark @endif" id="themer">
      <header
      x-data="{
        aboveContent: false,
        scrolled: function(){
          if (window.scrollY > 36) 
            this.aboveContent = true
          else
            this.aboveContent = false
        },
        get theme() {
          if (getCookieValue('theme') != undefined)
            return getCookieValue('theme')
          return 'auto'
        },
        get themeIcon() {
          if (this.theme == 'dark')
            return 'dark_mode'
          else if (this.theme == 'light')
            return 'light_mode'
          return 'brightness_auto'
        }
      }"
      @scroll.window="scrolled()">
        <nav class="fixed z-10 w-screen py-4 nav-border base-bg" x-bind:class="{'border-b': aboveContent}">
          <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between" style="height: 4.2rem">
              <div class="absolute flex items-center justify-center flex-1 md:relative schedulist-logo-nav sm:items-stretch sm:justify-start">
                <a href="{{ route ('landing') }}" class="z-20 overflow-y-auto">
                  <div class="flex-shrink-0">
                    <div class="mt-6 mb-3 -ml-10 border-none sm:ml-0 logo-image" style="width: 160px;">
                    </div>
                  </div>
                </a>
              </div>
              <div class="absolute w-full">
                <a href="{{ route('themes') }}" class="float-right ml-4 mdc-icon-button material-icons theme-text-primary" @click="profileMenu = false">
                  <div class="mdc-icon-button__ripple"></div>
                  <span class="mdc-icon-button__focus-ring"></span>
                  <span x-text="themeIcon"></span>
                </a>
                @if(Auth::check())
                  <a href="{{ route('dashboard') }}"class="float-right max-w-xs mt-1.5 text-sm transition duration-150 ease-in-out bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                  aria-label="User menu" aria-haspopup="true">
                    <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::User()->profile_photo_url }}" alt="{{Auth::User()->firstname}}" />
                  </a>
                @else
                  <a class="float-right text-lg w-22 h-11 mdc-button mdc-button--raised" href="{{route('login')}}" wire:ignore>
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

      <div class="antialiased content-div mdc-typography">
          {{ $slot }}
      </div>

      <x-footer/>

      @livewireScripts
      <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
      <script src="{{ mix('js/bundle.js') }}" defer></script>
      <script type="module">
        import {Workbox, messageSW} from 'https://storage.googleapis.com/workbox-cdn/releases/6.1.1/workbox-window.prod.mjs';

        if ('serviceWorker' in navigator) {
          const wb = new Workbox('/service-worker.js');
          let registration;

          window.addEventListener('updatePWA', function (e) {
            wb.addEventListener('controlling', (event) => {
              window.location.reload();
            });

            if (registration && registration.waiting) {
              messageSW(registration.waiting, {type: 'SKIP_WAITING'});
            }
          });

          const showSkipWaitingPrompt = (event) => {
            showRefresh();
          };

          // Add an event listener to detect when the registered
          // service worker has installed but is waiting to activate.
          wb.addEventListener('waiting', showSkipWaitingPrompt);
          wb.addEventListener('externalwaiting', showSkipWaitingPrompt);
          wb.register().then((r) => registration = r);
        }

        function refreshPWA(){
          window.dispatchEvent(new Event('updatePWA'));
        }

        window.refreshPWA = refreshPWA;
      </script>
    </body>
</html>
