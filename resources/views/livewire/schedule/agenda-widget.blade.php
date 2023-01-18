<div class="w-full" id="agenda" x-data="schedule()" @agenda-data-updated.window="fetchNewData()">
    @livewire('schedule.event-create')
    @livewire('schedule.event-edit')

    <div class="fixed w-full" wire:ignore>
        <div class="mdc-elevation--z2 agenda-header flex w-full pt-2 pb-3 pl-6 md:pr-5">
            <div class="flex self-center flex-grow space-x-2 md:ml-16">
                <div class="w-full">
                    <p class="text-sm font-medium transition-all sm:text-lg"
                        :class="{ 'agenda-date-active': isToday && view == 'day', 'md:text-2xl': view == 'day' }">
                        <span x-show="view == 'day'" x-text="date.format('MMMM D, YYYY')"></span>
                        <span x-show="view == 'week'">
                            <span x-text="weekDays[0].format('MMMM D')"></span><span
                                x-text="weekDays[0].year() != weekDays[6].year() ? `, ${weekDays[0].year()}` : ''"></span>
                            -
                            <span
                                x-text="weekDays[0].month() == weekDays[6].month() ? weekDays[6].format('D') : weekDays[6].format('MMMM D')"></span>,
                            <span x-text="weekDays[6].year()"></span>
                        </span>
                    </p>
                    <p class="mt-1 text-sm text-gray-500 md:text-base"
                        x-text="view == 'day' ? date.format('dddd') : ''">
                    </p>
                    <template x-if="view == 'week'">
                        <div class="grid w-full grid-cols-7 pt-2 -ml-1 select-none">
                            <template x-for="day in weekDays">
                                <div
                                    class="flex items-center justify-center w-full space-x-2 text-center text-gray-600">
                                    <span x-text="day.format('ddd')"></span>
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full cursor-pointer"
                                        @click="jumpToDate(day)"
                                        :class="{
                                            'bg-primary-theme': day.format('YYYY-MM-DD') == new dayjs().format(
                                                'YYYY-MM-DD')
                                        }">
                                        <p x-text="day.date()"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
            <div class="flex flex-none items-center space-x-1 self-center pr-3 sm:w-[19.5rem] sm:space-x-3 sm:pl-6">
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

                <button class="mdc-button mdc-button--outlined" aria-describedby="jump-today"
                    @click="setDate(new dayjs())" :disabled="isToday">
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
            <div class="p-6">
                <x-agenda.mini-calendar />
            </div>
        </div>
        <div class="agenda-padding sm:px-6 lg:px-8">
            <div class="outer-agenda-container relative pb-8 overflow-x-hidden overflow-y-scroll"
                style="height: calc(100vh - 154px);" x-ref="outerAgenda">
                <div class="inner-agenda-container relative">
                    <div class="absolute w-full">
                        @for ($i = 0; $i < 24; $i++)
                            <div class="flex">
                                <div
                                    class="agenda-clockslot pr-2 mb-2 -mt-2 text-xs text-right text-gray-400 align-middle select-none">
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
                                </div>
                                <div class="agenda-timeslot"></div>
                            </div>
                        @endfor
                    </div>

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

                                    <template
                                        x-for="(item, index) in agenda?.[day.year()]?.[day.format('M')]?.[day.date()] ?? []"
                                        :key="index">
                                        <x-agenda.item />
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            <x-agenda.agenda-popup />
        </div>
        <!-- Agenda context menu -->

        <x-ui.tooltip tooltip-id="jump-today" text="Jump to Today" />
        <x-ui.tooltip tooltip-id="backward-day" text="Previous Day" />
        <x-ui.tooltip tooltip-id="forward-day" text="Next Day" />
        <x-ui.tooltip tooltip-id="inbox" text="View event invitations" />
        <x-ui.tooltip tooltip-id="toggle-view" text="Toggle between day and week view" />
    </div>
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

                popupPos: 'left: 0px',

                colorPicker: false,

                selectedColor: 'blue',

                eventColors: [],

                view: @json($view),

                init: function() {
                    this.$refs.outerAgenda.scrollTop = this.todaySeconds;
                    this.date = new dayjs({{ $initDate->timestamp * 1000 }});
                },

                setDate: function(d) {
                    this.date = d;
                    this.updateURL();
                    this.$dispatch('update-current-date')

                    if (this.agenda?.[d.year()]?.[d.format('M')] != undefined) {
                        const nextMonth = d.startOf('month').add(1, 'month');
                        const prevMonth = d.startOf('month').subtract(1, 'month');

                        if (this.agenda?.[nextMonth.year()]?.[nextMonth.format('M')] == undefined)
                            this.$wire.getMonthData(nextMonth);

                        if (this.agenda?.[prevMonth.year()]?.[prevMonth.format('M')] == undefined)
                            this.$wire.getMonthData(prevMonth);
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

                setSelectedItem: function(index, date, $event) {
                    this.selectedItem = index;
                    this.selectedItemData = this.agenda[date.year()][date.format('M')][date.date()][index];

                    const obj = document.querySelector('.agenda-item-' + index).getBoundingClientRect();
                    this.popupHeight = obj.top + window.scrollY;
                    if (this.popupHeight + 240 > document.body.clientHeight)
                        this.popupHeight = document.body.clientHeight - 260;
                    if (this.popupHeight < 170)
                        this.popupHeight = 170;

                    const width = document.body.clientWidth;
                    if (width >= '768') {
                        if (this.view == 'week') {
                            if ($event.clientX < (width / 2))
                                this.popupPos = `left: ${$event.clientX}px`;
                            else
                                this.popupPos = `right: ${(width - $event.clientX)}px; left: auto`;
                        } else {
                            this.popupPos = `left: ${width / 2}px`;
                        }
                    }

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
                    this.$wire.fetchAgendaData(this.date.format('YYYY-MM-DD'));
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
                    return this.date.format('ddd, MMMM D, YYYY');
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
