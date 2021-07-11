<div x-data="editMenu()" x-init="init()"
@display-edit-menu.window="editMenu = true"
@hide-edit-menu.window="editMenu = false; undoFixBody()">
  <div class="mdc-dialog delete-assignment-conf" style="z-index: 70" wire:ignore>
    <div class="mdc-dialog__container">
      <div class="mdc-dialog__surface"
        role="alertdialog"
        aria-modal="true"
        aria-labelledby="my-dialog-title"
        aria-describedby="my-dialog-content">
        <div class="mdc-dialog__content" id="my-dialog-content">
          Really delete this assignment?
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
    <div x-show="editMenu" x-transition:enter="ease-out duration-100" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="assignment-edit-div base-bg" x-cloak>
      <form wire:submit.prevent="save">
        <div class="edit-toprow">
          <button class="mdc-icon-button edit-dia-buttons material-icons float-left" style="margin-right: 5px" x-on:click="editMenu = false" type="button" onclick="undoFixBody()">close</button>
          <span class="mdc-typography--headline6 nunito edit-title">Edit Assignment</span>
          <div id="demo-menu" class="mdc-menu-surface--anchor float-right">
            <button class="mdc-icon-button edit-dia-buttons more material-icons ml-2" type="button" x-on:click="moreMenu.open = true">more_vert</button>
            <div class="mdc-menu mdc-menu-surface edit-more-menu" wire:ignore>
              <ul class="mdc-list dark-theme-list" role="menu" aria-hidden="true" aria-orientation="vertical" tabindex="-1">
                <li class="mdc-list-item" role="menuitem" onclick="openAssignmentDialog()">
                  <span class="mdc-list-item__ripple"></span>
                  <span class="mdc-list-item__text">Delete Assignment</span>
                </li>
                <li class="mdc-list-item" role="menuitem" wire:click="toggleNotification()">
                  <span class="mdc-list-item__ripple"></span>
                  <span class="mdc-list-item__text">@if($assignment->notifications_disabled == null)Disable Notifications @else()Enable Notifications @endif</span>
                </li>
              </ul>
            </div>
          </div>
          <button class="mdc-button mdc-button--raised mdc-button-ripple float-right assignment_save_button" wire:ignore>
            <span class="mdc-button__ripple"></span>
            <span class="mdc-button__label">Save</span>
          </button>
        </div>
        <div class="assignment-e-forms">
          <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating w-full mt-4 @error('title') mdc-text-field--invalid @enderror"
            x-data="{  }"
            x-init="$watch('title', newtitle => document.title = newtitle)"
            @cleared-field.window="document.title = 'Untitled Assignment'">
            <span class="mdc-text-field__ripple" wire:ignore></span>
            <input wire:model="title" type="text" class="mdc-text-field__input" aria-labelledby="name-label" required wire:ignore>
            <span class="mdc-floating-label mdc-floating-label--float-above" wire:ignore>Title</span>
            <span class="mdc-line-ripple" wire:ignore></span>
          </label>
          <div class="mdc-text-field-helper-line h-2.5">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" id="my-helper-id" aria-hidden="true"><p class="text-error">@error('title') A name for the assignment is required @enderror</p></div>
          </div>
          <div class="mdc-select mdc-select--filled mdc-select--required edit-class-sel mt-5" style="width: 100%" wire:ignore>
            <div class="mdc-select__anchor"
                 role="button"
                 aria-haspopup="listbox"
                 aria-expanded="false"
                 aria-required="true"
                 aria-labelledby="select-label demo-selected-text">
              <span class="mdc-select__ripple"></span>
              <span id="select-label" class="mdc-floating-label mdc-floating-label--float-above" style="transform: translateY(-106%) scale(0.75)">Class Period</span>
              <span class="mdc-select__selected-text-container">
                <span id="demo-selected-text" class="mdc-select__selected-text">{{$originalClass->period.': '.$originalClass->name}}</span>
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
              <ul class="mdc-list dark-theme-list">
                <li class="mdc-list-item mdc-list-item--selected" data-value="{{$originalClass->id}}" wire:click="$set('classperiod', {{$originalClass->id}})">
                  <span class="mdc-list-item__ripple"></span>
                  <span class="mdc-list-item__text">{{$originalClass->period.': '.$originalClass->name}}</span>
                </li>
                <li class="mdc-list-divider" role="separator"></li>
                @foreach($classes as $class)
                <li class="mdc-list-item" data-value="{{$class->id}}" wire:click="$set('classperiod', {{$class->id}})">
                  <span class="mdc-list-item__ripple"></span>
                  <span class="mdc-list-item__text">{{$class->period}}: {{$class->name}}</span>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <div class="assignment-e-forms-right">
          <div class="-mt-2">
            @livewire('assignments.assignment-edit-due', ['time' => $time, 'date' => $date])
          </div>
          <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating w-full mt-2 @error('link') mdc-text-field--invalid @enderror">
            <span class="mdc-text-field__ripple" wire:ignore></span>
            <input wire:model.lazy="link" type="text" class="mdc-text-field__input" aria-labelledby="link-label" wire:ignore>
            <span class="mdc-floating-label mdc-floating-label--float-above" wire:ignore>Link</span>
            <span class="mdc-line-ripple" wire:ignore></span>
          </label>
          @error('link')
            <div class="mdc-text-field-helper-line" wire:ignore>
              <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" aria-hidden="true"><p class="text-error">Double check that the link is a valid URL</p></div>
            </div>
          @enderror

          <div class="pt-10">
            @if($link != '')
              <x-link-preview :preview="$preview"/>
            @endif
          </div>

        </div>
        <div class="assignment-e-forms">
          <label class="mdc-text-field mdc-text-field--filled mdc-text-field--textarea mdc-text-field--label-floating mdc-text-field--with-internal-counter mt-5 w-full @error('assignment.description') mdc-text-field--invalid @enderror" x-ref="descriptionContainer" wire:ignore>
            <span class="mdc-floating-label mdc-floating-label--float-above" wire:ignorewire:ignore>Description</span>
            <textarea wire:model="assignment.description" class="mdc-text-field__input edit_description h-full" aria-labelledby="my-label-id" rows="6" x-ref="descriptionBox" required @input="descriptionInput()"></textarea>
            <span class="mdc-line-ripple"></span>
          </label>
          @error('assignment.description')
            <div class="mdc-text-field-helper-line mb-10" wire:ignore>
              <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" aria-hidden="true"><p class="text-error">A description for the assignment is required</p></div>
            </div>
          @enderror
        </div>
      </form>
    </div>
  </div>
</div>
@push('scripts')
<script>
function editMenu(){
  return {
    editMenu: false,
    errors: @this.errorMessages,
    title: @entangle('title'),
    init: function(){
      var descriptionBox = this.$refs.descriptionBox;
      var container = this.$refs.descriptionContainer;
      container.style.height = (descriptionBox.scrollHeight + 40) + 'px';
      if (descriptionBox.scrollHeight == 0)
        container.style.height = '184px';
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
