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

        @stack('meta')

        <title>{{$title ?? 'Schedulist'}}</title>
        <title>Schedulist</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">

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
      <header>
        @livewire('navigation-menu')
      </header>

      <x-ui.snackbar/>
      <x-pwa-snackbar/>

      <div class="content-div antialiased mdc-typography">
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
