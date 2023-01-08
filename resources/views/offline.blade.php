<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>No Connection</title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link type="text/css" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">
    <link type="text/css" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"
        media="print" onload="this.media='all'" />
    <link href="{{ asset('images/logo/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
    <link type="image/png" href="{{ asset('images/logo/favicon-32x32.png') }}" rel="icon" sizes="32x32">
    <link type="image/png" href="{{ asset('images/logo/favicon-16x16.png') }}" rel="icon" sizes="16x16">
    <link href="{{ asset('manifest.webmanifest') }}" rel="manifest">

    <!-- Styles -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])

    <style>
        .wifi_icon {
            font-size: 80px;
            display: table;
            text-align: center;
            margin: auto;
            font-family: "Material Symbols Outlined";
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

<body class="theme-div @if (Cookie::get('theme') == 'dark') theme-dark @endif overflow-x-hidden antialiased"
    id="themer">
    <div class="min-h-screen">
        @livewire('navigation-menu')
        <main>
            <div class="center">
                <span class="material-icons wifi_icon mdc-typography">signal_wifi_off</span>
                <p class="mdc-typography mdc-typography--headline2 center_text mt-5 text-center font-bold">You're
                    offline</p>
                <p class="mdc-typography mt-5 text-center text-lg font-medium text-gray-600">We'll try to reconnect you
                    when you get back online</p>
            </div>
        </main>
    </div>
    <script>
        window.addEventListener('online', function(event) {
            location.reload();
        });
    </script>

</body>

</html>
