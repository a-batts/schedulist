<div x-data="{
    shareModal: false,

    loading: false,

    errorMessages: @entangle('errorMessages'),

    init: function() {
        this.$watch('errorMessages', () => { this.loading = false });
    },

    share: function() {
        this.loading = true;
        this.$wire.share();
    }
}" @open-share-modal.window="shareModal = true; loading = false"
    @finish-share-loading.window="loading = false">
    <x-ui.modal class="mdc-typography top-14" title="" bind="shareModal">
        <x-slot name="actions">
            <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" @click="shareModal = false">
                <span class="mdc-button__ripple"></span>Done
            </button>
        </x-slot>
        <x-slot name="preloader">
            <div class="h-1 pt-1">
                <div class="linear-preload" x-show="loading">
                    <div class="background"></div>
                    <div class="indeterminate"></div>
                </div>
            </div>
        </x-slot>

        <div class="px-3">
            <p class="mb-2 -mt-4 text-2xl font-semibold">Share your event with others</p>
            <div class="flex items-center mb-6 text-sm text-gray-600 gap-x-3">
                <p class="material-icons">
                    edit_off
                </p>
                <p>Invited users will see your event on their calendars, but won't be able to make changes to
                    it.</p>
            </div>
            <label class="mdc-text-field mdc-text-field--outlined relative w-full"
                :class="{ 'mdc-text-field--invalid': errorMessages['query'] != undefined }" wire:ignore>
                <span class="mdc-notched-outline">
                    <span class="mdc-notched-outline__leading"></span>
                    <span class="mdc-notched-outline__notch">
                        <span class="mdc-floating-label" id="my-label-id">Enter an email address</span>
                    </span>
                    <span class="mdc-notched-outline__trailing"></span>
                </span>
                <input class="mdc-text-field__input" type="text" aria-labelledby="my-label-id" autocomplete="qekfk"
                    wire:model.debounce.50ms="query">
                <div class="absolute right-0 flex items-center h-full pr-1">
                    <button class="mdc-icon-button material-icons" type="button"
                        :class="{ 'color-error': errorMessages['query'] != undefined }" @click="share()"
                        :disabled="loading">
                        <div class="mdc-icon-button__ripple"></div>
                        send
                    </button>
                </div>
            </label>
            <x-ui.validation-error for="query" />
        </div>
        <div class="mt-4">
            @if ($event->sharedWith->count() > 0)
                <p class="mb-3 ml-3 text-xl font-semibold">Shared with</p>
            @endif
            @foreach ($event->sharedWith as $user)
                <div class="w-full px-3 py-2 mb-2 h-14">
                    <img class="float-left w-10 h-10 mt-1 rounded-full" src="{{ $user->profile_photo_url }}"
                        alt="{{ $user->name }}">
                    <div class="float-left ml-4">
                        <span class="block mt-1 mb-0 text-base font-medium">{{ $user->name }}</span>
                        <br />
                        <span class="block -mt-6 text-xs text-gray-600">{{ $user->email }}</span>
                    </div>
                    <button class="mdc-icon-button material-icons float-right" type="button"
                        @click="$wire.unshare({{ $user->id }})" wire:ignore>
                        <div class="mdc-icon-button__ripple"></div>
                        close
                    </button>
                </div>
            @endforeach
            <div class="w-full px-3 py-2">
                <div class="section-border border-100 mb-3"></div>
                <div class="event-link-icon block float-left w-10 h-10 mt-1 rounded-full" style="padding-top: 3px">
                    <span class="material-icons add-link-icon block text-2xl">add_link</span>
                </div>
                @if (!$event->public)
                    <div class="float-left ml-2" style="width: calc(100% - 50px)">
                        <button class="mdc-button mdc-button-ripple w-full h-14" type="button"
                            wire:click="makePublic()">
                            <span class="mdc-button__ripple"></span>
                            <span
                                class="mdc-typograpy absolute float-left leading-6 tracking-normal text-left normal-case left-2 top-1">
                                <span class="create-link-title block mt-1 mb-0 text-base font-medium">Create a public
                                    link</span>
                                <br />
                                <span class="block -mt-6 text-xs font-normal text-gray-600">Anyone with the link will be
                                    able to save this event</span>
                            </span>
                        </button>
                    </div>
                @else
                    <div class="mt-4 ml-14">
                        <div class="share-link-box h-10 px-3 py-2 rounded-lg"
                            @click="$clipboard('{{ $publicLink }}'); snack('Copied link to clipboard')">
                            <input class="mdc-typograpy w-full h-5 bg-transparent outline-none overflow-ellipsis"
                                type="text" value="{{ $publicLink }}"
                                @click="$clipboard('{{ $publicLink }}'); snack('Copied link to clipboard')"
                                readonly />
                        </div>
                        <div class="h-10 mt-4 -ml-2">
                            <button class="mdc-button mt-1" type="button" wire:click="makePrivate()">
                                <span class="mdc-button__ripple"></span>
                                <span class="mdc-button__label">Disable Public Link</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-ui.modal>
</div>
