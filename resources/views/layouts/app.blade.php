<!doctype html>
<html class="theme-div @if ($theme == 'dark') theme-dark @endif" id="theme-container"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark light">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('images/logo/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
    <link type="image/png" href="{{ asset('images/logo/favicon-32x32.png') }}" rel="icon" sizes="32x32">
    <link type="image/png" href="{{ asset('images/logo/favicon-16x16.png') }}" rel="icon" sizes="16x16">
    <link href="{{ asset('manifest.webmanifest') }}" rel="manifest">
    <meta name="theme-color" content="#0180FF">

    @stack('meta')

    <title>{{ $title }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link type="text/css" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">
    <link type="text/css" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"
        media="print" onload="this.media='all'" />
    <link type="text/css" href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wdth,wght@75,724&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">

    <!-- Styles -->
    @vite(['resources/css/app.scss', 'resources/js/app.js', 'resources/js/vendor.js'])
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('build/registerSW.js') }}"></script>
    <script>
        //Match site theme to system settings if set to auto
        const theme = ('; ' + document.cookie).split(`; theme=`).pop().split(';')[0];
        const themeContainer = document.getElementById('theme-container');
        if (theme == 'auto')
            window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? themeContainer.classList.add(
                'theme-dark') : themeContainer.classList.remove('theme-dark');

        window.matchMedia('(prefers-color-scheme: dark)')
            .addEventListener('change', ({
                matches
            }) => {
                matches ? themeContainer.classList.add(
                    'theme-dark') : themeContainer.classList.remove('theme-dark');
            })
    </script>
</head>

<body class="mdc-typography @if (Request::is('agenda*')) overflow-y-hidden @endif overflow-x-clip antialiased">
    <div class="content-div min-h-screen" id="makefixed" wire:ignore.self>
        @livewire('navigation-menu')

        <x-ui.snackbar />
        <x-pwa-snackbar />

        <main class="min-h-screen pt-20">
            <div class="relative" id="main">
                {{ $slot }}
            </div>
        </main>
    </div>
    @if (!Request::is('agenda*'))
        <x-footer />
    @endif

    @stack('scripts')

    @livewireScripts
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
</body>

</html>
