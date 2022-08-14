<x-app-layout title="Confirm Account Password">
    <div class="pt-20">
        <x-ui.auth-card title="Confirm your password" description="Since you are accessing sensitive information, we need you to verify your identity.">
            <div
            x-data="{
                passwordField: 'password',
            }">
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="w-full pt-4">
                        <div class="mx-auto h-16 w-16"><img src="{{Auth::user()->profile_photo_url}}" class="rounded-full"></div>
                        <p class="mx-auto mt-3 text-center text-xl font-medium">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</p>
                        <p class="mx-auto mt-1 text-center text-sm text-gray-700">{{Auth::user()->email}}</p>
                    </div>

                    <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon mt-8 w-full" wire:ignore>
                        <input class="mdc-text-field__input" aria-labelledby="password-label" :type="passwordField"  name="password" required autocomplete="current-password"/>
                        <button class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon" @click="passwordField === 'password' ? passwordField = 'text' : passwordField = 'password'" type="button" tabindex="0">
                            <div class="mdc-icon-button__ripple"></div>
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
                    <div class="forgot-password mr-2 w-full text-right">
                        <a class="robototheme-color-text text-sm" href="{{ route('password.request') }}">Forgot password?</a>
                    </div>
            
                    <div class="">
                        <button class="float-right mt-5 mdc-button mdc-button-ripple mdc-button--raised" wire:ignore>
                            <span class="mdc-button__ripple"></span>Sign In
                        </button>
                    </div>
                </form>
            </div>
          </x-ui.auth-card>
    </div>
</x-app-layout>