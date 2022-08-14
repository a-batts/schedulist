<div
x-data="{
  passwordField: 'password',
  errorMessages: @entangle('errorMessages'),
}"
>
    <x-ui.auth-card title="Confirm your password" description="To finish linking your Google Account, confirm ownership of the Schedulist Account with the same email address">
      <form wire:submit.prevent="authenticate">
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon mt-8 w-full" :class="{'mdc-text-field--invalid': errorMessages['password'] != undefined}" wire:ignore>
          <input class="mdc-text-field__input" aria-labelledby="password-label" :type="passwordField" autofill="current-password" wire:model.lazy="password" required />
          <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon" @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'" type="button" tabindex="0">
            <i class="material-icons mdc-icon-button__icon" x-text="passwordField == 'password' ? 'visibility' : 'visibility_off'"></i>
          </button>
          <span class="mdc-notched-outline">
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label" id="password-label">Password</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        <x-ui.validation-error :message="$errorMessages" for="password"/>

        <div>
          <button class="mdc-button mdc-button-ripple mdc-button--raised float-right mt-6" wire:ignore>
              <span class="mdc-button__ripple"></span>Confirm Password
          </button>
        </div>
      </form>

    </x-ui.auth-card>
</div>
