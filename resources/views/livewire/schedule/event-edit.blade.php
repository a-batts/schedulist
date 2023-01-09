  <div class="mdc-typography" x-data="eventEdit()" @update-content.window="updateContent($wire)"
      @close-edit-modal.window="modal = false">
      <x-ui.modal class="top-4" title="Edit Event" bind="modal">
          <x-slot name="actions">
              <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button"
                  @click="$wire.set('event.reoccuring', reoccuring); $wire.set('frequency', frequency); $wire.setDays(days); $wire.edit()">
                  <span class="mdc-button__ripple"></span>Save
              </button>
          </x-slot>

          <label class="mdc-text-field mdc-text-field--filled w-4/5"
              x-bind:class="{ 'mdc-text-field--invalid': errorMessages['event.name'] != undefined }" wire:ignore>
              <span class="mdc-text-field__ripple"></span>
              <span class="mdc-floating-label mdc-floating-label--float-above" id="event-name-label">Event Name</span>
              <input class="mdc-text-field__input" type="text" aria-labelledby="event-name-label"
                  wire:model.lazy="event.name" required>
              <span class="mdc-line-ripple"></span>
          </label>
          <x-ui.validation-error for="event.name" />

          <x-ui.select class="w-4/5" value="" title="Event Category" style="filled" :data="json_encode($categories)"
              bind="category" required />
          <x-ui.validation-error for="event.category" />

          <div class="flex space-x-3">
              <div class="w-full">
                  <x-ui.time-picker title="Start Time" bind="startTime" />
                  <x-ui.validation-error for="start_time" />
              </div>

              <div class="w-full">
                  <x-ui.time-picker title="End Time" bind="endTime" />
                  <x-ui.validation-error for="end_time" />
              </div>
          </div>

          <x-ui.date-picker title="Event Date" bind="date" valid-date="validDate" />
          <x-ui.validation-error for="event.date" />

          <div class="py-2 -ml-2">
              <div class="mdc-checkbox">
                  <input class="mdc-checkbox__native-control" id="edit-check" type="checkbox"
                      @click="reoccuring = !reoccuring" :checked="reoccuring" />
                  <div class="mdc-checkbox__background">
                      <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                          <path class="mdc-checkbox__checkmark-path" fill="none"
                              d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                      </svg>
                      <div class="mdc-checkbox__mixedmark"></div>
                  </div>
                  <div class="mdc-checkbox__ripple"></div>
              </div>
              <label for="edit-check" style="vertical-align: 6px">This event recurrs</label>
          </div>

          <div class="py-3" x-transition x-show="reoccuring && modal" x:cloak>

              <x-ui.select class="{'mdc-select--invalid': errorMessages['event.frequency'] != undefined}" class="w-3/5"
                  title="Repeat event every..." style="filled" bind="frequency" :data="json_encode($frequencies)" required />
              <x-ui.validation-error for="event.frequency" />

              <div wire:ignore>
                  <template x-if="frequency == 'Week' || frequency == 'Two Weeks'">
                      <div class="mt-5 ml-1">
                          <span>Repeat event on</span>
                          <div class="h-10 mt-3" wire:ignore>
                              <template x-for="day in ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']">
                                  <button
                                      class="mdc-icon-button day-selector float-left w-8 h-8 mr-2 rounded-full select-none"
                                      type="button"
                                      :class="{ 'day-selector-selected': days.includes(day) && !isCurrentWeekday(day) }"
                                      :disabled="isCurrentWeekday(day)" @click="daysToggle(day)" :wire:key="day">
                                      <div class="mdc-icon-button__ripple"></div>
                                      <span class="day-selector-text text-sm text-center" x-text="day"></span>
                                  </button>
                              </template>
                          </div>
                      </div>

                  </template>
              </div>
              <x-ui.validation-error for="event.days" />
          </div>
      </x-ui.modal>
  </div>

  @push('scripts')
      <script data-swup-reload-script>
          function eventEdit() {
              return {
                  modal: false,

                  date: new Date(),

                  startTime: {
                      h: 0,
                      m: 0
                  },

                  endTime: {
                      h: 23,
                      m: 59
                  },

                  category: '',

                  reoccuring: false,

                  frequency: null,

                  days: [],

                  errorMessages: @entangle('errorMessages'),

                  init: function() {
                      this.daysToggle(this.date.toLocaleString('default', {
                          weekday: 'short'
                      }));

                      this.$watch('date', (value, oldVal) => {
                          this.$wire.setDate(
                              value.getFullYear() + '-' + String(value.getMonth() + 1).padStart(2, '0') +
                              '-' + String(value.getDate()).padStart(2, '0')
                          )

                          if (oldVal)
                              this.daysToggle(oldVal.toLocaleString('default', {
                                  weekday: 'short'
                              }))
                          this.daysToggle(value.toLocaleString('default', {
                              weekday: 'short'
                          }))
                      });

                      this.$watch('startTime', (value) => {
                          this.$wire.setStartTime(value);
                      });

                      this.$watch('endTime', (value) => {
                          if (value.h < 12 && this.startTime.h >= 12) {
                              value.h = value.h + 12;
                              this.endTime = value;
                          }

                          this.$wire.setEndTime(value);
                      });
                  },

                  updateContent: function($wire) {
                      //snack('Loading');
                      this.currentDay = $wire.dayOfWeekValue;

                      $wire.getReoccuring().then(result => {
                          this.reoccuring = result;
                      });

                      $wire.getDate().then(result => {
                          date = new Date(result);
                          date.setDate(date.getDate() + 1);
                          this.date = date;
                      }).then(
                          $wire.getStartTime().then(result => {
                              result = result.split(':');
                              this.startTime.h = parseInt(result[0]);
                              this.startTime.m = parseInt(result[1])

                          }).then(
                              $wire.getEndTime().then(result => {
                                  result = result.split(':');
                                  this.endTime.h = parseInt(result[0]);
                                  this.endTime.m = parseInt(result[1])
                              })
                          )
                      ).finally(() => {
                          this.category = $wire.get('event.category');
                          this.frequency = $wire.get('frequency');
                          $wire.getDays().then(result => {
                              this.days = result;
                          });

                          this.modal = true;
                      });
                  },

                  validDate: function(date) {
                      return date >= new Date();
                  },

                  daysToggle: function(e) {
                      var index = this.days.indexOf(e);
                      if (index !== -1 && !this.isCurrentWeekday(e))
                          this.days.splice(index, 1);
                      else
                          this.days.push(e);
                  },

                  isCurrentWeekday: function(val) {
                      return val == this.date.toLocaleString('default', {
                          weekday: 'short'
                      });
                  },
              }
          }
      </script>
  @endpush
