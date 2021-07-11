@if(Auth::user()->hasPassword)
<form wire:submit.prevent="save">
    @csrf
    <div class="mdc-card mdc-card--outlined options_card">
      <h4 class="mdc-typography mdc-typography--headline5 mt-2 nunito">Update Password</h4>
      <p class="mdc-typography mdc-typography--body2 text-gray-600 mt-1">Choose a strong password that's at least 10 characters and contains at least one uppercase letter, number, and special character</p>
      <div class="border-t border-gray-200 mt-5"></div>
      <div class="col-span-6 mt-5 email_margins">
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon pw_input login-form @error('currentPassword') mdc-text-field--invalid @enderror">
          <input type="password" id="current_password" class="mdc-text-field__input" aria-labelledby="old-password-label" required wire:model="currentPassword"/>
          <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle" onclick="showLoginPassword('current_password')" type="button" tabindex="0" wire:ignore><i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i><i class="material-icons mdc-icon-button__icon">visibility</i></button>
          <span class="mdc-notched-outline" wire:ignore>
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label" id="old-password-label">Old Password</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        @error('currentPassword')
        <div class="livewire-helper mdc-text-field-helper-line">
          <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="firstname-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
        </div>
        @enderror
      </div>
      <div class="col-span-6 mt-7 email_margins">
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon @error('newPassword') mdc-text-field--invalid @enderror pw_input login-form">
          <input type="password" id="password" class="mdc-text-field__input" aria-labelledby="password-label" wire:model="newPassword" required autocomplete="new-password" />
          <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle" onclick="showLoginPassword('password')" type="button" tabindex="0" wire:ignore><i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i><i class="material-icons mdc-icon-button__icon">visibility</i></button>
          <span class="mdc-notched-outline" wire:ignore>
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label" id="password-label">New Password</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        @error('newPassword')
        <div class="livewire-helper mdc-text-field-helper-line">
          <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="firstname-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
        </div>
        @enderror
      </div>
      <div class="col-span-6 mt-7 email_margins">
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon pw_input login-form @error('newPasswordComf') mdc-text-field--invalid @enderror">
          <input type="password" id="confpassword" class="mdc-text-field__input" aria-labelledby="confpassword-label" wire:model="newPasswordComf" required autocomplete="new-password" />
          <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle" onclick="showLoginPassword('confpassword')" type="button" tabindex="0" wire:ignore><i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i><i class="material-icons mdc-icon-button__icon">visibility</i></button>
          <span class="mdc-notched-outline" wire:ignore>
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label" id="confpassword-label">Confirm New Password</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        @error('newPasswordComf')
        <div class="livewire-helper mdc-text-field-helper-line">
          <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="firstname-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
        </div>
        @enderror
      </div>
      <div>
        <button class="mdc-button mdc-button--raised mdc-button-ripple save_button mt-10" wire:ignore>  <span class="mdc-button__ripple"></span>Save</button>
      </div>
    </div>
</form>
@else
<form wire:submit.prevent="save">
    @csrf
    <div class="mdc-card mdc-card--outlined options_card">
      <h4 class="mdc-typography mdc-typography--headline5 mt-2">Set password</h4>
      <p class="mdc-typography mdc-typography--body2 text-gray-600 mt-1">Add a password to use as a backup to social sign in. Make sure to choose a strong password that's at least 10 characters and contains at least one uppercase letter, number, and special character</p>
      <div class="col-span-6 mt-5 email_margins">
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon pw_input login-form @error('newPassword') mdc-text-field--invalid @enderror">
          <input type="password" id="password" class="mdc-text-field__input" aria-labelledby="password-label" wire:model="newPassword" required autocomplete="new-password" />
          <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle" onclick="showLoginPassword('password')" type="button" tabindex="0" wire:ignore><i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i><i class="material-icons mdc-icon-button__icon">visibility</i></button>
          <span class="mdc-notched-outline" wire:ignore>
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label" id="password-label">New Password</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        @error('newPassword')
        <div class="livewire-helper mdc-text-field-helper-line">
          <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="firstname-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
        </div>
        @enderror
      </div>
      <div class="col-span-6 mt-7 email_margins">
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon pw_input login-form @error('newPasswordComf') mdc-text-field--invalid @enderror">
          <input type="password" id="confpassword" class="mdc-text-field__input" aria-labelledby="confpassword-label" wire:model="newPasswordComf" required autocomplete="new-password" />
          <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle" onclick="showLoginPassword('confpassword')" type="button" tabindex="0" wire:ignore><i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i><i class="material-icons mdc-icon-button__icon">visibility</i></button>
          <span class="mdc-notched-outline" wire:ignore>
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label" id="confpassword-label">Confirm New Password</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        @error('newPasswordComf')
        <div class="livewire-helper mdc-text-field-helper-line">
          <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="firstname-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
        </div>
        @enderror
      </div>
      <div>
        <button class="mdc-button mdc-button--raised mdc-button-ripple save_button mt-10" wire:ignore>  <span class="mdc-button__ripple"></span>Save</button>
      </div>
    </div>
</form>
@endif
