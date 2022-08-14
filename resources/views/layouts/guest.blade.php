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
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <!-- <script src="{{ mix('js/turbo.js') }}"></script> -->
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
        <nav class="nav-border base-bg fixed z-10 w-screen py-4" x-bind:class="{'border-b': aboveContent}">
          <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between" style="height: 4.2rem">
              <div class="schedulist-logo-nav absolute flex flex-1 items-center justify-center sm:items-stretch sm:justify-start md:relative">
                <a href="{{ route ('landing') }}" class="z-20 overflow-y-auto">
                  <div class="flex-shrink-0">
                    <div class="logo-image mt-6 mb-3 -ml-10 border-none sm:ml-0" style="width: 160px;">
                    </div>
                  </div>
                </a>
              </div>
              <div class="absolute w-full">
                <a href="{{ route('themes') }}" class="mdc-icon-button material-icons text-primary float-right ml-4" @click="profileMenu = false">
                  <div class="mdc-icon-button__ripple"></div>
                  <span class="mdc-icon-button__focus-ring"></span>
                  <span x-text="themeIcon"></span>
                </a>
                @if(Auth::check())
                  <a href="{{ route('dashboard') }}"class="float-right mt-1.5 max-w-xs rounded-full bg-gray-800 text-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
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

      <div class="content-div mdc-typography antialiased">
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
