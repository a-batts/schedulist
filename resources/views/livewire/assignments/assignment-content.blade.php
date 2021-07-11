<div class="mdc-typography">
  <div id="makefixed" wire:ignore.self x-data="{}">
    <div class="pt-5">
      <button class="mdc-icon-button material-icons" onclick="window.history.back()" style="margin-right: -8px">arrow_back</button>
      <span class="mdc-typography--headline4 ml-2 nunito assignment-page-title">{{Crypt::decryptString($assignment->assignment_name)}}</span>
      <button class="mdc-icon-button material-icons float-right assignment-edit-icon" style="margin-right: 5px" x-on:click="$dispatch('display-edit-menu'); fixBody()">edit</button>
    </div>
    <div class="assignment-page-det">
      <span class="mdc-typography--subtitle1 text-gray-600 ml-5">{{($assignment->class_name)}} • {{$assignment->created_date}} @if($assignment->edited_date != null) (Edited: {{$assignment->edited_date}}) @endif</span>
      @if ($assignment->status == 'inc')
      <span class="mdc-typography--subtitle1 float-right @if($assignment->is_late) text-error @else text-green @endif assignment-due-line">@if($assignment->is_late) Late: @endif Due @if($assignment->is_due_today) {{$assignment->due_time}} @else {{$assignment->due_date}} @endif</span>
      @else
      <span class="mdc-typography--subtitle1 float-right assignment-due-line">Done - Due {{$assignment->due_date}}</span>
      @endif
      <div class="section-border border-200 assignment-border"></div>
      <div class="mt-10">
        <div class="assignment-page-right">
          @if ($assignment->status == 'inc')
          <button class="mdc-button mdc-button--raised mdc-button-ripple" wire:click="markDone({{$assignment->id}})">
            <span class="mdc-button__ripple"></span>
            <span class="mdc-button__label">Mark completed</span>
          </button>
          @else
          <button class="mdc-button mdc-button--raised mdc-button-ripple" wire:click="markIncomplete({{$assignment->id}})">
            <span class="mdc-button__ripple"></span>
            <span class="mdc-button__label">Mark incomplete</span>
          </button>
          @endif
        </div>
        <div class="assignment-page-left mb-5">
          <p style="white-space: pre-wrap">@if($assignment->description != null){{Crypt::decryptString($assignment->description)}}@endif</p>
        </div>
      </div>
    </div>
    <br>

    <div class="py-10 ml-12">
      @if($assignment->assignment_link != null)
        <x-link-preview :preview="$preview"/>
      @endif
    </div>

  </div>
  @livewire('assignments.assignment-edit', ['assignment' => $assignment])
</div>
