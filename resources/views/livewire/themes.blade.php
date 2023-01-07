<x-app-layout title="Theme">
    @guest
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
                <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="relative flex items-center justify-between" style="height: 4.2rem">
                        <div
                            class="schedulist-logo-nav absolute flex items-center justify-center flex-1 sm:items-stretch sm:justify-start md:relative">
                            <a class="z-20 overflow-y-auto" href="{{ route('landing') }}">
                                <div class="flex-shrink-0">
                                    <div class="logo-image mt-6 mb-3 -ml-10 border-none sm:ml-0" style="width: 160px;">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="absolute w-full">
                            <button class="mdc-icon-button material-icons text-primary float-right ml-4"
                                @click="profileMenu = false" disabled>
                                <div class="mdc-icon-button__ripple"></div>
                                <span class="mdc-icon-button__focus-ring"></span>
                                <span x-text=""></span>
                            </button>
                            <a class="w-22 mdc-button mdc-button--raised float-right text-lg h-11"
                                href="{{ route('login') }}" wire:ignore>
                                <span class="mdc-button__ripple"></span>
                                <span class="mdc-button__focus-ring"></span>
                                <span class="mdc-button__label font-medium tracking-normal normal-case">Sign In</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    @endguest
    <div class="@guest pt-20 @endguest py-10 mx-auto max-w-7xl sm:px-6 lg:px-8 transition-all" id="app">
        <div class="mt-10"></div>
        @livewire('profile.themes.change-themes')
    </div>

</x-app-layout>
