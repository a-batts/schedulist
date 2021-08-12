<div class="py-10 mx-auto flex justify-center flex-col align-middle inline-block">
  <x-ui.auth-card title="Create your account" description="We just need some information from you to get everything set up.">
    <form wire:submit.prevent="create"
    x-data="{
      errorMessages: @entangle('errorMessages'),
      passwordField: 'password',
    }">
      <div class="w-full mt-8">
        <div class="float-left w-1/2 pr-2">
          <label class="mdc-text-field mdc-text-field--outlined w-full" :class="{'mdc-text-field--invalid': errorMessages['firstName'] != undefined}" wire:ignore>
            <input type="text" class="mdc-text-field__input" aria-labelledby="firstname-label" autocomplete="given-name" maxlength="50" wire:model.lazy="firstName" required autofocus>
            <span class="mdc-notched-outline">
              <span class="mdc-notched-outline__leading"></span>
              <span class="mdc-notched-outline__notch">
                <span class="mdc-floating-label" id="firstname-label">First Name</span>
              </span>
              <span class="mdc-notched-outline__trailing"></span>
            </span>
          </label>
          <x-ui.validation-hint :message="$errorMessages" for="firstName"/>
        </div>
        <div class="float-right w-1/2 pl-2">
          <label class="mdc-text-field mdc-text-field--outlined w-full" :class="{'mdc-text-field--invalid': errorMessages['lastName'] != undefined}" wire:ignore>
            <input type="text" class="mdc-text-field__input" aria-labelledby="lastname-label" autocomplete="family-name" maxlength="50" wire:model.lazy="lastName" required>
            <span class="mdc-notched-outline">
              <span class="mdc-notched-outline__leading"></span>
              <span class="mdc-notched-outline__notch">
                <span class="mdc-floating-label" id="lastname-label">Last Name</span>
              </span>
              <span class="mdc-notched-outline__trailing"></span>
            </span>
          </label>
          <x-ui.validation-hint :message="$errorMessages" for="lastName"/>
        </div>
      </div>
      <div class="">
        <label class="mdc-text-field mdc-text-field--outlined w-full inline-block mt-4" :class="{'mdc-text-field--invalid': errorMessages['email'] != undefined}" wire:ignore>
          <input type="email" class="mdc-text-field__input" aria-labelledby="email-label" wire:model.lazy="email" autocomplete="email" required>
          <span class="mdc-notched-outline">
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label" id="email-label">Email address</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        <x-ui.validation-hint :message="$errorMessages" for="email"/>
      </div>
      <div>
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon mt-4 w-full" :class="{'mdc-text-field--invalid': errorMessages['password'] != undefined}" wire:ignore>
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
        @error('password')
          <div class="mdc-text-field-helper-line h-7">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="password-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
          </div>
        @enderror
        @if(!$errors->has('password') && $password == "")
          <div class="mdc-text-field-helper-line h-7">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="password-error" aria-hidden="true">Must be 10+ characters and contain an uppercase letter, number, and special character</div>
          </div>
        @elseif(!$errors->has('password'))
          <div class="mdc-text-field-helper-line h-7">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="password-error" aria-hidden="true"><p class="text-green -mt-3.5">
              Password strength requirements have been met</p></div>
          </div>
        @endif
      </div>
      <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon mt-4 w-full" :class="{'mdc-text-field--invalid': errorMessages['passwordConfirmation'] != undefined}" wire:ignore>
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
      <div class="mt-4">
        <label class="mdc-text-field mdc-text-field--outlined w-full" :class="{'mdc-text-field--invalid': errorMessages['school'] != undefined}" wire:ignore>
        <input type="text" class="mdc-text-field__input" aria-labelledby="school_name" wire:model.lazy="school">
        <span class="mdc-notched-outline">
          <span class="mdc-notched-outline__leading"></span>
          <span class="mdc-notched-outline__notch">
            <span class="mdc-floating-label" id="school_name">School Name (Optional)</span>
          </span>
          <span class="mdc-notched-outline__trailing"></span>
        </span>
      </label>
      <x-ui.validation-hint :message="$errorMessages" for="school"/>

      <x-ui.select :data="$gradeOptions" text="Grade Level" var="GradeLevel" type="outlined" class="w-full mt-4" required/>
      <x-ui.validation-hint :message="$errorMessages" for="gradeLevel"/>

      <div class="mt-12 logincontainer">
        <button class="mdc-button mdc-button-ripple mdc-button--raised loginbutton" wire:ignore>
          <span class="mdc-button__ripple"></span>Register
        </button>
      </div>
      <div class="mdc-typography continue-with">
        <p>OR SIGN IN WITH</p>
      </div>
      <div class="logincontainer secondcontainer">
        <button class="mdc-button mdc-button-ripple mdc-button--outlined loginG" onclick="document.location='/login/google'" wire:ignore>
          <span class="mdc-button__ripple"></span>
          <img class="mdc-button__icon" src="/images/icon/vendor/google.png" width="18px" height="18px" aria-hidden="true">Google
        </button>
      </div>
    </form>
  </x-ui.auth-card>
</div>
