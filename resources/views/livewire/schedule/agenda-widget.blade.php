<div class="w-full" id="agenda" x-data="schedule()" @agenda-data-updated.window="fetchNewData()">
    <div class="mdc-elevation--z2 agenda-header flex w-full pt-2 pb-3 pl-6 md:pr-5">
        <div class="flex self-center flex-grow space-x-2 md:ml-16">
            <div class="w-full">
                <p class="text-sm font-bold sm:text-xl"
                    x-text="view == 'day' ? date.format('MMMM D, YYYY') : date.format('MMMM YYYY')"
                    :class="{ 'agenda-date-active': isToday && view == 'day', 'md:text-2xl': view == 'day' }"></p>
                <p class="mt-1 text-sm text-gray-500 md:text-base" x-text="view == 'day' ? date.format('dddd') : ''"></p>
                <template x-if="view == 'week'">
                    <div class="grid w-full grid-cols-7 -ml-1 select-none">
                        <template x-for="day in weekDays">
                            <div class="flex items-center justify-center w-full space-x-2 font-medium text-center">
                                <span x-text="day.format('ddd')"></span>
                                <div class="flex items-center justify-center w-8 h-8 rounded-full cursor-pointer"
                                    @click="jumpToDate(day)"
                                    :class="{ 'bg-primary-theme': day.format('YYYY-MM-DD') == new dayjs().format('YYYY-MM-DD') }">
                                    <p x-text="day.date()"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
        <div class="flex flex-none items-center space-x-1 self-center pr-3 sm:w-[19.5rem] sm:space-x-3 sm:pl-6"
            wire:ignore>
            <x-agenda.event-invitations />

            <button class="mdc-icon-button material-icons hidden md:block" aria-describedby="toggle-view"
                @click="toggleView()">
                <div class="mdc-icon-button__ripple"></div>
                <span x-text="view == 'week' ? 'calendar_view_day' : 'calendar_view_week' "></span>
            </button>

            <button class="mdc-icon-button material-icons" aria-describedby="backward-day" @click="backwardDay()">
                <div class="mdc-icon-button__ripple"></div>
                chevron_left
            </button>

            <button class="mdc-button mdc-button--outlined" aria-describedby="jump-today" @click="setDate(new dayjs())"
                :disabled="isToday">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label">Today</span>
            </button>

            <button class="mdc-icon-button material-icons" aria-describedby="forward-day" @click="forwardDay()">
                <div class="mdc-icon-button__ripple"></div>
                chevron_right
            </button>

            <button class="mdc-icon-button material-icons -ml-1 md:hidden" aria-describedby="show-menu"
                @click="showingSideMenu = !showingSideMenu">
                <div class="mdc-icon-button__ripple"></div>
                menu_open
            </button>
        </div>
    </div>
    <div class="agenda-sidebar float-right w-full origin-right overflow-y-scroll sm:!block sm:w-[20rem] md:overflow-hidden"
        x-show="showingSideMenu" x-transition>
        <div class="p-6 border-b border-gray-200">
            <x-agenda.mini-calendar />
        </div>
        <div class="px-6 py-4 overflow-y-scroll">
            <h4 class="mb-4 text-xl font-semibold">Filter Events</h4>
            <template x-for="(category, index) in filterCategories">
                <div class="-ml-3">
                    <div class="mdc-checkbox mdc-checkbox--touch" @click="filterToggle(category)">
                        <input class="mdc-checkbox__native-control" type="checkbox" :id="'checkbox-' + category"
                            :checked="!filter.includes(category)">
                        <div class="mdc-checkbox__background">
                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                <path class="mdc-checkbox__checkmark-path" fill="none"
                                    d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                            </svg>
                            <div class="mdc-checkbox__mixedmark"></div>
                        </div>
                        <div class="mdc-checkbox__ripple"></div>
                    </div>
                    <label class="agenda-filter-label w-full mr-2 -ml-2 capitalize" :for="'checkbox-' + category"
                        x-text="filterPlurals[index]"></label>
                </div>
            </template>
        </div>
    </div>
    <div class="agenda-padding sm:px-6 lg:px-8" wire:ignore>
        <div class="outer-agenda-container relative pb-8 overflow-x-hidden overflow-y-scroll"
            style="height: calc(100vh - 154px);" x-ref="outerAgenda">
            <div class="inner-agenda-container">
                @for ($i = 0; $i < 24; $i++)
                    <div class="agenda-clockslot float-left pr-2">
                        <p class="mb-2 -mt-2 text-xs text-right text-gray-400 align-middle">
                            @if ($i == 12)
                                12 PM
                            @elseif($i == 0)
                            @else
                                {{ $i % 12 }}@if ($i < 12)
                                    AM
                                @else()
                                    PM
                                @endif
                            @endif
                        </p>
                    </div>
                    <div class="agenda-timeslot float-right"></div>
                @endfor

                <div class="relative h-full ml-12">
                    <div class="absolute grid h-full" style="width:calc(100%)"
                        :class="{ 'grid-cols-7': view == 'week' }">
                        <template x-for="(day, index) in weekDays">
                            <div class="week-column relative w-full h-full transition-all border-solid"
                                :class="{
                                    'border-l': index != 0 && view == 'week',
                                    'hidden': view == 'day' && day.format('YYYY-MM-DD') != date
                                        .format('YYYY-MM-DD')
                                }">
                                <template x-if="day.format('YYYY-MM-DD') == new dayjs().format('YYYY-MM-DD')">
                                    <div class="absolute z-[4] flex w-full items-center"
                                        :style="`top: ${todaySeconds -5}px`;">
                                        <div class="bg-primary-theme w-4 h-4 -mr-1 rounded-full"></div>
                                        <div class="bg-primary-theme h-0.5 w-full"></div>
                                    </div>
                                </template>

                                <template x-for="(item, index) in agenda[day.year()][day.format('M')][day.date()] ?? []"
                                    :key="index">
                                    <!-- prettier-ignore-attribute :style -->
                                    <div class="transition-width mdc-card mdc-card--outlined agenda-item absolute w-full transition-colors"
                                        @click="setSelectedItem(index, day)"
                                        :class="`${'background-' + getItemColor(item.id, item.color)} ${'agenda-item-' + index  }`"
                                        :style="`top: ${item.top}px; width: calc(${item.width}% - .25rem ); left: calc(${item.left}% + .25rem); height: calc(${item.bottom}px - ${item.top}px); z-index: ${item.height}; min-height: 80px`"
                                        x-show="! filter.includes(`${item.type}`)" x-transition>
                                        <div class="mdc-card__primary-action h-full pt-4 pb-2" tabindex="0"
                                            :class="`${ view == 'day' ? 'px-5' : 'px-3'}`">
                                            <p class="agenda-text-primary mb-2 font-medium"
                                                :class="{
                                                    'text-xl ': view == 'day',
                                                    'overflow-x-hidden': view ==
                                                        'week'
                                                }"
                                                x-text="item.name"></p>
                                            <p class="agenda-text-secondary mdc-typography--body2 transition-all">
                                                <span x-text="item.startString"></span>
                                                <template x-if="item.endString != null">
                                                    <span x-text="' - ' + item.endString"></span>
                                                </template>
                                            </p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Agenda context menu -->
    <x-agenda.agenda-popup />

    <x-ui.tooltip tooltip-id="jump-today" text="Jump to Today" />
    <x-ui.tooltip tooltip-id="backward-day" text="Previous Day" />
    <x-ui.tooltip tooltip-id="forward-day" text="Next Day" />
    <x-ui.tooltip tooltip-id="inbox" text="View event invitations" />
    <x-ui.tooltip tooltip-id="toggle-view" text="Toggle between day and week view" />
