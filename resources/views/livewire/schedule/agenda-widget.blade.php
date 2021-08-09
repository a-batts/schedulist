<div x-data="agenda($wire)"
x-init="initDate($wire)"
@update-current-date.window="stopLoading(); agenda = @this.monthAgenda; currentDayData = agenda[day]"
@offline.window = "online = false"
@online.window = "online = true"
id="agenda"
class="w-full"
>
  <div class="pb-3 pt-2 -mt-4 mdc-elevation--z2 w-full md:pr-5 agenda-header mdc-typograpy">
    <p class="text-3xl font-bold uppercase text-gray-700 ml-8 -mb-12 mt-4" x-text="month"></p>
    <div class="agenda-current-date text-gray-500 ml-2">
      <p class="text-sm font-bold uppercase ml-24 mt-4 w-10 text-center" x-text="dayOfWeek" x-bind:class="{ 'agenda-date-active': date.toDateString() == new Date().toDateString()}"></p>
      <p class="text-xl tracking-wide ml-24 w-10 text-center" x-text="day" x-bind:class="{ 'agenda-date-active': date.toDateString() == new Date().toDateString()}"></p>
    </div>
    <div class="float-right -mt-12 mr-3">
      <button class="mdc-icon-button material-icons" wire:ignore @click="resetDate()" x-bind:disabled="date.toDateString() == new Date().toDateString()" aria-describedby="jump-today">today</button>
      <button class="mdc-icon-button material-icons -ml-1" wire:ignore @click="backwardDay()" aria-describedby="backward-day">chevron_left</button>
      <button class="mdc-icon-button material-icons -ml-1" wire:ignore @click="forwardDay()" aria-describedby="forward-day">chevron_right</button>
      <button class="mdc-icon-button material-icons -ml-1" wire:ignore @click="showingMenu = !showingMenu; $dispatch('swap-button-state')" aria-describedby="show-menu">menu_open</button>
    </div>
  </div>
  <div class="float-right w-full sm:w-72 agenda-sidebar overflow-y-scroll" x-show.transition.origin.center.right="showingMenu" x-cloak>
    <div class="px-5 pt-5 pb-2 sidebar-line-header">
      <p class="font-medium text-lg ml-2 mb-2 mdc-typography nunito">Agenda Options</p>
      <a href="{{route('schedule-settings')}}"><button class="mdc-icon-button material-icons float-right -mt-12 -mr-4" wire:ignore aria-describedby="settings">settings</button></a>
    </div>
    <div class="px-5 pb-5 pt-2">
      <p class="font-medium mt-2 ml-2 mb-2 mdc-typography">Filter Displayed Events</p>
      <div>
        <div class="mdc-checkbox mdc-checkbox--touch cb-green" @click="filterToggle('Assignment')">
          <input type="checkbox"
                 class="mdc-checkbox__native-control"
                 id="checkbox-2"/ x-bind:checked="! filter.includes('Assignment')">
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
        <label for="checkbox-2" class="-ml-2 w-full mr-2 agenda-filter-label">Assignments</label>
      </div>
      <div class="-mt-2">
        <div class="mdc-checkbox mdc-checkbox--touch cb-red" @click="filterToggle('Class')">
          <input type="checkbox"
                 class="mdc-checkbox__native-control"
                 id="checkbox-1"/ x-bind:checked="! filter.includes('Class')">
          <div class="mdc-checkbox__background">
            <svg class="mdc-checkbox__checkmark"
                 viewBox="0 0 24 24">
              <path class="mdc-checkbox__checkmark-path"
                    fill="none"
                    d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
            </svg>
            <div class="mdc-checkbox__mixedmark"></div>
          </div>
          <div class="mdc-checkbox__ripple"fi></div>
        </div>
        <label for="checkbox-1" class="-ml-2 w-full mr-2 agenda-filter-label">Classes</label>
      </div>
      <div class="-mt-2">
        <div class="mdc-checkbox mdc-checkbox--touch cb-blue" @click="filterToggle('Event')">
          <input type="checkbox"
                 class="mdc-checkbox__native-control"
                 id="checkbox-3"/ x-bind:checked="! filter.includes('Event')">
          <div class="mdc-checkbox__background">
            <svg class="mdc-checkbox__checkmark"
                 viewBox="0 0 24 24">
              <path class="mdc-checkbox__checkmark-path"
                    fill="none"
                    d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
            </svg>
            <div class="mdc-checkbox__mixedmark"></div>
          </div>
          <div class="mdc-checkbox__ripple"fi></div>
        </div>
        <label for="checkbox-3" class="-ml-2 w-full mr-2 agenda-filter-label">Other Events</label>
      </div>
    </div>
  </div>
  <div class="sm:px-6 lg:px-8 agenda-padding" wire:ignore>
    <div class="mdc-typography outer-agenda-container relative overflow-y-scroll" style="height: calc(100vh - 154px);">
      <div class="inner-agenda-container">
        @for ($i=0; $i < 24; $i++)
          <div class="float-left agenda-clockslot">
            <p class="text-xs align-middle text-gray-500">@if($i == 12) 12 PM @elseif($i == 0) @else {{($i % 12)}} @if($i < 12) AM @else PM @endif @endif</p>
          </div>
          <div class="agenda-timeslot float-right"></div>
        @endfor

        <template x-if="currentDayData != null">
          <template x-for="(item, index) in currentDayData" :key="index">
            <div class="mdc-card mdc-card--outlined agenda-item mx-0 ml-12 mr-2 absolute"
            x-on:click="setSelectedItem(index)"
            x-bind:class="`${'background-' + getItemColor(item['id'], item['color'])} ${'agenda-item-' + index  }`"
            x-bind:style="`top: ${item['top']}px;
            left: ${item['left']}px;
            height: calc(${item['bottom']}px - ${item['top']}px);
            width: calc(100% - ${item['left'] + 55}px);
            z-index: ${item['height']}`"
            x-show="! filter.includes(`${item['type']}`)">
              <div class="mdc-card__primary-action px-5 pt-2.5 pb-2 h-full" tabindex="0">
                <p class="agenda-text-primary font-medium truncate" x-text="item['title']"></p>
                <p class="agenda-text-secondary mdc-typography--body2">
                  <span x-text="item['start']"></span>
                  <template x-if="item['end'] != null">
                    <span x-text="' - ' + item['end']"></span>
                  </template>
                </p>
              </div>
            </div>
          </template>
        </template>
      </div>
    </div>
  </div>
  <!-- Agenda context menu -->
  <x-agenda.agenda-context/>
  <x-agenda.agenda-color-menu/>

  <x-ui.tooltip tooltip-id="jump-today" text="Jump to Today"/>
  <x-ui.tooltip tooltip-id="backward-day" text="Previous Day"/>
  <x-ui.tooltip tooltip-id="forward-day" text="Next Day"/>
  <x-ui.tooltip tooltip-id="show-menu" text="Menu"/>
  <x-ui.tooltip tooltip-id="settings" text="Schedule Settings"/>
</div>

@push('scripts')
  <script>
    function agenda($wire){
      return {
        online: navigator.onLine,
        agenda: @this.monthAgenda,
        date: new Date(),
        selectedItem: -1,
        agendaContext: false,
        selectedItemData: [],
        showingMenu: false,
        popupHeight: -200,
        colorPopupHeight: -200,
        filter: [],
        colorPicker: false,
        selectedColor: 'blue',
        eventColors: [],
        initDate: function ($wire) {
          this.selectedItemData['title'] = '';
          this.selectedItemData['color'] = '';
          this.selectedItemData['link'] = '';
          this.date = new Date({{$initDate->timestamp * 1000}})
          this.currentDayData = this.agenda[this.day];
        },
        resetDate: function () {
          let today = new Date();
          if (this.date.getMonth() != today.getMonth() || this.date.getYear() != today.getYear()){
            this.currentDayData = null;
            @this.setDate(today);
            startLoading();
          }
          this.date = new Date();
          this.updateURL();
          this.currentDayData = this.agenda[this.day];
        },
        forwardDay: function () {
          let tomorrow = new Date(this.date.getTime());
          tomorrow.setDate(tomorrow.getDate() + 1);
          if (this.date.getMonth() != tomorrow.getMonth() || this.date.getYear() != tomorrow.getYear()){
            this.currentDayData = null;
            @this.setDate(tomorrow);
            startLoading();
          }
          this.date.setDate(this.date.getDate() + 1);
          this.updateURL()
          this.currentDayData = this.agenda[this.day];
        },
        backwardDay: function () {
          let yesterday = new Date(this.date.getTime());
          yesterday.setDate(yesterday.getDate() - 1);
          if (this.date.getMonth() != yesterday.getMonth() || this.date.getYear() != yesterday.getYear()){
            let x = new Date(this.date.getTime());
            x.setDate(x.getDate() - 5);
            @this.setDate(x);
            startLoading();
          }
          this.date.setDate(this.date.getDate() - 1);
          this.updateURL()
          this.currentDayData = this.agenda[this.day];
        },
        setSelectedItem: function (e) {
          this.selectedItem = e;
          this.selectedItemData = this.agenda[this.day][e];
          let obj = document.querySelector('.agenda-item-' + e).getBoundingClientRect();
          this.popupHeight = obj.top + window.scrollY;
          if (this.popupHeight +  200 > document.body.clientHeight)
            this.popupHeight = document.body.clientHeight - 220;
          if (this.popupHeight < 260)
            this.popupHeight = 260;
          this.agendaContext = true;
          this.colorPicker = false;
          disableScroll();
        },
        closeDetails: function (){
          this.agendaContext = false;
          this.selectedItem = -1;
          this.popupHeight = -200;
          enableScroll();
        },
        filterToggle: function (e){
          if(this.filter.includes(e)){
            const search = (element) => element == e;
            var i = this.filter.findIndex(search);
            this.filter.splice(i, i + 1);
          }
          else
            this.filter.push(e);
        },
        openColorPicker: function (){
          this.selectedColor = this.getItemColor(this.selectedItemData['id'], this.selectedItemData['color']);
          let obj = document.querySelector('.agenda-item-' + this.selectedItem).getBoundingClientRect();
          this.colorPopupHeight = obj.top + window.scrollY;
          if (this.colorPopupHeight +  200 > document.body.clientHeight)
            this.colorPopupHeight = document.body.clientHeight - 220;
          if (this.colorPopupHeight < 260)
            this.colorPopupHeight = 260;
          this.popupHeight = -200;
          this.colorPicker = true;
          this.agendaContext = false;
        },
        updateEventColor: function (e){
          var index = this.selectedItem;
          this.selectedColor = e;
          this.eventColors[this.selectedItemData['id']] = e;
          Livewire.emit('updateEventColor', {'id': this.selectedItemData['id'], 'color': e});
        },
        getItemColor: function (id, color){
          if (this.eventColors[id] != undefined)
            return this.eventColors[id];
          if (color != undefined)
            return color;
          return 'blue';
        },
        updateURL: function (){
          let url = window.location.href;
          url = url.split('/');
          url.splice(4);
          url[4] = this.date.getMonth() + 1;
          url[5] = this.day;
          url[6] = this.date.getFullYear();
          url = url.join('/');
          window.history.pushState({}, 'Agenda | ' + this.date.toDateString() , url);
          document.title = 'Agenda | ' + this.date.toDateString();
        },
        get dayOfWeek (){
          return this.date.toLocaleString('default', { weekday: 'short' });
        },
        get month (){
          return this.date.toLocaleString('default', { month: 'short' });
        },
        get day (){
          return this.date.getDate();
        },
        get dateString (){
          return this.date.toLocaleString('default', { weekday: 'long' }) + ", " + this.date.toLocaleString('default', { month: 'long' }) + " " + this.date.getDate() + ", " + this.date.getFullYear();
        }
      }
    }
  </script>
@endpush
