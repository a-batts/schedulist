<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
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
    @vite(manifest.web['resources/css/app.scss', 'resources/js/app.js', 'resources/js/vendor.js'])
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('build/registerSW.js') }}"></script>
</head>

<body class="theme-div @if ($theme == 'dark') theme-dark @endif mdc-typography overflow-x-hidden"
    id="themer">
    <header x-data="{
        aboveContent: false,
        scrolled: function() {
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
    }" @scroll.window="scrolled()">
        <nav class="nav-border base-bg fixed top-0 z-10 w-screen py-4" x-bind:class="{ 'border-b': aboveContent }">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between" style="height: 4.2rem">
                    <div
                        class="schedulist-logo-nav absolute flex flex-1 items-center justify-center sm:items-stretch sm:justify-start md:relative">
                        <a class="z-20 overflow-y-auto" href="{{ route('landing') }}">
                            <div class="flex-shrink-0">
                                <div class="logo-image mt-6 mb-3 -ml-10 border-none sm:ml-0" style="width: 160px;">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="absolute w-full">
                        <a class="mdc-icon-button material-icons text-primary float-right ml-4"
                            href="{{ route('themes') }}" @click="profileMenu = false">
                            <div class="mdc-icon-button__ripple"></div>
                            <span class="mdc-icon-button__focus-ring"></span>
                            <span x-text="themeIcon"></span>
                        </a>
                        @auth
                            <a href="{{ route('dashboard') }}"class="float-right mt-1.5 max-w-xs rounded-full bg-gray-800 text-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                aria-label="User menu" aria-haspopup="true">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                    alt="{{ Auth::user()->firstname }}" />
                            </a>
                        @else
                            <a class="w-22 mdc-button mdc-button--raised float-right h-11 text-lg"
                                href="{{ route('login') }}" wire:ignore>
                                <span class="mdc-button__ripple"></span>
                                <span class="mdc-button__focus-ring"></span>
                                <span class="mdc-button__label font-medium normal-case tracking-normal">Sign In</span>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <x-ui.snackbar />
    <x-pwa-snackbar />

    <div class="content-div mdc-typography min-h-screen pt-20 antialiased">
        {{ $slot }}
    </div>

    <x-footer />

    @livewireScripts
</body>

</html>
