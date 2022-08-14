<div x-data="schedule()"
  @update-current-date.window="stopLoading(); agenda = @this.agenda; currentDayData = agenda[day]"
  @offline.window = "online = false"
  @online.window = "online = true"
  id="agenda"
  class="mdc-typograpy w-full"
  >
  <div class="mdc-elevation--z2 agenda-header -mt-4 flex w-full pt-2 pb-3 pl-6 md:pr-5">
    <div class="ml-16 flex flex-grow space-x-2 self-center">
      <div>
        <p x-text="headerDate" class="text-2xl font-bold" x-bind:class="{ 'agenda-date-active': isToday}"></p>
        <p x-text="dayOfWeek" class="mt-1 text-gray-500"></p>
      </div>
    </div>
    <div class="flex flex-none items-center self-center pr-3" wire:ignore>
      <button class="mdc-icon-button material-icons -ml-1" @click="backwardDay()" aria-describedby="backward-day">
        <div class="mdc-icon-button__ripple"></div>
        chevron_left
      </button>
      
      <button class="mdc-button mdc-button--outlined mx-4" @click="resetDate()" x-bind:disabled="isToday" aria-describedby="jump-today">
        <span class="mdc-button__ripple"></span>
        <span class="mdc-button__label">Today</span>
      </button>
      
      <button class="mdc-icon-button material-icons -ml-1" @click="forwardDay()" aria-describedby="forward-day">
        <div class="mdc-icon-button__ripple"></div>
        chevron_right
      </button>
      
      <button class="mdc-icon-button material-icons -ml-1 md:hidden" @click="showingMenu = !showingMenu; $dispatch('swap-button-state')" aria-describedby="show-menu">menu_open</button>
    </div>
  </div>
  <div class="agenda-sidebar float-right w-full origin-right sm:w-[20rem]">
    <div class="border-b border-gray-200 p-6">
      <x-agenda.mini-calendar/>
    </div>
    <div class="overflow-y-scroll px-6 py-4">
      <h4 class="mb-4 text-xl font-semibold">Filter Events</h4>
      <template x-for="(category, index) in filterCategories">
        <div class="-ml-3">
          <div class="mdc-checkbox mdc-checkbox--touch" @click="filterToggle(category)">
            <input type="checkbox"
                   class="mdc-checkbox__native-control"
                   :id="'checkbox-' + category" x-bind:checked="! filter.includes(category)">
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
          <label :for="'checkbox-' + category" class="agenda-filter-label mr-2 -ml-2 w-full capitalize" x-text="filterPlurals[index]"></label>
        </div>
      </template>
    </div>
  </div>
  <div class="agenda-padding sm:px-6 lg:px-8" wire:ignore>
    <div class="mdc-typography outer-agenda-container relative overflow-y-scroll pb-8" style="height: calc(100vh - 154px);">
      <div class="inner-agenda-container">
        @for ($i=0; $i < 24; $i++)
          <div class="agenda-clockslot float-left pr-2">
            <p class="mb-2 -mt-2 text-right align-middle text-xs text-gray-400">@if($i == 12) 12PM @elseif($i == 0) @else {{($i % 12)}}@if($i < 12)AM @else()PM @endif @endif</p>
          </div>
          <div class="agenda-timeslot float-right"></div>
        @endfor

        <div class="relative mx-2.5">
          <template x-if="currentDayData != null">
            <template x-for="(item, index) in currentDayData" :key="index">
              <div class="mdc-card mdc-card--outlined agenda-item absolute ml-12 mr-2 transition-all"
              x-on:click="setSelectedItem(index)"
              x-bind:class="`${'background-' + getItemColor(item.id, item.color)} ${'agenda-item-' + index  }`"
              x-bind:style="`top: ${item.top}px;
              left: ${item.left}px;
              height: calc(${item.bottom}px - ${item.top}px);
              width: calc(100% - ${item.left + 55}px);
              z-index: ${item.height};
              min-height: 80px;`"
              x-show="! filter.includes(`${item.type}`)"
              x-transition>
                <div class="mdc-card__primary-action h-full px-6 pt-4 pb-2" tabindex="0">
                  <p class="agenda-text-primary truncate text-xl font-medium transition-all" x-text="item.name"></p>
                  <p class="agenda-text-secondary mdc-typography--body2 transition-all">
                    <span x-text="item.startString"></span>
                    <template x-if="item.endString != null">
                      <span x-text="' - ' + item.endString"></span>
                    </template>
                  </p>
                </div>
              </div>
            </template>
          </template>
        </div>
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
    function schedule(){
      return {
        online: navigator.onLine,
        agenda: @this.agenda,
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
        init: function () {
          this.selectedItemData.name = '';
          this.selectedItemData.color = '';
          this.selectedItemData.link = '';
          this.date = new Date({{$initDate->timestamp * 1000}})
          this.currentDayData = this.agenda[this.day];
        },
        setDate: function (d){
          if (this.date.getMonth() != d.getMonth() || this.date.getYear() != d.getYear()){
            this.currentDayData = null;
            @this.setDate(d);
            startLoading();
          }
          this.date = d;
          this.updateURL();
          this.currentDayData = @this.agenda[this.day];
        },
        resetDate: function () {
          this.setDate(new Date());          
        },
        forwardDay: function () {
          let nextDay = new Date(this.date.getTime());
          nextDay.setDate(nextDay.getDate() + 1);
          this.setDate(nextDay);
        },
        backwardDay: function () {
          let prevDay = new Date(this.date.getTime());  
          prevDay.setDate(prevDay.getDate() - 1);
          this.setDate(prevDay);
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
          e = e.toLowerCase();

          if (this.filterCategories.includes(e)){
            if(this.filter.includes(e)){
              const search = (element) => element == e;
              var i = this.filter.findIndex(search);
              this.filter.splice(i, i + 1);
            }
            else
              this.filter.push(e);
          }
        },
        openColorPicker: function (){
          this.selectedColor = this.getItemColor(this.selectedItemData.id, this.selectedItemData.color);
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
          this.eventColors[this.selectedItemData.id] = e;
          Livewire.emit('updateEventColor', {'id': this.selectedItemData.id, 'color': e});
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
          window.history.replaceState({}, 'Agenda | ' + this.dateString , url);
          document.title = 'Agenda | ' + this.dateString;
        },
        get isToday (){
          return this.date.toDateString() == new Date().toDateString();
        },
        get day (){
          return this.date.getDate();
        },
        get dayOfWeek (){
          return this.date.toLocaleString('default', { weekday: 'long' });
        },
        get dateString (){
          return this.date.toLocaleString('default', { weekday: 'short' }) + ", " + this.date.toLocaleString('default', { month: 'long' }) + " " + this.date.getDate() + ", " + this.date.getFullYear();
        },
        get month (){
          return this.date.toLocaleString('default', { month: 'long' });
        },
        get year (){
          return this.date.getFullYear();
        },
        get headerDate (){
          return this.date.toLocaleString('default', { month: 'long' }) + " " + this.date.getDate() + ", " + this.date.getFullYear();
        },
        get filterCategories(){
          return ['assignment', 'class', 'event'];
        },
        get filterPlurals(){
          return ['assignments', 'classes', 'your events'];
        }
      }
    }
  </script>
@endpush