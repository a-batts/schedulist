<div class="pt-20" x-data="{
    errorMessages: @entangle('errorMessages'),
    passwordField: 'password',
}">
    <x-ui.settings-card title="{{ strpos(URL::current(), 'update') === false ? 'Set' : 'Update' }} password"
        description="Choose a new password that's at least 10 characters and contains at least one uppercase letter, number, and special character."
        back-button>
        <form style="max-width: 600px" wire:submit.prevent="save">
            <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon mt-8 w-full"
                :class="{ 'mdc-text-field--invalid': errorMessages['password'] != undefined }" wire:ignore>
                <input class="mdc-text-field__input" aria-labelledby="password-label" :type="passwordField"
                    autofill="new-password" wire:model.debounce="password" required />
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
            <x-ui.validation-error for="password" />

            <p class="mt-4 text-gray-500">To keep your account secure, make sure that you do not use your new password
                for any of your other accounts, and that it is not something that can be easily guessed, like a family
                member or pet's name.</p>

            <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon mt-7 w-full"
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
            <x-ui.validation-error for="passwordConfirmation" />

            <div>
                <button class="mdc-button mdc-button-ripple mdc-button--raised float-right mt-6" wire:ignore>
                    <span class="mdc-button__ripple"></span>Save Password
                </button>
            </div>
        </form>
    </x-ui.settings-card>

</div>
