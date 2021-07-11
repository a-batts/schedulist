<div class="mdc-card mdc-card--outlined options_card mdc-typograpy">
  <h4 class="mdc-typography--headline5 nunito mt-2">Google Login</h4>
  <p class="mdc-typography--body2 text-gray-600 mt-1">Link a Google Account to sign in with just a single click.</p>
  <div class="border-t border-gray-200 mt-5"></div>
  @if (Auth::user()->google_id == "0" || Auth::user()->google_id == null)
  <p class="mdc-typography--body2 text-gray-600 mt-5">Click connect to select the account you want to link to. You can unlink it at any time.</p>
  <div class="mt-10 mb-10">
    <button class="mdc-button mdc-button-ripple mdc-button--outlined loginG tfa-button float-left" onclick="document.location='/login/google'">
      <span class="mdc-button__ripple"></span>
      <img class="mdc-button__icon" src="/images/icon/vendor/google.png" width="18px" height="18px" aria-hidden="true">
      Connect to Google
    </button>
  </div>
  @else
  <p class="mdc-typography--body2 text-gray-600 mt-5">You've already linked a Google Account. You can remove this account to disable sign in or switch accounts.</p>
  <div class="mt-10 mb-10">
    <button class="mdc-button mdc-button-ripple mdc-button--outlined loginG tfa-button float-left" wire:click="disconnectGoogle">
      <span class="mdc-button__ripple"></span>
      <img class="mdc-button__icon" src="/images/icon/vendor/google.png" width="18px" height="18px" aria-hidden="true">
      Disconnect
    </button>
    <span class="mdc-typography--subtitle1 float-left mt-1 ml-6">{{Auth::user()->google_email}}<span>
  </div>
  @endif
</div>
