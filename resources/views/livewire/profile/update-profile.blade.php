<div x-data="phoneVerification()" 
x-init="$watch('numberConfirmationDialog', value =>{
  if (value)
    fixBody()
  else
    undoFixBody()
})"
@start-countdown.window="countdown($refs)"
@display-phone-verification.window="numberConfirmationDialog = true"
@hide-phone-verification.window="numberConfirmationDialog = false"
class="" id="profile_settings">
  @livewire('profile.update-profile-photo')
  <form wire:submit.prevent="save">
    <x-ui.settings-card title="Personal info"
    description="Update your basic information, such as your name and email address.">
    <div class="pt-4 pb-2">
      <p class="mt-1 text-gray-600">Set or change your profile picture</p>
      <p class="mt-1 text-sm text-gray-500"><span class="inline-block"><span class="material-icons mt-1 mr-3 inline-block align-text-bottom text-inherit" style="vertical-align: -5px">public</span>Other Schedulist users will be able to view the picture you select.</span></p>
      <div>
        <div class="mt-5 block w-full">
          <div class="w-full">
            <img class="mx-auto h-24 w-24 rounded-full" src="{{Auth::User()->profile_photo_url}}"/>
          </div>
          <div class="mt-7 block text-center">
            <button class="mdc-button mdc-button--outlined mdc-button-ripple inline-block" type="button" @click="$dispatch('open-photo-dialog')" wire:ignore>
              <i class="material-icons mdc-button__icon" aria-hidden="true">edit</i>
              <span class="mdc-button__ripple"></span>Change photo
            <button>
          </div>
        </div>
      </div>
    </div>
    <x-jet-section-border />
    <div class="mt-2">
      <div class="float-left w-1/2 pr-1.5">
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--label-floating w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['state.firstname'] != undefined}" wire:ignore>
          <span class="mdc-notched-outline">
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label mdc-floating-label--float-above" id="first-name-label">First Name</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
          <input class="mdc-text-field__input" wire:model.debounce.250ms="state.firstname" type="text" autocomplete="given-name" aria-labelledby="first-name-label" required>
        </label>
        <x-ui.validation-error for="state.firstname"/>
      </div>
      <div class="float-right w-1/2 pl-1.5">
        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--label-floating w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['state.lastname'] != undefined}" wire:ignore>
          <span class="mdc-notched-outline">
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label mdc-floating-label--float-above" id="last-name-label">Last Name</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
          <input class="mdc-text-field__input" wire:model.debounce.250ms="state.lastname" type="text" autocomplete="family-name" aria-labelledby="last-name-label" required>
        </label>
        <x-ui.validation-error for="state.lastname"/>
      </div>
      </div>
      <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--label-floating w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['state.email'] != undefined}" wire:ignore>
        <span class="mdc-notched-outline">
          <span class="mdc-notched-outline__leading"></span>
          <span class="mdc-notched-outline__notch">
            <span class="mdc-floating-label mdc-floating-label--float-above" id="email-label">Email</span>
          </span>
          <span class="mdc-notched-outline__trailing"></span>
        </span>
        <input class="mdc-text-field__input" wire:model.debounce.250ms="state.email" type="email" autocomplete="email" aria-labelledby="email-label" id="profile-email-input" required>
      </label>
      <x-ui.validation-error for="state.email"/>
      <div class="w-full">
        <div class="float-left w-1/2 pr-1.5">
          <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--label-floating w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['state.phone'] != undefined}" wire:ignore>
            <span class="mdc-notched-outline">
              <span class="mdc-notched-outline__leading"></span>
              <span class="mdc-notched-outline__notch">
                <span class="mdc-floating-label mdc-floating-label--float-above" id="phone-label">Phone Number</span>
              </span>
              <span class="mdc-notched-outline__trailing"></span>
            </span>
            <input class="mdc-text-field__input" wire:model.debounce.250ms="state.phone" type="text" autocomplete="phone" aria-labelledby="phone-label" id="profile-phone-input">
          </label>
          <x-ui.validation-error for="state.phone"/>
        </div>
      </div>
      <div>
        <div class="float-left clear-left w-1/2 pr-1.5">
          <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--label-floating w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['state.school'] != undefined}" wire:ignore>
            <span class="mdc-notched-outline">
              <span class="mdc-notched-outline__leading"></span>
              <span class="mdc-notched-outline__notch">
                <span class="mdc-floating-label mdc-floating-label--float-above" id="school-name-label">School Name</span>
              </span>
              <span class="mdc-notched-outline__trailing"></span>
            </span>
            <input class="mdc-text-field__input" wire:model.debounce.250ms="state.school" type="text" autocomplete="school-name" aria-labelledby="school-name-label" required>
          </label>
          <x-ui.validation-error for="state.school"/>
        </div>
        <div class="float-right w-1/2 pl-1.5">
          <div class="mdc-select mdc-select--outlined w-full" wire:ignore>
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
              <ul class="mdc-deprecated-list dark-theme-list">
                <li class="mdc-deprecated-list-item @if(Auth::user()->grade_level=="es") mdc-deprecated-list-item--selected @endif" wire:click="setGrade('es')" data-value="es">
                  <span class="mdc-deprecated-list-item__ripple"></span>
                  <span class="mdc-deprecated-list-item__text">Elementary School (K-5/6)</span>
                </li>
                <li class="mdc-deprecated-list-item @if(Auth::user()->grade_level=="ms") mdc-deprecated-list-item--selected @endif" wire:click="setGrade('ms')" data-value="ms">
                  <span class="mdc-deprecated-list-item__ripple"></span>
                  <span class="mdc-deprecated-list-item__text">Middle School (6/7-8)</span>
                </li>
                <li class="mdc-deprecated-list-item @if(Auth::user()->grade_level=="hs") mdc-deprecated-list-item--selected @endif" wire:click="setGrade('hs')" data-value="hs">
                  <span class="mdc-deprecated-list-item__ripple"></span>
                  <span class="mdc-deprecated-list-item__text">High School (9-12)</span>
                </li>
                <li class="mdc-deprecated-list-item @if(Auth::user()->grade_level=="university") mdc-deprecated-list-item--selected @endif" wire:click="setGrade('university')" data-value="university">
                  <span class="mdc-deprecated-list-item__ripple"></span>
                  <span class="mdc-deprecated-list-item__text">College/University</span>
                </li>
                <li class="mdc-deprecated-list-item @if(Auth::user()->grade_level=="other") mdc-deprecated-list-item--selected @endif" wire:click="setGrade('other')" data-value="other">
                  <span class="mdc-deprecated-list-item__ripple"></span>
                  <span class="mdc-deprecated-list-item__text">Other</span>
                </li>
              </ul>
            </div>
            <x-ui.validation-error for="state.grade_level"/>
          </div>
        </div>
      </div>
      <div class="mt-4">
        <button class="mdc-button mdc-button--raised mdc-button-ripple float-right clear-left" wire:ignore>
          <span class="mdc-button__ripple"></span>Save Changes
        <button>
      </div>
    </x-ui.settings-card>
  </form>
  <!-- Phone number confirmation menu -->
  <div>
    <div class="modal-skim inset-0 hidden bg-gray-500 opacity-75" style="display: none" x-show="numberConfirmationDialog" x-cloak wire:ignore.self></div>
    <div class="modal-container mdc-typography fixed top-20 h-screen w-screen overflow-y-auto pb-6" x-transition x-show="numberConfirmationDialog" x-cloak wire:ignore.self>
      <div class="mdc-card mdc-card--outlined modal-card px-6 pb-6">
        <h6 class="mt-4">
          <span class="material-icons ml-1 mr-4 select-none" style="vertical-align: -2px">textsms</span>
          <span class="mt-4 text-3xl font-medium">Verify your phone number</span>
        </h6>
        <p class="mt-3 text-gray-600">We just sent a text with a confirmation code to {{$formattedPhoneNumber ?? 'null'}}.</p>
        <p class="text-blue mt-1 text-sm" style="cursor: pointer" @click="numberConfirmationDialog = false" wire:click="cancelValidation()">Wrong phone number?</p>
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
        <x-ui.validation-error for="verificationCodeInput"/>
        <div class="mt-10">
          <button class="mdc-button mdc-button-ripple tfa-button float-left" wire:ignore wire:click="resendAndCount()" id="countdown-button" x-ref="countdownButton">
            <span class="mdc-button__ripple"></span>
              Resend code <span id="countdown-time" x-ref="countdownTime" style="white-space: pre"> (120)</span>
          </button>
          <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button" wire:ignore wire:click="confirmVerification()">
            <span class="mdc-button__ripple"></span>
              Submit
          </button>
          <button class="mdc-button mdc-button-ripple tfa-button mr-3" @click="numberConfirmationDialog = false" wire:click="cancelValidation()" wire:ignore>
            <span class="mdc-button__ripple"></span>
              Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    function phoneVerification(){
      return{
        errorMessages: @entangle('errorMessages'),
        numberConfirmationDialog: false,
        countdown: function($refs){
          $refs.countdownTime.innerHTML = ' (120)';
          $refs.countdownButton.disabled = true;
          sleep(1000).then(function () {
            countdownClock(120, $refs);
          });
        },
      }
    }
  </script>
@endpush