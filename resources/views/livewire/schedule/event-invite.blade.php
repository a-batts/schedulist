<div x-data="{
  invite: @this.showingInviteMenu,
  invalidError: @this.invalid,
}"
@open-invite-menu.window="invite = true"
@close-invite-menu.window="invite = false"
@open-invalid-event-menu.window="invalidError = true">
    <div class="modal-skim inset-0 hidden bg-gray-500 opacity-75" style="display: none" x-show="invite" x-cloak></div>
    <div class="modal-container mdc-typography top-16" x-show="invite" x-cloak wire:ignore>
        @isset($eventOwner)
          <div class="mdc-card mdc-card--outlined modal-card py-5">
            <img src="{{$eventOwner->profile_photo_url}}" class="mt-1 ml-auto mr-auto h-28 w-28 rounded-full">
            <p class="mt-6 text-center text-xl"> <span class="font-medium">{{$eventOwner->firstname}} {{$eventOwner->lastname}}</span> shared <span class="font-medium">"{{Crypt::decryptString($event->name)}}"</span></p>
            <p class="text-center">with you</p>
            <div class="event-share-info-div mdc-card mdc-card--outlined mt-6 ml-auto mr-auto rounded-lg py-3 px-4">
              <div>
                <div class="float-left w-14">
                  <i class="material-icons float-left ml-1 mt-1.5 text-3xl">event_note</i>
                </div>
                <div class="roboto float-left mt-0.5 w-auto">
                  <p class="font-medium">{{$eventDate->format('D, F jS, Y')}}</p>
                  <p class="text-sm text-gray-600">{{$eventTimes}}</p>
                </div>
                @if ($event->reoccuring)
                  <div class="float-right">
                    <i class="material-icons mr-2 mt-1 text-xl text-gray-700">restart_alt</i>
                  </div>
                @endif
              </div>
            </div>
            <div class="mt-10">
              <button class="mdc-button mdc-button--raised mdc-button-ripple float-right ml-3" wire:click="addEvent()" wire:ignore autofocus>
                <span class="mdc-button__ripple"></span>
                  Add to Agenda
              </button>
              <button class="mdc-button mdc-button-ripple float-right" @click="invite = false" wire:ignore>
                <span class="mdc-button__ripple"></span>
                  Cancel
              </button>
            </div>
          </div>
        @endisset
    </div>
</div>
