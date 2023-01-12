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
    <link href="{{ asset('/manifest.webmanifest') }}" rel="manifest">
    <meta name="theme-color" content="#0180FF">

    @stack('meta')

    <title>Schedulist</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link type="text/css" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">
    <link type="text/css" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"
        media="print" onload="this.media='all'" />
    <link type="text/css" href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wdth,wght@75,724&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">
    @stack('fonts')

    <!-- Styles -->
    @vite(['resources/css/app.scss', 'resources/js/app.js', 'resources/js/vendor.js'])
    @livewireStyles

    <!-- Scripts -->
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
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body class="mdc-typography overflow-x-hidden font-sans antialiased" x-data="{
    aboveContent: false,
    scrolled: function() {
        if (window.scrollY > 36)
            this.aboveContent = true
        else
            this.aboveContent = false
    },
}"
    @scroll.window="scrolled()">
    <div class="swup-transition-fade" id="swup">
        <header>
            @if (!Auth::check())
                <div id="g_id_onload"
                    data-client_id="827540481261-uhs04f4uecph0vpigh7tcek6jdfp7ggl.apps.googleusercontent.com"
                    data-login_uri="login/callback/onetap" data-auto_select="true" data-prompt_parent_id="g_id_onload"
                    data-_token="{{ csrf_token() }}"
                    style="position: fixed; top: 70px; right: 400px;
              width: 0; height: 0; z-index: 1001;">
                </div>
            @endif

            <nav class="nav-border base-bg fixed z-10 w-screen py-4" :class="{ 'border-b': aboveContent }">
                <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                    <div class="flex w-full items-center" style="height: 4.2rem">
                        <div class="flex-grow">
                            <a class="z-20 overflow-y-auto">
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
                                    <a href="{{ route('dashboard') }}"class="max-w-xs text-sm transition duration-150 ease-in-out bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                        aria-label="User menu" aria-haspopup="true">
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

        <main class="min-h-screen overflow-y-auto overflow-x-hidden pt-40 pl-8 md:pl-20">
            <div class="xl:flex">
                <div class="mb-12 max-w-xl pr-2 2xl:max-w-3xl">
                    <div class="mt-12 text-6xl font-bold md:text-7xl">School organization made easy</div>
                    <p class="mt-6 text-2xl text-gray-600">You have enough to worry about during the school year. Don't
                        make
                        keeping track of everything more stressful then it needs to be.</p>
                    <p class="mt-6 text-2xl text-gray-600">Meet Schedulist: The easiest way to organize all of your
                        classes,
                        assignments, events, and more.</p>
                    <a class="mdc-button mdc-button--raised mdc-button--icon-trailing mt-10 h-14 w-72 text-xl"
                        href="{{ Auth::check() ? route('dashboard') : route('register') }}" wire:ignore>
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__focus-ring"></span>
                        <span class="mdc-button__label font-medium normal-case tracking-normal">
                            {{ Auth::check() ? 'Go to Dashboard' : 'Create an Account' }}
                        </span>
                        <i class="material-icons mdc-button__icon" aria-hidden="true">arrow_forward</i>
                    </a>
                </div>
                <div class="float-right -mr-12 h-fit pb-12 xl:mr-0 xl:-mt-6 xl:h-auto">
                    <img class="show-light" src="{{ asset('images/landing/landing.png') }}"
                        alt="Schedulist homepage preview" height="1071" width="787" />
                    <img class="show-dark" src="{{ asset('images/landing/landing-dark.png') }}"
                        alt="Schedulist homepage preview" height="1071" width="787" />
                </div>
            </div>
        </main>

        <x-footer />

        @livewireScripts
        @stack('scripts')

        <script>
            Livewire.on('toastMessage', message => {
                snack(message);
            });
        </script>
    </div>
</body>

</html>
