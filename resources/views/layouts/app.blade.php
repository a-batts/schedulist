<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark light">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('images/logo/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
    <link type="image/png" href="{{ asset('images/logo/favicon-32x32.png') }}" rel="icon" sizes="32x32">
    <link type="image/png" href="{{ asset('images/logo/favicon-16x16.png') }}" rel="icon" sizes="16x16">
    <link href="{{ asset('/site.webmanifest') }}" rel="manifest">
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
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('build/registerSW.js') }}"></script>
</head>

<body
    class="theme-div mdc-typography @if ($theme == 'dark') theme-dark @endif @if (Request::is('agenda*')) overflow-y-hidden @endif overflow-x-clip antialiased"
    id="themer">
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

    <script src="{{ asset('js/scripts.js') }}" defer></script>

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
