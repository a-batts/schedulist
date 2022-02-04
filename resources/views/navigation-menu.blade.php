<nav class="fixed z-10 w-screen" style="background-color: #242323"
x-data="{
  profileMenu: false,
  mobileMenu: false,
  init: function($watch){
    $watch('mobileMenu', value => {
      document.body.classList.toggle('overflow-y-hidden');
    });
  },
  get theme() {
    if (getCookieValue('theme') != undefined)
      return getCookieValue('theme');
    return 'auto';
  },
  get themeIcon() {
    if (this.theme == 'dark')
      return 'dark_mode';
    else if (this.theme == 'light')
      return 'light_mode';
    return 'brightness_auto';
  }
}"
x-init="init($watch)"
:class="{'rounded-b-lg': mobileMenu}"
data-turbolinks-permanent>
  <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between" style="height: 4.2rem">
      <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
        <button class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-white focus:outline-none focus:text-white mdc-icon-button material-icons" aria-label="Main menu" aria-expanded="false" @click="mobileMenu = !mobileMenu"><div class="mdc-icon-button__ripple"></div>menu</button>
      </div>
      <div class="absolute flex items-center justify-center flex-1 md:relative schedulist-logo-nav sm:items-stretch sm:justify-start">
        <div class="flex-shrink-0">
          <img src="{{ asset('images/logo/logo_light.svg') }}" width="140px" class="mb-3 border-none" alt="Schedulist Logo"></img>
        </div>
      </div>
      <div class="absolute w-full">
        <div class="left-0 right-0 items-center justify-center hidden w-full mx-auto space-x-2 md:flex">
          @if (Auth::check())
            <div>
              <a href="{{ route('dashboard') }}" class="mx-2">
                <button class="mdc-button mdc-button-ripple navbar-button" @if(Request::is('app')) disabled @endif>
                  <span class="mdc-button__ripple"></span>Dashboard
                </button>
              </a>
            </div>
            <div>
              <a href="{{ route('assignments') }}" class="mx-2">
                <button class="mdc-button mdc-button-ripple navbar-button" @if(Request::is('assignments')) disabled @endif>
                  <span class="mdc-button__ripple"></span>Assignments
                </button>
              </a>
            </div>
            <div>
              <a href="{{ route('schedule') }}" class="mx-2">
                <button class="mdc-button mdc-button-ripple navbar-button" @if(Request::is('agenda')) disabled @endif>
                  <span class="mdc-button__ripple"></span>Schedule
                </button>
              </a>
            </div>
          @else
            <div>
              <a href="../" class="mx-2">
                <button class="mdc-button mdc-button-ripple navbar-button" @if(Request::is('/')) disabled @endif>
                  <span class="mdc-button__ripple"></span>Home
                </button>
              </a>
            </div>
          @endif
        </div>
      </div>
      <!-- Profile menu -->
      <div class="z-20 hidden pt-4 pb-3 border-gray-700 profile-button-icon md:block">
        @if (Auth::check())
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <button aria-describedby="switchacct-tooltip" class="flex items-center max-w-xs text-sm transition duration-150 ease-in-out bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white profilebutton"
              id="user-menu" @click="profileMenu = !profileMenu" aria-label="User menu" aria-haspopup="true">
                <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::User()->profile_photo_url }}" alt="{{Auth::User()->firstname}}" />
              </button>
            </div>
            <div class="absolute right-0 mt-4 origin-top-right mdc-card mdc-card-outlined profile-menu"
            x-show.transition="profileMenu" @click.away="profileMenu = false" x-cloak>
              <div class="mb-4">
                <div class="w-full px-2">
                  <div class="w-16 h-16 mx-auto"><img src="{{Auth::user()->profile_photo_url}}" alt="Profile photo" class="rounded-full"></div>
                  <p class="mx-auto mt-3 text-xl font-medium text-center">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</p>
                  <p class="mx-auto mt-1 text-sm text-center text-gray-700">{{Auth::user()->email}}</p>
              </div>
              </div>
              <div class="section-border border-100"></div>
              <div class="flex flex-col items-center">
                <div>
                  <a class="mt-4 mdc-button mdc-button--outlined lowercase-text" href="{{ route('profile') }}" @click="profileMenu = false">
                    <span class="mdc-button__ripple"></span>
                    <span class="mdc-button__focus-ring"></span>
                    <span class="mdc-button__label">Account Settings</span>
                  </a>
                </div>
              </div>
              <div class="pt-6 pb-2">
                <div class="float-left">
                  <a href="{{ route('themes') }}" class="mdc-icon-button material-icons" @click="profileMenu = false">
                    <div class="mdc-icon-button__ripple"></div>
                    <span class="mdc-icon-button__focus-ring"></span>
                    <span x-text="themeIcon"></span>
                  </a>
                </div>
                <div class="float-right">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="mt-2 mdc-button mdc-button--icon-leading theme-text-primary">
                      <span class="mdc-button__ripple"></span>
                      <span class="mdc-button__focus-ring"></span>
                      <i class="material-icons mdc-button__icon text-inherit" aria-hidden="true">logout</i>
                      <span class="mdc-button__label text-inherit">Sign out</span>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @else
          <div>
            <a href="{{ route('login') }}">
              <button class="float-right ml-3 mdc-button mdc-button-ripple mdc-button--raised">
                <span class="mdc-button__ripple"></span>Sign In
              </button>
            </a>
            <a href="{{ route('register') }}" class="hidden float-right md:block">
              <button class="mdc-button mdc-button-ripple">
                <span class="mdc-button__ripple"></span>Sign Up
              </button>
            </a>
          </div>
        @endif
      </div>
    </div>
    <!-- Mobile menu list -->
    <div class="fixed top-0 left-0 z-20 w-screen md:hidden mobile-menu" style="background-color: #242323" x-show.transition="mobileMenu" x-cloak>
      <div class="px-2 text-white">
        <div class="pt-3">
          <div class="block mobile-menu-top">
            <button class="float-left mdc-icon-button material-icons" @click="mobileMenu = false">
              <div class="mdc-icon-button__ripple"></div>close
            </button>
            @if (Auth::check())
              <a href="{{route('profile')}}">
                <button class="float-right mdc-icon-button material-icons">
                  <div class="mdc-icon-button__ripple"></div>account_circle
                </button>
              </a>
            @endif
          </div>
          <div class="block px-6 mt-4">
            @if (Auth::check())
              <img class="float-left object-cover w-16 h-16 rounded-full" src="{{ Auth::User()->profile_photo_url }}" alt="{{Auth::User()->firstname}}" />
              <div class="inline-block mt-2 ml-6">
                <h6 class="text-lg font-medium text-white name_head">{{Auth::User()->firstname." ".Auth::User()->lastname }}</h6>
                <h1 class="text-sm email_head">{{ Auth::User()->email}}</h1>
              </div>
            @endif
          </div>
        </div>
        <div class="mt-12 border-t border-gray-100"></div>
        <div class="pt-8 pl-4 pr-12">
          @if(Auth::check())
            <a href="{{route('dashboard')}}">
              <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('app')) mobile-dropdown-selected @endif">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label"><i class="inline-block ml-2 material-icons mdc-button__icon" aria-hidden="true">dashboard</i>
                <span>Dashboard</span>
                </span>
              </button>
            </a>
            <a href="{{route('assignments')}}">
              <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('assignments')) mobile-dropdown-selected @endif">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label"><i class="inline-block ml-2 material-icons mdc-button__icon" aria-hidden="true">assignment</i>
                <span>Assignments</span>
                </span>
              </button>
            </a>
            <a href="{{route('schedule')}}">
              <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('agenda')) mobile-dropdown-selected @endif">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label"><i class="inline-block ml-2 material-icons mdc-button__icon" aria-hidden="true">calendar_today</i>
                <span>Schedule</span>
                </span>
              </button>
            </a>
          @endif
          <a href="{{route('themes')}}">
            <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('user/theme')) mobile-dropdown-selected @endif">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label"><i class="inline-block ml-2 material-icons mdc-button__icon" aria-hidden="true" x-text="themeIcon"></i>
              <span>Theme</span>
              </span>
            </button>
          </a>
          @if(Auth::check())
            <div class="absolute bottom-0 w-screen pt-8 pr-12">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button" onclick="event.preventDefault(); this.closest('form').submit();">
                  <span class="mdc-button__ripple"></span>
                  <span class="mdc-button__label"><i class="inline-block ml-2 material-icons mdc-button__icon" aria-hidden="true">logout</i>
                  <span>Sign out</span>
                  </span>
                </button>
              </form>
            </div>
          @else
            <div class="absolute bottom-0 w-screen pt-8 pr-12">
              <a href="{{ route('login') }}">
                <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button">
                  <span class="mdc-button__ripple"></span>
                  <span class="mdc-button__label"><i class="inline-block ml-2 material-icons mdc-button__icon" aria-hidden="true">login</i>
                  <span>Sign in</span>
                  </span>
                </button>
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</nav>