</div>

@push('scripts')
    <script data-swup-reload-script>
        function schedule() {
            return {
                agenda: @entangle('agenda'),

                currentDayData: [],

                selectedItem: -1,

                showingDetails: false,

                selectedItemData: [],

                showingSideMenu: false,

                popupHeight: -200,

                filter: [],

                colorPicker: false,

                selectedColor: 'blue',

                eventColors: [],

                view: @json($view),

                init: function() {
                    this.$refs.outerAgenda.scrollTop = this.todaySeconds;
                    this.date = new dayjs({{ $initDate->timestamp * 1000 }});
                    this.filterCategories = ['assignment', 'class', 'event'];
                    this.filterPlurals = ['assignments', 'classes', 'your events'];
                },

                setDate: function(d) {
                    this.date = d;
                    this.updateURL();
                    this.$dispatch('update-current-date')

                    if (this.agenda?.[d.year()]?.[d.format('M')] != undefined) {
                        const nextMonth = d.startOf('month').add(1, 'month');
                        const prevMonth = d.startOf('month').subtract(1, 'month');

                        if (this.agenda?.[nextMonth.year()]?.[nextMonth.format('M')] == undefined)
                            this.$wire.getMonthData(nextMonth).then((result) => {
                                if (this.agenda[nextMonth.year()] == undefined)
                                    this.agenda[nextMonth.year()] = [];
                                this.agenda[nextMonth.year()][nextMonth.format('M')] = result
                            });

                        if (this.agenda?.[prevMonth.year()]?.[prevMonth.format('M')] == undefined)
                            this.$wire.getMonthData(prevMonth).then((result) => {
                                if (this.agenda[prevMonth.year()] == undefined)
                                    this.agenda[prevMonth.year()] = [];
                                this.agenda[prevMonth.year()][prevMonth.format('M')] = result
                            });
                    } else {
                        this.fetchNewData();
                    }
                },

                forwardDay: function() {
                    this.setDate(this.date.add(1, this.view));
                },

                backwardDay: function() {
                    this.setDate(this.date.subtract(1, this.view));
                },

                setSelectedItem: function(index, date) {
                    this.selectedItem = index;
                    this.selectedItemData = this.agenda[date.year()][date.format('M')][date.date()][index];
                    let obj = document.querySelector('.agenda-item-' + index).getBoundingClientRect();
                    this.popupHeight = obj.top + window.scrollY;
                    if (this.popupHeight + 240 > document.body.clientHeight)
                        this.popupHeight = document.body.clientHeight - 260;
                    if (this.popupHeight < 170)
                        this.popupHeight = 170;
                    this.showingDetails = true;
                    this.colorPicker = false;
                    this.selectedColor = this.getItemColor(this.selectedItemData.id, this.selectedItemData.color);
                    disableScroll();
                },

                closeDetails: function() {
                    this.showingDetails = false;
                    this.selectedItem = -1;
                    this.popupHeight = -200;
                    enableScroll();
                },

                filterToggle: function(e) {
                    e = e.toLowerCase();

                    if (this.filterCategories.includes(e)) {
                        if (this.filter.includes(e)) {
                            const search = (element) => element == e;
                            var i = this.filter.findIndex(search);
                            this.filter.splice(i, i + 1);
                        } else
                            this.filter.push(e);
                    }
                },

                updateEventColor: function(color) {
                    this.selectedColor = color;
                    this.eventColors[this.selectedItemData.id] = color;

                    //Update event color through fetch
                    fetch(window.location.origin + '/event', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            "Content-Type": "application/json",
                            "accept": "application/json",
                            "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content,
                        },
                        body: JSON.stringify({
                            id: this.selectedItemData.id,
                            color: color
                        })
                    }).then((response) => {
                        if (response.ok) {}
                    })
                },

                getItemColor: function(id, color) {
                    if (this.eventColors[id] != undefined)
                        return this.eventColors[id];
                    if (color != undefined)
                        return color;
                    return 'blue';
                },

                fetchNewData: function() {
                    this.$wire.getAgendaData(this.date).then((result) => {
                        this.agenda = result;
                    })
                },

                jumpToDate: function(date) {
                    this.view = 'day';
                    this.setDate(new dayjs(date.toISOString()));
                },

                toggleView: function() {
                    this.view = this.view == 'week' ? 'day' : 'week';
                    this.updateURL();
                },

                updateURL: function() {
                    let url = window.location.href;
                    url = url.split('/');
                    url.splice(4);
                    url[4] = this.date.format('M');
                    url[5] = this.date.date();
                    url[6] = this.date.year();

                    //Append week to the URL if in week view
                    if (this.view == 'week')
                        url[7] = 'week';
                    url = url.join('/');
                    window.history.replaceState({}, 'Agenda | ' + this.dateString, url);
                    document.title = 'Agenda | ' + this.dateString;
                },

                get isToday() {
                    return this.date.format('YYYY-MM-DD') == new dayjs().format('YYYY-MM-DD');
                },

                get dateString() {
                    return this.date.format('ddd MMMM D, YYYY');
                },

                get todaySeconds() {
                    const dt = new Date();
                    return Math.round((dt.getSeconds() + (60 * (dt.getMinutes() + (60 * dt.getHours())))) /
                        {{ $scaleFactor }});
                },

                get weekDays() {
                    const start = this.date.startOf('week');
                    const days = [];
                    for (i = 0; i < 7; i++)
                        days.push(start.add(i, 'days'));
                    return days;
                }
            }
        }
    </script>
@endpush
