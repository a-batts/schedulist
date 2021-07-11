<div x-data="eventCreate()"
x-init="days.push($wire.dayOfWeekValue); currentDay = $wire.dayOfWeekValue; init($watch)"
x-on:swap-button-state.window="showingButton = !showingButton"
x-on:toggle-day.window="
if(! days.includes(event.detail.newDay))
  days.push(event.detail.newDay)
currentDay = event.detail.newDay
var index = days.indexOf(event.detail.oldDay);
if (index !== -1)
  days.splice(index, 1);"
class="mdc-typography">
  <x-ui.modal alpine="dialog" title="New Event" action="Add" classes="-top-16" x-on:click="$wire.set('event.reoccuring', reoccuring); $wire.set('event.frequency', frequency); $wire.set('event.days', days); $wire.create()">
    <label class="mdc-text-field mdc-text-field--filled w-4/5" x-bind:class="{'mdc-text-field--invalid': errorMessages['event.name'] != undefined}" wire:ignore>
      <span class="mdc-text-field__ripple"></span>
      <span class="mdc-floating-label" id="event-name-label">Event Name</span>
      <input class="mdc-text-field__input" wire:model.lazy="event.name" type="text" aria-labelledby="event-name-label" required>
      <span class="mdc-line-ripple"></span>
    </label>
    <x-ui.validation-hint :message="$errorMessages" for="event.name"/>
    <x-ui.select text="Event Category" var="Category" type="filled" :data="$categories" class="w-4/5" required/>
    <x-ui.validation-hint :message="$errorMessages" for="event.category"/>

    @livewire('schedule.event-create-picker-vue')

    <div>
      <div class="mdc-checkbox">
       <input type="checkbox"
              class="mdc-checkbox__native-control"
              id="create-check"
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
      <x-ui.select text="Repeat every" alpine="frequency" type="filled" :data="$frequencies" x-bind:class="{'mdc-select--invalid': errorMessages['event.frequency'] != undefined}" class="w-3/5" required/>
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

  <div class="fab_button" x-show.transition="showingButton">
    <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Event" x-on:click="dialog = true; vueApp.resetInputs()">
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
        showingButton: true,
        dialog: false,
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
          $watch('dialog', value => {
            document.body.classList.toggle('overflow-y-hidden');
            document.getElementById('agenda').classList.toggle('fixed');
          });
        }
      }
    }

  </script>
@endpush
