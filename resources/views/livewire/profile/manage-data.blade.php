<div>
    <x-ui.settings-card title="Your data"
        description="Download or delete parts of your data, or delete your entire account.">
        <div class="pb-2 -mx-4">
            <ul
                class="mdc-deprecated-list mdc-deprecated-list--two-line mdc-deprecated-list--icon-list security-list w-full">
                <a class="security-list mdc-deprecated-list-item border-b border-gray-200"
                    href="{{ route('account.manage-data') }}" tabindex="0">
                    <span class="mdc-deprecated-list-item__ripple"></span>
                    <span class="mdc-deprecated-list-item__graphic material-icons text-gray-600 text-inherit"
                        aria-hidden="true">
                        source
                    </span>
                    <span class="security-list-text mdc-deprecated-list-item__text">
                        <span class="text-lg">Manage data</span>
                        <span class="mdc-deprecated-list-item__secondary-text -mt-2 text-sm text-gray-500">Download
                            archives of your Schedulist data or delete specific parts of it</span>
                    </span>
                    <button class="mdc-icon-button material-icons text-primary absolute right-0 sm:right-5"
                        type="button" aria-describedby="" aria-label="">
                        <div class="mdc-icon-button__ripple"></div>
                        navigate_next
                    </button>
                </a>
                <a class="security-list mdc-deprecated-list-item border-b border-gray-200"
                    href="{{ route('account.delete-account') }}" tabindex="0">
                    <span class="mdc-deprecated-list-item__ripple"></span>
                    <span class="mdc-deprecated-list-item__graphic material-icons text-gray-600 text-inherit"
                        aria-hidden="true">
                        delete_forever
                    </span>
                    <span class="security-list-text mdc-deprecated-list-item__text">
                        <span class="text-lg">Delete account</span>
                        <span class="mdc-deprecated-list-item__secondary-text -mt-2 text-sm text-gray-500">Permanently
                            delete your account and all of its data</span>
                    </span>
                    <button class="mdc-icon-button material-icons text-primary absolute right-0 sm:right-5"
                        type="button" aria-describedby="" aria-label="">
                        <div class="mdc-icon-button__ripple"></div>
                        navigate_next
                    </button>
                </a>
            </ul>
        </div>
    </x-ui.settings-card>
</div>
