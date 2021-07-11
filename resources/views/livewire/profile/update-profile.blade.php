<div x-data="{
  confirmNumber: @entangle('showingPhoneConfirmation'),
}" class="mdc-typography" id="profile_settings">
  @livewire('profile.update-profile-photo')
  <form wire:submit.prevent="save">
    <div class="mdc-card mdc-card--outlined options_card">
      <h4 class="mdc-typography mdc-typography--headline5 mt-2 nunito">Personal Info</h4>
      <p class="mdc-typography mdc-typography--body2 text-gray-600 mt-1">Update basic information, such as your name and email address</p>
      <div class="border-t border-gray-200 mt-5"></div>
      <div class="col-span-6 mt-5">
        <h1 class="mb-5 ml-2 mdc-typography--body text-gray-600">
          Update or reset your profile photo
        </h1>
        <div class="h-28 ml-2">
          <div class="w-28 float-left">
            <img class="rounded-full w-20 h-20" src="@if($hasProfilePicture)http://@endif{{Auth::User()->profile_photo_url}}"/>
          </div>
          <div class="ml-1 -mt-1">
            <button class="mdc-button mdc-button--raised mdc-button-ripple mt-5" type="button" @click="$dispatch('open-photo-dialog')" wire:ignore>
              <i class="material-icons mdc-button__icon" aria-hidden="true">edit</i>
              <span class="mdc-button__ripple"></span>Change photo
            <button>
          </div>
        </div>
        <div class="double_left">
          <label class="mdc-text-field mdc-text-field--outlined @error('state.firstname') mdc-text-field--invalid @enderror login-form mdc-text-field--label-floating">
            <input type="text" class="mdc-text-field__input" aria-labelledby="firstname-label" wire:model.debounce.250ms="state.firstname" autocomplete="given-name" name="firstname" value="{{ old('firstname') }}" required>
            <span class="mdc-notched-outline mdc-notched-outline--notched" wire:ignore>
              <span class="mdc-notched-outline__leading"></span>
              <span class="mdc-notched-outline__notch" style="width: 74px;">
                <span class="mdc-floating-label mdc-floating-label--float-above">First Name</span>
              </span>
              <span class="mdc-notched-outline__trailing"></span>
            </span>
          </label>
          @error('state.firstname')
          <div class="livewire-helper mdc-text-field-helper-line">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="firstname-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
          </div>
          @enderror
        </div>

        <div class="double_right">
          <label class="mdc-text-field mdc-text-field--outlined @error('state.lastname') mdc-text-field--invalid @enderror login-form mdc-text-field--label-floating">
            <input type="text" class="mdc-text-field__input" aria-labelledby="lastname-label" autocomplete="family-name" name="lastname" wire:model.debounce.250ms="state.lastname" value="{{ old('lastname') }}" required>
            <span class="mdc-notched-outline mdc-notched-outline--notched" wire:ignore>
              <span class="mdc-notched-outline__leading"></span>
              <span class="mdc-notched-outline__notch" style="width: 72.5px;">
                <span class="mdc-floating-label mdc-floating-label--float-above">Last Name</span>
              </span>
              <span class="mdc-notched-outline__trailing"></span>
            </span>
          </label>
          @error('state.lastname')
          <div class="livewire-helper mdc-text-field-helper-line">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="lastname-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
          </div>
          @enderror
        </div>
      </div>
      <!-- Email -->
      <div class="mt-7 col-span-6 sm:col-span-6 mr-1 ">
        <label class="mdc-text-field mdc-text-field--outlined @error('state.email') mdc-text-field--invalid @enderror login-form-email mdc-text-field--label-floating">
          <input type="text" class="mdc-text-field__input" aria-labelledby="email-label" name="email" id="email" wire:model.debounce.250ms="state.email" value="{{ old('email') }}" required>
          <span class="mdc-notched-outline mdc-notched-outline--notched" wire:ignore>
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch" style="width: 44px;">
              <span class="mdc-floating-label mdc-floating-label--float-above">Email</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        @error('state.email')
        <div class="livewire-helper mdc-text-field-helper-line">
          <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="email-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
        </div>
        @enderror
      </div>
      <div class="mt-7 w-full md:w-1/2 phonebox">
        <label class="mdc-text-field mdc-text-field--outlined @error('state.phone') mdc-text-field--invalid @enderror login-form mdc-text-field--label-floating">
          <input type="text" class="mdc-text-field__input" aria-labelledby="phone-label" wire:model.debounce.250ms="state.phone" autocomplete="phone" name="phone" value="{{ old('phone') }}" maxlength="10">
          <span class="mdc-notched-outline mdc-notched-outline--notched" wire:ignore>
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch" style="width: 129.5px;">
              <span class="mdc-floating-label mdc-floating-label--float-above">Mobile Phone Number</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
        </label>
        @error('state.phone')
        <div class="livewire-helper mdc-text-field-helper-line">
          <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="firstname-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
        </div>
        @enderror
      </div>
      <div class="col-span-6 sm:col-span-6 mt-7">
        <div class="user-row-left">
          <label class="mdc-text-field mdc-text-field--outlined login-form @error('state.school') mdc-text-field--invalid @enderror @if(Auth::user()->school !== null) mdc-text-field--label-floating @endif change-school">
            <input type="text" class="mdc-text-field__input" aria-labelledby="school-label" id="school" name="school" wire:model.debounce.250ms="state.school" value="{{ old('school') }}">
            <span class="mdc-notched-outline mdc-notched-outline--notched" wire:ignore>
              <span class="mdc-notched-outline__leading"></span>
              <span class="mdc-notched-outline__notch" style="width: 80.75px;">
                <span class="mdc-floating-label @if(Auth::user()->school !== null) mdc-floating-label--float-above @endif">School Name</span>
              </span>
              <span class="mdc-notched-outline__trailing"></span>
            </span>
          </label>
          @error('state.school')
          <div class="livewire-helper mdc-text-field-helper-line">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="school-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
          </div>
          @enderror
        </div>
        <div class="user-row-right">
          <div class="mdc-select mdc-select--outlined login-form mt-4 mb15" wire:ignore>
            <div class="mdc-select__anchor">
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

            <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fixed">
              <ul class="mdc-list dark-theme-list">
                <li class="mdc-list-item @if(Auth::user()->grade_level=="es") mdc-list-item--selected @endif" wire:click="setGrade('es')" data-value="es">
                  <span class="mdc-list-item__ripple"></span>
                  <span class="mdc-list-item__text">Elementary School (K-5/6)</span>
                </li>
                <li class="mdc-list-item @if(Auth::user()->grade_level=="ms") mdc-list-item--selected @endif" wire:click="setGrade('ms')" data-value="ms">
                  <span class="mdc-list-item__ripple"></span>
                  <span class="mdc-list-item__text">Middle School (6/7-8)</span>
                </li>
                <li class="mdc-list-item @if(Auth::user()->grade_level=="hs") mdc-list-item--selected @endif" wire:click="setGrade('hs')" data-value="hs">
                  <span class="mdc-list-item__ripple"></span>
                  <span class="mdc-list-item__text">High School (9-12)</span>
                </li>
                <li class="mdc-list-item @if(Auth::user()->grade_level=="university") mdc-list-item--selected @endif" wire:click="setGrade('university')" data-value="university">
                  <span class="mdc-list-item__ripple"></span>
                  <span class="mdc-list-item__text">University</span>
                </li>
                <li class="mdc-list-item @if(Auth::user()->grade_level=="other") mdc-list-item--selected @endif" wire:click="setGrade('other')" data-value="other">
                  <span class="mdc-list-item__ripple"></span>
                  <span class="mdc-list-item__text">Other</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div>
        <button class="mdc-button mdc-button--raised mdc-button-ripple float-right mt-5" wire:ignore>
          <span class="mdc-button__ripple"></span>Save<button>
      </div>
    </div>
  </form>
  <div class="inset-0 bg-gray-500 opacity-75 modal_skim" x-show="confirmNumber" style="display:none" x-cloak></div>
  <div x-show.transition="confirmNumber" class="phone_confirmation_container" x-cloak>
    <div class="mdc-card mdc-card--outlined phone_confirmation">
      <h6 class="mdc-typography--headline5 nunito">
        <span class="material-icons ml-1">textsms</span>
      <span class="ml-2">Verify phone number</span></h6>
      <p class="mt-4 mdc-typography--subtitle1">We just sent a text with a confirmation code to {{$formattedPhoneNumber}}.</p>
      <p class="text-sm text-blue" style="cursor: pointer" @click="confirmNumber = false" wire:click="cancelValidation()">Not the right phone number?</p>
      <label class="mt-7 mdc-text-field mdc-text-field--outlined @error('verificationCodeInput') mdc-text-field--invalid @enderror login-form mdc-text-field--label-floating">
        <input type="number" class="mdc-text-field__input" aria-labelledby="confirmation-code-label" wire:model.debounce.250ms="verificationCodeInput" autocomplete="chrome-off" maxlength="6" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
        <span class="mdc-notched-outline mdc-notched-outline--notched" wire:ignore>
          <span class="mdc-notched-outline__leading"></span>
          <span class="mdc-notched-outline__notch" style="width: 105.5px">
            <span class="mdc-floating-label mdc-floating-label--float-above">Verification code</span>
          </span>
          <span class="mdc-notched-outline__trailing"></span>
        </span>
      </label>
      @error('verificationCodeInput')
      <div class="livewire-helper mdc-text-field-helper-line">
        <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="verification-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
      </div>
      @enderror
      <div class="mt-10">
        <button class="mdc-button mdc-button-ripple float-left tfa-button" wire:ignore wire:click="resendAndCount()" id="countdown-button">
          <span class="mdc-button__ripple"></span>
            Resend code <span id="countdown-time" style="white-space: pre"> (90)</span>
        </button>
        <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button" wire:ignore wire:click="confirmVerification()">
          <span class="mdc-button__ripple"></span>
            Submit
        </button>
        <button class="mdc-button mdc-button-ripple tfa-button mr-3" @click="confirmNumber = false" wire:click="cancelValidation()" wire:ignore>
          <span class="mdc-button__ripple"></span>
            Cancel
        </button>
      </div>
    </div>
  </div>
</div>
