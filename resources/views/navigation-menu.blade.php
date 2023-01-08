@auth
    <nav class="fixed top-0 z-10 w-screen" data-turbolinks-permanent style="background-color: #242323" x-data="{
        profileMenu: false,
        mobileMenu: false
    }"
        :class="{ 'rounded-b-lg': mobileMenu }">
        <div class="w-full px-2 mx-auto sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-20">
                <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
                    <button
                        class="mdc-icon-button material-icons inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-white focus:text-white focus:outline-none"
                        aria-label="Main menu" aria-expanded="false" @click="mobileMenu = !mobileMenu">
                        <div class="mdc-icon-button__ripple"></div>menu
                    </button>
                </div>
                <div
                    class="schedulist-logo-nav absolute flex items-center justify-center flex-1 sm:items-stretch sm:justify-start md:relative">
                    <div class="flex-shrink-0">
                        <img class="mb-1 border-none" src="{{ asset('images/logo/logo_light.svg') }}" alt="Schedulist Logo"
                            width="140px"></img>
                    </div>
                </div>
                <div class="absolute w-full">
                    <div
                        class="left-0 right-0 items-center justify-center hidden w-full mx-auto mt-2 space-x-3 md:flex lg:space-x-8">
                        <div>
                            <a class="mx-2" href="{{ route('dashboard') }}">
                                <button class="mdc-button mdc-button-ripple navbar-button"
                                    @if (Request::is('app')) disabled @endif>
                                    <span class="mdc-button__ripple"></span>Dashboard
                                </button>
                            </a>
                        </div>
                        <div>
                            <a class="mx-2" href="{{ route('assignments') }}">
                                <button class="mdc-button mdc-button-ripple navbar-button"
                                    @if (Request::is('assignments')) disabled @endif>
                                    <span class="mdc-button__ripple"></span>Assignments
                                </button>
                            </a>
                        </div>
                        <div>
                            <a class="mx-2" href="{{ route('schedule') }}">
                                <button class="mdc-button mdc-button-ripple navbar-button"
                                    @if (Request::is('agenda')) disabled @endif>
                                    <span class="mdc-button__ripple"></span>Schedule
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Profile menu -->
                <div class="profile-button-icon z-20 hidden pt-4 pb-3 border-gray-700 md:block">
                    <div class="flex items-center px-5 gap-x-4">
                        <div class="text-white">
                            <x-change-theme />
                        </div>
                        <div class="flex-shrink-0">
                            <button
                                class="profilebutton flex items-center max-w-xs text-sm transition duration-150 ease-in-out bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                id="user-menu" aria-describedby="switchacct-tooltip" aria-label="User menu"
                                aria-haspopup="true" @click="profileMenu = !profileMenu">
                                <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                                    alt="{{ Auth::user()->firstname }}" />
                            </button>
                        </div>
                        <div class="mdc-card mdc-card-outlined profile-menu absolute right-0 mt-6 origin-top-right"
                            x-show="profileMenu" @click.outside="profileMenu = false" x-transition x-cloak>
                            <div class="mb-4">
                                <div class="w-full py-2">
                                    <div class="w-16 h-16 mx-auto"><img class="rounded-full"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="Profile photo"
                                            alt="Profile photo"></div>
                                    <p class="mx-auto mt-3 text-xl font-medium text-center">
                                        {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</p>
                                    <p class="mx-auto mt-1 text-sm text-center text-gray-700">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <div class="section-border border-100"></div>
                            <div class="flex flex-col items-center">
                                <div>
                                    <a class="mdc-button mdc-button--outlined mt-6 tracking-normal capitalize"
                                        href="{{ route('profile') }}" @click="profileMenu = false">
                                        <span class="mdc-button__ripple"></span>
                                        <span class="mdc-button__focus-ring"></span>
                                        <span class="mdc-button__label">Account Settings</span>
                                    </a>
                                </div>
                            </div>
                            <div class="flex justify-end pb-2 pt-7">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button
                                        class="mdc-button mdc-button--icon-leading text-primary mt-2 tracking-normal capitalize">
                                        <span class="mdc-button__ripple"></span>
                                        <span class="mdc-button__focus-ring"></span>
                                        <i class="material-icons mdc-button__icon text-inherit"
                                            aria-hidden="true">logout</i>
                                        <span class="mdc-button__label text-inherit">Sign out</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile menu list -->
            <div class="mobile-menu fixed top-0 left-0 z-20 w-screen md:hidden" style="background-color: #242323"
                x-transition x-show="mobileMenu" x-trap.noscroll="mobileMenu" x-cloak>
                <div class="px-2 text-white">
                    <div class="pt-3">
                        <div class="mobile-menu-top flex">
                            <div class="flex-grow">
                                <button class="mdc-icon-button material-icons" @click="mobileMenu = false">
                                    <div class="mdc-icon-button__ripple"></div>close
                                </button>
                            </div>
                            <div class="flex gap-x-4">
                                <x-change-theme />
                                <a class="mdc-icon-button material-icons" href="{{ route('profile') }}">
                                    <div class="mdc-icon-button__ripple"></div>account_circle
                                </a>
                            </div>
                        </div>
                        <div class="flex px-6 mt-4">
                            <div>
                                <img class="object-cover w-16 h-16 rounded-full"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->firstname }}" />
                            </div>
                            <div class="mt-2 ml-6">
                                <h6 class="nav-menu-name text-lg font-medium text-white">
                                    {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</h6>
                                <h1 class="nav-menu-email text-sm">{{ Auth::user()->email }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 border-t border-gray-100"></div>
                    <div class="pt-8 pl-4 pr-12">
                        <a class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if (Request::is('app')) mobile-dropdown-selected @endif"
                            href="{{ route('dashboard') }}">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label"><i class="material-icons mdc-button__icon inline-block ml-2"
                                    aria-hidden="true">dashboard</i>
                                <span>Dashboard</span>
                            </span>
                        </a>
                        <a class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if (Request::is('assignments')) mobile-dropdown-selected @endif"
                            href="{{ route('assignments') }}">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label"><i class="material-icons mdc-button__icon inline-block ml-2"
                                    aria-hidden="true">assignment</i>
                                <span>Assignments</span>
                            </span>
                        </a>
                        <a class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if (Request::is('agenda')) mobile-dropdown-selected @endif"
                            href="{{ route('schedule') }}">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label"><i class="material-icons mdc-button__icon inline-block ml-2"
                                    aria-hidden="true">calendar_today</i>
                                <span>Schedule</span>
                            </span>
                        </a>
                        <div class="absolute bottom-0 w-screen pt-8 pr-12">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <span class="mdc-button__ripple"></span>
                                    <span class="mdc-button__label"><i
                                            class="material-icons mdc-button__icon inline-block ml-2"
                                            aria-hidden="true">logout</i>
                                        <span>Sign out</span>
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endauth
