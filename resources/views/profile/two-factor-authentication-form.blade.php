<div class="mdc-card mdc-card--outlined options_card mdc-typograpy">
  <h4 class="mdc-typography--headline5 mt-2 nunito">2-Factor Authentication</h4>
  <p class="mdc-typography--body2 text-gray-600 mt-1">Increase account security by requiring a unique and random token to be entered when signing in so we can verify that it is really you. You can use Google Authenticator, Authy, or any other 2FA app to set this up.</p>
  <div class="border-t border-gray-200 mt-5"></div>
  <div class="mt-5 mdc-button-ripple">
    @if ($this->enabled)
        <span class="material-icons-two-tone check_icon">check_circle</span>
        <span class="mt-10 ml-4 font-medium text-lg va-10">2-Factor Authentication is enabled</span>
    @else
        <span class="material-icons-two-tone x_icon">highlight_off</span>
        <span class="mt-10 ml-4 font-medium text-lg va-10">2-Factor Authentication is not enabled</span>
    @endif
  </div>
  @if ($this->enabled)
      @if ($showingQrCode)
          <div class="mt-4 text-sm text-gray-600">
              <p class="mdc-typography--subtitle1">2FA has been enabled! Scan this QR code with your authenticator app to add it to your phone.
              </p>
          </div>

          <div class="border-4 border-white mx-auto mt-6 mb-6">
            <div class="self-center" style="width: 192px; height: 192px">
                {!! $this->user->twoFactorQrCodeSvg() !!}
            </div>
          </div>
      @endif

      @if ($showingRecoveryCodes)
          <div class="mt-4 text-sm text-gray-600">
              <p class="mdc-typography--body2">
                Keep these recovery codes in a safe place. They can be used to recover access to your account if you do not have access to your 2FA app anymore. Each code can be used only once, so make sure to check for the updated codes if you use one.
              </p>
          </div>

          <div class="grid gap-1 max-w-xl mx-auto container mt-5 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
              @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                  <div>{{ $code }}</div>
              @endforeach
          </div>
      @endif
  @endif
  <div class="mt-5">
      @if (! $this->enabled)
          <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
            <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button mt-5" wire:ignore>
              <span class="mdc-button__ripple"></span>
              Enable
            </button>
          </x-jet-confirms-password>
      @else
          @if ($showingRecoveryCodes)
              <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                  <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button mt-5 ml-3" wire:ignore onclick="snack('2FA has been disabled')">
                    <span class="mdc-button__ripple"></span>
                      Disable
                  </button>
              </x-jet-confirms-password>
              <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                <button class="mdc-button mdc-button-ripple tfa-button mt-5" wire:ignore onclick="snack('Recovery codes were updated')">
                  <span class="mdc-button__ripple"></span>
                    Regenerate Codes
                </button>
              </x-jet-confirms-password>
          @else
              <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                  <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button mt-5 ml-3" wire:ignore onclick="snack('2FA has been disabled')">
                    <span class="mdc-button__ripple"></span>
                      Disable
                  </button>
              </x-jet-confirms-password>
              <x-jet-confirms-password wire:then="showRecoveryCodes">
                <button class="mdc-button mdc-button-ripple tfa-button mt-5" wire:ignore>
                  <span class="mdc-button__ripple"></span>
                    Show Recovery Codes
                </button>
              </x-jet-confirms-password>
          @endif
      @endif
  </div>
</div>
