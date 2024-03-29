<x-guest-layout title="Login">
    <div class="pt-12 pb-6">
        <x-ui.auth-card title="Sign in to Schedulist">
            <form method="POST" action="{{ route('login') }}" x-data="{
                passwordField: 'password',
            }">
                @csrf
                <div class="mt-6">
                    <label
                        class="mdc-text-field mdc-text-field--outlined @error('email') mdc-text-field--invalid @enderror w-full">
                        <input class="mdc-text-field__input" name="email" type="email" aria-labelledby="email-label"
                            wire:model.lazy="email" required autofocus>
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
                            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="email"
                                aria-hidden="true">
                                <p class="text-error">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-5 mb-2">
                    <label
                        class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon @error('password') mdc-text-field--invalid @enderror w-full">
                        <input class="mdc-text-field__input" name="password" aria-labelledby="password-label"
                            :type="passwordField" autocomplete="current-password" wire:model.lazy="password"
                            required />
                        <button
                            class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle"
                            type="button" tabindex="0"
                            @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'">
                            <i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i>
                            <i class="material-icons mdc-icon-button__icon">visibility</i>
                        </button>
                        <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__notch">
                                <span class="mdc-floating-label" id="password-label">Password</span>
                            </span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                    </label>
                </div>
                <div class="mt-6">
                    <div class="mdc-form-field">
                        <div class="mdc-checkbox remember_me">
                            <input class="mdc-checkbox__native-control" name="remember" type="checkbox" />
                            <div class="mdc-checkbox__background">
                                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                    <path
                                        class="mdc-checkbox__checkmark-path"fill="none"d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                </svg>
                                <div class="mdc-checkbox__mixedmark"></div>
                            </div>
                            <div class="mdc-checkbox__ripple"></div>
                        </div>
                        <label class="check_label" for="remember_me">Keep me signed in</label>
                    </div>
                    <div class="forgot-password mt-2 mr-2 flex items-center justify-end">
                        <a class="text-primary-theme text-sm hover:underline"
                            href="{{ route('forgot-password') }}">Forgot password?</a>
                    </div>
                </div>
                <div class="logincontainer mt-10">
                    <button class="mdc-button mdc-button-ripple mdc-button--raised loginbutton" wire:ignore>
                        <span class="mdc-button__ripple"></span>Sign In
                    </button>
                </div>
            </form>
            <div class="mdc-typography continue-with">
                <p>OR SIGN IN WITH</p>
            </div>
            <div class="logincontainer secondcontainer">
                <button class="mdc-button mdc-button-ripple mdc-button--outlined google-signin"
                    onclick="document.location='{{ route('google-login') }}'" wire:ignore>
                    <span class="mdc-button__ripple"></span>
                    <img class="mdc-button__icon" src="/images/logo/vendor/google.png" alt="Google logo"
                        aria-hidden="true" width="18px" height="18px">
                    Google
                </button>
            </div>
        </x-ui.auth-card>
    </div>
</x-guest-layout>
