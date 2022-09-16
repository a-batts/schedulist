<div class="px-2 md:pt-10 md:px-24" 
x-data="{
  noteContent: @entangle('noteContent').defer,
}">
  <div class="border-b border-gray-200 md:pb-4">
    <div class="flex py-5 mx-auto">
      <div class="flex items-center flex-grow">
          <button class="mdc-icon-button material-icons" aria-describedby="back-label" @click="window.history.back()" wire:ignore>
            <div class="mdc-icon-button__ripple"></div>
            arrow_back
          </button>
        <div class="ml-8">
          <h1 class="text-xl font-bold sm:text-4xl md:text-6xl">{{$assignment->name}}</h1>
          <div class="mt-2 text-sm md:mt-6">
            @if($assignment->status == 'done')
            <p class="text-gray-500">Marked complete • Originally due on {{$assignment->due_date}} at {{$assignment->due_time}}</p>
            @else
              <p class="{{$assignment->due < Carbon::now() ? 'text-red' : 'text-green'}}">
                {{$assignment->due < Carbon::now() ? 'Late • Due '.$assignment->due_date : 'Due '.$assignment->due_date.', '.$assignment->due_time}}
              </p>
            @endif
          </div>
        </div>
      </div>
      <div class="flex items-center space-x-3">
        <button class="mdc-icon-button material-icons" @click="$dispatch('display-edit-menu')" aria-describedby="edit-label" wire:ignore>
          <div class="mdc-icon-button__ripple"></div>
          edit
        </button>
        <button class="mdc-icon-button material-icons" id="reminder-button" aria-describedby="notifications-label" @if($assignment->status != 'inc' || $assignment->is_late) disabled @endif wire:ignore>
          <div class="mdc-icon-button__ripple"></div>
          notifications_active
        </button>
      </div>
    </div>
  </div>

  <div class="w-full px-4 pt-6 pb-16 border-b border-gray-200 sm:px-6 lg:px-8">
    <div class="lg:flex gap-x-8">
      <div class="flex-grow mb-10">
        <div class="flex my-4">
          <div class="rounded-full w-8 h-8 background-{{$classColor}} flex leading-8">
            <span class="self-center block mx-auto text-lg align-middle material-icons justify-self-center">class</span>
          </div>
          <div class="mt-1 ml-4 text-lg text-gray-700">
            <p class="">{{($assignment->class_name)}}</p>
          </div>
        </div>
        <p class="whitespace-pre-line">
          {{$assignment->description}}
        </p>
      </div>
      
      <div class="self-start flex-shrink-0 px-6 py-7 mdc-card mdc-card--outlined md:min-w-[27.5rem] mr-0">
        <h4 class="mr-6 text-2xl font-bold">Assignment Details</h4>
        <div class="mt-6 text-sm">
          <p class="font-medium">Created on</p>
          <p class="text-gray-600">{{$assignment->created_date}}</p>
        </div>
        <div class="mt-3 text-sm">
          <p class="font-medium">Last modified</p>
          <p class="text-gray-600">{{$assignment->edited_date}}</p>
        </div>
        @if($assignment->link != null)
          <div class="pt-6 mt-6 border-t border-gray-100">
            <p class="text-sm font-medium">Link</p>
            <div class="mx-auto mt-4">
                <x-link-preview :preview="$preview"/>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  <div class="px-4 pt-5 pb-16 mt-4 sm:px-6 lg:px-8">
    <h4 class="text-2xl font-bold">Notes</h4>
    <p class="mt-2 text-gray-600">Add additional details and instructions, as well as updates, to this assignment</p>
    <div class="flex w-full max-w-xl">
      <label class="flex-grow mt-7 mdc-text-field mdc-text-field--filled mdc-text-field--textarea">
        <span class="mdc-text-field__ripple"></span>
        <span class="mdc-floating-label" id="note-contents">Add a note</span>
        <textarea class="mdc-text-field__input autosize" rows="3" aria-label="Label" aria-labelledby="note-contents" x-model="noteContent" x-ref="noteBox"></textarea>
        <span class="mdc-line-ripple"></span>
      </label>
      <button class="self-end ml-2 transition-all mdc-icon-button material-icons text-primary-theme" aria-describedby="add-note-label" 
      wire:click="addNote" :disabled="noteContent.trim().length == 0" disabled>
        <div class="mdc-icon-button__ripple"></div>
        maps_ugc
      </button>
    </div> 
    <x-ui.validation-error for="noteContent"/>

    <div class="w-full max-w-xl pt-6 space-y-6">
      @foreach($this->notes as $note)
        <div class="w-full px-6 py-5 mdc-card mdc-card--outlined">
          <div class="flex gap-x-2">
            <div class="flex-grow overflow-hidden break-words">
              <p>{!! $note->parsed_contents !!}</p>
              <p class="mt-4 text-xs text-gray-600">{{$note->created_datetime}}</p>
            </div>
            <button class="self-start -mt-2 mdc-icon-button material-icons"
              wire:click="deleteNote({{$note->id}})">
                <div class="mdc-icon-button__ripple"></div>
                delete
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="fab-button">
    <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Assignment" wire:click="toggleCompletion()">
      <div class="mdc-fab__ripple"></div>
      @if ($assignment->status == 'inc')
        <span class="material-icons mdc-fab__icon">check_circle</span>
        <span class="mdc-fab__label">Mark As Completed</span>
      @else
        <span class="material-icons mdc-fab__icon">unpublished</span>
        <span class="mdc-fab__label">Mark As Incomplete</span>
      @endif
    </button>
  </div>

  @livewire('assignments.assignment-edit', ['assignment' => $assignment])
  @livewire('assignments.assignment-reminder', ['assignment' => $assignment])

  <x-ui.tooltip tooltip-id="back-label" text="Go back to assignments list"/>
  <x-ui.tooltip tooltip-id="edit-label" text="Edit assignment"/>
  <x-ui.tooltip tooltip-id="notifications-label" text="Manage notifications"/>
  <x-ui.tooltip tooltip-id="add-note-label" text="Add note"/>
</div>
