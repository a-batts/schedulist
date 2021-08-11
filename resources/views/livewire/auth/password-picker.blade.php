<div
x-data="{
  passwordField: 'password',
  errorMessages: @entangle('errorMessages'),
}"
>
    <x-ui.auth-card title="Set a password" description="Setting a password will allow you to sign in without using your Google Account, in case you lose access to it.">
      <p class="text-sm text-gray-600 mt-2">Your password needs to be at least 10 characters and contain at least one uppercase letter, number, and special character.</p>
      <form wire:submit.prevent="save">
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon mt-8 w-full" :class="{'mdc-text-field--invalid': errorMessages['password'] != undefined}" wire:ignore>
          <input class="mdc-text-field__input" aria-labelledby="password-label" :type="passwordField" autofill="new-password" wire:model.lazy="password" required />
          <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon" @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'" type="button" tabindex="0">
            <i class="material-icons mdc-icon-button__icon" x-text="passwordField == 'password' ? 'visibility' : 'visibility_off'"></i>
          </button>
          <span class="mdc-notched-outline">
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label" id="password-label">New Password</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        <x-ui.validation-hint :message="$errorMessages" for="password"/>

        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon mt-7 w-full" :class="{'mdc-text-field--invalid': errorMessages['passwordConfirmation'] != undefined}" wire:ignore>
          <input class="mdc-text-field__input" aria-labelledby="passwordconf-label" :type="passwordField" autofill="new-password" wire:model.lazy="passwordConfirmation" required />
          <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon" @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'" type="button" tabindex="0">
            <i class="material-icons mdc-icon-button__icon" x-text="passwordField == 'password' ? 'visibility' : 'visibility_off'"></i>
          </button>
          <span class="mdc-notched-outline">
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label" id="passwordconf-label">Confirm New Password</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        <x-ui.validation-hint :message="$errorMessages" for="passwordConfirmation"/>

        <div>
          <button class="mdc-button mdc-button-ripple mdc-button--raised float-right mt-6" wire:ignore>
              <span class="mdc-button__ripple"></span>Save Password
          </button>
        </div>
      </form>

    </x-ui.auth-card>
</div>
