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
        <x-ui.validation-hint :message="$errorMessages" for="query"/>
      </div>
      <div class="mt-5">
        @if($sharedWith->count() > 0)
          <p class="font-medium ml-3 mb-3 text-xl">Shared with</p>
        @endif
        @foreach ($sharedWith as $user)
          <div class="px-3 w-full py-2 h-14 mb-2">
            <img src="{{$user->profile_photo_url}}" class="rounded-full w-10 h-10 mt-1 float-left">
            <div class="float-left ml-4">
              <span class="block font-medium text-base mt-1 mb-0">{{$user->firstname}} {{$user->lastname}}</span>
              <br />
              <span class="block text-gray-600 text-xs -mt-6">{{$user->email}}</span>
            </div>
            <button class="mdc-icon-button material-icons float-right" type="button" wire:click="unshare({{$user->id}})" wire:ignore>close</button>
          </div>
        @endforeach
        <div class="px-3 w-full py-2 mb-7 h-20 mb-2">
          <div class="section-border border-100 mb-3"></div>
          <div class="rounded-full w-10 h-10 event-link-icon float-left block mt-1" style="padding-top: 3px">
            <span class="material-icons add-link-icon text-2xl block">add_link</span>
          </div>
          @if(! $event->public)
            <div class="float-left ml-2" style="width: calc(100% - 50px)">
              <button class="mdc-button mdc-button-ripple h-14 w-full" type="button" wire:click="makePublic()">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-typograpy tracking-normal normal-case text-left float-left absolute left-2 top-1 leading-6">
                  <span class="block font-medium create-link-title text-base mt-1 mb-0">Create a public link</span>
                  <br />
                  <span class="block text-gray-600 font-normal text-xs -mt-6">Anyone with this link can save this event</span>
                </span>
              </button>
            </div>
          @else
            <div class="ml-14 mt-4">
              <div class="share-link-box rounded-lg h-10 px-3 py-2" x-on:click="navigator.clipboard.writeText('{{$publicLink}}'); snack('Copied link to clipboard')">
                <input type="text" class="mdc-typograpy h-5 w-full overflow-ellipsis outline-none" x-on:click="navigator.clipboard.writeText('{{$publicLink}}'); snack('Copied link to clipboard')" value="{{$publicLink}}" readonly />
              </div>
              <div class="mb-5 mt-2 h-10 -ml-2">
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
