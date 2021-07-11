<div x-data="eventEdit()"
x-init="init($watch)"
x-on:toggle-day.window="
if(! days.includes(event.detail.newDay))
  days.push(event.detail.newDay)
currentDay = event.detail.newDay
var index = days.indexOf(event.detail.oldDay);
if (index !== -1)
  days.splice(index, 1);"
x-on:update-content.window="updateContent($wire)"
x-on:close-dialog="edit = false"
class="mdc-typography">
    <x-ui.modal alpine="edit" title="Edit Event" action="Save" classes="-top-16" x-on:click="$wire.set('event.reoccuring', reoccuring); $wire.set('event.frequency', frequency); $wire.set('event.days', days); $wire.edit()">
    <label class="mdc-text-field mdc-text-field--filled w-4/5" x-bind:class="{'mdc-text-field--invalid': errorMessages['event.name'] != undefined}" wire:ignore>
      <span class="mdc-text-field__ripple"></span>
      <span class="mdc-floating-label mdc-floating-label--float-above" id="event-name-label">Event Name</span>
      <input class="mdc-text-field__input" wire:model.lazy="event.name" type="text" aria-labelledby="event-name-label" required>
      <span class="mdc-line-ripple"></span>
    </label>
    <x-ui.validation-hint :message="$errorMessages" for="event.name"/>
    <x-ui.select text="Event Category" var="Category" type="filled" :data="$categories" :default="$event->category" class="w-4/5" prefilled required/>
    <x-ui.validation-hint :message="$errorMessages" for="event.category"/>

    @livewire('schedule.event-edit-picker-vue')

    <div>
      <div class="mdc-checkbox">
       <input type="checkbox"
              class="mdc-checkbox__native-control"
              id="edit-check"
              x-on:click="reoccuring = !reoccuring" x-bind:checked="reoccuring"/>
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
     <label for="create-check" style="vertical-align: 6px">Make this event reoccuring</label>
    </div>

    <div class="py-3" x-show.transition="reoccuring" x:cloak>
      <x-ui.select text="Repeat every" alpine="frequency" type="filled" :default="$event->frequency" :data="$frequencies" x-bind:class="{'mdc-select--invalid': errorMessages['event.frequency'] != undefined}" class="w-3/5" required prefilled/>
      <x-ui.validation-hint :message="$errorMessages" for="event.frequency"/>
      <div wire:ignore>
        <template x-if="frequency == 'Week' || frequency == 'Two Weeks'">
          <div class="mt-5 ml-1">
            <span>Repeat event on</span>
            <div class="mt-3 h-10" wire:ignore>
              @foreach($days as $day)
                <button class="rounded-full mdc-icon-button w-8 h-8 day-selector select-none float-left mr-2" x-bind:class="{'day-selector-selected': days.includes('{{$day}}') && currentDay != '{{$day}}'}" x-on:click="daysToggle('{{$day}}')" wire:key="{{$day}}" x-bind:disabled="currentDay == '{{$day}}'" type="button" >
                  <div class="mdc-icon-button__ripple"></div>
                  <span class="text-center text-sm day-selector-text">{{$day}}</span>
                </button>
              @endforeach
            </div>
          </div>

        </template>
      </div>
      <x-ui.validation-hint :message="$errorMessages" for="event.days"/>
    </div>
  </x-ui.modal>
</div>

@push('scripts')
  <script>
    function eventEdit(){
      return {
        showingButton: true,
        edit: false,
        reoccuring: false,
        frequency: null,
        currentDay: null,
        days: [],
        errorMessages: @entangle('errorMessages'),
        daysToggle: function (e){
          var index = this.days.indexOf(e);
          if (index !== -1)
            this.days.splice(index, 1);
          else
            this.days.push(e);
        },
        init: function ($watch){
          $watch('edit', value => {
            document.body.classList.toggle('overflow-y-hidden');
            document.getElementById('agenda').classList.toggle('fixed');
          });
        },
        updateContent: function ($wire){
          snack('Loading');
          this.currentDay = $wire.dayOfWeekValue;
          $wire.getReoccuring()
            .then(result => { this.reoccuring = result });
          $wire.getFrequency()
            .then(result => { this.frequency = result });
          $wire.getDays()
            .then(result => { this.days = result.split(',')});
          $wire.getStartTime()
            .then(result => { vueApp.startTime = result});
          $wire.getEndTime()
            .then(result => { vueApp.endTime = result});
          $wire.getDate()
            .then(result => { vueApp.date = result; this.edit = true; snackbar.close() });
        }
      }
    }

  </script>
@endpush
