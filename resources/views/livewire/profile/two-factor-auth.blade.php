<div class="pt-20 roboto">
    <x-ui.settings-card title="2-Factor Authentication"
    description="2FA allows you to make your account more secure by requiring a code after entering your password."
    back-button>
        <div class="py-4">
            <div class="inline-block float-left w-1/2 mt-1">
                @if ($this->enabled)
                    <p class="text-xl">2-Factor Authentication is enabled</p>
                    <p class="hidden text-sm text-gray-500 md:block">You're taking the right steps to keep your account more secure.</p>
                @else
                    <span class="text-xl">2-Factor Authentication is not enabled</span>
                    <p class="hidden text-sm text-gray-500 md:block">Setting up 2FA is very simple. All you need is a mobile device and an authentication app such as Authy or Google Authenticator.</p>
                @endif
            </div>
            <div class="float-right mt-3">
                <span wire:click="{{$this->enabled ? 'disableTwoFactorAuthentication' : 'enableTwoFactorAuthentication'}}">
                    <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button" wire:ignore.self>
                        <span class="mdc-button__ripple" wire:ignore></span><span>{{$this->enabled ? 'Disable 2FA' : 'Enable 2FA'}}</span>
                    </button> 
                </span>
            </div>
        </div>
        <div class="inline-block w-full mt-4 border-t border-gray-200">
            @if ($this->enabled)
                <div class="float-left w-1/2 mt-6">
                    <p class="text-xl">Change 2FA device</p>
                    <p class="hidden text-sm text-gray-500 md:block">The codes generated on your previous device's authenticator app will no longer be valid.</p>
                </div>
                <div class="float-right mt-9">
                    <span wire:click="changeTwoFactorDevice">
                        <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button" wire:ignore.self>
                            <span class="mdc-button__ripple" wire:ignore></span><span>Change Phone</span>
                        </button> 
                    </span>
                </div>
            @endif
            <div class="clear-both pt-2">
                @if ($this->enabled)
                    @if ($showingQrCode)
                        <p class="mt-8 text-lg font-medium text-center text-gray-700">2FA has been enabled! Scan this QR code with your authenticator app to add it to your phone.</p>
                        <div class="block w-full text-center">
                            <div class="inline-block my-8 border-4 border-white">
                                <div class="w-48 h-48">
                                    {!! $this->user->twoFactorQrCodeSvg() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        @if ($this->enabled)
            <div class="inline-block w-full pt-4 mt-4 border-t border-gray-200">
                <div class="inline-block float-left w-1/2 mt-1">
                    <p class="text-xl">Backup codes</p>
                    <p class="hidden text-sm text-gray-500 md:block">8 backup codes are currently active for your account. You can view the current codes or generate new ones.</p>
                </div>
                <div class="float-right mt-3">
                    <span wire:click="{{$showingRecoveryCodes ? 'regenerateRecoveryCodes' : 'showRecoveryCodes'}}">
                        <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button" wire:ignore.self>
                            <span class="mdc-button__ripple" wire:ignore></span>{{$showingRecoveryCodes ? 'Generate New Codes' : 'View Codes'}}
                        </button> 
                    </span>
                </div>
                <div class="clear-both pt-4">
                    @if ($showingRecoveryCodes)
                        <p class="mt-4 text-center text-gray-600">Keep these recovery codes in a safe place. They can be used to recover access to your account if you do not have access to your 2FA app anymore. Each code can be used only once, so make sure to check for the updated codes if you use one.</p>

                        <div class="container grid max-w-xl gap-1 px-4 py-4 mx-auto mt-5 font-mono text-sm bg-gray-100 rounded-lg">
                            @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                                <div>{{ $code }}</div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </x-ui.settings-card>
</div>
  