<div>
    <x-ui.settings-card title="Account security"
    description="{{Auth::user()->hasPassword ? 'Change your password, or enable other settings to help keep your account secure.' : 'Set a password first before you can access other security settings.'}}">
        <div class="pb-2 -mx-4">
            <ul class="w-full mdc-deprecated-list mdc-deprecated-list--two-line mdc-deprecated-list--icon-list security-list">
                @if(Auth::user()->hasPassword)
                    <a class="border-b border-gray-200 security-list mdc-deprecated-list-item" tabindex="0" href="{{route('account.update-password')}}">
                        <span class="mdc-deprecated-list-item__ripple"></span>
                        <span class="text-gray-600 mdc-deprecated-list-item__graphic material-icons text-inherit" aria-hidden="true">
                            vpn_key
                        </span>
                        <span class="security-list-text mdc-deprecated-list-item__text">
                            <span class="text-lg">Change your password</span>
                            <span class="-mt-2 text-sm text-gray-500 mdc-deprecated-list-item__secondary-text">Choose a new strong password</span>
                        </span>
                        <button class="absolute right-0 mdc-icon-button material-icons text-primary sm:right-5" type="button" aria-describedby="" aria-label="">
                            <div class="mdc-icon-button__ripple"></div>
                            navigate_next</button>
                    </a>
                    <a class="border-b border-gray-200 security-list mdc-deprecated-list-item" href="{{route('account.manage-devices')}}">
                        <span class="mdc-deprecated-list-item__ripple"></span>
                        <span class="text-gray-600 mdc-deprecated-list-item__graphic material-icons text-inherit" aria-hidden="true">
                            devices
                        </span>
                        <span class="security-list-text mdc-deprecated-list-item__text">
                            <span class="text-lg">Managed signed in devices</span>
                            <span class="-mt-2 text-sm text-gray-500 mdc-deprecated-list-item__secondary-text">View and remove other devices</span>
                        </span>
                        <button class="absolute right-0 mdc-icon-button material-icons text-primary sm:right-5" type="button" aria-describedby="" aria-label="">
                            <div class="mdc-icon-button__ripple"></div>
                            navigate_next</button>
                    </a>
                    <a class="border-b border-gray-200 security-list mdc-deprecated-list-item" href="{{route('account.two-factor')}}">
                        <span class="mdc-deprecated-list-item__ripple"></span>
                        <span class="text-gray-600 mdc-deprecated-list-item__graphic material-icons text-inherit" aria-hidden="true">
                            verified_user
                        </span>
                        <span class="security-list-text mdc-deprecated-list-item__text">
                            <span class="text-lg">{{!empty(Auth::user()->two_factor_secret) ? 'Manage 2-Factor settings' : 'Enable 2-Factor verification'}}</span>
                            <span class="-mt-2 text-sm text-gray-500 mdc-deprecated-list-item__secondary-text">{{!empty(Auth::user()->two_factor_secret) ? 'Enabled: Manage 2FA settings' : 'Disabled: Setup Schedulist with your 2FA app'}}</span>
                        </span>
                        <button class="absolute right-0 mdc-icon-button material-icons text-primary sm:right-5" type="button" aria-describedby="" aria-label="">
                            <div class="mdc-icon-button__ripple"></div>
                            navigate_next</button>
                    </a>
                @else
                <a class="border-b border-gray-200 security-list mdc-deprecated-list-item" tabindex="0" href="{{route('account.set-password')}}">
                    <span class="mdc-deprecated-list-item__ripple"></span>
                    <span class="text-gray-600 mdc-deprecated-list-item__graphic material-icons text-inherit" aria-hidden="true">
                        vpn_key
                    </span>
                    <span class="security-list-text mdc-deprecated-list-item__text">
                        <span class="text-lg">Set a password</span>
                        <span class="-mt-2 text-sm text-gray-500 mdc-deprecated-list-item__secondary-text">Use it as a backup to your Google login</span>
                    </span>
                    <button class="absolute right-0 mdc-icon-button material-icons text-primary sm:right-5" type="button" aria-describedby="" aria-label="">
<div class="mdc-icon-button__ripple"></div>
navigate_next</button>
                </a>
                @endif
              </ul>
        </div>
    </x-ui.settings-card>
</div>
