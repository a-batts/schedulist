@props(['title' => __('Confirm Password'), 'content' => __('To continue, enter your password to verify it\'s you'), 'button' => __('Continue')])

@php
    $confirmableId = md5($attributes->wire('then'));
@endphp

<span {{ $attributes->wire('then') }} x-data x-ref="span"
    x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')"
    x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);">
    {{ $slot }}
</span>

@once
    <x-jet-dialog-modal wire:model="confirmingPassword">
        <x-slot name="title">
            <h4 class="mdc-typography logintext nunito mt-2">{{ $title }}</h4>
        </x-slot>

        <x-slot name="content">
            <p class="mdc-typography mdc-typography--body2">{{ $content }}</p>

            <div class="email_margins mt-10" x-data="{}"
                x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
                <label
                    class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon pw_input login-form"
                    wire:ignore>
                    <input class="mdc-text-field__input" id="conf_password" name="password" type="password"
                        aria-labelledby="password-label" required x-ref="confirmable_password"
                        wire:model.defer="confirmablePassword" wire:keydown.enter="confirmPassword" />
                    <button
                        class="mdc-icon-button material-icons mdc-text-field__icon--trailing mdc-text-field__icon icontoggle"
                        type="button" tabindex="0" onclick="showLoginPassword('conf_password')"><i
                            class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">visibility_off</i><i
                            class="material-icons mdc-icon-button__icon">visibility</i></button>
                    <span class="mdc-notched-outline">
                        <span class="mdc-notched-outline__leading"></span>
                        <span class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label" id="password-label">Password</span>
                        </span>
                        <span class="mdc-notched-outline__trailing"></span>
                    </span>
                </label>
                <div class="mt-5 mb-2 ml-2">
                    <p class="text-error"><x-jet-input-error class="mdc-typograpy text-error" for="confirmable_password"
                            style="font-family: 'Roboto'; color: #B00020" /></p>
                </div>

            </div>
            <button class="mdc-button mdc-button--raised mdc-button-ripple tfa-button mt-10 ml-3 mb-4"
                wire:click="confirmPassword" wire:loading.attr="disabled">
                <span class="mdc-button__ripple"></span>
                {{ $button }}
            </button>
            <button class="mdc-button mdc-button-ripple tfa-button mt-10" wire:click="stopConfirmingPassword"
                wire:loading.attr="disabled">
                <span class="mdc-button__ripple"></span>
                {{ __('Nevermind') }}
            </button>
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>
@endonce
