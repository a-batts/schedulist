<div x-data="{
  showingInvite: @json(!$invalid),
}"
@close-invite-menu.window="showingInvite = false">
    <div class="inset-0 hidden bg-gray-500 opacity-75 modal-skim" style="display: none" x-show="showingInvite" x-cloak></div>
    <div class="modal-container mdc-typography top-16" x-show="showingInvite" x-cloak wire:ignore>
        @isset($event->creator)
          <div class="py-5 mdc-card mdc-card--outlined modal-card">
            <img src="{{$event->creator->profile_photo_url}}" alt="Profile photo" class="mt-1 ml-auto mr-auto rounded-full h-28 w-28">
            <p class="mt-6 text-xl text-center"> <span class="font-medium">{{$event->creator->name}}</span> shared <span class="font-medium">"{{$event->name}}"</span></p>
            <p class="text-center">with you</p>
            <div class="px-4 py-3 mt-6 ml-auto mr-auto rounded-lg event-share-info-div mdc-card mdc-card--outlined">
              <div>
                <div class="float-left w-14">
                  <i class="material-icons float-left ml-1 mt-1.5 text-3xl">event_note</i>
                </div>
                <div class="float-left mt-0.5 w-auto">
                  <p class="font-medium">{{$event->formatted_date}}</p>
                  <p class="text-sm text-gray-600">{{$event->formatted_time}}</p>
                </div>
                @if ($event->reoccuring)
                  <div class="float-right">
                    <i class="mt-1 mr-2 text-xl text-gray-700 material-icons">restart_alt</i>
                  </div>
                @endif
              </div>
            </div>
            <div class="mt-10">
              <button class="float-right ml-3 mdc-button mdc-button--raised mdc-button-ripple" wire:click="addEvent()" wire:ignore autofocus>
                <span class="mdc-button__ripple"></span>
                  Add to Agenda
              </button>
              <button class="float-right mdc-button mdc-button-ripple" @click="showingInvite = false" wire:ignore>
                <span class="mdc-button__ripple"></span>
                  Cancel
              </button>
            </div>
          </div>
        @endisset
    </div>
</div>
