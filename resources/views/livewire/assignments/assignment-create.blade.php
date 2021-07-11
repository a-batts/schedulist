<div x-data="{
  modal: false,
  offline: false
}"
@offline.window="offline = true"
@online.window="online = true"
@close-assignment-modal.window="modal=false"
class="mdc-typography">
  @if (Auth::User()->num_classes > 0)
  <div class="fab_button">
    <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Assignment" @click="modal = true; fixBody()">
      <div class="mdc-fab__ripple"></div>
      <span class="material-icons mdc-fab__icon">add</span>
      <span class="mdc-fab__label">Add Assignment</span>
    </button>
  </div>
  @endif
  <div class="inset-0 bg-gray-500 opacity-75 modal_skim" style="display: none" id="createskim" x-show="modal"></div>
  <div class="add_class_div mt-7" x-show="modal" x-transition:enter="ease-out duration-100" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
  x-transition:leave="ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" x-cloak>
    <form wire:submit.prevent="save">
      <div class="mdc-card mdc-card--outlined addclass_card assignment_card" id="app">
        <div class="toprowcontainer">
          <div class="assignment_add_leftrow">
              <button class="mdc-icon-button close-icon material-icons closeleft" type="button" aria-describedby="close-tooltip" x-on:click="modal = false; undoFixBody()" v-on:click="menu = false; menu2 = false; resetFormElements()" aria-label="close">close</button>
            <h1 class="closeright mdc-typography--headline6 nunito">New Assignment</h1>
          </div>
          <div id="close-tooltip" class="mdc-tooltip" role="tooltip" aria-hidden="true">
            <div class="mdc-tooltip__surface">
              Close
            </div>
          </div>
          <div class="addbutton">
            <button class="mdc-button mdc-button--raised mdc-button-ripple" type="submit" aria-label="Add" x-bind:disabled="offline" wire:ignore>
              <span class="mdc-button__ripple"></span>Add
            </button>
          </div>
        </div>
        <div>
          @if($errors->any())
             <div class="alertmessage" style="height: {{count($errors) * 24 + 20}}px">
               <div style="width:24px; float:left">
                 <span class="material-icons">error</span>
               </div>
               <div style="width: calc(100% - 24px); float:right">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li class="addmessage ml-2" wire:key="{{$error}}">{{$error}}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          @endif
        </div>
        <div class="mb-2">
          <div class="float-left" style="width:50%" wire:ignore>
            <label class="mdc-text-field mdc-text-field--filled" style="width: 100%">
              <span class="mdc-text-field__ripple"></span>
              <input type="text" class="mdc-text-field__input" aria-labelledby="name-label" wire:model.debounce.300ms="name" required>
              <span class="mdc-floating-label">Assignment Title</span>
              <span class="mdc-line-ripple"></span>
            </label>
          </div>
          <div class="float-right mb-8" style="width:48%" wire:ignore>
            <div class="mdc-select mdc-select--filled mdc-select--required w-full">
              <div class="mdc-select__anchor"
                   role="button"
                   aria-haspopup="listbox"
                   aria-expanded="false"
                   aria-required="true"
                   aria-labelledby="demo-label demo-selected-text">
                <span class="mdc-select__ripple"></span>
                <span id="demo-label" class="mdc-floating-label">Class Period</span>
                <span class="mdc-select__selected-text-container">
                  <span id="demo-selected-text" class="mdc-select__selected-text"></span>
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
                  @foreach($usersClasses as $classes)
                    <li class="mdc-list-item" data-value="{{$classes->period}}" wire:key="{{$classes->period}}" wire:click="setClass({{$classes->period}})">
                      <span class="mdc-list-item__ripple"></span>
                      <span class="mdc-list-item__text">{{$classes->period}}: {{$classes->name}}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          @livewire('assignments.assignment-due')
          <label class="mdc-text-field mdc-text-field--filled w-full" >
            <span class="mdc-text-field__ripple"></span>
            <input type="URL" class="mdc-text-field__input" aria-labelledby="class_link-label" wire:model.debounce.300ms="link">
            <span class="mdc-floating-label">Assignment Link</span>
            <span class="mdc-line-ripple"></span>
          </label>
          <label class="mdc-text-field mdc-text-field--filled mdc-text-field--textarea mdc-text-field--with-internal-counter mt-5 mb-10" style="width: 100%;" wire:ignore>
            <span class="mdc-floating-label" id="my-label-id">Assignment Description</span>
            <textarea class="mdc-text-field__input" aria-labelledby="my-label-id" rows="6" wire:model.debounce.300ms="description" required></textarea>
            <span class="mdc-line-ripple"></span>
          </label>
        </div>
      </form>
    </div>
  </div>
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
            date: new Date(new Date().setDate(new Date().getDate() + 1)).toISOString().substr(0, 10),
            menu: false,
            modal: false,
            time: '23:59',
            menu2: false,
            modal2: false,
          }),
          methods: {
              disablePastDates(val) {
                 return val >= new Date(new Date().setDate(new Date().getDate() + 1)).toISOString().substr(0, 10)
              },
              methodThatForcesUpdate: function() {
                this.$forceUpdate();
              },
              resetFormElements: function(){
                this.time = '23:59';
                this.date = new Date(new Date().setDate(new Date().getDate() + 1)).toISOString().substr(0, 10);
              },
              emitTime() {
                Livewire.emit('updateTime', this.time);
              },
              emitDate() {
                Livewire.emit('updateDate', this.date);
              }
          },
          computed: {
              time2: {
                  get(){
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
                  set(newVal){
                      this.value = newVal;
                  }
              },
              date2: {
                get(){
                  return this.date.substring(5,7)*1 + "/" + this.date.substring(8,10)*1 + "/" + this.date.substring(0,4);
                },
                set(newVal){
                    this.value = newVal;
                }
              }
          }
        })
        Livewire.on('setTime', time => {
          vueApp.setTime(time);
        });
        Livewire.on('setDate', date => {
          vueApp.setDate(date);
        });
  </script>
@endpush
