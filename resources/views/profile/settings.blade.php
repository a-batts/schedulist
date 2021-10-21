<x-app-layout style="mt-10" title="Account Settings">
    <div class="py-10 pt-20 mx-auto max-w-7xl sm:px-6 lg:px-8">
        @livewire('profile.update-profile')
        <x-jet-section-border />
        <div class="mt-10 sm:mt-0">
            @livewire('profile.security-settings')
        </div>
        <x-jet-section-border />
        <div class="mt-10 sm:mt-0">
            @livewire('profile.social-logins')
        </div>
        <x-jet-section-border />
        <div class="mt-10 sm:mt-0">
            @livewire('profile.notification-settings')
        </div>
    </div>
</x-app-layout>
