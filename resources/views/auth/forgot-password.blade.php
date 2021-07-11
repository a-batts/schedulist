<x-guest-layout title="Forgot Password">
    <x-jet-authentication-card>
        <x-slot name="logo">
          <div class="logoimage">
          </div>
        </x-slot>
        <div class="mt-1"></div>
        <div>

            <span class="mdc-typography logintext mb-4">
              Forgot password?
            </span>
            <p class="mdc-typography mb-4" style="font-size: 15px;">
              Enter your email and we'll send you a magic link to reset it!
            </p>
        </div>

        @if (session('status'))
            <div class="mb-2 mdc-typography mdc-typography--body2 text-green">
                {{ session('status') }}
            </div>
        @endif



        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
              <label class="mdc-text-field mdc-text-field--outlined login-form resemail mt-4">
                <input type="email" class="mdc-text-field__input" aria-labelledby="email-label" name="email" value="{{ old('email') }}" required autofocus>
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

            <div class="flex items-center justify-end mt-8">
                <button class="mdc-button mdc-button-ripple mdc-button--raised">
                    <span class="mdc-button__ripple"></span>
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
