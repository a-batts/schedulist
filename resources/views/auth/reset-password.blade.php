<x-guest-layout title="Reset Password">
    <div class="py-16" x-data="{
        passwordField: 'password',
    }">
        <x-ui.auth-card title="Reset password" description="Select a new password to use for signing in to your account">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input name="token" type="hidden" value="{{ $request->route('token') }}">
                <div class="mt-11 block">
                    <label class="mdc-text-field mdc-text-field--outlined w-full">
                        <input class="mdc-text-field__input" name="email" type="email" aria-labelledby="email-label"
                            autocomplete="email" required autofocus>
                        <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__notch">
                                <span class="mdc-floating-label" id="email-label">Email address</span>
                            </span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                    </label>
                </div>
                <x-ui.validation-error for="email" :message="$errors->first('email')" />

                <div class="mt-4">
                    <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon w-full"
                        wire:ignore>
                        <input class="mdc-text-field__input" name="password" aria-labelledby="password-label"
                            :type="passwordField" autofill="new-password" required />
                        <button
                            class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon"
                            type="button" tabindex="0"
                            @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'">
                            <i class="material-icons mdc-icon-button__icon"
                                x-text="passwordField == 'password' ? 'visibility' : 'visibility_off'"></i>
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
                            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent"
                                id="password-error" aria-hidden="true">
                                <p class="text-error">{{ $message }}</p>
                            </div>
                        </div>
                    @enderror
                    @if (!$errors->has('password'))
                        <div class="mdc-text-field-helper-line h-7">
                            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent"
                                id="password-error" aria-hidden="true">Must be 10+ characters and contain an uppercase
                                letter, number, and special character</div>
                        </div>
                    @endif
                </div>
                <div class="mt-4">
                    <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon w-full"
                        wire:ignore>
                        <input class="mdc-text-field__input" name="password_confirmation"
                            aria-labelledby="passwordconf-label" :type="passwordField" autofill="new-password"
                            required />
                        <button
                            class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon"
                            type="button" tabindex="0"
                            @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'">
                            <i class="material-icons mdc-icon-button__icon"
                                x-text="passwordField == 'password' ? 'visibility' : 'visibility_off'"></i>
                        </button>
                        <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__notch">
                                <span class="mdc-floating-label" id="passwordconf-label">Confirm New Password</span>
                            </span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                    </label>
                    <x-ui.validation-error for="passwordConfirmation" :message="$errors->first('password_confirmation')" />
                </div>

                <div class="mt-8 flex items-center justify-end">
                    <button class="mdc-button mdc-button-ripple mdc-button--raised">
                        <span class="mdc-button__ripple"></span>Reset Password
                    </button>
                </div>
            </form>
        </x-ui.auth-card>

    </div>

</x-guest-layout>
