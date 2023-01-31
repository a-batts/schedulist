<div x-data="classList" wire:ignore>
    @livewire('dashboard.class-edit')
    @livewire('dashboard.class-delete')

    <div class="mt-16 px-4 md:px-24">
        <p class="text-3xl font-semibold">All of your classes</p>
        <div class="mt-5 mb-10 border-t border-gray-200"></div>
        <div class="mdc-select mdc-select--filled alpine-select mb-6 w-full md:max-w-sm">
            <div class="mdc-select__anchor" role="button" aria-haspopup="listbox" aria-expanded="false">
                <span class="mdc-select__ripple"></span>
                <span class="mdc-floating-label mdc-floating-label--float-above">Sort by schedule</span>
                <span class="mdc-select__selected-text-container">
                    <span class="mdc-select__selected-text">All</span>
                </span>
                <span class="mdc-select__dropdown-icon">
                    <svg class="mdc-select__dropdown-icon-graphic" viewBox="7 10 10 5" focusable="false">
                        <polygon class="mdc-select__dropdown-icon-inactive" stroke="none" fill-rule="evenodd"
                            points="7 10 12 15 17 10">
                        </polygon>
                        <polygon class="mdc-select__dropdown-icon-active" stroke="none" fill-rule="evenodd"
                            points="7 15 12 10 17 15">
                        </polygon>
                    </svg>
                </span>
                <span class="mdc-line-ripple"></span>
            </div>
            <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
                <ul class="mdc-deprecated-list dark-theme-list" role="listbox">
                    <li class="mdc-deprecated-list-item mdc-deprecated-list-item--selected" role="option"
                        :data-value="-1" @click="sortSchedule = -1">
                        <span class="mdc-deprecated-list-item__ripple"></span>
                        <span class="mdc-deprecated-list-item__text">All
                        </span>
                    </li>
                    <template x-for="(schedule, index) in schedules">
                        <li class="mdc-deprecated-list-item" role="option" :data-value="index"
                            @click="sortSchedule = schedule.id">
                            <span class="mdc-deprecated-list-item__ripple"></span>
                            <span class="mdc-deprecated-list-item__text" x-text="schedule.name">
                            </span>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
        <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-3">
            <template x-for="(cl, index) in filteredClasses" :key="index">
                <div class="mdc-card mdc-card--outlined px-4 py-6 transition-colors md:px-8"
                    :class="'background-' + cl.color.toLowerCase()">
                    <div class="flex h-full">
                        <div class="flex-grow">
                            <p class="text-2xl font-semibold" x-text="cl.name"></p>
                            <span class="mt-1 inline-block text-lg tracking-normal" x-text="cl.teacher"></span>
                            <p class="mt-1 text-base" x-text="cl.location"></p>
                        </div>
                        <div class="flex items-center">
                            <button class="mdc-button mdc-button--icon-trailing text-black" @click="selectClass(index)">
                                <span class="mdc-button__ripple"></span>
                                <span class="mdc-button__label">Class details</span>
                                <i class="material-icons mdc-button__icon" aria-hidden="true">read_more</i>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <template x-if="classData.length < 1">
            <div class="flex flex-col items-center justify-center py-8">
                <p class="material-icons assignment-card-icon text-9xl">add_box</p>
                <p class="mt-4 text-2xl font-medium text-gray-400">Add a class to get started</p>
            </div>
        </template>
    </div>

    <div class="modal-skim inset-0 bg-gray-500 opacity-75" style="display: none" x-show="showingClassDetails" x-cloak>
    </div>
    <template x-if="hasClasses && classData[selectedClass] != undefined">
        <div>
            <div class="modal-container fixed top-0 flex h-screen w-screen items-baseline justify-center overflow-y-auto"
                style="display: none" x-show.important="showingClassDetails" x-trap.noscroll="showingClassDetails"
                @keydown.escape="showingClassDetails = false" x-transition x-cloak>
                <div class="mdc-card mdc-card--outlined mr-0 w-full max-w-full border-hidden sm:w-4/5 md:mt-10">
                    <div class="mdc-card mr-0 rounded-b-none border-hidden p-5"
                        :class="'background-' + classData?.[selectedClass]?.['color'].toLowerCase()">
                        <div class="flex h-full">
                            <div class="flex-grow">
                                <button class="mdc-icon-button material-icons" @click="showingClassDetails = false">
                                    <div class="mdc-icon-button__ripple"></div>
                                    close
                                </button>
                            </div>
                            <div>
                                <button class="mdc-icon-button material-icons" :disabled="offline"
                                    @click="$dispatch('edit-class', { id: classData?.[selectedClass]?.['id']}); showingClassDetails = false">
                                    <div class="mdc-icon-button__ripple"></div>
                                    edit
                                </button>
                            </div>
                        </div>
                        <div class="px-2 py-4">
                            <h2 class="text-4xl font-bold md:text-7xl" x-text="classData?.[selectedClass]?.['name']">
                            </h2>
                            <div class="flex">
                                <div class="flex-grow">
                                    <p class="mt-3 text-xl" x-text="classData?.[selectedClass]?.['teacher']"></p>
                                    <p class="mt-1 text-xl" x-text="classData?.[selectedClass]?.['location']"></p>
                                </div>
                                <div class="-mr-2">
                                    <a :class="{ 'pointer-events-none': classData?.[selectedClass]?.['teacher_email'] == null }"
                                        :href="'mailto:' + classData?.[selectedClass]?.['teacher_email']">
                                        <button class="mdc-icon-button material-icons"
                                            :disabled="classData?.[selectedClass]?.['teacher_email'] == null">
                                            <div class="mdc-icon-button__ripple"></div>
                                            email
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 pt-8">
                        <div class="border-b border-gray-200 pb-7">
                            <h3 class="text-2xl font-semibold">Links</h3>
                            <div class="mt-4">
                                <span class="mdc-evolution-chip-set" role="grid">
                                    <span class="mdc-evolution-chip-set__chips" role="presentation">
                                        <template x-for="(link, index) in classData?.[selectedClass]?.['links']">
                                            <span class="mdc-evolution-chip" role="row"
                                                :id="'c' + selectedClass + '' + index" :key="link.id">
                                                <span
                                                    class="mdc-evolution-chip__cell mdc-evolution-chip__cell--primary"
                                                    role="gridcell">
                                                    <a class="mdc-evolution-chip__action mdc-evolution-chip__action--primary"
                                                        tabindex="0" :href="link.link" target="_blank">
                                                        <span
                                                            class="mdc-evolution-chip__ripple mdc-evolution-chip__ripple--primary"></span>
                                                        <span
                                                            class="mdc-evolution-chip__icon mdc-evolution-chip__icon--leading material-icons mr-2 inline-block">link</span>
                                                        <span class="mdc-evolution-chip__text-label"
                                                            x-text="link.name"></span>
                                                    </a>
                                                    <span
                                                        class="mdc-evolution-chip__cell mdc-evolution-chip__cell--trailing mr-2"
                                                        role="gridcell">
                                                        <button
                                                            class="mdc-evolution-chip__action mdc-evolution-chip__action--trailing"
                                                            data-mdc-deletable="true" type="button"
                                                            aria-label="Remove link" tabindex="-1"
                                                            @click="removeLink(link.id)">
                                                            <span
                                                                class="mdc-evolution-chip__ripple mdc-evolution-chip__ripple--trailing"></span>
                                                            <span
                                                                class="mdc-evolution-chip__icon material-icons text-primary mdc-evolution-chip__icon--trailing">close</span>
                                                        </button>
                                                    </span>
                                                </span>
                                            </span>
                                        </template>
                                        <span class="mdc-evolution-chip" id="add-chip" role="row"> <span
                                                class="mdc-evolution-chip__cell mdc-evolution-chip__cell--primary"
                                                role="gridcell">
                                                <button
                                                    class="mdc-evolution-chip__action mdc-evolution-chip__action--primary"
                                                    tabindex="0" @click="showingLinkCreate = true">
                                                    <span
                                                        class="mdc-evolution-chip__ripple mdc-evolution-chip__ripple--primary"></span>
                                                    <span
                                                        class="mdc-evolution-chip__icon mdc-evolution-chip__icon--leading material-icons mr-2 inline-block">add</span>
                                                    <span class="mdc-evolution-chip__text-label">Add link</span>
                                                </button>
                                            </span>
                                        </span>

                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="pt-7 lg:grid lg:grid-cols-2">
                            <div class="lg:pr-5">
                                <template x-if="!classData?.[selectedClass]?.['schedule_id']">
                                    <div class="mt-1">
                                        <p>To set when this class takes place you must add it to a schedule</p>
                                        <div class="pt-4">
                                            <a class="mdc-button" class=""
                                                href="{{ route('schedule-settings') }}">
                                                <span class="mdc-button__ripple"></span>
                                                <span class="mdc-button__label">Create new schedule</span>
                                            </a>
                                        </div>
                                        <div class="mdc-select mdc-select--filled mt-6 w-full">
                                            <div class="mdc-select__anchor" role="button" aria-haspopup="listbox"
                                                aria-expanded="false">
                                                <span class="mdc-select__ripple"></span>
                                                <span class="mdc-floating-label mdc-floating-label--float-above">Your
                                                    schedules</span>
                                                <span class="mdc-select__selected-text-container">
                                                    <span class="mdc-select__selected-text"></span>
                                                </span>
                                                <span class="mdc-select__dropdown-icon">
                                                    <svg class="mdc-select__dropdown-icon-graphic" viewBox="7 10 10 5"
                                                        focusable="false">
                                                        <polygon class="mdc-select__dropdown-icon-inactive"
                                                            stroke="none" fill-rule="evenodd"
                                                            points="7 10 12 15 17 10">
                                                        </polygon>
                                                        <polygon class="mdc-select__dropdown-icon-active"
                                                            stroke="none" fill-rule="evenodd"
                                                            points="7 15 12 10 17 15">
                                                        </polygon>
                                                    </svg>
                                                </span>
                                                <span class="mdc-line-ripple"></span>
                                            </div>
                                            <div
                                                class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
                                                <ul class="mdc-deprecated-list dark-theme-list" role="listbox">
                                                    <template x-for="(schedule, index) in schedules">
                                                        <li class="mdc-deprecated-list-item" role="option"
                                                            :data-value="index"
                                                            @click="selectedSchedule = schedule.id">
                                                            <span class="mdc-deprecated-list-item__ripple"></span>
                                                            <span class="mdc-deprecated-list-item__text"
                                                                x-text="schedule.name">
                                                            </span>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="classData?.[selectedClass]?.['schedule_id']">
                                    <div>
                                        <div class="flex items-center">
                                            <div class="pb-4">
                                                <p class="text-2xl font-semibold"
                                                    x-text="schedules[classData?.[selectedClass]?.['schedule_id']]?.name">
                                                </p>
                                                <p class="mt-2 text-sm">
                                                    (<span
                                                        x-text="schedules[classData?.[selectedClass]?.['schedule_id']]?.human_start"></span>
                                                    -
                                                    <span
                                                        x-text="schedules[classData?.[selectedClass]?.['schedule_id']]?.human_end"></span>)
                                                </p>
                                            </div>
                                            <button class="mdc-icon-button material-icons ml-6"
                                                @click="changeSchedule()" :disabled="offline">
                                                <div class="mdc-icon-button__ripple"></div>
                                                edit
                                            </button>
                                        </div>
                                        <div class="mt-2 border-t border-gray-200 pt-2">
                                            <template
                                                x-for="(time, index) in classData?.[selectedClass]?.['times'].sort((a,b) => a.day_of_week - b.day_of_week)"
                                                :key="index">
                                                <div class="flex px-2 py-2">
                                                    <div class="flex flex-grow items-center">
                                                        <p>
                                                            <span x-text="time.day"></span>,
                                                            <span x-text="time.start"></span> - <span
                                                                x-text="time.end"></span>
                                                        </p>
                                                    </div>
                                                    <div class="">
                                                        <button class="mdc-icon-button material-icons"
                                                            @click="deleteClassTime(time.id)" :disabled="offline">
                                                            <div class="mdc-icon-button__ripple"></div>
                                                            do_not_disturb_on
                                                        </button>
                                                    </div>
                                                </div>
                                            </template>
                                            <div class="pt-3">
                                                <button class="mdc-button mdc-button--icon-leading" type="button"
                                                    @click="addTime = !addTime"
                                                    :disabled="classData?.[selectedClass]?.['times'].length >= 7">
                                                    <span class="mdc-button__ripple"></span>
                                                    <i class="material-icons mdc-button__icon"
                                                        aria-hidden="true">add_circle_outline</i>
                                                    <span class="mdc-button__label">Add time</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="space-y-3 pt-3" x-show="addTime" x-transition.origin.top x-cloak>
                                            <div class="mdc-select mdc-select--filled w-full">
                                                <div class="mdc-select__anchor" role="button"
                                                    aria-haspopup="listbox" aria-expanded="false">
                                                    <span class="mdc-select__ripple"></span>
                                                    <span
                                                        class="mdc-floating-label mdc-floating-label--float-above">Day
                                                        of
                                                        week</span>
                                                    <span class="mdc-select__selected-text-container">
                                                        <span class="mdc-select__selected-text"></span>
                                                    </span>
                                                    <span class="mdc-select__dropdown-icon">
                                                        <svg class="mdc-select__dropdown-icon-graphic"
                                                            viewBox="7 10 10 5" focusable="false">
                                                            <polygon class="mdc-select__dropdown-icon-inactive"
                                                                stroke="none" fill-rule="evenodd"
                                                                points="7 10 12 15 17 10">
                                                            </polygon>
                                                            <polygon class="mdc-select__dropdown-icon-active"
                                                                stroke="none" fill-rule="evenodd"
                                                                points="7 15 12 10 17 15">
                                                            </polygon>
                                                        </svg>
                                                    </span>
                                                    <span class="mdc-line-ripple"></span>
                                                </div>
                                                <div
                                                    class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
                                                    <ul class="mdc-deprecated-list dark-theme-list" role="listbox">
                                                        <template x-for="(item, index) in filteredDays">
                                                            <li class="mdc-deprecated-list-item" role="option"
                                                                :data-value="index" @click="newTimeDay = item">
                                                                <span class="mdc-deprecated-list-item__ripple"></span>
                                                                <span class="mdc-deprecated-list-item__text"
                                                                    x-text="item">
                                                                </span>
                                                            </li>
                                                        </template>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="flex space-x-3">
                                                <div class="w-full">
                                                    <x-ui.time-picker title="Start Time" bind="newTimeStart" />
                                                </div>

                                                <div class="w-full">
                                                    <x-ui.time-picker title="End Time" bind="newTimeEnd" />
                                                </div>
                                            </div>
                                            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg mdc-text-field-helper-text--persistent text-error ml-1 mt-0.5 mb-0.5 h-5"
                                                aria-hidden="true" x-text="error"></div>
                                            <div>
                                                <button class="mdc-button mdc-button--raised mdc-button-ripple"
                                                    type="button" @click="addClassTime()" :disabled="offline">
                                                    <span class="mdc-button__ripple"></span>
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <div class="pt-4 lg:pt-0 lg:pl-5">
                                <div>
                                    <h3 class="text-2xl font-semibold">Assignments</h3>
                                    <p class="mt-2 text-sm">Late or due in the next 30 days</p>
                                    <div class="pt-3">
                                        <template
                                            x-for="assignment in classData?.[selectedClass]?.['assignments'].filter((el, index) => {return el.status == 0 && (el.is_late || el.due_in_next_month) && index < assignmentCount})"
                                            :key="assignment.id">
                                            <div>
                                                <a :href="'/assignments/assignment/' + assignment.url_string">
                                                    <div class="mdc-card mdc-card--outlined mt-3">
                                                        <div class="mdc-card__primary-action assignment-card-dashboard flex truncate px-5"
                                                            tabindex="0">
                                                            <div class="flex-grow">
                                                                <p class="-mt-0.5 text-xl font-medium"
                                                                    x-text="assignment.name"></p>
                                                                <p class="mt-1 text-sm"
                                                                    :class="assignment.is_late ? 'text-red' : 'text-green'">
                                                                    Due <span x-text="assignment.human_due"></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </template>
                                        <template x-if="classData?.[selectedClass]?.['assignments'].length == 0">
                                            <div class="py-12 text-center text-gray-600">
                                                <h3 class="text-xl font-medium">You're all caught up!</h3>
                                                <p class="mt-2">Nothing due for this class in the next month.</p>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="pt-4">
                                        <a class="mdc-button" class=""
                                            :href="'assignments/' + classData?.[selectedClass]?.['id']">
                                            <span class="mdc-button__ripple"></span>
                                            <span class="mdc-button__label">View all</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    @livewire('dashboard.class-link-create')
