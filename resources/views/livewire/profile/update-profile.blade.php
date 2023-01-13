<div id="profile_settings" x-data="phoneVerification()" @display-phone-verification.window="confirmingNumber = true; timeout()"
    @hide-phone-verification.window="confirmingNumber = false" @set-timer.window="seconds = event.detail">
    @livewire('profile.update-profile-photo')
    <form wire:submit.prevent="save">
        <x-ui.settings-card title="Personal info"
            description="Update your basic information, such as your name and email address.">
            <div class="pt-4 pb-2">
                <p class="mt-1 text-gray-600">Set or change your profile picture</p>
                <p class="mt-1 text-sm text-gray-500"><span class="inline-block"><span
                            class="material-icons inline-block mt-1 mr-3 align-text-bottom text-inherit"
                            style="vertical-align: -5px">public</span>Other Schedulist users will be able to view the
                        picture you select.</span></p>
                <div>
                    <div class="block w-full mt-5">
                        <div class="w-full">
                            <img class="w-24 h-24 mx-auto rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                                alt="Profile photo" />
                        </div>
                        <div class="block text-center mt-7">
                            <button class="mdc-button mdc-button--outlined mdc-button-ripple inline-block"
                                type="button" @click="$dispatch('open-photo-dialog')" :disabled="offline"
                                wire:ignore>
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
                    <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--label-floating w-full"
                        :class="{ 'mdc-text-field--invalid': errorMessages['state.firstname'] != undefined }"
                        wire:ignore>
                        <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__notch">
                                <span class="mdc-floating-label mdc-floating-label--float-above"
                                    id="first-name-label">First name</span>
                            </span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                        <input class="mdc-text-field__input" type="text" aria-labelledby="first-name-label"
                            wire:model.debounce.250ms="state.firstname" autocomplete="given-name" required>
                    </label>
                    <x-ui.validation-error for="state.firstname" />
                </div>
                <div class="float-right w-1/2 pl-1.5">
                    <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--label-floating w-full"
                        :class="{ 'mdc-text-field--invalid': errorMessages['state.lastname'] != undefined }"
                        wire:ignore>
                        <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__notch">
                                <span class="mdc-floating-label mdc-floating-label--float-above"
                                    id="last-name-label">Last name</span>
                            </span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                        <input class="mdc-text-field__input" type="text" aria-labelledby="last-name-label"
                            wire:model.debounce.250ms="state.lastname" autocomplete="family-name" required>
                    </label>
                    <x-ui.validation-error for="state.lastname" />
                </div>
            </div>
            <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--label-floating w-full"
                :class="{ 'mdc-text-field--invalid': errorMessages['state.email'] != undefined }" wire:ignore>
                <span class="mdc-notched-outline">
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                        <span class="mdc-floating-label mdc-floating-label--float-above" id="email-label">Email</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                </span>
                <input class="mdc-text-field__input" id="profile-email-input" type="email"
                    aria-labelledby="email-label" wire:model.debounce.250ms="state.email" autocomplete="email" required>
            </label>
            <x-ui.validation-error for="state.email" />
            <div class="w-full">
                <div class="float-left w-1/2 pr-1.5">
                    <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--label-floating w-full"
                        :class="{ 'mdc-text-field--invalid': errorMessages['state.phone'] != undefined }" wire:ignore>
                        <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__notch">
                                <span class="mdc-floating-label mdc-floating-label--float-above" id="phone-label">Phone
                                    number</span>
                            </span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                        <input class="mdc-text-field__input" id="profile-phone-input" type="text"
                            aria-labelledby="phone-label" wire:model.debounce.250ms="state.phone" autocomplete="phone">
                    </label>
                    <x-ui.validation-error for="state.phone" />
                </div>
            </div>
            <div>
                <div class="float-left clear-left w-1/2 pr-1.5">
                    <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--label-floating w-full"
                        :class="{ 'mdc-text-field--invalid': errorMessages['state.school'] != undefined }" wire:ignore>
                        <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__notch">
                                <span class="mdc-floating-label mdc-floating-label--float-above"
                                    id="school-name-label">School name</span>
                            </span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                        <input class="mdc-text-field__input" type="text" aria-labelledby="school-name-label"
                            wire:model.debounce.250ms="state.school" autocomplete="school-name" required>
                    </label>
                    <x-ui.validation-error for="state.school" />
                </div>
                <div class="float-right w-1/2 pl-1.5">
                    <div class="mdc-select mdc-select--outlined w-full" wire:ignore>
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
                                    <polygon class="mdc-select__dropdown-icon-inactive" stroke="none"
                                        fill-rule="evenodd" points="7 10 12 15 17 10">
                                    </polygon>
                                    <polygon class="mdc-select__dropdown-icon-active" stroke="none"
                                        fill-rule="evenodd" points="7 15 12 10 17 15">
                                    </polygon>
                                </svg>
                            </span>
                        </div>

                        <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fixed">
                            <ul class="mdc-deprecated-list dark-theme-list">
                                @foreach ($gradeLevels as $level)
                                    <li class="mdc-deprecated-list-item @if ($state['grade_level'] == $level['value']) mdc-deprecated-list-item--selected @endif"
                                        data-value="{{ $level['value'] }}"
                                        wire:click="setGrade({{ $level['value'] }})">
                                        <span class="mdc-deprecated-list-item__ripple"></span>
                                        <span
                                            class="mdc-deprecated-list-item__text">{{ $level['formatted_name'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <x-ui.validation-error for="state.grade_level" />
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button class="mdc-button mdc-button--raised mdc-button-ripple float-right clear-left"
                    :disabled="offline" wire:ignore>
                    <span class="mdc-button__ripple"></span>Save Changes
                    <button>
            </div>
        </x-ui.settings-card>
    </form>
    <!-- Phone number confirmation menu -->
    <div>
        <div class="modal-skim inset-0 hidden bg-gray-500 opacity-75" style="display: none" x-show="confirmingNumber"
            x-cloak wire:ignore.self></div>
        <div class="modal-container mdc-typography fixed w-screen h-screen pb-6 overflow-y-auto top-20"
            x-show="confirmingNumber" x-transition x-trap.noscroll="confirmingNumber" x-cloak wire:ignore.self>
            <div class="mdc-card mdc-card--outlined modal-card px-6 pb-6">
                <h6 class="mt-4">
                    <span class="material-icons ml-1 mr-4 select-none" style="vertical-align: -2px">textsms</span>
                    <span class="mt-4 text-3xl font-bold">Verify your phone number</span>
                </h6>
                <p class="mt-3 text-gray-600">We just sent a text with a confirmation code to
                    {{ $formattedPhoneNumber ?? 'null' }}.</p>
                <p class="text-blue mt-1 text-sm" style="cursor: pointer" @click="confirmingNumber = false"
                    wire:click="cancelValidation()">Wrong phone number?</p>
                <label
                    class="mdc-text-field mdc-text-field--outlined @error('verificationCodeInput') mdc-text-field--invalid @enderror login-form mdc-text-field--label-floating mt-7">
                    <input class="mdc-text-field__input" type="number" aria-labelledby="confirmation-code-label"
                        wire:model.debounce.250ms="verificationCodeInput" autocomplete="chrome-off" maxlength="6"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        required>
                    <span class="mdc-notched-outline mdc-notched-outline--notched" wire:ignore>
                        <span class="mdc-notched-outline__leading"></span>
                        <span class="mdc-notched-outline__notch" style="width: 105.5px">
                            <span class="mdc-floating-label mdc-floating-label--float-above">Verification code</span>
                        </span>
                        <span class="mdc-notched-outline__trailing"></span>
                    </span>
                </label>
                <x-ui.validation-error for="verificationCodeInput" />
                <div class="mt-10">
                    <button class="mdc-button mdc-button-ripple tfa-button float-left" type="button"
                        @click="$wire.resendCode(); timeout()" :disabled="seconds > 0" wire:ignore>
                        <span class="mdc-button__ripple"></span>
                        Resend code
                        <p class="whitespace-pre"> (<span x-text="seconds"></span>)</p>
                    </button>
                    <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button"
                        wire:click="confirmVerification()" wire:ignore>
                        <span class="mdc-button__ripple"></span>
                        Submit
                    </button>
                    <button class="mdc-button mdc-button-ripple tfa-button mr-3" @click="confirmingNumber = false"
                        wire:click="cancelValidation()" wire:ignore>
                        <span class="mdc-button__ripple"></span>
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script data-swup-reload-script>
        function phoneVerification() {
            return {
                confirmingNumber: false,

                errorMessages: @entangle('errorMessages'),

                seconds: 120,

                timeout: function() {
                    this.seconds = 120;

                    const timer = setInterval(() => {
                        if (this.seconds == 0)
                            clearInterval(timer);
                        else
                            this.seconds--;
                    }, 1000);
                },
            }
        }
    </script>
@endpush
