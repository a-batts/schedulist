<x-app-layout title="Account Settings" style="mt-10">
    <x-offline-banner />
    <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mdc-card mdc-card--outlined options_card mdc-typography mb-12">
            <div>
                <div>
                    <h4 class="mt-2 text-4xl font-bold">Settings</h4>
                    <p class="mt-2 text-gray-600">Customize your account to make it yours.</p>
                </div>
                <div class="mt-5 border-t border-gray-200"></div>
                <p class="pt-4 text-lg">Other settings</p>
                <span class="mdc-deprecated-list-item__secondary-text -mt-1 text-sm text-gray-500">Modify additional
                    options not displayed on this page</span>
                <div class="flex flex-wrap pt-4 gap-x-3 gap-y-3">
                    <div>
                        <a class="mdc-button mdc-button--outlined mdc-button--icon-leading"
                            href="{{ route('schedule-settings') }}">
                            <span class="mdc-button__ripple"></span>
                            <i class="material-icons mdc-button__icon" aria-hidden="true">edit_calendar</i>
                            <span class="mdc-button__label">Manage class schedules</span>
                        </a>
                    </div>
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
        @if (Auth::user()->hasPassword)
            <div class="mt-10 sm:mt-0">
                @livewire('profile.manage-data')
            </div>
        @endif
    </div>
</x-app-layout>