</div>

@push('scripts')
    <script data-swup-reload-script>
        function classList() {
            return {
                classData: @entangle('classData'),

                schedules: @this.schedules,

                selectedClass: -1,

                showingClassDetails: false,

                showingLinkCreate: false,

                addTime: false,

                newTimeStart: {
                    h: new Date().getHours(),
                    m: new Date().getMinutes()
                },

                newTimeEnd: {
                    h: 23,
                    m: 59
                },

                newTimeDay: '',

                assignmentCount: 4,

                sortSchedule: -1,

                init: function() {
                    this.days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    const keys = Object.keys(this.classData);
                    this.selectedClass = keys[0] ?? -1;

                    this.error = '';

                    this.newTimeDay = this.days[0];

                    this.$nextTick(() => {
                        regenSelects('alpine-select');
                    });
                },

                changeSchedule: function() {
                    this.classData[this.selectedClass]['schedule_id'] = null;
                    regenSelects();
                },

                selectClass: function(index) {
                    this.selectedClass = index;
                    this.showingClassDetails = true;
                    regenSelects();
                },

                removeLink: function(id) {
                    this.$wire.removeLink(id).then((response) => {
                        if (response) {
                            this.classData[this.selectedClass]['links'] =
                                this.classData[this.selectedClass]['links']
                                .filter((el) =>
                                    el.id != id
                                );
                        } else
                            snack('Unable to remove link');
                    })
                },

                get hasClasses() {
                    return Object.keys(this.classData).length > 0;
                },

                get filteredDays() {
                    let usedDays = [];
                    if (this.selectedClass != -1 && this.classData[this.selectedClass] != undefined) {
                        this.classData[this.selectedClass]['times'].forEach((time) => {
                            usedDays.push(this.days[time.day_of_week]);
                        })
                    }

                    return this.days.filter((el) => {
                        return !usedDays.includes(el);
                    })
                },

                get filteredClasses() {
                    if (this.sortSchedule == -1)
                        return this.classData;

                    let filteredData = {};
                    for (const [key, value] of Object.entries(this.classData)) {
                        if (value.schedule_id == this.sortSchedule)
                            filteredData[key] = value;
                    }
                    return filteredData;
                },

                addClassTime: function() {
                    this.error = '';

                    const start = ''.concat(this.newTimeStart.h, ':', this.newTimeStart.m);
                    const end = ''.concat(this.newTimeEnd.h, ':', this.newTimeEnd.m);

                    fetch(window.location.origin + '/class/addtime', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            "Content-Type": "application/json",
                            "accept": "application/json",
                            "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content,
                        },
                        body: JSON.stringify({
                            start: start,
                            end: end,
                            day: this.newTimeDay,
                            class: this.selectedClass
                        })
                    }).then((response) => {
                        if (response.ok) {
                            let json = response.json().then((data) => {
                                this.classData[this.selectedClass]['times'].push(JSON.parse(data.data));
                                this.addTime = false;
                            });
                            this.$wire.emit('updateCurrentClass');
                        } else {
                            let json = response.json().then((data) => {
                                this.error = data.error
                            });
                        }
                    }).catch();
                },

                deleteClassTime: function(id) {
                    fetch(window.location.origin + '/class/removetime', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            "Content-Type": "application/json",
                            "accept": "application/json",
                            "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content,
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    }).then((response) => {
                        if (response.ok) {
                            const index = this.classData[this.selectedClass]['times'].findIndex((el) => el.id ==
                                id);
                            this.classData[this.selectedClass]['times'].splice(index, 1);
                            this.$wire.emit('updateCurrentClass');
                        }
                    })
                },

                set selectedSchedule(scheduleId) {
                    //Update class schedule through fetch
                    fetch(window.location.origin + '/class/setschedule', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            "Content-Type": "application/json",
                            "accept": "application/json",
                            "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content,
                        },
                        body: JSON.stringify({
                            class: this.selectedClass,
                            schedule: scheduleId
                        })
                    }).then((response) => {
                        if (response.ok) {
                            this.classData[this.selectedClass]['schedule_id'] = scheduleId;
                            regenSelects();
                        }
                    })
                },
            }
        }
    </script>
@endpush
