<nav class="z-10 w-screen fixed" style="background-color: #242323"
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
  get themeicon() {
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
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between" style="height: 4.2rem">
      <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
        <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white focus:outline-none focus:text-white transition duration-150 ease-in-out mdc-icon-button material-icons" aria-label="Main menu" aria-expanded="false" @click="mobileMenu = !mobileMenu">menu</button>
      </div>
      <div class="flex-1 flex items-center justify-center absolute md:relative schedulist-logo-nav sm:items-stretch sm:justify-start">
        <div class="flex-shrink-0">
          <img src="{{ asset('images/logo/logo_light.svg') }}" width="140px" class="border-none mb-3" alt="Schedulist Logo"></img>
        </div>
      </div>
      <div class="absolute w-full">
        <div class="hidden md:flex items-center justify-center w-full space-x-2 left-0 right-0 mx-auto">
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
      <div class="pt-4 pb-3 border-gray-700 profile-button-icon hidden md:block z-20">
        @if (Auth::check())
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <button aria-describedby="switchacct-tooltip" class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white transition duration-150 ease-in-out profilebutton"
              id="user-menu" @click="profileMenu = !profileMenu" aria-label="User menu" aria-haspopup="true">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::User()->profile_photo_url }}" alt="{{Auth::User()->firstname}}" />
              </button>
            </div>
            <div class="origin-top-right absolute right-0 mt-2 mdc-card mdc-card-outlined profile-menu"
            x-show.transition="profileMenu" @click.away="profileMenu = false" x-cloak>
              <div class="dropdowncontainer mb-4">
                <div class="dropdown_left">
                  <img class="h-12 w-12 rounded-full object-cover" src="{{ Auth::User()->profile_photo_url }}" alt="{{Auth::User()->firstname}}" />
                </div>
                <div class="dropdown_right">
                  <h6 class="name_head font-medium text-base nunito">{{Auth::User()->firstname." ".Auth::User()->lastname }}</h6>
                  <h1 class="email_head text-xs">{{ Auth::User()->email}}</h1>
                </div>
              </div>
              <div class="section-border border-100"></div>
              <a href="{{ route('profile') }}" class="text-md block lowercase-text" @click="profileMenu = false">
                <button class="mdc-button mdc-button-ripple lowercase-text menu-buttons">
                  <span class="mdc-button__ripple"></span>
                  <p class="menu-button-text">Account Settings</p>
                </button>
              </a>
              @if(Auth::User()->canAccessFilament())
                <a href="{{ route('filament.dashboard') }}" class="text-md block lowercase-text" @click="profileMenu = false" data-turbolinks="false">
                  <button class="mdc-button mdc-button-ripple lowercase-text menu-buttons">
                    <span class="mdc-button__ripple"></span>
                    <p class="menu-button-text">Admin Dashboard</p>
                  </button>
                </a>
              @endif
              <a href="{{ route('themes') }}" class=" text-md block lowercase-text" @click="profileMenu = false">
                <button class="mdc-button mdc-button-ripple lowercase-text menu-buttons">
                  <span class="mdc-button__ripple"></span>
                  <p class="menu-button-text">Change Theme</p>
                </button>
              </a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mdc-button mdc-button-ripple mdc-button--outlined popup-signout g_id_signout" onclick="event.preventDefault(); this.closest('form').submit(); google.accounts.id.disableAutoSelect();">
                  <span class="mdc-button__ripple"></span>
                  Sign Out
                </button>
              </form>
            </div>
          </div>
        @else
          <div>
            <a href="{{ route('login') }}">
              <button class="mdc-button mdc-button-ripple mdc-button--raised ml-3 float-right">
                <span class="mdc-button__ripple"></span>Sign In
              </button>
            </a>
            <a href="{{ route('register') }}" class="hidden md:block float-right">
              <button class="mdc-button mdc-button-ripple">
                <span class="mdc-button__ripple"></span>Sign Up
              </button>
            </a>
          </div>
        @endif
      </div>
    </div>
    <!-- Mobile menu list -->
    <div class="md:hidden fixed z-20 w-screen left-0 top-0 mobile-menu" style="background-color: #242323" x-show.transition="mobileMenu" x-cloak>
      <div class="px-2 text-white">
        <div class="pt-3">
          <div class="block mobile-menu-top">
            <button class="mdc-icon-button material-icons float-left" @click="mobileMenu = false">
              <div class="mdc-icon-button__ripple"></div>close
            </button>
            @if (Auth::check())
              <a href="{{route('profile')}}">
                <button class="mdc-icon-button material-icons float-right">
                  <div class="mdc-icon-button__ripple"></div>account_circle
                </button>
              </a>
            @endif
          </div>
          <div class="block mt-4 px-6">
            @if (Auth::check())
              <img class="h-16 w-16 rounded-full object-cover float-left" src="{{ Auth::User()->profile_photo_url }}" alt="{{Auth::User()->firstname}}" />
              <div class="inline-block ml-6 mt-2">
                <h6 class="name_head font-medium text-lg text-white">{{Auth::User()->firstname." ".Auth::User()->lastname }}</h6>
                <h1 class="email_head text-sm">{{ Auth::User()->email}}</h1>
              </div>
            @endif
          </div>
        </div>
        <div class="border-t border-gray-100 mt-12"></div>
        <div class="pl-4 pr-12 pt-8">
          @if(Auth::check())
            <a href="{{route('dashboard')}}">
              <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('app')) mobile-dropdown-selected @endif">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label"><i class="material-icons mdc-button__icon inline-block ml-2" aria-hidden="true">dashboard</i>
                <span>Dashboard</span>
                </span>
              </button>
            </a>
            <a href="{{route('assignments')}}">
              <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('assignments')) mobile-dropdown-selected @endif">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label"><i class="material-icons mdc-button__icon inline-block ml-2" aria-hidden="true">assignment</i>
                <span>Assignments</span>
                </span>
              </button>
            </a>
            <a href="{{route('schedule')}}">
              <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('agenda')) mobile-dropdown-selected @endif">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label"><i class="material-icons mdc-button__icon inline-block ml-2" aria-hidden="true">calendar_today</i>
                <span>Schedule</span>
                </span>
              </button>
            </a>
          @endif
          <a href="{{route('themes')}}">
            <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button @if(Request::is('user/theme')) mobile-dropdown-selected @endif">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label"><i class="material-icons mdc-button__icon inline-block ml-2" aria-hidden="true" x-text="themeicon"></i>
              <span>Theme</span>
              </span>
            </button>
          </a>
          @if(Auth::check())
            <div class="absolute pr-12 pt-8 bottom-0 w-screen">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button" onclick="event.preventDefault(); this.closest('form').submit();">
                  <span class="mdc-button__ripple"></span>
                  <span class="mdc-button__label"><i class="material-icons mdc-button__icon inline-block ml-2" aria-hidden="true">logout</i>
                  <span>Sign out</span>
                  </span>
                </button>
              </form>
            </div>
          @else
            <div class="absolute pr-12 pt-8 bottom-0 w-screen">
              <a href="{{ route('login') }}">
                <button class="mdc-button mdc-button--icon-leading mobile-dropdown-button">
                  <span class="mdc-button__ripple"></span>
                  <span class="mdc-button__label"><i class="material-icons mdc-button__icon inline-block ml-2" aria-hidden="true">login</i>
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
