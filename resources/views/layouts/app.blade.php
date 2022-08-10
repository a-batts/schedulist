<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark light">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">
    <meta name="theme-color" content="#0180FF">

    @stack('meta')

    <script src="{{ mix('js/theme-engine.js') }}"></script>

    <title>{{$title}}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wdth,wght@75,724&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">

    @stack('fonts')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/bundle.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles

    <!-- Scripts -->
    <!-- <script src="{{ mix('js/turbo.js') }}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.js"></script>
  </head>
  <body class="font-sans antialiased theme-div mdc-typography @if($theme == "dark") theme-dark @endif @if(Request::is('agenda*')) overflow-y-hidden @endif" id="themer" @if(Request::is('assignments/assignment*')) style="height: 98.5vh; margin-top: -6.3rem" @else style="margin-top: -6.3rem" @endif>
    <div class="min-h-screen content-div" id="makefixed" wire:ignore.self>
      <header class="pb-4">
        @livewire('navigation-menu')
      </header>

      <x-ui.snackbar/>
      <x-pwa-snackbar/>

      <main class="min-h-screen">
        <div id="main" class="relative">
            {{ $slot }}
        </div>
      </main>

      @if (! Request::is('agenda*'))
        <x-footer/>
      @endif
    </div>
    @stack('modals')

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
      document.addEventListener('FilePond:loaded', e => {
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginImageCrop);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginImageTransform);
        FilePond.registerPlugin(FilePondPluginImageOverlay);
      });
    </script>
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
