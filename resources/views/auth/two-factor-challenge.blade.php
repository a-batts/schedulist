<x-guest-layout title="Verify login">
    <x-ui.auth-card title="Verify that it's you"
        description="Please enter the six digit code displayed in your authenticator app (or a backup code) to continue.">
        <div x-data="{
            twoFactorCode: '',
            recovery: false,
            codeUpdated: function() {
                this.twoFactorCode = this.twoFactorCode.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')
        
                if (this.twoFactorCode.length == 6)
                    document.getElementById('twoFactorForm').submit()
            }
        }">
            <form id="twoFactorForm" method="POST" action="/two-factor-challenge">
                @csrf
                <div class="mt-8 mb-6 h-20 pt-5" x-show="!recovery">
                    <label
                        class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label @error('code')mdc-text-field--invalid @enderror w-full"
                        style="height: 70px;">
                        <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                        <input class="mdc-text-field__input text-center text-4xl" id="code" name="code"
                            type="tel" aria-label="2FA code" style="letter-spacing: 20px; font-weight: 600"
                            autofocus x-ref="code" x-model="twoFactorCode" x-on:input="codeUpdated()"
                            autocomplete="chrome-off" minlength="6" maxlength="6">
                    </label>
                    <x-ui.validation-error for="code" />
                </div>

                <div class="mt-8 mb-6 h-20" x-show="recovery" x-cloak>
                    <p class="mb-4 -mt-4 text-sm">Recovery codes format: <span
                            class="rounded-lg bg-gray-100 px-2 py-2 font-mono">XXXXXXXXXX-XXXXXXXXXX</span></p>
                    <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--no-label w-full">
                        <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__trailing"></span>
                        </span>
                        <input class="mdc-text-field__input" id="recovery_code" name="recovery_code" type="text"
                            aria-label="2FA code" x-ref="recovery_code" autocomplete="chrome-off" autofocus>
                    </label>
                </div>

                <div class="mt-8 flex items-center justify-end">
                    <button class="mdc-button mdc-button-ripple" type="button" x-show="!recovery"
                        x-on:click="recovery = true;
            $nextTick(() => { $refs.recovery_code.focus() })">
                        <span class="mdc-button__ripple"></span>Use a backup code
                    </button>

                    <button class="mdc-button mdc-button-ripple" type="button" x-show="recovery"
                        x-on:click="recovery = false;
            $nextTick(() => { $refs.code.focus() })" x-cloak>
                        <span class="mdc-button__ripple"></span>Use auth code
                    </button>

                    <button class="mdc-button mdc-button--raised mdc-button-ripple ml-4">
                        <span class="mdc-button__ripple"></span>Continue
                    </button>
                </div>
            </form>
        </div>
    </x-ui.auth-card>
</x-guest-layout>
