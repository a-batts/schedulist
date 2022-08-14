<x-ui.settings-card title="Notification settings"
    description="Control the notifications that you receive about account security, assignments, and events.">
        <div class="roboto pt-4 pb-2" x-data="{}">
          <p class="">You're receiving emails at <span class="font-medium">{{Auth::user()->email}}</span></p>
          <div class="float-right -mt-7">
            <button class="mdc-button mx-5" @click="document.getElementById('last-name-label').scrollIntoView({'behavior': 'smooth'})">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label">Change</span>
           </button>
          </div>
          @isset(Auth::user()->phone)
            <p class="mt-6">You're receiving text messages at <span class="font-medium">{{$this->formattedPhoneNumber}}</span></p>
            <div class="float-right -mt-7">
              <button class="mdc-button mx-5" @click="document.getElementById('profile-email-input').scrollIntoView({'behavior': 'smooth'}); ">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label">Change</span>
             </button>
            </div>
          @endisset

          <div class="mt-5 border-t border-gray-200"></div>
          <p class="mt-4 text-lg">Account security updates</p>
          <p class="mt-2 text-sm text-gray-500">Get notified if your password and security settings are updated, or if we detect suspicious activity</p>
          <div class="mt-6">
            <div>
              <button id="email-acct-switch" class="mdc-switch mdc-switch--unselected @if($userSettings->account_alert_emails) mdc-switch--selected @endif" wire:click="toggle('account_alert_emails')" type="button" role="switch" aria-checked="false" @if($userSettings->account_alert_emails) aria-checked="true" @endif wire:ignore>
                <div class="mdc-switch__track"></div>
                <div class="mdc-switch__handle-track">
                  <div class="mdc-switch__handle">
                    <div class="mdc-switch__shadow">
                      <div class="mdc-elevation-overlay"></div>
                    </div>
                    <div class="mdc-switch__ripple"></div>
                    <div class="mdc-switch__icons">
                      <svg class="mdc-switch__icon mdc-switch__icon--on" viewBox="0 0 24 24">
                        <path d="M19.69,5.23L8.96,15.96l-4.23-4.23L2.96,13.5l6,6L21.46,7L19.69,5.23z" />
                      </svg>
                      <svg class="mdc-switch__icon mdc-switch__icon--off" viewBox="0 0 24 24">
                        <path d="M20 13H4v-2h16v2z" />
                      </svg>
                    </div>
                  </div>
                </div>
              </button>
              <label for="email-acct-switch" class="ml-2 text-sm">Send an email</label>  
            </div>
            <div class="clear-both mt-6">  
              <button id="text-acct-switch" class="mdc-switch mdc-switch--unselected @if($userSettings->account_alert_texts) mdc-switch--selected @endif" wire:click="toggle('account_alert_texts')" type="button" role="switch" aria-checked="false" @if($userSettings->account_alert_texts) aria-checked="true" @endif wire:ignore>
                <div class="mdc-switch__track"></div>
                <div class="mdc-switch__handle-track">
                  <div class="mdc-switch__handle">
                    <div class="mdc-switch__shadow">
                      <div class="mdc-elevation-overlay"></div>
                    </div>
                    <div class="mdc-switch__ripple"></div>
                    <div class="mdc-switch__icons">
                      <svg class="mdc-switch__icon mdc-switch__icon--on" viewBox="0 0 24 24">
                        <path d="M19.69,5.23L8.96,15.96l-4.23-4.23L2.96,13.5l6,6L21.46,7L19.69,5.23z" />
                      </svg>
                      <svg class="mdc-switch__icon mdc-switch__icon--off" viewBox="0 0 24 24">
                        <path d="M20 13H4v-2h16v2z" />
                      </svg>
                    </div>
                  </div>
                </div>
              </button>
              <label for="text-acct-switch" class="ml-2 text-sm">Send a text message</label>     
            </div>     
          </div>  
          <div class="mt-5 border-t border-gray-200"></div> 
          <p class="mt-4 text-lg">Assignment completion reminders</p>
          <p class="mt-2 text-sm text-gray-500">Recieve a reminder an hour before an assignment is due, as well as any user selected times</p>
          <div class="mt-6">
            <div>
              <button id="email-acct-switch" class="mdc-switch mdc-switch--unselected @if($userSettings->assignment_emails) mdc-switch--selected @endif" wire:click="toggle('assignment_emails')" type="button" role="switch" aria-checked="false" @if($userSettings->assignment_emails) aria-checked="true" @endif wire:ignore>
                <div class="mdc-switch__track"></div>
                <div class="mdc-switch__handle-track">
                  <div class="mdc-switch__handle">
                    <div class="mdc-switch__shadow">
                      <div class="mdc-elevation-overlay"></div>
                    </div>
                    <div class="mdc-switch__ripple"></div>
                    <div class="mdc-switch__icons">
                      <svg class="mdc-switch__icon mdc-switch__icon--on" viewBox="0 0 24 24">
                        <path d="M19.69,5.23L8.96,15.96l-4.23-4.23L2.96,13.5l6,6L21.46,7L19.69,5.23z" />
                      </svg>
                      <svg class="mdc-switch__icon mdc-switch__icon--off" viewBox="0 0 24 24">
                        <path d="M20 13H4v-2h16v2z" />
                      </svg>
                    </div>
                  </div>
                </div>
              </button>
              <label for="email-acct-switch" class="ml-2 text-sm">Send an email</label>  
            </div>
            <div class="clear-both mt-6">  
              <button id="text-acct-switch" class="mdc-switch mdc-switch--unselected @if($userSettings->assignment_texts) mdc-switch--selected @endif" wire:click="toggle('assignment_texts')" type="button" role="switch" aria-checked="false" @if($userSettings->assignment_texts) aria-checked="true" @endif wire:ignore>
                <div class="mdc-switch__track"></div>
                <div class="mdc-switch__handle-track">
                  <div class="mdc-switch__handle">
                    <div class="mdc-switch__shadow">
                      <div class="mdc-elevation-overlay"></div>
                    </div>
                    <div class="mdc-switch__ripple"></div>
                    <div class="mdc-switch__icons">
                      <svg class="mdc-switch__icon mdc-switch__icon--on" viewBox="0 0 24 24">
                        <path d="M19.69,5.23L8.96,15.96l-4.23-4.23L2.96,13.5l6,6L21.46,7L19.69,5.23z" />
                      </svg>
                      <svg class="mdc-switch__icon mdc-switch__icon--off" viewBox="0 0 24 24">
                        <path d="M20 13H4v-2h16v2z" />
                      </svg>
                    </div>
                  </div>
                </div>
              </button>
              <label for="text-acct-switch" class="ml-2 text-sm">Send a text message</label>     
            </div>     
          </div>
          <div class="mt-5 border-t border-gray-200"></div> 
          <p class="mt-4 text-lg">Event reminders and share notifications</p>
          <p class="mt-2 text-sm text-gray-500">Receieve a reminder before an upcoming event as well as a notification for when an event is shared with you</p>
          <div class="mt-6">
            <div>
              <button id="email-acct-switch" class="mdc-switch mdc-switch--unselected @if($userSettings->event_emails) mdc-switch--selected @endif" wire:click="toggle('event_emails')" type="button" role="switch" aria-checked="false" @if($userSettings->event_emails) aria-checked="true" @endif wire:ignore>
                <div class="mdc-switch__track"></div>
                <div class="mdc-switch__handle-track">
                  <div class="mdc-switch__handle">
                    <div class="mdc-switch__shadow">
                      <div class="mdc-elevation-overlay"></div>
                    </div>
                    <div class="mdc-switch__ripple"></div>
                    <div class="mdc-switch__icons">
                      <svg class="mdc-switch__icon mdc-switch__icon--on" viewBox="0 0 24 24">
                        <path d="M19.69,5.23L8.96,15.96l-4.23-4.23L2.96,13.5l6,6L21.46,7L19.69,5.23z" />
                      </svg>
                      <svg class="mdc-switch__icon mdc-switch__icon--off" viewBox="0 0 24 24">
                        <path d="M20 13H4v-2h16v2z" />
                      </svg>
                    </div>
                  </div>
                </div>
              </button>
              <label for="email-acct-switch" class="ml-2 text-sm">Send an email</label>  
            </div>
            <div class="clear-both mt-6">  
              <button id="text-acct-switch" class="mdc-switch mdc-switch--unselected @if($userSettings->event_texts) mdc-switch--selected @endif" wire:click="toggle('event_texts')" type="button" role="switch" aria-checked="false" @if($userSettings->event_texts) aria-checked="true" @endif wire:ignore>
                <div class="mdc-switch__track"></div>
                <div class="mdc-switch__handle-track">
                  <div class="mdc-switch__handle">
                    <div class="mdc-switch__shadow">
                      <div class="mdc-elevation-overlay"></div>
                    </div>
                    <div class="mdc-switch__ripple"></div>
                    <div class="mdc-switch__icons">
                      <svg class="mdc-switch__icon mdc-switch__icon--on" viewBox="0 0 24 24">
                        <path d="M19.69,5.23L8.96,15.96l-4.23-4.23L2.96,13.5l6,6L21.46,7L19.69,5.23z" />
                      </svg>
                      <svg class="mdc-switch__icon mdc-switch__icon--off" viewBox="0 0 24 24">
                        <path d="M20 13H4v-2h16v2z" />
                      </svg>
                    </div>
                  </div>
                </div>
              </button>
              <label for="text-acct-switch" class="ml-2 text-sm">Send a text message</label>     
            </div>     
          </div>
           
        </div>
</x-ui.settings-card>