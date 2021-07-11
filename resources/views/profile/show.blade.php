<x-app-layout style="mt-10" title="Account Settings">
    @push('meta')
      <meta name="turbolinks-cache-control" content="no-cache">
    @endpush
    @push('fonts')
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet" type="text/css" media="print" onload="this.media='all'">
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>


    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
          <div class="mt-10"></div>
            @livewire('profile.update-profile')

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <x-jet-section-border />
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password')
                </div>
            @endif

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.social-logins')
            </div>

            @if (Auth::User()->phone != null)
              <x-jet-section-border />

              <div class="mt-10 sm:mt-0">
                  @livewire('profile.manage-texts')
              </div>
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>
            @endif


            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-data')
            </div>

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
