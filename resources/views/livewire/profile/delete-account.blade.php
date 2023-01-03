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
    <div class="pb-4 border-b border-gray-200">
        <p class="mt-4 text-lg">You will lose all of the following when you delete your account</p>
        <p class="text-sm text-gray-500">Any data saved to your account is at risk of being erased, including items not listed below.</p>  
    </div>
    <div style="max-width: 600px">
        <ul class="w-full mt-2 mdc-deprecated-list mdc-deprecated-list--icon-list security-list">
            <li class="border-b border-gray-200 security-list mdc-deprecated-list-item" tabindex="0" href="{{route('account.set-password')}}">
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
                <div class="flex-none material-icons w-14">history</div>                    
                <div class="font-medium">You can download an archive of your data before deleting your account</div>
                <div>
                    <a class="flex-none mt-1 ml-4 mdc-icon-button material-icons h-14" href="{{route('account.manage-data')}}" aria-describedby="back-arrow">
                        <div class="mdc-icon-button__ripple"></div>
                        navigate_next
                    </a>
                </div>
            </div>
        </div>
        <div class="pt-4 pb-12">
            <div class="relative float-left ml-2 mdc-checkbox mdc-checkbox--touch" x-on:click="confirmed = !confirmed">
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
                <p class="float-left ml-16 mr-2 -mt-10 text-sm text-gray-600 agenda-filter-label">I confirm that I want to delete my account and data and recognize that once deleted, they cannot be recovered under any circumstances.</p>
            </div>
        </div>
        <div class="mt-5">
            <button class="mt-5 mdc-button mdc-button--raised mdc-button-ripple tfa-button"
            x-bind:disabled="!confirmed"
            x-on:click="passwordConfirmation = true; setTimeout(() => $refs.password.focus(), 250)" wire:ignore>
                <span class="mdc-button__ripple"></span>Delete My Account
            </button>
            <a href="{{route('profile')}}" class="mt-5 mr-4 mdc-button mdc-button-ripple tfa-button" @click="passwordConfirmation = false" wire:ignore wire:loading.attr="disabled">
                <span class="mdc-button__ripple"></span>Nevermind
            </a>
        </div>
    </div>
  </x-ui.settings-card>
  <div class="inset-0 hidden bg-gray-500 opacity-75 modal-skim" style="display: none" x-show="passwordConfirmation" x-cloak></div>
  <div class="fixed w-screen h-screen pb-6 overflow-y-auto modal-container top-12" x-transition x-show="passwordConfirmation" x-trap.noscroll="passwordConfirmation" x-cloak wire:ignore.self>
    <div class="px-6 pt-6 mdc-card mdc-card--outlined modal-card">
        <div>
            <h6 class="text-3xl font-medium">Confirm your password</h6>
            <div class="mt-3 text-base text-left text-gray-600">Before we can delete your account, we need you to verify your identity.</div>
        </div>
        <div class="mt-5 mb-2 border-t border-gray-200"></div>
        <div class="w-full pt-4">
            <div class="w-16 h-16 mx-auto"><img src="{{Auth::user()->profile_photo_url}}" alt="Profile photo" class="rounded-full"></div>
            <p class="mx-auto mt-3 text-xl font-medium text-center">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</p>
            <p class="mx-auto mt-1 text-sm text-center text-gray-700">{{Auth::user()->email}}</p>
        </div>

        <label class="w-full mt-8 mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon" wire:ignore>
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
        <div class="w-full mr-2 text-right forgot-password">
            <a class="text-sm theme-color-text" href="{{ route('password.request') }}">Forgot password?</a>
        </div>

        <div class="mt-5">
            <button class="float-right ml-4 mdc-button mdc-button-ripple mdc-button--raised" wire:click="deleteUser()" wire:ignore>
                <span class="mdc-button__ripple"></span>Confirm
            </button>
            <button class="float-right mdc-button mdc-button-ripple" @click="passwordConfirmation = false" wire:ignore wire:loading.attr="disabled">
                <span class="mdc-button__ripple"></span>Nevermind
            </button>
        </div>
    </div>
  </div>


</div>