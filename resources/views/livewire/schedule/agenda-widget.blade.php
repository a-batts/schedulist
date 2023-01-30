<div class="w-full" id="agenda" x-data="schedule()" @agenda-data-updated.window="fetchNewData()">
    @livewire('schedule.event-create')
    @livewire('schedule.event-edit')

    <div class="fixed w-full" wire:ignore>
        <div class="mdc-elevation--z2 agenda-header flex w-full pt-2 pb-3 pl-6 md:pr-5">
            <div class="mt-2 flex flex-grow space-x-2 self-center md:ml-16">
                <div class="w-full">
                    <p class="font-medium sm:text-lg"
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
                    <p class="mt-1 text-xs text-gray-500 md:text-base"
                        x-text="view == 'day' ? date.format('dddd') : ''">
                    </p>
                    <template x-if="view == 'week'">
                        <div class="-ml-1 grid w-full select-none grid-cols-7 pt-2 text-sm lg:text-base">
                            <template x-for="day in weekDays">
                                <div
                                    class="flex w-full items-center justify-center space-x-0.5 text-center text-gray-600 lg:space-x-2">
                                    <span x-text="day.format('ddd')"></span>
                                    <div class="flex h-6 w-6 cursor-pointer items-center justify-center rounded-full lg:h-8 lg:w-8"
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

                <button class="mdc-button" aria-describedby="jump-today" @click="setDate(new dayjs())"
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
        <div class="agenda-sidebar float-right w-full flex-1 origin-right overflow-y-scroll sm:!flex sm:w-[20rem] sm:flex-col sm:overflow-hidden"
            x-show="showingSideMenu" x-ref="sidebar" x-transition>
            <div class="p-6">
                <x-agenda.mini-calendar />
            </div>
            <div class="mt-4 flex-grow overflow-y-auto border-t border-gray-200 py-8">
                <div class="px-6">
                    <p class="mb-2 text-xl font-bold">Your calendars</p>
                    <template x-for="(item, index) in userCalendars">
                        <div class="mdc-form-field w-full">
                            <div class="mdc-checkbox" @click="toggleFilter(index)">
                                <input class="mdc-checkbox__native-control" type="checkbox" :id="index"
                                    :checked="!filters.includes(index)" />
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none"
                                            d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                                <div class="mdc-checkbox__ripple"></div>
                            </div>
                            <label class="text-primary" :for="index" x-text="item"></label>
                        </div>
                    </template>

                    <div class="pt-4">
                        <p class="mb-2 text-xl font-bold">Other calendars</p>
                        <div class="mdc-form-field w-full">
                            <div class="mdc-checkbox" @click="toggleFilter('shared-event')">
                                <input class="mdc-checkbox__native-control" id="shared-checkbox" type="checkbox"
                                    :checked="!filters.includes('shared-event')" checked />
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none"
                                            d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                                <div class="mdc-checkbox__ripple"></div>
                            </div>
                            <label class="text-primary" for="shared-checkbox">Shared events</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="agenda-padding sm:px-6 lg:px-8">
            <div class="outer-agenda-container relative overflow-x-hidden overflow-y-scroll pb-20 sm:pb-12"
                style="height: calc(100vh - 154px);" x-ref="outerAgenda">
                <div class="inner-agenda-container relative">
                    <div class="absolute w-full">
                        @for ($i = 0; $i < 24; $i++)
                            <div class="flex">
                                <div
                                    class="agenda-clockslot mb-2 -mt-2 select-none pr-2 text-right align-middle text-xs text-gray-400">
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

                    <div class="relative ml-12 h-full">
                        <div class="absolute grid h-full" style="width:calc(100%)"
                            :class="{ 'grid-cols-7': view == 'week' }">
                            <template x-for="(day, index) in weekDays">
                                <div class="week-column relative h-full w-full border-solid transition-all"
                                    :class="{
                                        'border-l': index != 0 && view == 'week',
                                        'hidden': view == 'day' && day.format('YYYY-MM-DD') != date
                                            .format('YYYY-MM-DD')
                                    }">
                                    <template x-if="day.format('YYYY-MM-DD') == new dayjs().format('YYYY-MM-DD')">
                                        <div class="absolute z-[4] flex w-full items-center"
                                            :style="`top: ${todaySeconds -5}px`;">
                                            <div class="bg-text -mr-1 h-4 w-4 rounded-full"></div>
                                            <div class="bg-text h-0.5 w-full"></div>
                                        </div>
                                    </template>

                                    <template
                                        x-for="(item, index) in agenda?.[day.year()]?.[day.format('M')]?.[day.date()].filter((item) => !filters.includes(item.type)) ?? []"
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

                popupDate: new dayjs(),

                colorPicker: false,

                selectedColor: 'blue',

                eventColors: [],

                view: @json($view),

                filters: [],

                init: function() {
                    this.$refs.outerAgenda.scrollTop = this.todaySeconds;
                    this.date = new dayjs({{ $initDate->timestamp * 1000 }});
                    this.userCalendars = {
                        assignment: 'Assignments',
                        class: 'Classes',
                        event: 'Your events'
                    }
                },

                setDate: function(d) {
                    this.date = d;
                    this.updateURL();
                    this.$dispatch('update-current-date')

                    if (this.agenda?.[d.year()]?.[d.format('M')] != undefined) {
                        const nextMonth = d.startOf('month').add(1, 'month');
                        const prevMonth = d.startOf('month').subtract(1, 'month');

                        if (this.agenda?.[nextMonth.year()]?.[nextMonth.format('M')] == undefined)
                            this.$wire.fetchMonthData(nextMonth);

                        if (this.agenda?.[prevMonth.year()]?.[prevMonth.format('M')] == undefined)
                            this.$wire.fetchMonthData(prevMonth);
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
                    this.popupDate = date;

                    const clickedElement = $event.srcElement.getBoundingClientRect();
                    const popupBox = this.$refs.popupBox;
                    const navHeight = document.getElementById('navbar').offsetHeight;

                    const w = this.$refs.outerAgenda.offsetWidth;
                    const h = this.$refs.outerAgenda.offsetHeight;

                    if (clickedElement.bottom - navHeight < h / 2) {
                        popupBox.style.top = (clickedElement.bottom - navHeight) + 'px';
                        popupBox.style.bottom = 'auto';
                    } else {
                        popupBox.style.top = 'auto';
                        popupBox.style.bottom = (document.body.clientHeight - clickedElement.top + 20) + 'px';
                    }

                    if (document.body.clientWidth >= '768') {
                        if (this.view == 'week') {
                            if (clickedElement.right < w / 2) {
                                popupBox.style.left = clickedElement.right + 'px';
                                popupBox.style.right = 'auto';
                            } else {
                                popupBox.style.left = 'auto';
                                popupBox.style.right = (clickedElement.left - this.$refs.sidebar.offsetWidth) + 'px';
                            }
                        }
                    }
                    this.showingDetails = true;
                    this.colorPicker = false;
                    this.selectedColor = this.getItemColor(this.selectedItemData.id, this.selectedItemData.color);
                    this.disableScroll();
                },

                closeDetails: function() {
                    this.showingDetails = false;
                    this.selectedItem = -1;
                    this.popupHeight = -200;
                    this.enableScroll();
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

                toggleFilter: function(name) {
                    this.filters = this.filters.includes(name) ?
                        this.filters.filter(el => el != name) : [...this.filters, name];
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

                disableScroll: function() {
                    const container = this.$refs.outerAgenda;
                    const scrollTop = container.scrollTop;
                    container.onscroll = function() {
                        container.scrollTo(container.scrollLeft, scrollTop);
                    }
                    window.addEventListener('touchmove', this.preventDefault, {
                        passive: false
                    });
                },

                enableScroll: function() {
                    this.$refs.outerAgenda.onscroll = function() {};
                    window.removeEventListener('touchmove', this.preventDefault, {
                        passive: false
                    });
                },

                preventDefault: function(e) {
                    e.preventDefault();
                },

                get isToday() {
                    return this.date.format('YYYY-MM-DD') == new dayjs().format('YYYY-MM-DD');
                },

                get dateString() {
                    return this.popupDate.format('ddd, MMMM D, YYYY');
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
