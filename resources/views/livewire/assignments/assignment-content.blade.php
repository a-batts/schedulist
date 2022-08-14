<div class="roboto w-full py-16" x-data="">
  <div class="w-full rounded-b-lg px-2 pt-4 pb-8 text-white sm:px-6" style="background-color: #242323">
    <a @click="window.history.back()"><button class="mdc-icon-button material-icons mr-2 align-top" aria-describedby="back-label">arrow_back</button></a>
    <span class="mt-3 inline-block truncate pb-1 text-xl font-medium sm:mt-0 sm:text-4xl md:text-6xl">{{Crypt::decryptString($assignment->assignment_name)}}</span>
    <button class="mdc-icon-button material-icons float-right md:mr-7" @click="$dispatch('display-edit-menu'); fixBody()" aria-describedby="edit-label">edit</button>
    <button class="mdc-icon-button material-icons float-right md:mr-3" id="reminder-button" aria-describedby="notifications-label" @if($assignment->status != 'inc' || $assignment->is_late) disabled @endif><span class="material-icons-outlined">notifications_active</span></button>
    <div class="mt-4 ml-4 md:ml-14">
      <div class="rounded-full w-8 h-8 background-{{$classColor}} float-left text-center align-bottom leading-8"><span class="material-icons inline-block text-lg">class</span></div>
      <div class="white ml-12 h-10 text-base">
        <p class="absolute mt-1">{{($assignment->class_name)}}
          <br class="sm:hidden"/>
          <span class="text-xs sm:ml-5">Created {{$assignment->created_date}} @if($assignment->edited_date != null) • Last Edited {{$assignment->edited_date}} @endif</span>
        </p>
      </div>
    </div>
  </div>
  <div class="mx-auto w-full max-w-6xl sm:px-6 lg:px-8">
    <div class="mt-10 px-4 md:px-8">
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
      <div class="section-border border-200 assignment-border mb-2 w-full"></div>
      <div class="mx-auto py-10">
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
