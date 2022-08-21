<div class="w-full py-16" x-data="">
  <div class="w-full px-2 pt-4 pb-8 text-white rounded-b-lg sm:px-6" style="background-color: #242323">
    <a @click="window.history.back()"><button class="mr-2 align-top mdc-icon-button material-icons" aria-describedby="back-label">arrow_back</button></a>
    <span class="inline-block pb-1 mt-3 text-xl font-medium truncate sm:mt-0 sm:text-4xl md:text-6xl">{{Crypt::decryptString($assignment->assignment_name)}}</span>
    <button class="float-right mdc-icon-button material-icons md:mr-7" @click="$dispatch('display-edit-menu')" aria-describedby="edit-label">edit</button>
    <button class="float-right mdc-icon-button material-icons md:mr-3" id="reminder-button" aria-describedby="notifications-label" @if($assignment->status != 'inc' || $assignment->is_late) disabled @endif><span class="material-icons-outlined">notifications_active</span></button>
    <div class="mt-4 ml-4 md:ml-14">
      <div class="rounded-full w-8 h-8 background-{{$classColor}} float-left text-center align-bottom leading-8"><span class="inline-block text-lg material-icons">class</span></div>
      <div class="h-10 ml-12 text-base white">
        <p class="absolute mt-1">{{($assignment->class_name)}}
          <br class="sm:hidden"/>
          <span class="text-xs sm:ml-5">Created {{$assignment->created_date}} @if($assignment->edited_date != null) • Last Edited {{$assignment->edited_date}} @endif</span>
        </p>
      </div>
    </div>
  </div>
  <div class="w-full max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="px-4 mt-10 md:px-8">
      @if($assignment->status == 'done')
        <p class="text-gray-500">Marked as completed • Originally Due {{$assignment->due_date}}</p>
      @else
        <p class="{{$assignment->due < Carbon::now() ? 'text-red' : 'text-green'}}">
          {{$assignment->due < Carbon::now() ? 'Late, Due '.$assignment->due_date : 'Due '.$assignment->due_date.', '.$assignment->due_time}}
        </p>
      @endif
      <p class="whitespace-pre-wrap">
        {{Crypt::decryptString($assignment->description)}}
      </p>
      <div class="w-full mb-2 section-border border-200 assignment-border"></div>
      <div class="py-10 mx-auto">
        @if($assignment->assignment_link != null)
          <x-link-preview :preview="$preview"/>
        @endif
      </div>
    </div>
  </div>

  <div class="fab-button">
    <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Assignment" wire:click="updateStatus()">
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
</div>
