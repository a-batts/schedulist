<div class="pt-20" 
x-data="{
    passwordConfirmation: false,
    passwordField: 'password',
}"
@hide-password-confirmation="passwordConfirmation = false">
  <x-ui.settings-card title="Your devices"
    description="You are currently signed in to all the devices below. If desired, you may sign out of all other browser sessions across your devices. If you are concerned your account is compromised, you should also change your password."
    back-button>
    <div style="max-width: 600px">
        @if (count($this->sessions) > 0)
            <div class="mt-5 ml-5 space-y-6">
                @foreach ($this->sessions as $index => $session)
                    <div class="flex items-center">
                        <div class="w-full h-20">
                            <div class="block float-left mt-1 mr-5 select-none">
                                @if ($session->agent->isDesktop())
                                    <span class="material-icons" class="w-8 h-8">desktop_windows</span>
                                @elseif ($session->agent->isTablet())
                                    <span class="material-icons" class="w-8 h-8">tablet_mac</span>
                                @else
                                    <span class="material-icons" class="w-8 h-8">smartphone</span>
                                @endif
                            </div>
                            <div class="block">
                                <div class="text-xl font-medium">{{ $session->agent->platform()}} {{$session->agent->version($session->agent->platform())}}</div>
                                <div class="text-gray-500">@isset($session->details) Near @endisset {{$session->details->city ?? ''}}, {{$session->details->region ?? ''}}</div>
                                <div class="text-gray-500 ml-11">{{ $session->ip_address }}, {{ $session->agent->device() }} - {{$session->agent->browser()}}</div>
                            </div>
                            <div class="block sm:float-right sm:mr-1 sm:-mt-9">
                                @if ($session->is_current_device)
                                    <span class="mr-1 select-none material-icons check-icon-sm -va-5">check_circle</span>
                                    <span class="text-green">This device</span>
                                @else
                                    <span>Last active {{ $session->last_active }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 border-t border-gray-200"></div>
                @endforeach
            </div>
        @endif
        <div class="mt-5">
            <button class="mt-5 mdc-button mdc-button--raised mdc-button-ripple tfa-button" @click="passwordConfirmation = true; setTimeout(() => $refs.password.focus(), 250)" wire:ignore>
            <span class="mdc-button__ripple"></span>
            Sign Out Other Devices
            </button>
        </div>
    </div>
  </x-ui.settings-card>
  <div class="inset-0 hidden bg-gray-500 opacity-75 modal-skim" style="display: none" x-show="passwordConfirmation" x-cloak></div>
  <div class="fixed w-screen h-screen pb-6 overflow-y-auto modal-container top-12" x-transition x-show.important="passwordConfirmation" x-trap.noscroll="passwordConfirmation" x-cloak wire:ignore.self>
    <div class="px-6 pt-6 mdc-card mdc-card--outlined modal-card">
        <div>
            <h6 class="text-3xl font-bold">Confirm your password</h6>
            <div class="mt-3 text-base text-left text-gray-600">Before we can sign out your other devices, we need you to verify your identity.</div>
        </div>
        <div class="mt-5 mb-2 border-t border-gray-200"></div>
        <div class="w-full pt-4">
            <div class="w-16 h-16 mx-auto"><img src="{{Auth::user()->profile_photo_url}}" class="rounded-full"></div>
            <p class="mx-auto mt-3 text-xl font-medium text-center">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</p>
            <p class="mx-auto mt-1 text-sm text-center text-gray-700">{{Auth::user()->email}}</p>
        </div>

        <label class="w-full mt-8 mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon" wire:ignore>
            <input class="mdc-text-field__input" aria-labelledby="password-label" :type="passwordField" wire:model="password" required autocomplete="current-password" x-ref="password"/>
            <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon" @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'" type="button" tabindex="0">
                <i class="material-icons mdc-icon-button__icon" x-text="passwordField == 'password' ? 'visibility' : 'visibility_off'"></i>
            </button>
            <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__notch">
                <span class="mdc-floating-label" id="password-label">Password</span>
                </span>
                <span class="mdc-notched-outline__trailing"></span>
            </span>
        </label>
        <x-ui.validation-error for="password"/>
        <div class="w-full mr-2 text-right forgot-password">
            <a class="text-sm theme-color-text" href="{{ route('password.request') }}">Forgot password?</a>
        </div>

        <div class="mt-5">
            <button class="float-right ml-4 mdc-button mdc-button-ripple mdc-button--raised" wire:click="logoutOtherBrowserSessions()" wire:ignore>
                <span class="mdc-button__ripple"></span>Confirm
            </button>
            <button class="float-right mdc-button mdc-button-ripple" @click="passwordConfirmation = false" wire:ignore wire:loading.attr="disabled">
                <span class="mdc-button__ripple"></span>Nevermind
            </button>
        </div>
    </div>
  </div>


</div>