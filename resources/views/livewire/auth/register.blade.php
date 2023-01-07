<div class="flex flex-col justify-center py-10 mx-auto align-middle">
    <x-ui.auth-card title="Create your account"
        description="We just need some information from you to get everything set up.">
        <form wire:submit.prevent="create" x-data="{
            grade: @entangle('gradeLevel').defer,
            passwordField: 'password',
            errorMessages: @entangle('errorMessages'),
        }">
            <div class="flex w-full mt-8 space-x-4">
                <div class="">
                    <label class="w-full mdc-text-field mdc-text-field--outlined"
                        :class="{ 'mdc-text-field--invalid': errorMessages['firstName'] != undefined }" wire:ignore>
                        <input class="mdc-text-field__input" type="text" aria-labelledby="firstname-label"
                            autocomplete="given-name" maxlength="50" wire:model.lazy="firstName" required autofocus>
                        <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__notch">
                                <span class="mdc-floating-label" id="firstname-label">First name</span>
                            </span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                    </label>
                    <x-ui.validation-error for="firstName" />
                </div>

                <div class="">
                    <label class="w-full mdc-text-field mdc-text-field--outlined"
                        :class="{ 'mdc-text-field--invalid': errorMessages['lastName'] != undefined }" wire:ignore>
                        <input class="mdc-text-field__input" type="text" aria-labelledby="lastname-label"
                            autocomplete="family-name" maxlength="50" wire:model.lazy="lastName" required>
                        <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__notch">
                                <span class="mdc-floating-label" id="lastname-label">Last name</span>
                            </span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                    </label>
                    <x-ui.validation-error for="lastName" />
                </div>
            </div>

            <div class="">
                <label class="inline-block w-full mt-4 mdc-text-field mdc-text-field--outlined"
                    :class="{ 'mdc-text-field--invalid': errorMessages['email'] != undefined }" wire:ignore>
                    <input class="mdc-text-field__input" type="email" aria-labelledby="email-label"
                        wire:model.lazy="email" autocomplete="email" required>
                    <span class="mdc-notched-outline">
                        <span class="mdc-notched-outline__leading"></span>
                        <span class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label" id="email-label">Email address</span>
                        </span>
                        <span class="mdc-notched-outline__trailing"></span>
                    </span>
                </label>
                <x-ui.validation-error for="email" />
            </div>

            <div>
                <label class="w-full mt-4 mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon"
                    :class="{ 'mdc-text-field--invalid': errorMessages['password'] != undefined }" wire:ignore>
                    <input class="mdc-text-field__input" aria-labelledby="password-label" :type="passwordField"
                        autocomplete="new-password" wire:model.lazy="password" required />
                    <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon"
                        type="button" tabindex="0"
                        @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'">
                        <i class="material-icons mdc-icon-button__icon"
                            x-text="passwordField == 'password' ? 'visibility' : 'visibility_off'"></i>
                    </button>
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
                        <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="password-error"
                            aria-hidden="true">
                            <p class="text-error">{{ $message }}</p>
                        </div>
                    </div>
                @enderror
                @if (!$errors->has('password') && $password == '')
                    <div class="mdc-text-field-helper-line h-7">
                        <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent"
                            id="password-error" aria-hidden="true">Must be 10+ characters and contain an uppercase
                            letter, number, and special character</div>
                    </div>
                @elseif(!$errors->has('password'))
                    <div class="mdc-text-field-helper-line h-7">
                        <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent"
                            id="password-error" aria-hidden="true">
                            <p class="text-green -mt-3.5">
                                Password strength requirements have been met</p>
                        </div>
                    </div>
                @endif
            </div>

            <label class="w-full mt-4 mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon"
                :class="{ 'mdc-text-field--invalid': errorMessages['passwordConfirmation'] != undefined }" wire:ignore>
                <input class="mdc-text-field__input" aria-labelledby="passwordconf-label" :type="passwordField"
                    autocomplete="new-password" wire:model.lazy="passwordConfirmation" required />
                <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon"
                    type="button" tabindex="0"
                    @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'">
                    <i class="material-icons mdc-icon-button__icon"
                        x-text="passwordField == 'password' ? 'visibility' : 'visibility_off'"></i>
                </button>
                <span class="mdc-notched-outline">
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                        <span class="mdc-floating-label" id="passwordconf-label">Confirm password</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                </span>
            </label>
            <x-ui.validation-error for="passwordConfirmation" />

            <div class="w-full mdc-select mdc-select--outlined" wire:ignore>
                <div class="mdc-select__anchor">
                    <span class="mdc-notched-outline">
                        <span class="mdc-notched-outline__leading"></span>
                        <span class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label mdc-floating-label--float-above"
                                id="outlined-select-label">Grade level</span>
                        </span>
                        <span class="mdc-notched-outline__trailing"></span>
                    </span>
                    <span class="mdc-select__selected-text-container outlined_select">
                        <span class="mdc-select__selected-text" id="grade-selected-text"></span>
                    </span>
                    <span class="mdc-select__dropdown-icon">
                        <svg class="mdc-select__dropdown-icon-graphic" viewBox="7 10 10 5">
                            <polygon class="mdc-select__dropdown-icon-inactive" stroke="none" fill-rule="evenodd"
                                points="7 10 12 15 17 10">
                            </polygon>
                            <polygon class="mdc-select__dropdown-icon-active" stroke="none" fill-rule="evenodd"
                                points="7 15 12 10 17 15">
                            </polygon>
                        </svg>
                    </span>
                </div>

                <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fixed">
                    <ul class="mdc-deprecated-list dark-theme-list">
                        @foreach ($gradeLevels as $level)
                            <li class="mdc-deprecated-list-item @if ($gradeLevel->value == $level['value']) mdc-deprecated-list-item--selected @endif"
                                data-value="{{ $level['value'] }}" wire:click="setGrade({{ $level['value'] }})">
                                <span class="mdc-deprecated-list-item__ripple"></span>
                                <span class="mdc-deprecated-list-item__text">{{ $level['formatted_name'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <x-ui.validation-error for="gradeLevel" />
            </div>

            <div class="mt-4">
                <label class="w-full mdc-text-field mdc-text-field--outlined"
                    :class="{ 'mdc-text-field--invalid': errorMessages['school'] != undefined }" wire:ignore>
                    <input class="mdc-text-field__input" type="text" aria-labelledby="school_name"
                        wire:model.lazy="school">
                    <span class="mdc-notched-outline">
                        <span class="mdc-notched-outline__leading"></span>
                        <span class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label" id="school_name">School name</span>
                        </span>
                        <span class="mdc-notched-outline__trailing"></span>
                    </span>
                </label>
                <x-ui.validation-error for="school" />

                <div class="mt-12 logincontainer">
                    <button class="mdc-button mdc-button-ripple mdc-button--raised loginbutton" wire:ignore>
                        <span class="mdc-button__ripple"></span>Register
                    </button>
                </div>
                <div class="mdc-typography continue-with">
                    <p>OR REGISTER WITH</p>
                </div>
                <div class="logincontainer secondcontainer">
                    <button class="mdc-button mdc-button-ripple mdc-button--outlined google-signin"
                        onclick="document.location='{{ route('google-login') }}'" wire:ignore>
                        <span class="mdc-button__ripple"></span>
                        <img class="mdc-button__icon" src="/images/logo/vendor/google.png" alt="Google logo"
                            aria-hidden="true" width="18px" height="18px">Google
                    </button>
                </div>
        </form>
    </x-ui.auth-card>
</div>
