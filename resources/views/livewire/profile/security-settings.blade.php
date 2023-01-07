<div>
    <x-ui.settings-card title="Account security"
        description="{{ Auth::user()->hasPassword ? 'Change your password, or enable other settings to help keep your account secure.' : 'Set a password first before you can access other security settings.' }}">
        <div class="pb-2 -mx-4">
            <ul
                class="mdc-deprecated-list mdc-deprecated-list--two-line mdc-deprecated-list--icon-list security-list w-full">
                @if (Auth::user()->hasPassword)
                    <a class="security-list mdc-deprecated-list-item border-b border-gray-200"
                        href="{{ route('account.update-password') }}" tabindex="0">
                        <span class="mdc-deprecated-list-item__ripple"></span>
                        <span class="mdc-deprecated-list-item__graphic material-icons text-gray-600 text-inherit"
                            aria-hidden="true">
                            vpn_key
                        </span>
                        <span class="security-list-text mdc-deprecated-list-item__text">
                            <span class="text-lg">Change your password</span>
                            <span class="mdc-deprecated-list-item__secondary-text -mt-2 text-sm text-gray-500">Choose a
                                new strong password</span>
                        </span>
                        <button class="mdc-icon-button material-icons text-primary absolute right-0 sm:right-5"
                            type="button" aria-describedby="" aria-label="">
                            <div class="mdc-icon-button__ripple"></div>
                            navigate_next
                        </button>
                    </a>
                    <a class="security-list mdc-deprecated-list-item border-b border-gray-200"
                        href="{{ route('account.manage-devices') }}">
                        <span class="mdc-deprecated-list-item__ripple"></span>
                        <span class="mdc-deprecated-list-item__graphic material-icons text-gray-600 text-inherit"
                            aria-hidden="true">
                            devices
                        </span>
                        <span class="security-list-text mdc-deprecated-list-item__text">
                            <span class="text-lg">Managed signed in devices</span>
                            <span class="mdc-deprecated-list-item__secondary-text -mt-2 text-sm text-gray-500">View and
                                remove other devices</span>
                        </span>
                        <button class="mdc-icon-button material-icons text-primary absolute right-0 sm:right-5"
                            type="button" aria-describedby="" aria-label="">
                            <div class="mdc-icon-button__ripple"></div>
                            navigate_next
                        </button>
                    </a>
                    <a class="security-list mdc-deprecated-list-item border-b border-gray-200"
                        href="{{ route('account.two-factor') }}">
                        <span class="mdc-deprecated-list-item__ripple"></span>
                        <span class="mdc-deprecated-list-item__graphic material-icons text-gray-600 text-inherit"
                            aria-hidden="true">
                            verified_user
                        </span>
                        <span class="security-list-text mdc-deprecated-list-item__text">
                            <span
                                class="text-lg">{{ !empty(Auth::user()->two_factor_secret) ? 'Manage 2-Factor settings' : 'Enable 2-Factor verification' }}</span>
                            <span
                                class="mdc-deprecated-list-item__secondary-text -mt-2 text-sm text-gray-500">{{ !empty(Auth::user()->two_factor_secret) ? 'Enabled: Manage 2FA settings' : 'Disabled: Setup Schedulist with your 2FA app' }}</span>
                        </span>
                        <button class="mdc-icon-button material-icons text-primary absolute right-0 sm:right-5"
                            type="button" aria-describedby="" aria-label="">
                            <div class="mdc-icon-button__ripple"></div>
                            navigate_next
                        </button>
                    </a>
                @else
                    <a class="security-list mdc-deprecated-list-item border-b border-gray-200"
                        href="{{ route('account.set-password') }}" tabindex="0">
                        <span class="mdc-deprecated-list-item__ripple"></span>
                        <span class="mdc-deprecated-list-item__graphic material-icons text-gray-600 text-inherit"
                            aria-hidden="true">
                            vpn_key
                        </span>
                        <span class="security-list-text mdc-deprecated-list-item__text">
                            <span class="text-lg">Set a password</span>
                            <span class="mdc-deprecated-list-item__secondary-text -mt-2 text-sm text-gray-500">Use it as
                                a backup to your Google login</span>
                        </span>
                        <button class="mdc-icon-button material-icons text-primary absolute right-0 sm:right-5"
                            type="button" aria-describedby="" aria-label="">
                            <div class="mdc-icon-button__ripple"></div>
                            navigate_next
                        </button>
                    </a>
                @endif
            </ul>
        </div>
    </x-ui.settings-card>
</div>
