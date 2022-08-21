<div class="pt-20" 
x-data="{
    confirmed: false,
    passwordConfirmation: false,
    passwordField: 'password',
}"
@hide-password-confirmation="passwordConfirmation = false">
  <x-ui.settings-card title="Delete account"
    description="You are deleting your account, which will permanently remove access to your account and data. You will not be able to recover anything once deleted."
    back-button>
    <div class="border-b border-gray-200 pb-4">
        <p class="mt-4 text-lg">You will lose all of the following when you delete your account</p>
        <p class="text-sm text-gray-500">Any data saved to your account is at risk of being erased, including items not listed below.</p>  
    </div>
    <div style="max-width: 600px">
        <ul class="mdc-deprecated-list mdc-deprecated-list--icon-list security-list mt-2 w-full">
            <li class="security-list mdc-deprecated-list-item border-b border-gray-200" tabindex="0" href="{{route('account.set-password')}}">
                <span class="mdc-deprecated-list-item__graphic material-icons -mt-0.5 text-gray-600 text-inherit" aria-hidden="true">
                    badge
                </span>
                <span class="security-list-text mdc-deprecated-list-item__text">
                    <span class="">All of your personal information</span>
                </span>
            </li>
            @if($this->numberClasses > 0)
                <li class="border-b border-gray-200 security-list mdc-deprecated-list-item" tabindex="0" href="{{route('account.set-password')}}">
                    <span class="mdc-deprecated-list-item__graphic material-icons -mt-0.5 text-gray-600 text-inherit" aria-hidden="true">
                        school
                    </span>
                    <span class="security-list-text mdc-deprecated-list-item__text">
                        <span class="">{{$this->numberClasses}} class{{$this->numberClasses > 1 ? 'es': ''}}, and their associated data</span>
                    </span>
                </li>
            @endif
            @if($this->numberAssignments > 0)
                <li class="border-b border-gray-200 security-list mdc-deprecated-list-item" tabindex="0" href="{{route('account.set-password')}}">
                    <span class="mdc-deprecated-list-item__graphic material-icons -mt-0.5 text-gray-600 text-inherit" aria-hidden="true">
                        assignment
                    </span>
                    <span class="security-list-text mdc-deprecated-list-item__text">
                        <span class="">{{$this->numberAssignments}} assignment{{$this->numberAssignments > 1 ? 's': ''}}</span>
                    </span>
                </li>
            @endif
            @if($this->numberEvents > 0)
                <li class="border-b border-gray-200 security-list mdc-deprecated-list-item" tabindex="0" href="{{route('account.set-password')}}">
                    <span class="mdc-deprecated-list-item__graphic material-icons -mt-0.5 text-gray-600 text-inherit" aria-hidden="true">
                        date_range
                    </span>
                    <span class="security-list-text mdc-deprecated-list-item__text">
                        <span class="">{{$this->numberEvents}} event{{$this->numberEvents > 1 ? 's': ''}}, and access to shared events</span>
                    </span>
                </li>
            @endif
        </ul>
        <div class="rounded-md background-red">
            <div class="flex items-center px-4 py-4 text-sm sm:py-0">
                <div class="material-icons w-14 flex-none">history</div>                    
                <div class="font-medium">You can download an archive of your data before deleting your account</div>
                <div>
                    <a class="mdc-icon-button material-icons mt-1 ml-4 h-14 flex-none" href="{{route('account.manage-data')}}" aria-describedby="back-arrow">
                        <div class="mdc-icon-button__ripple"></div>
                        navigate_next
                    </a>
                </div>
            </div>
        </div>
        <div class="pt-4 pb-12">
            <div class="mdc-checkbox mdc-checkbox--touch relative float-left ml-2" x-on:click="confirmed = !confirmed">
              <input type="checkbox"
                     class="mdc-checkbox__native-control" x-bind:checked="confirmed">
              <div class="mdc-checkbox__background">
                <svg class="mdc-checkbox__checkmark"
                     viewBox="0 0 24 24">
                  <path class="mdc-checkbox__checkmark-path"
                        fill="none"
                        d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                </svg>
                <div class="mdc-checkbox__mixedmark"></div>
              </div>
              <div class="mdc-checkbox__ripple"></div>
            </div>
            <div class="ml-2">
                <p class="agenda-filter-label float-left ml-16 mr-2 -mt-10 text-sm text-gray-600">I confirm that I want to delete my account and data and recognize that once deleted, they cannot be recovered under any circumstances.</p>
            </div>
        </div>
        <div class="mt-5">
            <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button mt-5"
            x-bind:disabled="!confirmed"
            x-on:click="fixBody(); passwordConfirmation = true; setTimeout(() => $refs.password.focus(), 250)" wire:ignore>
                <span class="mdc-button__ripple"></span>Delete My Account
            </button>
            <a href="{{route('profile')}}" class="mdc-button mdc-button-ripple tfa-button mt-5 mr-4" @click="passwordConfirmation = false" wire:ignore wire:loading.attr="disabled">
                <span class="mdc-button__ripple"></span>Nevermind
            </a>
        </div>
    </div>
  </x-ui.settings-card>
  <div class="modal-skim inset-0 hidden bg-gray-500 opacity-75" style="display: none" x-show="passwordConfirmation" x-cloak></div>
  <div class="modal-container fixed top-12 h-screen w-screen overflow-y-auto pb-6" x-transition x-show="passwordConfirmation" x-cloak wire:ignore.self>
    <div class="mdc-card mdc-card--outlined modal-card px-6 pt-6">
        <div>
            <h6 class="text-3xl font-medium">Confirm your password</h6>
            <div class="mt-3 text-left text-base text-gray-600">Before we can delete your account, we need you to verify your identity.</div>
        </div>
        <div class="mt-5 mb-2 border-t border-gray-200"></div>
        <div class="w-full pt-4">
            <div class="mx-auto h-16 w-16"><img src="{{Auth::user()->profile_photo_url}}" class="rounded-full"></div>
            <p class="mx-auto mt-3 text-center text-xl font-medium">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</p>
            <p class="mx-auto mt-1 text-center text-sm text-gray-700">{{Auth::user()->email}}</p>
        </div>

        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon mt-8 w-full" wire:ignore>
            <input class="mdc-text-field__input" aria-labelledby="password-label" :type="passwordField" wire:model="password" required autocomplete="current-password" x-ref="password"/>
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
        <x-ui.validation-error for="password"/>
        <div class="forgot-password mr-2 w-full text-right">
            <a class="theme-color-text text-sm" href="{{ route('password.request') }}">Forgot password?</a>
        </div>

        <div class="mt-5">
            <button class="mdc-button mdc-button-ripple mdc-button--raised float-right ml-4" wire:click="" wire:ignore>
                <span class="mdc-button__ripple"></span>Confirm
            </button>
            <button class="mdc-button mdc-button-ripple float-right" @click="passwordConfirmation = false; undoFixBody()" wire:ignore wire:loading.attr="disabled">
                <span class="mdc-button__ripple"></span>Nevermind
            </button>
        </div>
    </div>
  </div>


</div>