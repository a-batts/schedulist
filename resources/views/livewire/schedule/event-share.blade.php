<div x-data="{
  share: false,
  errorMessages: @entangle('errorMessages'),
}"
@open-share-modal.window="share = true">
  <x-ui.modal bind="share" title="Share Event" class="top-14 mdc-typography">
    <x-slot name="actions">
      <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" @click="share = false" >
        <span class="mdc-button__ripple"></span>Done
      </button>
    </x-slot>
    
    <div class="px-3">
      <p class="mb-2 -mt-2 text-gray-700">Share your event with other Schedulist users.</p>
      <div class="flex items-center mb-6 text-sm text-gray-600">
        <p class="material-icons">
          edit_off
        </p>
        <p class="ml-2">Invited users will recieve an invatation to add the event to their personal calendar but won't be able to make changes to it.</p>
      </div>
      <label class="w-full mdc-text-field mdc-text-field--outlined" :class="{'mdc-text-field--invalid': errorMessages['query'] != undefined}" wire:ignore>
        <span class="mdc-notched-outline">
          <span class="mdc-notched-outline__leading"></span>
          <span class="mdc-notched-outline__notch">
            <span class="mdc-floating-label" id="my-label-id">Enter an email address</span>
          </span>
          <span class="mdc-notched-outline__trailing"></span>
        </span>
        <input type="text" class="mdc-text-field__input" aria-labelledby="my-label-id" autocomplete="qekfk" wire:model.debounce.50ms="query" @keydown.enter.prevent="$wire.share()">
      </label>
      <x-ui.validation-error for="query"/>
    </div>
    <div class="mt-2">
      @if($event->sharedWith->count() > 0)
        <p class="mb-3 ml-3 text-xl font-medium">Shared with</p>
      @endif
      @foreach ($event->sharedWith as $user)
        <div class="w-full px-3 py-2 mb-2 h-14">
          <img src="{{$user->profile_photo_url}}" class="float-left w-10 h-10 mt-1 rounded-full">
          <div class="float-left ml-4">
            <span class="block mt-1 mb-0 text-base font-medium">{{$user->firstname}} {{$user->lastname}}</span>
            <br />
            <span class="block -mt-6 text-xs text-gray-600">{{$user->email}}</span>
          </div>
          <button class="float-right mdc-icon-button material-icons" type="button" @click="$wire.unshare({{$user->id}})" wire:ignore>
            <div class="mdc-icon-button__ripple"></div>
            close
          </button>
        </div>
      @endforeach
      <div class="w-full px-3 py-2">
        <div class="mb-3 section-border border-100"></div>
        <div class="block float-left w-10 h-10 mt-1 rounded-full event-link-icon" style="padding-top: 3px">
          <span class="block text-2xl material-icons add-link-icon">add_link</span>
        </div>
        @if(! $event->public)
          <div class="float-left ml-2" style="width: calc(100% - 50px)">
            <button class="w-full mdc-button mdc-button-ripple h-14" type="button" wire:click="makePublic()">
              <span class="mdc-button__ripple"></span>
              <span class="absolute float-left leading-6 tracking-normal text-left normal-case mdc-typograpy left-2 top-1">
                <span class="block mt-1 mb-0 text-base font-medium create-link-title">Create a public link</span>
                <br />
                <span class="block -mt-6 text-xs font-normal text-gray-600">Anyone with this link can save this event</span>
              </span>
            </button>
          </div>
        @else
          <div class="mt-4 ml-14">
            <div class="h-10 px-3 py-2 rounded-lg share-link-box" @click="$clipboard('{{$publicLink}}'); snack('Copied link to clipboard')">
              <input type="text" class="w-full h-5 bg-transparent outline-none mdc-typograpy overflow-ellipsis" @click="$clipboard('{{$publicLink}}'); snack('Copied link to clipboard')" value="{{$publicLink}}" readonly/>
            </div>
            <div class="h-10 mt-4 -ml-2">
              <button class="mt-1 mdc-button" wire:click="makePrivate()" type="button">
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
