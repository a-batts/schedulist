<x-guest-layout title="2FA">
    <x-jet-authentication-card>
        <x-slot name="logo">
          <div class="logoimage"></div>
        </x-slot>
        <h4 class="mdc-typography logintext mt-4">Enter 2FA Code</h4>
        <div x-data="{ recovery: false }">
            <div class="mb-4 mt-2 mdc-typography mdc-typography--body2 text-gray-600" x-show="! recovery">
                {{ __('Please enter the six digit code displayed in your authenticator app to continue.') }}
            </div>

            <div class="mb-4 mt-4 mdc-typography mdc-typography--body2 text-gray-600" x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </div>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="/two-factor-challenge">
                @csrf

                <div class="mt-8 mb-6" x-show="! recovery">
                  <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label w-full" style="height: 70px;">
                    <span class="mdc-notched-outline">
                      <span class="mdc-notched-outline__leading"></span>
                      <span class="mdc-notched-outline__trailing"></span>
                    </span>
                    <input id="code" class="mdc-text-field__input" type="tel" name="code" autofocus x-ref="code" autocomplete="chrome-off" aria-label="2FA code" style="text-align: center; letter-spacing: 20px; font-size: 33px" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" minlength="6" maxlength="6">
                  </label>
                </div>

                <div class="mt-8 mb-6" x-show="recovery">
                  <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label w-full">
                    <span class="mdc-notched-outline">
                      <span class="mdc-notched-outline__leading"></span>
                      <span class="mdc-notched-outline__trailing"></span>
                    </span>
                    <input id="recovery_code" class="mdc-text-field__input" type="text" name="recovery_code" autofocus x-ref="recovery_code" autocomplete="chrome-off" aria-label="2FA code">
                  </label>
                </div>

                <div class="flex items-center justify-end mt-8">
                    <button type="button" class="mdc-button mdc-button-ripple"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        <span class="mdc-button__ripple"></span>
                        {{ __('Use a recovery code') }}
                    </button>

                    <button type="button" class="mdc-button mdc-button-ripple"
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        <span class="mdc-button__ripple"></span>
                        {{ __('Use authentication code') }}
                    </button>

                    <button class="ml-4 mdc-button mdc-button--raised mdc-button-ripple">
                        <span class="mdc-button__ripple"></span>
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
