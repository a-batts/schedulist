<div x-data="editMenu()"
@display-edit-menu.window="editMenu = true"
@hide-edit-menu.window="editMenu = false; undoFixBody()">
  <div class="mdc-dialog delete-assignment-conf" style="z-index: 70" wire:ignore>
    <div class="mdc-dialog__container">
      <div class="mdc-dialog__surface"
        role="alertdialog"
        aria-modal="true"
        aria-labelledby="my-dialog-title"
        aria-describedby="my-dialog-content">
        <div class="mdc-dialog__title">Really delete assignment?</div>
        <div class="mdc-dialog__content" id="my-dialog-content">
          It will be completely deleted and will not be recoverable.
        </div>
        <div class="mdc-dialog__actions">
          <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="cancel">
            <div class="mdc-button__ripple"></div>
            <span class="mdc-button__label">Cancel</span>
          </button>
          <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="delete" wire:click="delete()">
            <div class="mdc-button__ripple"></div>
            <span class="mdc-button__label">Delete</span>
          </button>
        </div>
      </div>
    </div>
    <div class="mdc-dialog__scrim"></div>
  </div>
  <div>
    <x-ui.modal alpine="editMenu" title="Edit Assignment" action="Save" classes="top-4" wire:submit.prevent="edit">
      <x-slot name="topAction">
        <button class="float-left mr-3 -mt-1 mdc-icon-button material-icons" type="button" aria-describedby="delete-class" aria-label="close" x-on:click="editMenu = false; openAssignmentDialog();">delete</button>
        <x-ui.tooltip tooltip-id="delete-class" text="Delete Class"/>
      </x-slot>
      <div>
        <div class="w-1/2 pr-1.5 float-left">
          <label class="w-full mdc-text-field mdc-text-field--filled" x-bind:class="{'mdc-text-field--invalid': errorMessages['assignment.assignment_name'] != undefined}" wire:ignore>
            <span class="mdc-text-field__ripple"></span>
            <span class="mdc-floating-label mdc-floating-label--float-above" id="assignment-name-label">Assignment Name</span>
            <input class="mdc-text-field__input" wire:model.lazy="assignment.assignment_name" x-model="title" type="text" aria-labelledby="assignment-name-label" required>
            <span class="mdc-line-ripple"></span>
          </label>
          <x-ui.validation-error :message="$errorMessages" for="assignment.assignment_name"/>
        </div>
        <div class="w-1/2 pl-1.5 float-right">
          <div class="w-full mdc-select mdc-select--filled" wire:ignore>
            <div class="mdc-select__anchor"
                 role="button"
                 aria-haspopup="listbox"
                 aria-expanded="false">
              <span class="mdc-select__ripple"></span>
              <span class="mdc-floating-label mdc-floating-label--float-above">Class</span>
              <span class="mdc-select__selected-text-container">
                <span class="mdc-select__selected-text"></span>
              </span>
              <span class="mdc-select__dropdown-icon">
                <svg
                    class="mdc-select__dropdown-icon-graphic"
                    viewBox="7 10 10 5" focusable="false">
                  <polygon
                      class="mdc-select__dropdown-icon-inactive"
                      stroke="none"
                      fill-rule="evenodd"
                      points="7 10 12 15 17 10">
                  </polygon>
                  <polygon
                      class="mdc-select__dropdown-icon-active"
                      stroke="none"
                      fill-rule="evenodd"
                      points="7 15 12 10 17 15">
                  </polygon>
                </svg>
              </span>
              <span class="mdc-line-ripple"></span>
            </div>
            <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
              <ul class="mdc-deprecated-list dark-theme-list" role="listbox">
                @foreach($classes as $x)
                  <li class="mdc-deprecated-list-item @if($x['id'] == $assignment->classid) mdc-deprecated-list-item--selected @endif" role="option" data-value="{{$x['id']}}" wire:click="setClass({{$x['id']}})">
                    <span class="mdc-deprecated-list-item__ripple"></span>
                    <span class="mdc-deprecated-list-item__text">
                      {{$x['name']}}
                    </span>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
  
      <div class="block mb-3 -mt-1 h-14">
        @livewire('assignments.assignment-edit-due', ['time' => $time, 'date' => $date])
      </div>
      <x-ui.validation-error :message="$errorMessages" for="assignment.due"/>
  
      <label class="w-full mt-1 mdc-text-field mdc-text-field--filled" x-bind:class="{'mdc-text-field--invalid': errorMessages['assignment.assignment_link'] != undefined}" wire:ignore>
        <span class="mdc-text-field__ripple"></span>
        <span class="mdc-floating-label mdc-floating-label--float-above" id="assignment-link-label">Assignment Link</span>
        <input class="mdc-text-field__input" wire:model.lazy="assignment.assignment_link" type="text" aria-labelledby="assignment-link-label">
        <span class="mdc-line-ripple"></span>
      </label>
      <x-ui.validation-error :message="$errorMessages" for="assignment.assignment_link"/>

      <div class="w-full pt-4 pb-8">
        <div class="left-0 right-0 mx-auto">
         @if($assignment->assignment_link != '')
           <x-link-preview :preview="$preview"/>
         @endif
        </div>
       </div>
  
      <label class="w-full mdc-text-field mdc-text-field--filled mdc-text-field--textarea mdc-text-field--with-internal-counter" x-bind:class="{'mdc-text-field--invalid': errorMessages['assignment.description'] != undefined}" x-ref="descriptionContainer" wire:ignore>
        <span class="mdc-floating-label mdc-floating-label--float-above" id="assignment-description-label">Assignment Description</span>
        <textarea class="mdc-text-field__input" aria-labelledby="assignment-description-label" rows="6" wire:model.lazy="assignment.description" x-ref="descriptionBox" required 
        ="descriptionInput()"></textarea>
        <span class="mdc-line-ripple"></span>
      </label>
      <x-ui.validation-error :message="$errorMessages" for="assignment.description"/>
    </x-ui.modal>
  </div>
</div>
@push('scripts')
<script>
function editMenu(){
  return {
    editMenu: false,
    errorMessages: @entangle('errorMessages'),
    title: @this.assignment.assignment_name,
    init: function($watch, $wire){
      $watch('title', newtitle => {
        if (newtitle != '')
          document.title = newtitle
        else
          document.title = 'Untitled Assignment'
      });
      var descriptionBox = this.$refs.descriptionBox;
      var container = this.$refs.descriptionContainer;
      container.style.height = (descriptionBox.scrollHeight + 40) + 'px';
      if (descriptionBox.scrollHeight == 0)
        container.style.height = '184px';
      $wire.getTime()
        .then(result => { vueApp.time = result});
      $wire.getDate()
        .then(result => { vueApp.date = result });
    },
    descriptionInput: function(){
      var descriptionBox = this.$refs.descriptionBox;
      var container = this.$refs.descriptionContainer;
      container.style.height = 'auto';
      container.style.height = (descriptionBox.scrollHeight + 40) + 'px';
      if (descriptionBox.scrollHeight == 0)
        container.style.height = '40px';
    },
    clickEdit: function(){
      var descriptionBox = this.$refs.descriptionBox;
      var container = this.$refs.descriptionContainer;
      setTimeout(() => {
        container.style.height = 'auto';
        container.style.height = (descriptionBox.scrollHeight + 40) + 'px';
      }, 300)
    }
  }
}


</script>
@endpush
