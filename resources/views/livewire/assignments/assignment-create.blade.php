<div x-data="{
  dialog: false,
  offline: false,
  errorMessages: @entangle('errorMessages'),
}"
@offline.window="offline = true"
@online.window="online = true"
@close-assignment-modal.window="modal=false"
class="mdc-typography">
  <div class="fab-button">
    <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Assignment" @click="dialog = true; fixBody()">
      <div class="mdc-fab__ripple"></div>
      <span class="material-icons mdc-fab__icon">add</span>
      <span class="mdc-fab__label">New Assignment</span>
    </button>
  </div>

  <x-ui.modal alpine="dialog" title="New Assignment" action="Add" classes="top-4" wire:submit.prevent="create">
    <div>
      <div class="w-1/2 pr-1.5 float-left">
        <label class="mdc-text-field mdc-text-field--filled w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['assignment.assignment_name'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label" id="assignment-name-label">Assignment Name</span>
          <input class="mdc-text-field__input" wire:model.lazy="assignment.assignment_name" type="text" aria-labelledby="assignment-name-label" required>
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error :message="$errorMessages" for="assignment.assignment_name"/>
      </div>
      <div class="w-1/2 pl-1.5 float-right">
        <div class="mdc-select mdc-select--filled w-full" wire:ignore>
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
            <ul class="mdc-list dark-theme-list" role="listbox">
              @foreach($classes as $x)
                <li class="mdc-list-item" role="option" data-value="{{$x['id']}}" wire:click="setClass({{$x['id']}})">
                  <span class="mdc-list-item__ripple"></span>
                  <span class="mdc-list-item__text">
                    {{$x['name']}}
                  </span>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="h-14 -mt-1 block">
      @livewire('assignments.assignment-due')
    </div>
    <x-ui.validation-error :message="$errorMessages" for="assignment.due"/>

    <label class="mdc-text-field mdc-text-field--filled w-full mt-1" x-bind:class="{'mdc-text-field--invalid': errorMessages['assignment.assignment_link'] != undefined}" wire:ignore>
      <span class="mdc-text-field__ripple"></span>
      <span class="mdc-floating-label" id="assignment-link-label">Assignment Link</span>
      <input class="mdc-text-field__input" wire:model.lazy="assignment.assignment_link" type="text" aria-labelledby="assignment-link-label">
      <span class="mdc-line-ripple"></span>
    </label>
    <x-ui.validation-error :message="$errorMessages" for="assignment.assignment_link"/>

    <label class="mdc-text-field mdc-text-field--filled mdc-text-field--textarea mdc-text-field--with-internal-counter w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['assignment.description'] != undefined}" wire:ignore>
      <span class="mdc-floating-label" id="assignment-description-label">Assignment Description</span>
      <textarea class="mdc-text-field__input" aria-labelledby="assignment-description-label" rows="6" wire:model.lazy="assignment.description" required></textarea>
      <span class="mdc-line-ripple"></span>
    </label>
    <x-ui.validation-error :message="$errorMessages" for="assignment.description"/>
  </x-ui.modal>
</div>

@push('scripts')
  <script src="https://cdn.jsdelivr.net/gh/livewire/vue@v0.3.x/dist/livewire-vue.js"></script>
  <script>
        var vueApp = new Vue({
          el: '#app',
          vuetify: new Vuetify({
              icons: {
                iconfont: 'md',
              },
            }),
          data: () => ({
            date: new Date().toISOString().substr(0, 10),
            menu: false,
            time: '23:59',
            menu2: false,
          }),
          methods: {
              disablePastDates(val) {
                 return val >= new Date().toISOString().substr(0, 10)
              },
              resetFormElements: function(){
                this.time = '23:59';
                this.date = new Date().toISOString().substr(0, 10);
              },
              emitTime() {
                Livewire.emit('setTime', this.time);
              },
              emitDate() {
                Livewire.emit('setDate', this.date);
              }
          },
          computed: {
              formattedTime: function() {
                var split = this.time.split(":");
                split[0] = split[0] * 1;
                if (split[0] == 12){
                  split = split.join(":");
                  return split + " PM";
                }
                if (split[0] > 12){
                  split[0] -= 12;
                  split = split.join(":");
                  return split + " PM";
                }
                if (split[0] == 0)
                  split[0] +=12;
                split = split.join(":");
                return split + " AM";
              },
              formattedDate: function() {
                return this.date.substring(5,7)*1 + "/" + this.date.substring(8,10)*1 + "/" + this.date.substring(0,4);
              }
          }
        })
  </script>
@endpush
