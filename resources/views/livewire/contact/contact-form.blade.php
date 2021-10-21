<div>
  <div class="content__div" style="background-image: url({{ asset('images/plane.svg') }}); background-repeat: no-repeat; background-position: center;">
      <h2 class="mdc-typography mdc-typography--headline3 contact_head mt-5">Contact Us</h2>
      <p class="mdc-typography mdc-typography--caption2 text-center">Just fill out this form to send a message to the Schedulist team</p>
      <div>
        <form wire:submit.prevent="submit" x-data="{
          disableSubmit: false,
          resetCharacterCounter(){
            document.querySelector('.char_counter').innerHTML = '0 / 250';
          }
        }">
          @csrf
          <label class="mdc-text-field mdc-text-field--filled @error('name') mdc-text-field--invalid @enderror @if($name) mdc-text-field--label-floating @endif login-form mt-10">
            <span class="mdc-text-field__ripple"></span>
            <span class="mdc-floating-label @if($name) mdc-floating-label--float-above @endif" id="name-label" wire:ignore>Full Name</span>
            <input class="mdc-text-field__input" type="text" aria-labelledby="name-label" autocomplete="name" wire:model.lazy="name" required wire:ignore>
            <span class="mdc-line-ripple"></span>
          </label>
          @error('name')
          <div class="livewire-helper mdc-text-field-helper-line">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="name-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
          </div>
          @enderror
          <label class="mdc-text-field mdc-text-field--filled @error('email') mdc-text-field--invalid @enderror @if($email) mdc-text-field--label-floating @endif login-form mt-7">
            <span class="mdc-text-field__ripple"></span>
            <span class="mdc-floating-label @if($email) mdc-floating-label--float-above @endif" id="email-label">Your Email</span>
            <input class="mdc-text-field__input" type="email" aria-labelledby="email-label" autocomplete="email" wire:model.debounce.500ms="email" wire:ignore>
            <span class="mdc-line-ripple"></span>
          </label>
          @error('email')
          <div class="livewire-helper mdc-text-field-helper-line">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="email-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
          </div>
          @enderror
          <div class="mdc-select mdc-select--required mdc-select--filled login-form mt-7 @error('reason') mdc-select--invalid @enderror">
            <div class="mdc-select__anchor"
                 role="button"
                 aria-haspopup="listbox"
                 aria-expanded="false"
                 aria-required="true"
                 aria-labelledby="demo-label demo-selected-text" wire:ignore>
              <span class="mdc-select__ripple"></span>
              <span id="demo-label" class="mdc-floating-label">Reason For Contacting</span>
              <span class="mdc-select__selected-text-container">
                <span id="demo-selected-text" class="mdc-select__selected-text"></span>
              </span>
              <span class="mdc-select__dropdown-icon">
                <svg
                    class="mdc-select__dropdown-icon-graphic"
                    viewBox="7 10 10 5" focusable="false">
                  <polygon
                      class="mdc-select__dropdown-icon-inactive"
                      stroke="none"
                      fill-rule="evenodd"
                      points="7 10 12 15 17 10">
                  </polygon>
                  <polygon
                      class="mdc-select__dropdown-icon-active"
                      stroke="none"
                      fill-rule="evenodd"
                      points="7 15 12 10 17 15">
                  </polygon>
                </svg>
              </span>
              <span class="mdc-line-ripple"></span>
            </div>

            <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth @error('reason') mdc-select__menu--invalid @enderror">
              <ul class="mdc-deprecated-list dark-theme-list" role="listbox" aria-label="Contact reason selection" wire:ignore>
                <li class="mdc-deprecated-list-item" aria-selected="false" wire:click="setReason('General Feedback')" data-value="General Feedback" role="option">
                  <span class="mdc-deprecated-list-item__ripple"></span>
                  <span class="mdc-deprecated-list-item__text">
                    General feedback
                  </span>
                </li>
                <li class="mdc-deprecated-list-item" aria-selected="false" wire:click="setReason('Feature Suggestion')" data-value="Feature Suggestion" role="option">
                  <span class="mdc-deprecated-list-item__ripple"></span>
                  <span class="mdc-deprecated-list-item__text">
                    New feature suggestion
                  </span>
                </li>
                <li class="mdc-deprecated-list-item" aria-selected="false" wire:click="setReason('Account Issues')" data-value="Account Issues" role="option">
                  <span class="mdc-deprecated-list-item__ripple"></span>
                  <span class="mdc-deprecated-list-item__text">
                    Account or login problems
                  </span>
                </li>
                <li class="mdc-deprecated-list-item" aria-selected="false" wire:click="setReason('Bug Reports')" data-value="Bug Reports" role="option">
                  <span class="mdc-deprecated-list-item__ripple"></span>
                  <span class="mdc-deprecated-list-item__text">
                    Bug report
                  </span>
                </li>
                <li class="mdc-deprecated-list-item" aria-selected="false" wire:click="setReason('Other')" data-value="Other" role="option">
                  <span class="mdc-deprecated-list-item__ripple"></span>
                  <span class="mdc-deprecated-list-item__text">
                    Other reason
                  </span>
                </li>
              </ul>
            </div>
          </div>
          @error('reason')
          <div class="livewire-helper mdc-text-field-helper-line ml-1">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="reason-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
          </div>
          @enderror
          <label class="mdc-text-field mdc-text-field--filled mdc-text-field--textarea ml-1 mdc-text-field--with-internal-counter login-form mt-7 @error('message') mdc-text-field--invalid @enderror">
            <span class="mdc-floating-label" id="my-label-id" wire:ignore>What's On Your Mind?</span>
            <textarea class="mdc-text-field__input" aria-labelledby="my-label-id" rows="6" maxlength="250" wire:model.debounce.500ms="message" required wire:ignore></textarea>
            <div class="char_counter mdc-text-field-character-counter" wire:ignore>0 / 250</div>
            <span class="mdc-line-ripple" wire:ignore></span>
          </label>
          @error('message')
          <div class="livewire-helper mdc-text-field-helper-line ml-1">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="reason-error" aria-hidden="true"><p class="text-error">{{ $message }}</p></div>
          </div>
          @enderror
          <div class="mt-10">
            <button class="mdc-button send_button mdc-button-ripple mdc-button mdc-button--raised float-right mb-6" type="submit" wire:ignore @disable-send-button.window="disableSubmit = true; resetCharacterCounter()" x-bind:disabled="disableSubmit">
              <span class="mdc-button__ripple"></span>
              <i class="material-icons mdc-button__icon" aria-hidden="true">send</i>
              Send Email</button>
          </div>
        </form>
      </div>
      <br>
  </div>
</div>
