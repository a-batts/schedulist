<div class="py-4">
    <div class="mdc-card mdc-card--outlined w-full px-10 py-8 mx-auto mt-6 overflow-hidden sm:max-w-xl">
        <div class="text-5xl font-medium">Contact Us</div>
        <div class="mt-3 text-base text-left text-gray-600">Fill out this form to send a message to the
            Schedulist team.</div>
        <div class="mt-5 border-t border-gray-200"></div>
        <form wire:submit.prevent="submit" x-data="{
            submissionDisabled: false,
            resetCharacterCounter() {
                document.querySelector('.char-counter').innerHTML = '0 / 250';
            }
        }">
            <label
                class="mdc-text-field mdc-text-field--outlined @error('name') mdc-text-field--invalid @enderror @if ($name) mdc-text-field--label-floating @endif login-form mt-10">
                <span class="mdc-notched-outline" wire:ignore>
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                        <span class="mdc-floating-label mdc-floating-label--float-above" id="name-label">Full
                            Name</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                </span>
                <input class="mdc-text-field__input" type="text" aria-labelledby="name-label" autocomplete="name"
                    wire:model.lazy="name" required wire:ignore>
            </label>
            <x-ui.validation-error for="name" />
            <label
                class="mdc-text-field mdc-text-field--outlined @error('email') mdc-text-field--invalid @enderror @if ($email) mdc-text-field--label-floating @endif login-form mt-5">
                <span class="mdc-notched-outline" wire:ignore>
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                        <span class="mdc-floating-label mdc-floating-label--float-above" id="email-label">Your
                            Email</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                </span>
                <input class="mdc-text-field__input" type="email" aria-labelledby="email-label" autocomplete="email"
                    wire:model.debounce.500ms="email" wire:ignore>
            </label>
            <x-ui.validation-error for="email" />
            <div
                class="mdc-select mdc-select--required mdc-select--outlined @error('subject') mdc-select--invalid @enderror login-form mt-5">
                <div class="mdc-select__anchor" role="button" aria-haspopup="listbox" aria-expanded="false"
                    aria-required="true" aria-labelledby="subject-label" wire:ignore>
                    <span class="mdc-notched-outline">
                        <span class="mdc-notched-outline__leading"></span>
                        <span class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label" id="subject-label">Subject</span>
                        </span>
                        <span class="mdc-notched-outline__trailing"></span>
                    </span>
                    <span class="mdc-select__selected-text-container">
                        <span class="mdc-select__selected-text" id="demo-selected-text"></span>
                    </span>
                    <span class="mdc-select__dropdown-icon">
                        <svg class="mdc-select__dropdown-icon-graphic" viewBox="7 10 10 5" focusable="false">
                            <polygon class="mdc-select__dropdown-icon-inactive" stroke="none" fill-rule="evenodd"
                                points="7 10 12 15 17 10">
                            </polygon>
                            <polygon class="mdc-select__dropdown-icon-active" stroke="none" fill-rule="evenodd"
                                points="7 15 12 10 17 15">
                            </polygon>
                        </svg>
                    </span>
                </div>
                <div
                    class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth @error('subject') mdc-select__menu--invalid @enderror">
                    <ul class="mdc-deprecated-list dark-theme-list" role="listbox"
                        aria-label="Contact subject selection" wire:ignore>
                        <li class="mdc-deprecated-list-item" data-value="General Feedback" role="option"
                            aria-selected="false" wire:click="setSubject('General Feedback')">
                            <span class="mdc-deprecated-list-item__ripple"></span>
                            <span class="mdc-deprecated-list-item__text">
                                General feedback
                            </span>
                        </li>
                        <li class="mdc-deprecated-list-item" data-value="Feature Suggestion" role="option"
                            aria-selected="false" wire:click="setSubject('Feature Suggestion')">
                            <span class="mdc-deprecated-list-item__ripple"></span>
                            <span class="mdc-deprecated-list-item__text">
                                New feature suggestion
                            </span>
                        </li>
                        <li class="mdc-deprecated-list-item" data-value="Account Issues" role="option"
                            aria-selected="false" wire:click="setSubject('Account Issues')">
                            <span class="mdc-deprecated-list-item__ripple"></span>
                            <span class="mdc-deprecated-list-item__text">
                                Account or login problems
                            </span>
                        </li>
                        <li class="mdc-deprecated-list-item" data-value="Bug Reports" role="option"
                            aria-selected="false" wire:click="setSubject('Bug Reports')">
                            <span class="mdc-deprecated-list-item__ripple"></span>
                            <span class="mdc-deprecated-list-item__text">
                                Bug report
                            </span>
                        </li>
                        <li class="mdc-deprecated-list-item" data-value="Other" role="option" aria-selected="false"
                            wire:click="setSubject('Other')">
                            <span class="mdc-deprecated-list-item__ripple"></span>
                            <span class="mdc-deprecated-list-item__text">
                                Other subject
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <x-ui.validation-error for="subject" />
            <label
                class="mdc-text-field mdc-text-field--outlined mdc-text-field--textarea mdc-text-field--with-internal-counter login-form @error('message') mdc-text-field--invalid @enderror ml-1 mt-5">
                <span class="mdc-notched-outline" wire:ignore>
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                        <span class="mdc-floating-label" id="message-label">What's your message?</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                </span>
                <textarea class="mdc-text-field__input" aria-labelledby="message-label" rows="6" maxlength="250"
                    wire:model.debounce.500ms="message" required wire:ignore></textarea>
                <div class="char-counter mdc-text-field-character-counter" wire:ignore>0 / 250</div>
            </label>
            <x-ui.validation-error for="message" />
            <div class="flex justify-end mt-10">
                <button class="mdc-button mdc-button-ripple mdc-button--raised mb-4" type="submit"
                    @disable-send-button.window="submissionDisabled = true"
                    @reset-form.window="submissionDisabled = true; resetCharacterCounter()"
                    :disabled="submissionDisabled" wire:ignore>
                    <span class="mdc-button__ripple"></span>
                    <i class="material-icons mdc-button__icon" aria-hidden="true">send</i>Send Email
                </button>
            </div>
        </form>
    </div>
</div>
