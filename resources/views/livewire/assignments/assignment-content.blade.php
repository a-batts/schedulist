<div class="py-16 w-full roboto" x-data="">
  <div class="w-full pt-4 pb-8 px-2 sm:px-6 rounded-b-lg text-white" style="background-color: #242323">
    <a @click="window.history.back()"><button class="mdc-icon-button material-icons mr-2 align-top" aria-describedby="back-label">arrow_back</button></a>
    <span class="font-medium text-xl inline-block mt-3 sm:mt-0 sm:text-4xl md:text-6xl truncate">{{Crypt::decryptString($assignment->assignment_name)}}</span>
    <button class="mdc-icon-button material-icons float-right md:mr-7" @click="$dispatch('display-edit-menu'); fixBody()" aria-describedby="edit-label">edit</button>
    <div class="ml-4 md:ml-14 mt-4">
      <div class="rounded-full w-8 h-8 background-{{$classColor}} float-left text-center align-bottom leading-8"><span class="material-icons text-lg inline-block">class</span></div>
      <div class="text-base white ml-12 h-10">
        <p class="absolute mt-1">{{($assignment->class_name)}}
          <br class="sm:hidden"/>
          <span class="text-xs sm:ml-5">Created {{$assignment->created_date}} @if($assignment->edited_date != null) • Last Edited {{$assignment->edited_date}} @endif</span>
        </p>
      </div>
    </div>
  </div>
  <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 w-full">
    <div class="mt-10 px-4 md:px-8">
      @if($assignment->status == 'done')
        <p class="text-gray-500">Marked as completed • Originally Due {{$assignment->due_date}}</p>
      @else
        <p class="{{$assignment->due < Carbon::now() ? 'text-red' : 'text-green'}}">
          {{$assignment->due < Carbon::now() ? 'Late, Due '.$assignment->due_date : 'Due '.$assignment->due_date.', '.$assignment->due_time}}
        </p>
      @endif
      <p class="whitespace-pre-wrap ">
        {{Crypt::decryptString($assignment->description)}}
      </p>
      <div class="section-border border-200 assignment-border mb-2 w-full"></div>
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

  <x-ui.tooltip tooltip-id="back-label" text="Go back to assignments list"/>
  <x-ui.tooltip tooltip-id="edit-label" text="Edit assignment"/>
</div>
