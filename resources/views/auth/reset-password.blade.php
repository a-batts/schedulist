<x-guest-layout title="Reset Password">
    <x-jet-authentication-card>
        <x-slot name="logo">
          <div class="logoimage">
          </div>
        </x-slot>
        <h2 class="roboto logintext">Reset password</h2>
        <h6 class="roboto" style="font-size: 15px;">Select a new password to use for signing in</h6>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block mt-6">
              <label class="mdc-text-field mdc-text-field--outlined login-form email">
                <input type="email" class="mdc-text-field__input" aria-labelledby="email-label" name="email" :value="old('email', $request->email)" autocomplete="email" required autofocus>
                <span class="mdc-notched-outline">
                  <span class="mdc-notched-outline__leading"></span>
                  <span class="mdc-notched-outline__notch">
                    <span class="mdc-floating-label" id="email-label">Email address</span>
                  </span>
                  <span class="mdc-notched-outline__trailing"></span>
                </span>
              </label>
              @if ($errors->has('email'))
                @foreach ($errors->get('email') as $message)
                <div class="mdc-text-field-helper-line">
                  <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="my-helper-id" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
                @endforeach
              @endif
            </div>

            <div class="mt-4">
                <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon login-form">
                  <input type="password" class="mdc-text-field__input" id="passwordfield" aria-labelledby="password-label" name="password" required autocomplete="new-password" />
                  <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle" onclick="showLoginPassword('passwordfield')" type="button" tabindex="0"><i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i><i class="material-icons mdc-icon-button__icon">visibility</i></button>
                  <span class="mdc-notched-outline">
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                      <span class="mdc-floating-label" id="password-label">Password</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                  </span>
                </label>
                @if ($errors->has('password'))
                  @foreach ($errors->get('password') as $message)
                  @if($message=="The password must be at least 10 characters and contain at least one uppercase character, one number, and one special character.")
                  <div class="mdc-text-field-helper-line">
                    <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="my-helper-id" aria-hidden="true"><p class="text-error">Password must be 10+ characters, with an uppercase letter, number, and special character.</p></div>
                  @endif
                  @endforeach
                @else
                <div class="mdc-text-field-helper-line">
                  <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="my-helper-id" aria-hidden="true">Must be 10+ characters and contain an uppercase letter, number, and special character</div>
                @endif
            </div>

            <div class="mt-4">
                <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon login-form">
                <input type="password" class="mdc-text-field__input" id="passwordcomf" aria-labelledby="password-confirmation" name="password_confirmation" required autocomplete="new-password" />
                <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle" onclick="showLoginPassword('passwordcomf')" type="button" tabindex="0"><i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i><i class="material-icons mdc-icon-button__icon">visibility</i></button>
                <span class="mdc-notched-outline">
                  <span class="mdc-notched-outline__leading"></span>
                  <span class="mdc-notched-outline__notch">
                    <span class="mdc-floating-label" id="password-confirmation">Confirm Password</span>
                  </span>
                  <span class="mdc-notched-outline__trailing"></span>
                </span>
                </label>
                @if ($errors->has('password'))
                  @foreach ($errors->get('password') as $message)
                  @if($message=="The password confirmation does not match.")
                  <div class="mdc-text-field-helper-line">
                    <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="my-helper-id" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
                  @endif
                  @endforeach
                @endif
                </div>
            </div>

            <div class="flex items-center justify-end mt-8">
              <button class="mdc-button mdc-button-ripple mdc-button--raised">
                  <span class="mdc-button__ripple"></span>
                  {{ __('Reset Password') }}
              </button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
