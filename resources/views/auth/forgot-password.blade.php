<x-guest-layout title="Forgot Password">
  <div class="roboto pt-32 pb-24">
    <x-ui.auth-card title="Forgot your password?" description="Enter your email address and we'll send you a magic link to reset it!">
      <div class="text-green mb-2 mt-3 h-4 text-sm">
        @if (session()->has('status'))
          {{ session('status') }}
        @endif
      </div>
      <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="block">
            <label class="mdc-text-field mdc-text-field--outlined mt-4 w-full">
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

          <div class="mt-12 flex items-center justify-end">
            <button class="mdc-button mdc-button-ripple mdc-button--raised">
              <span class="mdc-button__ripple"></span>Email Password Reset Link
            </button>
          </div>
      </form>
    </x-ui.auth-card>
  </div>
</x-guest-layout>
