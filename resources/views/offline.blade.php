<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>No Connection</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/bundle.css') }}">
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/turbo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpine-turbo-drive-adapter@1.0.x/dist/alpine-turbo-drive-adapter.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

    <style>
    .wifi_icon{
      font-size: 80px;
      display: table;
      text-align: center;
      margin: auto;
      font-family: "Material Icons";
    }
    .center {
      margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }
    </style>

  </head>
  <body class="antialiased theme-div @if(Cookie::get('theme') == 'dark') theme-dark @endif" id="themer">
    <div class="min-h-screen">
      @livewire('navigation-menu')
      <main>
        <div class="center">
          <span class="material-icons wifi_icon mdc-typography">signal_wifi_off</span>
          <p class="mdc-typography mdc-typography--headline2 center_text mt-5 text-center font-bold">You're offline</p>
          <p class="mdc-typography font-medium text-lg text-gray-600 mt-5 text-center">We'll try to reconnect you when you get back online</p>
        </div>
      </main>
    </div>
    <script src="{{ mix('js/bundle.js') }}" defer></script>
    <script>
      window.addEventListener('online', function(event){
          location.reload();
      });
    </script>

  </body>

</html>
