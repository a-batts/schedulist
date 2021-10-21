<x-app-layout style="mt-10" title="Account Settings">
    @push('meta')
        <meta name="turbolinks-cache-control" content="no-cache">
    @endpush
    @push('fonts')
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet" type="text/css"
            media="print" onload="this.media='all'">
    @endpush
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>


    <div>
        <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if (Auth::User()->phone != null)
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.notification-settings')
                </div>
            @endif

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
