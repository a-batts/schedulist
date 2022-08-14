<div x-data="{
  share: false,
  errorMessages: @entangle('errorMessages'),
}"
x-init="
  $watch('share', value => {
    document.body.classList.toggle('overflow-y-hidden')
    document.getElementById('agenda').classList.toggle('fixed')
  })
"
@open-share-modal.window="share = true">
    <x-ui.modal alpine="share" title="Share Event" action="Done" classes="top-14 mdc-typography" @click="share = false">
      <p class="ml-3 mb-6 -mt-6 mb-2 text-gray-700">Allow other users to view your event on their agenda</p>
      <div class="px-3">
        <label class="mdc-text-field mdc-text-field--outlined w-full" x-on:dblclick="showDropdownMenu()" x-bind:class="{'mdc-text-field--invalid': errorMessages['query'] != undefined}" wire:ignore>
          <span class="mdc-notched-outline">
            <span class="mdc-notched-outline__leading"></span>
            <span class="mdc-notched-outline__notch">
              <span class="mdc-floating-label" id="my-label-id">Enter an email address</span>
            </span>
            <span class="mdc-notched-outline__trailing"></span>
          </span>
          <input type="text" class="mdc-text-field__input" aria-labelledby="my-label-id" autocomplete="qekfk" wire:model.debounce.50ms="query" wire:keydown.enter.prevent="share()">
        </label>
        <x-ui.validation-error :message="$errorMessages" for="query"/>
      </div>
      <div class="mt-5">
        @if($sharedWith->count() > 0)
          <p class="ml-3 mb-3 text-xl font-medium">Shared with</p>
        @endif
        @foreach ($sharedWith as $user)
          <div class="mb-2 h-14 w-full px-3 py-2">
            <img src="{{$user->profile_photo_url}}" class="float-left mt-1 h-10 w-10 rounded-full">
            <div class="float-left ml-4">
              <span class="mt-1 mb-0 block text-base font-medium">{{$user->firstname}} {{$user->lastname}}</span>
              <br />
              <span class="-mt-6 block text-xs text-gray-600">{{$user->email}}</span>
            </div>
            <button class="mdc-icon-button material-icons float-right" type="button" wire:click="unshare({{$user->id}})" wire:ignore>close</button>
          </div>
        @endforeach
        <div class="mb-7 mb-2 h-20 w-full px-3 py-2">
          <div class="section-border border-100 mb-3"></div>
          <div class="event-link-icon float-left mt-1 block h-10 w-10 rounded-full" style="padding-top: 3px">
            <span class="material-icons add-link-icon block text-2xl">add_link</span>
          </div>
          @if(! $event->public)
            <div class="float-left ml-2" style="width: calc(100% - 50px)">
              <button class="mdc-button mdc-button-ripple h-14 w-full" type="button" wire:click="makePublic()">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-typograpy absolute left-2 top-1 float-left text-left normal-case leading-6 tracking-normal">
                  <span class="create-link-title mt-1 mb-0 block text-base font-medium">Create a public link</span>
                  <br />
                  <span class="-mt-6 block text-xs font-normal text-gray-600">Anyone with this link can save this event</span>
                </span>
              </button>
            </div>
          @else
            <div class="ml-14 mt-4">
              <div class="share-link-box h-10 rounded-lg px-3 py-2" x-on:click="navigator.clipboard.writeText('{{$publicLink}}'); snack('Copied link to clipboard')">
                <input type="text" class="mdc-typograpy h-5 w-full overflow-ellipsis outline-none" x-on:click="navigator.clipboard.writeText('{{$publicLink}}'); snack('Copied link to clipboard')" value="{{$publicLink}}" readonly />
              </div>
              <div class="mb-5 mt-2 -ml-2 h-10">
                <button class="mdc-button mt-1" wire:click="makePrivate()" type="button">
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
