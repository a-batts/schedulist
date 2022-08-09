<div>
  <x-ui.settings-card title="Sign in with Google"
  description="Link a Google account to sign in to your account with just a single click.">
    <div class="pt-4 pb-2">
      <div class="float-left">
        @if($this->hasGoogleAccount)
          <p class="mt-1 text-lg">You are already connected to Google</p>
          <p class="mt-2 text-sm text-gray-500">Linked to <span class="font-medium">{{Auth::user()->google_email}}</span></p>
        @else
          <p class="mt-1 text-lg">Connect to Google</p>
          <p class="mt-2 text-sm text-gray-500">You'll be able to use your account for passwordless sign in</p>
        @endif
      </div>
      <div class="float-right mt-3">
        <button class="float-left mdc-button mdc-button-ripple mdc-button--outlined google-signin" @if($this->hasGoogleAccount) wire:click="disconnectGoogle" @else onclick="document.location='/login/google'" @endif>
          <span class="mdc-button__ripple"></span>
          <img class="mdc-button__icon" src="/images/icon/vendor/google.png" width="18px" height="18px" aria-hidden="true">
          {{$this->hasGoogleAccount ? 'Disconnect Account' : 'Connect Account'}}
        </button>
      </div>
    </div>
  </x-ui.settings-card>
</div>