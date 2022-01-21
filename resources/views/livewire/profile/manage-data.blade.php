<div>
    <x-ui.settings-card title="Your data"
    description="Download or delete parts of your data, or delete your entire account.">
        <div class="pb-2 -mx-4">
            <ul class="w-full mdc-deprecated-list mdc-deprecated-list--two-line mdc-deprecated-list--icon-list security-list">
                <a class="border-b border-gray-200 security-list mdc-deprecated-list-item" tabindex="0" href="{{route('account.manage-data')}}">
                    <span class="mdc-deprecated-list-item__ripple"></span>
                    <span class="text-gray-600 mdc-deprecated-list-item__graphic material-icons text-inherit" aria-hidden="true">
                        source
                    </span>
                    <span class="security-list-text mdc-deprecated-list-item__text">
                        <span class="text-lg">Manage data</span>
                        <span class="-mt-2 text-sm text-gray-500 mdc-deprecated-list-item__secondary-text">Download archives of your Schedulist data or delete specific parts of it</span>
                    </span>
                    <button class="absolute right-0 sm:right-5 mdc-icon-button material-icons" type="button" aria-describedby="" aria-label="">navigate_next</button>
                </a>
                <a class="border-b border-gray-200 security-list mdc-deprecated-list-item" tabindex="0" href="{{route('account.delete-account')}}">
                    <span class="mdc-deprecated-list-item__ripple"></span>
                    <span class="text-gray-600 mdc-deprecated-list-item__graphic material-icons text-inherit" aria-hidden="true">
                        delete_forever
                    </span>
                    <span class="security-list-text mdc-deprecated-list-item__text">
                        <span class="text-lg">Delete account</span>
                        <span class="-mt-2 text-sm text-gray-500 mdc-deprecated-list-item__secondary-text">Permanently delete your account and all of its data</span>
                    </span>
                    <button class="absolute right-0 sm:right-5 mdc-icon-button material-icons" type="button" aria-describedby="" aria-label="">navigate_next</button>
                </a>
              </ul>
        </div>
    </x-ui.settings-card>
</div>
