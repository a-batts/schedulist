<x-guest-layout title="Login">
  <div class="pt-12 pb-6">
    <x-ui.auth-card title="Sign in to Schedulist">
      <form method="POST" action="{{ route('login') }}"
      x-data="{
        passwordField: 'password',
      }">
        @csrf
        <div class="mt-6">
          <label class="mdc-text-field mdc-text-field--outlined w-full @error('email') mdc-text-field--invalid @enderror">
            <input type="email" class="mdc-text-field__input" aria-labelledby="email-label" name="email" wire:model.lazy="email" required autofocus>
            <span class="mdc-notched-outline">
              <span class="mdc-notched-outline__leading"></span>
              <span class="mdc-notched-outline__notch">
                <span class="mdc-floating-label" id="email-label">Email address</span>
              </span>
              <span class="mdc-notched-outline__trailing"></span>
            </span>
          </label>
          <div class="h-2 mdc-text-field-helper-line">
            @error('email')
              <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="email" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
            @enderror
          </div>
        </div>
        <div class="mt-5 mb-2">
          <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon w-full @error('password') mdc-text-field--invalid @enderror">
            <input class="mdc-text-field__input" aria-labelledby="password-label" name="password" :type="passwordField" autocomplete="current-password" wire:model.lazy="password" required />
            <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle" @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'" type="button" tabindex="0">
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
              <input type="checkbox" class="mdc-checkbox__native-control" name="remember"/>
              <div class="mdc-checkbox__background">
                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                  <path class="mdc-checkbox__checkmark-path"fill="none"d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                </svg>
                <div class="mdc-checkbox__mixedmark"></div>
              </div>
              <div class="mdc-checkbox__ripple"></div>
            </div>
            <label class="check_label" for="remember_me">Keep me signed in</label>
          </div>
          <div class="flex items-center justify-end mt-2 mr-2 forgot-password">
            <a class="text-sm text-primary-theme hover:underline" href="{{ route('password.request') }}">Forgot password?</a>
          </div>
        </div>
        <div class="mt-10 logincontainer">
          <button class="mdc-button mdc-button-ripple mdc-button--raised loginbutton" wire:ignore>
            <span class="mdc-button__ripple"></span>Sign In
          </button>
        </div>
      </form>
      <div class="mdc-typography continue-with">
        <p>OR SIGN IN WITH</p>
      </div>
      <div class="logincontainer secondcontainer">
        <button class="mdc-button mdc-button-ripple mdc-button--outlined google-signin" onclick="document.location='{{route('google-login')}}'" wire:ignore>
          <span class="mdc-button__ripple"></span>
          <img class="mdc-button__icon" src="/images/logo/vendor/google.png" width="18px" height="18px" aria-hidden="true">
          Google
        </button>
      </div>
    </x-ui.auth-card>
  </div>
</x-guest-layout>
