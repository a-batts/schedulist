<x-app-layout style="mt-10" title="Account Settings">
    <div class="py-10 pt-20 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-12 mdc-card mdc-card--outlined options_card mdc-typography">
            <div>
                <div>
                    <h4 class="mt-2 text-4xl font-medium">Settings</h4>
                </div>
            </div>
            <div>
            </div>
        </div>
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
        <x-jet-section-border />
        @if(Auth::user()->hasPassword)
            <div class="mt-10 sm:mt-0">
                @livewire('profile.manage-data')
            </div>
        @endif
    </div>
</x-app-layout>
