<div class="mdc-card mdc-card--outlined options_card mdc-typography">
  <h4 class="mdc-typography--headline5 mt-2 nunito">Text Message Preferences</h4>
  <p class="mdc-typography--body2 text-gray-600 mt-1">Choose which types of text alerts you want to recieve from Schedulist.</p>
  <div class="border-t border-gray-200 mt-5"></div>
  <div class="mt-5">
    <p class="mdc-typography--subtitle1 float-left left-phone-number">You're receiving text messages at {{$formattedPhoneNumber}}</p>
    <button class="mdc-button mdc-button-ripple tfa-button" wire:ignore onclick="window.scroll({top: 0, left: 0, behavior: 'smooth'})">
      <span class="mdc-button__ripple"></span>
        Change phone number
    </button>
  </div>
  <div class="mt-7">
    <div class="mdc-switch @if($accountAlertMessages) mdc-switch--checked @endif" wire:click="toggle('account')" wire:ignore>
      <div class="mdc-switch__track"></div>
      <div class="mdc-switch__thumb-underlay">
        <div class="mdc-switch__thumb"></div>
        <input type="checkbox" id="basic-switch" class="mdc-switch__native-control" role="switch" aria-checked="false" @if($accountAlertMessages) checked @endif>
      </div>
    </div>
    <label for="basic-switch" class="ml-2">Account alert messages</label>
    <p class="mdc-typography--body2 text-gray-600 mt-2.5">Get notified when your password and security settings are updated, or if we detect suspicious activity.</p>
    <div class="mdc-switch @if($assignmentAlertMessages) mdc-switch--checked @endif mt-7" wire:click="toggle('assignment')" wire:ignore>
      <div class="mdc-switch__track"></div>
      <div class="mdc-switch__thumb-underlay">
        <div class="mdc-switch__thumb"></div>
        <input type="checkbox" id="basic-switch" class="mdc-switch__native-control" role="switch" aria-checked="false" @if($assignmentAlertMessages) checked @endif>
      </div>
    </div>
    <label for="basic-switch" class="ml-2">Assignment due date messages</label>
    <p class="mdc-typography--body2 text-gray-600 mt-2.5 mb-6">Get a reminder an hour before assignments are due to make sure they are turned in on time.</p>
  </div>
</div>
