<div x-data="eventCreate()"
  @close-create-modal.window="modal = false"
  class="mdc-typography">
  <x-ui.modal bind="modal" title="New Event" class="top-4">
    <x-slot name="actions">
      <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" @click="$wire.set('event.reoccuring', reoccuring); $wire.set('frequency', frequency); $wire.set('days', days); $wire.create()">
        <span class="mdc-button__ripple"></span>Create
      </button>
    </x-slot>
    
    <label class="w-4/5 mdc-text-field mdc-text-field--filled" x-bind:class="{'mdc-text-field--invalid': errorMessages['event.name'] != undefined}" wire:ignore>
      <span class="mdc-text-field__ripple"></span>
      <span class="mdc-floating-label" id="event-name-label">Event Name</span>
      <input class="mdc-text-field__input" wire:model.lazy="event.name" type="text" aria-labelledby="event-name-label" required>
      <span class="mdc-line-ripple"></span>
    </label>
    <x-ui.validation-error for="event.name"/>
    
    <x-ui.select title="Event Category" :data="json_encode($categories)" bind="category" style="filled" class="w-4/5" value="" required/>
    <x-ui.validation-error for="event.category"/>

    <div class="flex space-x-3">
      <div class="w-full">
        <x-ui.time-picker bind="startTime" title="Start Time"/>
        <x-ui.validation-error for="start_time"/>
      </div>
      
      <div class="w-full">
        <x-ui.time-picker bind="endTime" title="End Time"/>
        <x-ui.validation-error for="end_time"/>
      </div>
    </div>

    <x-ui.date-picker bind="date" valid-date="validDate" title="Event Date"/>
    <x-ui.validation-error for="event.date"/>

    <div class="py-2 -ml-2">
      <div class="mdc-checkbox">
        <input type="checkbox"
                class="mdc-checkbox__native-control"
                id="create-check"
                @click="reoccuring = !reoccuring" :checked="reoccuring"/>
        <div class="mdc-checkbox__background">
          <svg class="mdc-checkbox__checkmark"
                viewBox="0 0 24 24">
            <path class="mdc-checkbox__checkmark-path"
                  fill="none"
                  d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
          </svg>
          <div class="mdc-checkbox__mixedmark"></div>
        </div>
        <div class="mdc-checkbox__ripple"></div>
      </div>
      <label for="create-check" style="vertical-align: 6px">This event recurrs</label>
    </div>

    <div class="py-3" x-transition x-show="reoccuring && modal" x:cloak>
      
      <x-ui.select title="Repeat event every..." bind="frequency" style="filled" 
      :data="json_encode($frequencies)" x-bind:class="{'mdc-select--invalid': errorMessages['event.frequency'] != undefined}" class="w-3/5" required/>
      <x-ui.validation-error for="event.frequency"/>
      
      <div wire:ignore>
        <template x-if="frequency == 'Week' || frequency == 'Two Weeks'">
          <div class="mt-5 ml-1">
            <span>Repeat event on</span>
            <div class="h-10 mt-3">
              <template x-for="day in ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']">
                <button class="float-left w-8 h-8 mr-2 rounded-full select-none mdc-icon-button day-selector" :class="{'day-selector-selected': days.includes(day) && !isCurrentWeekday(day)}" :disabled="isCurrentWeekday(day)" @click="daysToggle(day)" :wire:key="day" type="button" >
                  <div class="mdc-icon-button__ripple"></div>
                  <span class="text-sm text-center day-selector-text" x-text="day"></span>
                </button>
              </template>
            </div>
          </div>
          <x-ui.validation-error for="event.days"/>
        </template>
      </div>
    </div>
  </x-ui.modal>

  <div class="fab-button">
    <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Event" @click="modal = true">
      <div class="mdc-fab__ripple"></div>
      <span class="material-icons mdc-fab__icon">add</span>
      <span class="mdc-fab__label">Add Event</span>
    </button>
  </div>
</div>

  @push('scripts')
    <script>
      function eventCreate(){
        return {
          modal: false,
          
          date: new Date(),
          
          startTime : {h: new Date().getHours(), m: new Date().getMinutes()},
          
          endTime : {h: 23, m: 59},

          category: @entangle('event.category'),

          reoccuring: false,

          frequency: null,

          days: [],
          
          errorMessages: @entangle('errorMessages'),

          init: function (){
            this.daysToggle(this.date.toLocaleString('default', { weekday: 'short' }));
            
            this.$watch('date', (value, oldVal) => {
              this.$wire.setDate(
                value.getFullYear() + '-' + String(value.getMonth() + 1).padStart(2, '0') + '-' + String(value.getDate()).padStart(2, '0')
              )

              if (oldVal)
                this.daysToggle(oldVal.toLocaleString('default', { weekday: 'short' }))
              this.daysToggle(value.toLocaleString('default', { weekday: 'short' }))
            });

            this.$watch('startTime', (value) => {
              this.$wire.setStartTime(value);
            });

            this.$watch('endTime', (value) => {
              if (value.h < 12 && this.startTime.h >= 12){
                value.h = value.h + 12;
                this.endTime = value;
              }

              this.$wire.setEndTime(value);
            }); 
            
          },

          validDate: function(date) {
            return date >= new Date();
          },

          daysToggle: function (e){
            var index = this.days.indexOf(e);
            if (index !== -1 && ! this.isCurrentWeekday(e))
              this.days.splice(index, 1);
            else
              this.days.push(e);
          },

          isCurrentWeekday: function(val){
            return val == this.date.toLocaleString('default', { weekday: 'short' });
          },
        }
      }
    </script>
  @endpush
