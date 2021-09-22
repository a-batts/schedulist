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
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">

    @stack('fonts')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/bundle.css') }}">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/turbo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpine-turbo-drive-adapter@1.0.x/dist/alpine-turbo-drive-adapter.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
  </head>
  <body class="font-sans antialiased theme-div mdc-typography @if($theme == "dark") theme-dark @endif" id="themer">
    <header>
      @livewire('navigation-menu')
    </header>

    <x-ui.snackbar/>
    <x-pwa-snackbar/>

    <main class="min-h-screen">

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
  </body>
</html>
