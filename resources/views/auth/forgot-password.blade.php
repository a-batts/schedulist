<x-guest-layout title="Forgot Password">
  <div class="pt-32 pb-24">
    <x-ui.auth-card title="Forgot your password?" description="Enter your email address and we'll send you a magic link to reset it!">
      <div class="h-4 mt-3 mb-2 text-sm text-green">
        @if (session()->has('status'))
          {{ session('status') }}
        @endif
      </div>
      <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="block">
            <label class="w-full mt-4 mdc-text-field mdc-text-field--outlined">
              <input type="email" class="mdc-text-field__input" aria-labelledby="email-label" name="email" value="{{ old('email') }}" required autofocus>
              <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__notch">
                  <span class="mdc-floating-label" id="email-label">Email address</span>
                </span>
                <span class="mdc-notched-outline__trailing"></span>
              </span>
            </label>
            <x-ui.validation-error :message="$errors->first('email')" for="email"/>
          </div>

          <div class="flex items-center justify-end mt-12">
            <button class="mdc-button mdc-button-ripple mdc-button--raised">
              <span class="mdc-button__ripple"></span>Email Password Reset Link
            </button>
          </div>
      </form>
    </x-ui.auth-card>
  </div>
</x-guest-layout>
