<!doctype html>
<html class="theme-div @if ($theme == 'dark') theme-dark @endif" id="theme-container"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    @if (Request::is('privacy-policy')) style="scroll-behavior: smooth" @endif>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('images/logo/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
    <link type="image/png" href="{{ asset('images/logo/favicon-32x32.png') }}" rel="icon" sizes="32x32">
    <link type="image/png" href="{{ asset('images/logo/favicon-16x16.png') }}" rel="icon" sizes="16x16">
    <link href="{{ asset('manifest.webmanifest') }}" rel="manifest">
    <meta name="theme-color" content="#0180FF">

    @stack('meta')

    <title>{{ $title ?? 'Schedulist' }}</title>
    <title>Schedulist</title>

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
        if (theme == 'auto' || theme == '')
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

<body class="mdc-typography overflow-x-hidden">
    <div class="swup-transition-fade" id="swup">
        <header x-data="{
            aboveContent: false,
            scrolled: function() {
                if (window.scrollY > 36)
                    this.aboveContent = true
                else
                    this.aboveContent = false
            },
        }" @scroll.window="scrolled()">
            <nav class="nav-border base-bg fixed top-0 z-10 w-screen py-4" x-bind:class="{ 'border-b': aboveContent }">
                <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                    <div class="flex w-full items-center" style="height: 4.2rem">
                        <div class="flex-grow">
                            <a class="z-20 overflow-y-auto" href="{{ route('landing') }}">
                                <div class="flex-shrink-0">
                                    <div class="logo-image ml-2 h-10 w-32 border-none sm:ml-0 sm:h-12 sm:w-40">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="flex items-center gap-x-4">
                            <div>
                                <x-change-theme />
                            </div>
                            <div>
                                @auth
                                    <a class="block max-w-xs rounded-full bg-gray-800 text-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                        href="{{ route('dashboard') }}" aria-label="User menu" aria-haspopup="true">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->firstname }}" />
                                    </a>
                                @else
                                    <a class="w-22 mdc-button mdc-button--raised h-11 text-lg" href="{{ route('login') }}"
                                        wire:ignore>
                                        <span class="mdc-button__ripple"></span>
                                        <span class="mdc-button__focus-ring"></span>
                                        <span class="mdc-button__label font-medium normal-case tracking-normal">Sign
                                            In</span>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <x-ui.snackbar />
        <x-pwa-snackbar />

        <main class="content-div mdc-typography min-h-screen pt-20 antialiased" x-data="{ offline: !window.navigator.onLine }"
            @online.window="offline = false" @offline.window="offline = true">
            {{ $slot }}
        </main>

        <x-footer />

        @stack('scripts')

        @livewireScripts
    </div>
</body>

</html>
