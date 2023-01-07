<div x-data="{
    passwordField: 'password',
    errorMessages: @entangle('errorMessages'),
}">
    <x-ui.auth-card title="Set a password"
        description="Setting a password will allow you to sign in without using your Google Account, in case you lose access to it.">
        <p class="mt-2 text-sm text-gray-600">Your password needs to be at least 10 characters and contain at least one
            uppercase letter, number, and special character.</p>
        <form wire:submit.prevent="save">
            <label class="w-full mt-8 mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon"
                :class="{ 'mdc-text-field--invalid': errorMessages['password'] != undefined }" wire:ignore>
                <input class="mdc-text-field__input" aria-labelledby="password-label" :type="passwordField"
                    autofill="new-password" wire:model.lazy="password" required />
                <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon"
                    type="button" tabindex="0"
                    @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'">
                    <i class="material-icons mdc-icon-button__icon"
                        x-text="passwordField == 'password' ? 'visibility' : 'visibility_off'"></i>
                </button>
                <span class="mdc-notched-outline">
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                        <span class="mdc-floating-label" id="password-label">New Password</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                </span>
            </label>
            <x-ui.validation-error for="password" :message="$errorMessages" />

            <label class="w-full mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon mt-7"
                :class="{ 'mdc-text-field--invalid': errorMessages['passwordConfirmation'] != undefined }" wire:ignore>
                <input class="mdc-text-field__input" aria-labelledby="passwordconf-label" :type="passwordField"
                    autofill="new-password" wire:model.lazy="passwordConfirmation" required />
                <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon"
                    type="button" tabindex="0"
                    @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'">
                    <i class="material-icons mdc-icon-button__icon"
                        x-text="passwordField == 'password' ? 'visibility' : 'visibility_off'"></i>
                </button>
                <span class="mdc-notched-outline">
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                        <span class="mdc-floating-label" id="passwordconf-label">Confirm New Password</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                </span>
            </label>
            <x-ui.validation-error for="passwordConfirmation" :message="$errorMessages" />

            <div>
                <button class="float-right mt-6 mdc-button mdc-button-ripple mdc-button--raised" wire:ignore>
                    <span class="mdc-button__ripple"></span>Save Password
                </button>
            </div>
        </form>

    </x-ui.auth-card>
</div>
