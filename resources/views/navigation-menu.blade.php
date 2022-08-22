@auth
  <nav class="sticky top-0 z-10 w-screen" style="background-color: #242323"
  x-data="{
    profileMenu: false,
    mobileMenu: false,
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
  :class="{'rounded-b-lg': mobileMenu}"
  data-turbolinks-permanent>
  <div class="w-full px-2 mx-auto sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-20">
        <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
          <button class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md mdc-icon-button material-icons hover:text-white focus:text-white focus:outline-none" aria-label="Main menu" aria-expanded="false" @click="mobileMenu = !mobileMenu"><div class="mdc-icon-button__ripple"></div>menu</button>
        </div>
        <div class="absolute flex items-center justify-center flex-1 schedulist-logo-nav sm:items-stretch sm:justify-start md:relative">
          <div class="flex-shrink-0">
            <img src="{{ asset('images/logo/logo_light.svg') }}" width="140px" class="mb-1 border-none" alt="Schedulist Logo"></img>
          </div>
        </div>
        <div class="absolute w-full">
          <div class="left-0 right-0 items-center justify-center hidden w-full mx-auto mt-2 space-x-3 md:flex lg:space-x-8">
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
          </div>
        </div>
        <!-- Profile menu -->
        <div class="z-20 hidden pt-4 pb-3 border-gray-700 profile-button-icon md:block">
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <button aria-describedby="switchacct-tooltip" class="flex items-center max-w-xs text-sm transition duration-150 ease-in-out bg-gray-800 rounded-full profilebutton focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
              id="user-menu" @click="profileMenu = !profileMenu" aria-label="User menu" aria-haspopup="true">
                <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::User()->profile_photo_url }}" alt="{{Auth::User()->firstname}}" />
              </button>
            </div>
            <div class="absolute right-0 mt-6 origin-top-right mdc-card mdc-card-outlined profile-menu"
            x-show="profileMenu" @click.outside="profileMenu = false" x-transition x-cloak>
              <div class="mb-4">
                <div class="w-full py-2">
                  <div class="w-16 h-16 mx-auto"><img src="{{Auth::user()->profile_photo_url}}" alt="Profile photo" class="rounded-full"></div>
                  <p class="mx-auto mt-3 text-xl font-medium text-center">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</p>
                  <p class="mx-auto mt-1 text-sm text-center text-gray-700">{{Auth::user()->email}}</p>
              </div>
              </div>
              <div class="section-border border-100"></div>
              <div class="flex flex-col items-center">
                <div>
                  <a class="mt-6 lowercase mdc-button mdc-button--outlined" href="{{ route('profile') }}" @click="profileMenu = false">
                    <span class="mdc-button__ripple"></span>
                    <span class="mdc-button__focus-ring"></span>
                    <span class="mdc-button__label">Account Settings</span>
                  </a>
                </div>
              </div>
              <div class="pb-2 pt-7">
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
                    <button class="mt-2 lowercase mdc-button mdc-button--icon-leading text-primary">
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
        </div>
      </div>
      <!-- Mobile menu list -->
      <div class="fixed top-0 left-0 z-20 w-screen mobile-menu md:hidden" style="background-color: #242323" x-transition x-show="mobileMenu" x-trap.noscroll="mobileMenu" x-cloak>
        <div class="px-2 text-white">
          <div class="pt-3">
            <div class="block mobile-menu-top">
              <button class="float-left mdc-icon-button material-icons" @click="mobileMenu = false">
                <div class="mdc-icon-button__ripple"></div>close
              </button>
              <a href="{{route('profile')}}" class="float-right mdc-icon-button material-icons">
                <div class="mdc-icon-button__ripple"></div>account_circle
              </a>
            </div>
            <div class="block px-6 mt-4">
              <img class="float-left object-cover w-16 h-16 rounded-full" src="{{ Auth::User()->profile_photo_url }}" alt="{{Auth::User()->firstname}}" />
              <div class="inline-block mt-2 ml-6">
                <h6 class="text-lg font-medium text-white nav-menu-name">{{Auth::User()->firstname." ".Auth::User()->lastname }}</h6>
                <h1 class="text-sm nav-menu-email">{{ Auth::User()->email}}</h1>
              </div>
            </div>
          </div>
          <div class="mt-12 border-t border-gray-100"></div>
          <div class="pt-8 pl-4 pr-12">
            <a href="{{route('dashboard')}}" class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('app')) mobile-dropdown-selected @endif">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label"><i class="inline-block ml-2 material-icons mdc-button__icon" aria-hidden="true">dashboard</i>
              <span>Dashboard</span>
              </span>
            </a>
            <a href="{{route('assignments')}}" class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('assignments')) mobile-dropdown-selected @endif">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label"><i class="inline-block ml-2 material-icons mdc-button__icon" aria-hidden="true">assignment</i>
              <span>Assignments</span>
              </span>
            </a>
            <a href="{{route('schedule')}}" class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('agenda')) mobile-dropdown-selected @endif">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label"><i class="inline-block ml-2 material-icons mdc-button__icon" aria-hidden="true">calendar_today</i>
              <span>Schedule</span>
              </span>
            </a>
            <a href="{{route('themes')}}" class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('user/theme')) mobile-dropdown-selected @endif">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label"><i class="inline-block ml-2 material-icons mdc-button__icon" aria-hidden="true" x-text="themeIcon"></i>
              <span>Theme</span>
              </span>
            </a>
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
          </div>
        </div>
      </div>
    </div>
  </nav>
@endauth