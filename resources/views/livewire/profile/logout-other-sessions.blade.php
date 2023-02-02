<div class="pt-20" x-data="{
    passwordConfirmation: false,
    passwordField: 'password',
}" @hide-password-confirmation="passwordConfirmation = false">
    <x-ui.settings-card title="Your devices"
        description="You are currently signed in to all the devices below. If desired, you may sign out of all other browser sessions across your devices. If you are concerned your account is compromised, you should also change your password."
        back-button>
        <div style="max-width: 600px">
            @if (count($this->sessions) > 0)
                <div class="mt-5 ml-5 space-y-6">
                    @foreach ($this->sessions as $index => $session)
                        <div class="flex items-center">
                            <div class="h-20 w-full">
                                <div class="float-left mt-1 mr-5 block select-none">
                                    @if ($session->agent->isDesktop())
                                        <span class="material-icons" class="h-8 w-8">desktop_windows</span>
                                    @elseif ($session->agent->isTablet())
                                        <span class="material-icons" class="h-8 w-8">tablet_mac</span>
                                    @else
                                        <span class="material-icons" class="h-8 w-8">smartphone</span>
                                    @endif
                                </div>
                                <div class="block">
                                    <div class="text-xl font-medium">{{ $session->agent->platform() }}
                                        {{ $session->agent->version($session->agent->platform()) }}</div>
                                    <div class="text-gray-500">
                                        @isset($session->details)
                                            Near
                                        @endisset {{ $session->details->city ?? '' }},
                                        {{ $session->details->region ?? '' }}
                                    </div>
                                    <div class="ml-11 text-gray-500">{{ $session->ip_address }},
                                        {{ $session->agent->device() }} - {{ $session->agent->browser() }}</div>
                                </div>
                                <div class="block sm:float-right sm:mr-1 sm:-mt-9">
                                    @if ($session->is_current_device)
                                        <span
                                            class="material-icons check-icon-sm -va-5 mr-1 select-none">check_circle</span>
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
                <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button mt-5"
                    @click="passwordConfirmation = true; setTimeout(() => $refs.password.focus(), 250)" wire:ignore>
                    <span class="mdc-button__ripple"></span>
                    Sign Out Other Devices
                </button>
            </div>
        </div>
    </x-ui.settings-card>
    <div class="modal-skim inset-0 hidden bg-gray-500 opacity-75" style="display: none" x-show="passwordConfirmation"
        x-cloak></div>
    <div class="modal-container fixed top-12 h-screen w-screen overflow-y-auto pb-6" x-transition
        x-show.important="passwordConfirmation" x-trap.noscroll="passwordConfirmation" x-cloak wire:ignore.self>
        <div class="mdc-card mdc-card--outlined modal-card px-6 pt-6">
            <div>
                <h6 class="text-3xl font-bold">Confirm your password</h6>
                <div class="mt-3 text-left text-base text-gray-600">Before we can sign out your other devices, we need
                    you to verify your identity.</div>
            </div>
            <div class="mt-5 mb-2 border-t border-gray-200"></div>
            <div class="w-full pt-4">
                <div class="mx-auto h-16 w-16"><img class="rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                        alt="Profile photo"></div>
                <p class="mx-auto mt-3 text-center text-xl font-medium">
                    {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</p>
                <p class="mx-auto mt-1 text-center text-sm text-gray-700">{{ Auth::user()->email }}</p>
            </div>

            <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon mt-8 w-full"
                wire:ignore>
                <input class="mdc-text-field__input" aria-labelledby="password-label" :type="passwordField"
                    wire:model="password" required autocomplete="current-password" x-ref="password" />
                <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon"
                    type="button" tabindex="0"
                    @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'">
                    <i class="material-icons mdc-icon-button__icon"
                        x-text="passwordField == 'password' ? 'visibility' : 'visibility_off'"></i>
                </button>
                <span class="mdc-notched-outline">
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                        <span class="mdc-floating-label" id="password-label">Password</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                </span>
            </label>
            <x-ui.validation-error for="password" />
            <div class="forgot-password mr-2 w-full text-right">
                <a class="theme-color-text text-sm" href="{{ route('forgot-password') }}">Forgot password?</a>
            </div>

            <div class="mt-5">
                <button class="mdc-button mdc-button-ripple mdc-button--raised float-right ml-4"
                    wire:click="logoutOtherBrowserSessions()" wire:ignore>
                    <span class="mdc-button__ripple"></span>Confirm
                </button>
                <button class="mdc-button mdc-button-ripple float-right" @click="passwordConfirmation = false"
                    wire:ignore wire:loading.attr="disabled">
                    <span class="mdc-button__ripple"></span>Nevermind
                </button>
            </div>
        </div>
    </div>

</div>
