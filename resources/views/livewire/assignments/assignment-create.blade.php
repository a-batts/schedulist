<div x-data="assignmentEdit"
@close-assignment-modal.window="modal = false"
class="mdc-typography">
  <div class="fab-button">
    <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Assignment" @click="dialog = true">
      <div class="mdc-fab__ripple"></div>
      <span class="material-icons mdc-fab__icon">add</span>
      <span class="mdc-fab__label">New Assignment</span>
    </button>
  </div>

  <x-ui.modal bind="dialog" title="New Assignment" class="top-4">
    <x-slot name="actions">
      <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" wire:click="create()" wire:ignore>
        <span class="mdc-button__ripple"></span>Create
      </button>
    </x-slot>
    
    <div class="flex space-x-3">
      <div class="w-full">
        <label class="w-full mdc-text-field mdc-text-field--filled" :class="{'mdc-text-field--invalid': errorMessages['assignment.assignment_name'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label" id="assignment-name-label">Name</span>
          <input class="mdc-text-field__input" wire:model.lazy="assignment.assignment_name" type="text" aria-labelledby="assignment-name-label" required>
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error for="assignment.assignment_name"/>
      </div>
      <div class="w-full">
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
                <li class="mdc-deprecated-list-item" role="option" data-value="{{$x['id']}}" wire:click="setClass({{$x['id']}})">
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

    <div class="flex space-x-3">
      <div class="w-full">
        <x-ui.date-picker bind="date" title="Due Date" valid-date="validDate"/>
        <x-ui.validation-error for="due_date"/>
      </div>
      
      <div class="w-full">
        <x-ui.time-picker bind="time" title="Due Time"/>
        <x-ui.validation-error for="due_time"/>
      </div>
    </div>    

    <label class="w-full mt-1 mdc-text-field mdc-text-field--filled" :class="{'mdc-text-field--invalid': errorMessages['assignment.assignment_link'] != undefined}" wire:ignore>
      <span class="mdc-text-field__ripple"></span>
      <span class="mdc-floating-label" id="assignment-link-label">Link</span>
      <input class="mdc-text-field__input" wire:model.lazy="assignment.assignment_link" type="text" aria-labelledby="assignment-link-label">
      <span class="mdc-line-ripple"></span>
    </label>
    <x-ui.validation-error for="assignment.assignment_link"/>

    <label class="w-full mdc-text-field mdc-text-field--filled mdc-text-field--textarea mdc-text-field--with-internal-counter" :class="{'mdc-text-field--invalid': errorMessages['assignment.description'] != undefined}" wire:ignore>
      <span class="mdc-floating-label" id="assignment-description-label">Description</span>
      <textarea class="mdc-text-field__input" aria-labelledby="assignment-description-label" rows="6" wire:model.lazy="assignment.description" required></textarea>
      <span class="mdc-line-ripple"></span>
    </label>
    <x-ui.validation-error for="assignment.description"/>
  </x-ui.modal>
</div>

@push('scripts')
<script>
  document.addEventListener('alpine:init', () => {
        Alpine.data('assignmentEdit', () => ({
          dialog: false,
          
          errorMessages: @entangle('errorMessages'),

          date: new Date(),
          
          time : {h: 23, m: 59},

          init: function() {
            this.$watch('date', (value, oldVal) => {
              this.$wire.setDate(
                value.getFullYear() + '-' + String(value.getMonth() + 1).padStart(2, '0') + '-' + String(value.getDate()).padStart(2, '0')
              )
            });

            this.$watch('time', (value) => {
              this.$wire.setTime(value);
            });
          },

          validDate: function(date) {
            return date >= new Date();
          },
        }))
    })
</script>
@endpush
