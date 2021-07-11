<div class="mdc-card mdc-card--outlined options_card">
  <h4 class="mdc-typography mdc-typography--headline5 mt-2 nunito">Delete Data</h4>
  <p class="mdc-typography mdc-typography--body2 text-gray-600 mt-1">Remove all of your classes and assignments for a fresh start. Once your account data is deleted, it will be permanently erased and will not be able to be recovered.</p>
  <div class="border-t border-gray-200 mt-5"></div>
  <div>
    <button class="mdc-button mdc-button-ripple mdc-button--raised tfa-button mt-5 delete_account" wire:ignore>
      <span class="mdc-button__ripple" wire:click="confirmDataDeletion" wire:loading.attr="disabled"></span>
        Delete Data
    </button>
  </div>
  <x-jet-dialog-modal wire:model="confirmingDataDeletion">
      <x-slot name="title">
          <h4 class="mdc-typography logintext mt-2 nunito">Confirm Deletion</h4>
      </x-slot>

      <x-slot name="content">
          <p class="mdc-typography mdc-typography--body2">{{ __('Are you sure you want to delete your account data? Once your data is deleted, it will be permanently erased and can not be recovered. Please enter your password to verify you would like to permanently delete your data.') }}</p>

          <div class="mt-10 email_margins" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
            <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon pw_input login-form" wire:ignore>
              <input type="password" id="dat_password" class="mdc-text-field__input" aria-labelledby="password-label" name="password" required x-ref="password" wire:model.defer="password" wire:keydown.enter="deleteData"/>
              <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle" onclick="showLoginPassword('perm_password')" type="button" tabindex="0"><i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i><i class="material-icons mdc-icon-button__icon">visibility</i></button>
              <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__notch">
                  <span class="mdc-floating-label" id="password-label">Password</span>
                </span>
                <span class="mdc-notched-outline__trailing"></span>
              </span>
            </label>
            <div class="mt-5 mb-2 ml-2">
              <x-jet-input-error for="password"/>
            </div>
          </div>
          <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button mt-10 ml-3 mb-4" wire:click="deleteData" wire:loading.attr="disabled" wire:ignore>
            <span class="mdc-button__ripple"></span>
              {{ __('Delete Data') }}
          </button>
          <button class="mdc-button mdc-button-ripple mt-10 tfa-button" wire:click="$toggle('confirmingDataDeletion')" wire:loading.attr="disabled" wire:ignore>
            <span class="mdc-button__ripple"></span>
              {{ __('Nevermind') }}
          </button>
      </x-slot>

      <x-slot name="footer">
      </x-slot>
  </x-jet-dialog-modal>
</div>
