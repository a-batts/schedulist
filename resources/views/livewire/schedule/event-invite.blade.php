<div x-data="{
  invite: @this.showingInviteMenu,
  invalidError: @this.invalid,
}"
@open-invite-menu.window="invite = true"
@close-invite-menu.window="invite = false"
@open-invalid-event-menu.window="invalidError = true">
    <div class="inset-0 bg-gray-500 opacity-75 modal-skim hidden" style="display: none" x-show="invite || invalidError" x-cloak></div>
    <div class="modal-container top-16 mdc-typography" x-show="invite" x-cloak wire:ignore>
        @isset($eventOwner)
          <div class="mdc-card mdc-card--outlined modal-card py-5">
            <img src="{{$eventOwner->profile_photo_url}}" class="rounded-full w-28 h-28 mt-1 ml-auto mr-auto">
            <p class="text-center text-xl mt-6"> <span class="font-medium">{{$eventOwner->firstname}} {{$eventOwner->lastname}}</span> shared <span class="font-medium">"{{$event->name}}"</span></p>
            <p class="text-center">with you</p>
            <div class="event-share-info-div mdc-card mdc-card--outlined mt-6 ml-auto mr-auto py-3 px-4 rounded-lg">
              <div>
                <div class="float-left w-14">
                  <i class="material-icons text-3xl ml-1 mt-1.5 float-left">event_note</i>
                </div>
                <div class="float-left w-auto roboto mt-0.5">
                  <p class="font-medium">{{$eventDate->format('D, F jS, Y')}}</p>
                  <p class="text-gray-600 text-sm">{{$eventTimes}}</p>
                </div>
                @if ($event->reoccuring)
                  <div class="float-right">
                    <i class="material-icons text-xl text-gray-700 mr-2 mt-1">restart_alt</i>
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
