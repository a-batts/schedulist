<nav style="background-color:#242323; z-index:5" x-data="{ open: false, mobile: false }" class="mdc-elevation--z6 mdc-typography w-screen fixed" data-turbo-permanent>
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 ">
    <div class="relative flex items-center justify-between" style="height: 4.2rem">
      <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
        <!-- Mobile menu button-->
        <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white focus:outline-none focus:text-white transition duration-150 ease-in-out mdc-icon-button material-icons" aria-label="Main menu" aria-expanded="false" @click="mobile = !mobile">menu</button>
      </div>
      <div class="flex-1 flex items-center justify-center schedulist-logo-nav sm:items-stretch sm:justify-start">
        <div class="flex-shrink-0">
          <img src="{{ asset('images/logo/logo_light.svg') }}" width="140px" class="border-none mb-3" alt="Schedulist Logo"></img>
        </div>
        <div class="hidden md:block">
          <div class="ml-9 mt-1.5 flex items-baseline space-x-4">
            @if(! Auth::check())
            <a rel="prefetch" href="../" class="nava @if(Request::is('/')) test @endif"><button class="mdc-button mdc-button-ripple navbutton" @if(Request::is('/')) disabled @endif><span class="mdc-button__ripple"></span>Home</button></a>
            @else
            <a rel="prefetch" href="{{ route('dashboard') }}" class="nava @if(Request::is('app')) test @endif"><button class="mdc-button mdc-button-ripple navbutton" @if(Request::is('app')) disabled @endif><span class="mdc-button__ripple"></span>Dashboard</button></a>
            <a rel="prefetch" href="{{ route('assignments') }}" class="nava @if(Request::is('assignments')) test @endif"><button class="mdc-button mdc-button-ripple navbutton" @if(Request::is('assignments')) disabled @endif><span class="mdc-button__ripple"></span>Assignments</button></a>
            <a rel="prefetch" href="{{ route('schedule') }}" class="nava @if(Request::is('schedule')) test @endif"><button class="mdc-button mdc-button-ripple navbutton" @if(Request::is('schedule')) disabled @endif><span class="mdc-button__ripple"></span>Schedule</button></a>
            @endif
          </div>

          </div>
      </div>
      <div class="pt-4 pb-3 border-gray-700 profile-button-icon">
        <!-- Profile dropdown -->
        @if (Auth::check())
      <div class="flex items-center px-5">
        <div class="flex-shrink-0">
          <button aria-describedby="switchacct-tooltip" class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white transition duration-150 ease-in-out profilebutton" id="user-menu" @click="open = !open" aria-label="User menu" aria-haspopup="true">
            <img class="h-8 w-8 rounded-full object-cover" src="@if(Auth::User()->profile_photo_path != null)http://@endif{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->firstname }}" />
          </button>
        </div>
        <div class="origin-top-right absolute right-0 mt-2 mdc-card mdc-card-outlined profile_menu" x-show.transition="open" @click.away="open = false" x-cloak>
          <div class="dropdowncontainer mb-4">
            <div class="dropdown_left">
              <img class="h-12 w-12 rounded-full object-cover" src="@if(Auth::User()->profile_photo_path != null)http://@endif{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->firstname }}" />
            </div>
            <div class="dropdown_right">
              <h6 class="name_head font-medium text-base nunito">{{ Auth::user()->firstname." ".Auth::user()->lastname }}</h6>
              <h1 class="email_head text-xs">{{ Auth::user()->email}}</h1>
            </div>
          </div>
          <div class="section-border border-100"></div>
          <a href="{{ route('profile') }}" id="profilelink" class="text-md dropdownlinks lowercase-text hover" @click="open = false">
            <button class="mdc-button mdc-button-ripple lowercase-text menu-buttons">
              <span class="mdc-button__ripple"></span>
              <p class="menubutton-p nunito">Account settings</p>
            </button>
          </a>
          @if(Auth::User()->canAccessFilament())
            <a href="{{ route('filament.dashboard') }}" class=" text-md dropdownlinks lowercase-text hover" @click="open = false" data-turbolinks="false">
              <button class="mdc-button mdc-button-ripple lowercase-text menu-buttons">
                <span class="mdc-button__ripple"></span>
                <p class="menubutton-p nunito">Admin dashboard</p>
              </button>
            </a>
          @endif
          <a href="{{ route('themes') }}" class=" text-md dropdownlinks lowercase-text hover" @click="open = false">
            <button class="mdc-button mdc-button-ripple lowercase-text menu-buttons">
              <span class="mdc-button__ripple"></span>
              <p class="menubutton-p nunito">Change theme</p>
            </button>
          </a>
          <form method="POST" action="{{ route('logout') }}">
                @csrf
            <button class="mdc-button mdc-button-ripple mdc-button--outlined popup-signout" onclick="event.preventDefault(); this.closest('form').submit(); caches.delete('schedulist')">
              <span class="mdc-button__ripple"></span>
              Sign Out
            </button>
          </form>
        </div>
      </div>
      @else
      <a href="{{ route('register') }}" class="regbutton"><button class="mdc-button mdc-button-ripple"><span class="mdc-button__ripple"></span>Sign Up</button></a>
      <a href="{{ route('login') }}"><button class="mdc-button mdc-button-ripple mdc-button--raised right_button"><span class="mdc-button__ripple"></span>Sign In</button></a>
      @endif
    </div>
  </div>
  <!--
    Mobile menu
  -->
    <div class="md:hidden" x-show.transition="mobile" x-cloak>
      <div class="px-2 pt-2 pb-3">
        @if(! Auth::check())
          <a href="../" class="mt-1 block px-3 py-2 rounded-md text-base font-medium @if(Request::is('/')) text-white @else text-gray-300 hover:text-white hover:bg-gray-700 @endif  focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Home</a>
        @else
          <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium @if(Request::is('app')) text-white
          @else hover:text-white hover:bg-gray-700 text-gray-300 @endif focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Dashboard</a>
          <a href="{{ route('assignments') }}" class="mt-1 block px-3 py-2 rounded-md text-base font-medium             @if(Request::is('assignments')) text-white @else text-gray-300 hover:text-white hover:bg-gray-700 @endif focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Assignments</a>
        @endif
        <a href="{{ route('contact') }}" class="mt-1 block px-3 py-2 rounded-md text-base font-medium @if(Request::is('contact'))  text-white @else text-gray-300 hover:text-white hover:bg-gray-700 @endif focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Contact</a>
        @if (! Auth::check())
          <a href="{{ route('register') }}"  class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Sign Up</a>
        @endif
      </div>
    </div>
  </div>
</nav>
