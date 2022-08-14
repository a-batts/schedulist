@auth
  <nav class="fixed z-10 w-screen" style="background-color: #242323"
  x-init="$watch('mobileMenu', value => {
    document.body.classList.toggle('overflow-y-hidden');
  })"
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
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-20 items-center justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
          <button class="mdc-icon-button material-icons inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:text-white focus:text-white focus:outline-none" aria-label="Main menu" aria-expanded="false" @click="mobileMenu = !mobileMenu"><div class="mdc-icon-button__ripple"></div>menu</button>
        </div>
        <div class="schedulist-logo-nav absolute flex flex-1 items-center justify-center sm:items-stretch sm:justify-start md:relative">
          <div class="flex-shrink-0">
            <img src="{{ asset('images/logo/logo_light.svg') }}" width="140px" class="mb-1 border-none" alt="Schedulist Logo"></img>
          </div>
        </div>
        <div class="absolute w-full">
          <div class="left-0 right-0 mx-auto mt-2 hidden w-full items-center justify-center space-x-3 md:flex lg:space-x-8">
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
        <div class="profile-button-icon z-20 hidden border-gray-700 pt-4 pb-3 md:block">
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <button aria-describedby="switchacct-tooltip" class="profilebutton flex max-w-xs items-center rounded-full bg-gray-800 text-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
              id="user-menu" @click="profileMenu = !profileMenu" aria-label="User menu" aria-haspopup="true">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::User()->profile_photo_url }}" alt="{{Auth::User()->firstname}}" />
              </button>
            </div>
            <div class="mdc-card mdc-card-outlined profile-menu absolute right-0 mt-6 origin-top-right"
            x-show="profileMenu" @click.outside="profileMenu = false" x-transition x-cloak>
              <div class="mb-4">
                <div class="w-full py-2">
                  <div class="mx-auto h-16 w-16"><img src="{{Auth::user()->profile_photo_url}}" alt="Profile photo" class="rounded-full"></div>
                  <p class="mx-auto mt-3 text-center text-xl font-medium">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</p>
                  <p class="mx-auto mt-1 text-center text-sm text-gray-700">{{Auth::user()->email}}</p>
              </div>
              </div>
              <div class="section-border border-100"></div>
              <div class="flex flex-col items-center">
                <div>
                  <a class="mdc-button mdc-button--outlined mt-6 lowercase" href="{{ route('profile') }}" @click="profileMenu = false">
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
                    <button class="mdc-button mdc-button--icon-leading text-primary mt-2 lowercase">
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
      <div class="mobile-menu fixed top-0 left-0 z-20 w-screen md:hidden" style="background-color: #242323" x-transition x-show="mobileMenu" x-cloak>
        <div class="px-2 text-white">
          <div class="pt-3">
            <div class="mobile-menu-top block">
              <button class="mdc-icon-button material-icons float-left" @click="mobileMenu = false">
                <div class="mdc-icon-button__ripple"></div>close
              </button>
              <a href="{{route('profile')}}" class="mdc-icon-button material-icons float-right">
                <div class="mdc-icon-button__ripple"></div>account_circle
              </a>
            </div>
            <div class="mt-4 block px-6">
              <img class="float-left h-16 w-16 rounded-full object-cover" src="{{ Auth::User()->profile_photo_url }}" alt="{{Auth::User()->firstname}}" />
              <div class="mt-2 ml-6 inline-block">
                <h6 class="nav-menu-name text-lg font-medium text-white">{{Auth::User()->firstname." ".Auth::User()->lastname }}</h6>
                <h1 class="nav-menu-email text-sm">{{ Auth::User()->email}}</h1>
              </div>
            </div>
          </div>
          <div class="mt-12 border-t border-gray-100"></div>
          <div class="pt-8 pl-4 pr-12">
            <a href="{{route('dashboard')}}" class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('app')) mobile-dropdown-selected @endif">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label"><i class="material-icons mdc-button__icon ml-2 inline-block" aria-hidden="true">dashboard</i>
              <span>Dashboard</span>
              </span>
            </a>
            <a href="{{route('assignments')}}" class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('assignments')) mobile-dropdown-selected @endif">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label"><i class="material-icons mdc-button__icon ml-2 inline-block" aria-hidden="true">assignment</i>
              <span>Assignments</span>
              </span>
            </a>
            <a href="{{route('schedule')}}" class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('agenda')) mobile-dropdown-selected @endif">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label"><i class="material-icons mdc-button__icon ml-2 inline-block" aria-hidden="true">calendar_today</i>
              <span>Schedule</span>
              </span>
            </a>
            <a href="{{route('themes')}}" class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('user/theme')) mobile-dropdown-selected @endif">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label"><i class="material-icons mdc-button__icon ml-2 inline-block" aria-hidden="true" x-text="themeIcon"></i>
              <span>Theme</span>
              </span>
            </a>
            <div class="absolute bottom-0 w-screen pt-8 pr-12">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button" onclick="event.preventDefault(); this.closest('form').submit();">
                  <span class="mdc-button__ripple"></span>
                  <span class="mdc-button__label"><i class="material-icons mdc-button__icon ml-2 inline-block" aria-hidden="true">logout</i>
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