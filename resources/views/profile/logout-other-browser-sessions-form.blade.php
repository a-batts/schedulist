<div class="mdc-typography mdc-card mdc-card--outlined options_card">
  <h4 class="mdc-typography mdc-typography--headline5 mt-2 nunito">Your Devices</h4>
  <p class="mdc-typography mdc-typography--body2 text-gray-600 mt-1">You are currently signed in to all the devices listed below. If desired, you may sign out of all of your other browser sessions across your devices. If you are concerned your account is compromised, you should also change your password.</p>
  <div class="border-t border-gray-200 mt-5"></div>
  @if (count($this->sessions) > 0)
      <div class="mt-5 space-y-6">
          <!-- Other Browser Sessions -->
          @foreach ($this->sessions as $session)
              <div class="flex items-center">
                  <div>
                      @if ($session->agent->isDesktop())
                          <span class="material-icons" class="w-8 h-8">desktop_windows</span>
                      @elseif ($session->agent->isTablet())
                          <span class="material-icons" class="w-8 h-8">tablet_mac</span>
                      @else
                          <span class="material-icons" class="w-8 h-8">smartphone</span>
                      @endif
                  </div>

                  <div class="ml-3">
                      <div class="mdc-typography--subtitle1">
                          {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                      </div>

                      <div>
                          <div class="mdc-typography--subtitle2 text-gray-500">
                              {{ $session->ip_address }}, {{ $session->agent->browser() }}

                              @if ($session->is_current_device)
                                <span class="material-icons-two-tone check_icon_sm -va-5">check_circle</span>
                                  <span class="text-green">{{ __('This device') }}</span>
                              @else
                                  <span>{{ __('Last active') }} {{ $session->last_active }}</span>
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>
  @endif

  <div class="mt-5">
      <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button mt-5" wire:click="confirmLogout" wire:ignore>
        <span class="mdc-button__ripple"></span>
        Sign Out Other Devices
      </button>
      <x-jet-action-message class="ml-3" on="loggedOut">
      </x-jet-action-message>
  </div>

  <!-- Logout Other Devices Confirmation Modal -->
  <x-jet-dialog-modal wire:model="confirmingLogout">
      <x-slot name="title">
          <h4 class="mdc-typography ninito logintext mt-2 nunito">Confirm Password</h4>
      </x-slot>

      <x-slot name="content">
          <p class="mdc-typography mdc-typography--body2">Before we can sign out your other devices, enter your password to verify it's you.</p>

          <div class="mt-10 email_margins" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
              <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon pw_input login-form" wire:ignore>
                <input type="password" id="dev_password" class="mdc-text-field__input" aria-labelledby="password-label" name="password" required x-ref="password" wire:model.defer="password" wire:keydown.enter="logoutOtherBrowserSessions"/>
                <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle" onclick="showLoginPassword('dev_password')" type="button" tabindex="0"><i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i><i class="material-icons mdc-icon-button__icon">visibility</i></button>
                <span class="mdc-notched-outline">
                  <span class="mdc-notched-outline__leading"></span>
                  <span class="mdc-notched-outline__notch">
                    <span class="mdc-floating-label" id="password-label">Password</span>
                  </span>
                  <span class="mdc-notched-outline__trailing"></span>
                </span>
              </label>
              <div class="mt-5 mb-2 ml-2">
                <p class="text-error"><x-jet-input-error class="mdc-typograpy text-error" style="font-family: 'Roboto'; color: #B00020" for="password"/></p>
              </div>

          </div>
          <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button mt-10 ml-3 mb-4" wire:click="logoutOtherBrowserSessions" wire:ignore wire:loading.attr="disabled">
            <span class="mdc-button__ripple"></span>
              {{ __('Continue') }}
          </button>
          <button class="mdc-button mdc-button-ripple mt-10 tfa-button" wire:click="$toggle('confirmingLogout')" wire:ignore wire:loading.attr="disabled">
            <span class="mdc-button__ripple"></span>
              {{ __('Nevermind') }}
          </button>
      </x-slot>
  </x-jet-dialog-modal>
</div>
