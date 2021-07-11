<x-jet-authentication-card>
  <x-slot name="logo">
    <div class="logoimage mt-24">
    </div>
  </x-slot>
  <h2 class="roboto logintext">Welcome!</h2>
  <h6 class="roboto" style="font-size: 15px;">We just need a bit of information to get your account set up</h6>
  <form wire:submit.prevent="create"
  x-data="{
    errorMessages: @entangle('errorMessages'),
    passwordField: 'password',
    requiredFilled: @entangle('requiredFilled'),
  }">
    <div class="mt-6 reg-double">
      <div class="double_left">
        <label class="mdc-text-field mdc-text-field--outlined login-form" :class="{'mdc-text-field--invalid': errorMessages['firstName'] != undefined}" wire:ignore>
          <input type="text" class="mdc-text-field__input" aria-labelledby="firstname-label" autocomplete="given-name" maxlength="50" wire:model.lazy="firstName" required autofocus>
          <span class="mdc-notched-outline">
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label" id="firstname-label">First Name</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        <div class="mdc-text-field-helper-line h-3 mb-3">
          @error('firstName')
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="firstName-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
          @enderror
        </div>
      </div>
      <div class="double_right">
        <label class="mdc-text-field mdc-text-field--outlined login-form" :class="{'mdc-text-field--invalid': errorMessages['lastName'] != undefined}" wire:ignore>
          <input type="text" class="mdc-text-field__input" aria-labelledby="lastname-label" autocomplete="family-name" maxlength="50" wire:model.lazy="lastName" required>
          <span class="mdc-notched-outline">
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label" id="lastname-label">Last Name</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        <div class="mdc-text-field-helper-line h-3 mb-3">
          @error('lastName')
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="lastname-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
          @enderror
        </div>
      </div>
    </div>
    <div class="mt-6">
      <label class="mdc-text-field mdc-text-field--outlined login-form email" :class="{'mdc-text-field--invalid': errorMessages['email'] != undefined}" wire:ignore>
        <input type="email" class="mdc-text-field__input" aria-labelledby="email-label" wire:model.lazy="email" autocomplete="email" required>
        <span class="mdc-notched-outline">
          <span class="mdc-notched-outline__leading"></span>
          <span class="mdc-notched-outline__notch">
            <span class="mdc-floating-label" id="email-label">Email address</span>
          </span>
          <span class="mdc-notched-outline__trailing"></span>
        </span>
      </label>
      <div class="mdc-text-field-helper-line h-2">
        @error('email')
          <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="email-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
        @enderror
      </div>
    </div>

    <div class="mt-4">
      <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon login-form" :class="{'mdc-text-field--invalid': errorMessages['password'] != undefined}" wire:ignore>
        <input class="mdc-text-field__input" aria-labelledby="password-label" wire:model="password" :type="passwordField" autocomplete="new-password" required/>
        <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle" @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'" type="button" tabindex="0">
          <i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i>
          <i class="material-icons mdc-icon-button__icon">visibility</i></button>
        <span class="mdc-notched-outline">
          <span class="mdc-notched-outline__leading"></span>
          <span class="mdc-notched-outline__notch">
            <span class="mdc-floating-label" id="password-label">Password</span>
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
    <div class="mt-4">
      <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon login-form" :class="{'mdc-text-field--invalid': errorMessages['passwordConfirmation'] != undefined}" wire:ignore>
        <input class="mdc-text-field__input" aria-labelledby="password-confirmation" autocomplete="new-password" wire:model="passwordConfirmation" :type="passwordField" required/>
        <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle" @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'" type="button" tabindex="0">
          <i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i>
          <i class="material-icons mdc-icon-button__icon">visibility</i></button>
        <span class="mdc-notched-outline">
          <span class="mdc-notched-outline__leading"></span>
          <span class="mdc-notched-outline__notch">
            <span class="mdc-floating-label" id="password-confirmation">Confirm Password</span>
          </span>
          <span class="mdc-notched-outline__trailing"></span>
        </span>
      </label>
      <div class="mdc-text-field-helper-line h-2 mb-1">
        @error('passwordConfirmation')
          <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="password-conf-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
        @enderror
      </div>
    </div>
    <div class="mt-4">
      <label class="mdc-text-field mdc-text-field--outlined login-form" :class="{'mdc-text-field--invalid': errorMessages['school'] != undefined}" wire:ignore>
      <input type="text" class="mdc-text-field__input" aria-labelledby="school_name" wire:model.lazy="school">
      <span class="mdc-notched-outline">
        <span class="mdc-notched-outline__leading"></span>
        <span class="mdc-notched-outline__notch">
          <span class="mdc-floating-label" id="school_name">School Name</span>
        </span>
        <span class="mdc-notched-outline__trailing"></span>
      </span>
    </label>
    <div class="mdc-text-field-helper-line h-2">
      @error('school')
        <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="school-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
      @enderror
  </div>
  <div class="mdc-select mdc-select--outlined mdc-select--required login-form mt-4" wire:ignore>
    <div class="mdc-select__anchor" aria-required="true">
      <span class="mdc-notched-outline">
        <span class="mdc-notched-outline__leading"></span>
        <span class="mdc-notched-outline__notch">
          <span id="outlined-select-label" class="mdc-floating-label mdc-floating-label--float-above">Grade Level</span>
        </span>
        <span class="mdc-notched-outline__trailing"></span>
      </span>
      <span class="mdc-select__selected-text-container outlined_select">
        <span id="grade-selected-text" class="mdc-select__selected-text"></span>
      </span>
      <span class="mdc-select__dropdown-icon">
        <svg
            class="mdc-select__dropdown-icon-graphic"
            viewBox="7 10 10 5">
          <polygon
              class="mdc-select__dropdown-icon-inactive"
              stroke="none"
              fill-rule="evenodd"
              points="7 10 12 15 17 10">
          </polygon>
          <polygon
              class="mdc-select__dropdown-icon-active"
              stroke="none"
              fill-rule="evenodd"
              points="7 15 12 10 17 15">
          </polygon>
        </svg>
      </span>
    </div>
    <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
      <ul class="mdc-list dark-theme-list">
        <li class="mdc-list-item" data-value="es" wire:click="setGradeLevel('es')">
          <span class="mdc-list-item__ripple"></span>
          <span class="mdc-list-item__text">Elementary School (K-5 or K-6)</span>
        </li>
        <li class="mdc-list-item" data-value="ms" wire:click="setGradeLevel('ms')">
          <span class="mdc-list-item__ripple"></span>
          <span class="mdc-list-item__text">Middle School (6-8 or 7-8)</span>
        </li>
        <li class="mdc-list-item" data-value="hs" wire:click="setGradeLevel('hs')">
          <span class="mdc-list-item__ripple"></span>
          <span class="mdc-list-item__text">High School (9-12)</span>
        </li>
        <li class="mdc-list-item" data-value="university" wire:click="setGradeLevel('university')">
          <span class="mdc-list-item__ripple"></span>
          <span class="mdc-list-item__text">University</span>
        </li>
        <li class="mdc-list-item" data-value="other" wire:click="setGradeLevel('other')">
          <span class="mdc-list-item__ripple"></span>
          <span class="mdc-list-item__text">Other</span>
        </li>
      </ul>
    </div>
  </div>
  <div class="mdc-text-field-helper-line h-2 ml-3 mb-1">
    @error('gradeLevel')
      <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="grade-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
    @enderror
  </div>
  <div class="mt-6 logincontainer">
    <button class="mdc-button mdc-button-ripple mdc-button--raised loginbutton" :disabled="!requiredFilled" wire:ignore>
      <span class="mdc-button__ripple"></span>Register
    </button>
  </div>
  </form>
  <div class="continue_with">
    <p class="mdc-typography">OR REGISTER WITH</p>
  </div>
  <div class="logincontainer secondcontainer">
    <button class="mdc-button mdc-button-ripple mdc-button--outlined loginG" type="button" onclick="document.location='/login/google'">
      <span class="mdc-button__ripple"></span>
      <img class="mdc-button__icon" src="/images/icon/vendor/google.png" width="18px" height="18px" aria-hidden="true">Google
    </button>
  </div>
</x-jet-authentication-card>
