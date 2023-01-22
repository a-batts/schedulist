<div class="mdc-typography" x-data="eventCreate()" @close-create-modal.window="modal = false">
    <x-ui.modal class="top-4" title="Add event" bind="modal">
        <x-slot name="actions">
            <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" :disabled="offline"
                @click="submit()">
                <span class="mdc-button__ripple"></span>Save
            </button>
        </x-slot>

        <label class="mdc-text-field mdc-text-field--filled w-full"
            x-bind:class="{ 'mdc-text-field--invalid': errorMessages['event.name'] != undefined }" wire:ignore>
            <span class="mdc-text-field__ripple"></span>
            <span class="mdc-floating-label" id="event-name-label">Title</span>
            <input class="mdc-text-field__input" type="text" aria-labelledby="event-name-label"
                wire:model.lazy="event.name" required>
            <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error for="event.name" />

        <div class="flex gap-x-3">
            <div class="w-full">
                <x-ui.time-picker title="Starts" bind="startTime" />
                <x-ui.validation-error for="start_time" />

                <x-ui.date-picker title="On" bind="date" valid-date="validDate" />
                <x-ui.validation-error for="event.date" />
            </div>

            <div class="w-full">
                <x-ui.time-picker title="Ends" bind="endTime" />
                <x-ui.validation-error for="end_time" />
            </div>
        </div>
        <div class="w-full">
            <div class="flex items-center space-x-2">
                <div class="mdc-select mdc-select--filled mdc-select--with-leading-icon w-1/3" wire:ignore>
                    <div class="mdc-select__anchor">
                        <span class="mdc-select__ripple"></span>
                        <span class="mdc-floating-label mdc-floating-label--float-above">Repeats</span>
                        <span class="mdc-line-ripple"></span>
                        <i class="material-icons mdc-select__icon" role="button" tabindex="0">repeat</i>

                        <span class="mdc-select__selected-text-container">
                            <span class="mdc-select__selected-text" x-text="frequencies[frequency].name"></span>
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
                    </div>

                    <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
                        <ul class="mdc-deprecated-list dark-theme-list">
                            <template x-for="freq in frequencies">
                                <li class="mdc-deprecated-list-item" :data-value="freq.value"
                                    :class="{ 'mdc-deprecated-list-item--selected': frequency == freq.value }"
                                    @click="frequency = freq.value">
                                    <span class="mdc-deprecated-list-item__ripple"></span>
                                    <span class="mdc-deprecated-list-item__text" x-text="freq.name"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                    <x-ui.validation-error for="event.frequency" />
                </div>
                <p class="text-sm text-gray-600" x-show="frequency > 0" x-text="repeatString"></p>
                <button class="mdc-icon-button material-icons" type="button" x-show="frequency > 0"
                    @click="repeatModal = true">
                    <div class="mdc-icon-button__ripple"></div>
                    <span>edit</span>
                </button>
            </div>
            <div class="px-2 mt-6">

            </div>
        </div>

        <x-agenda.event-repeat />

        <div class="flex w-full gap-x-3">
            <div class="w-full">
                <div class="mdc-select mdc-select--filled w-full" wire:ignore>
                    <div class="mdc-select__anchor">
                        <span class="mdc-select__ripple"></span>
                        <span class="mdc-floating-label mdc-floating-label--float-above">Category</span>
                        <span class="mdc-line-ripple"></span>

                        <span class="mdc-select__selected-text-container">
                            <span class="mdc-select__selected-text"></span>
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
                    </div>
                    <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
                        <ul class="mdc-deprecated-list dark-theme-list">
                            @foreach ($categories as $category)
                                <li class="mdc-deprecated-list-item" data-value="{{ $category['value'] }}"
                                    wire:click="setCategory({{ $category['value'] }})">
                                    <span class="mdc-deprecated-list-item__ripple"></span>
                                    <span
                                        class="mdc-deprecated-list-item__text">{{ $category['formatted_name'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <x-ui.validation-error for="event.category" />
            </div>
            <div class="w-full">
                <label class="mdc-text-field mdc-text-field--filled w-full"
                    :class="{ 'mdc-text-field--invalid': errorMessages['event.location'] != undefined }" wire:ignore>
                    <span class="mdc-text-field__ripple"></span>
                    <span class="mdc-floating-label" id="event-location-label">Location</span>
                    <input class="mdc-text-field__input" type="text" aria-labelledby="event-location-label"
                        wire:model.lazy="event.location">
                    <span class="mdc-line-ripple"></span>
                </label>
                <x-ui.validation-error for="event.location" />
            </div>
        </div>

    </x-ui.modal>

    <div class="fab-button">
        <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Event" @click="openDialog()">
            <div class="mdc-fab__ripple"></div>
            <span class="material-icons mdc-fab__icon">add</span>
            <span class="mdc-fab__label">Add Event</span>
        </button>
    </div>
</div>

@push('scripts')
    <script data-swup-reload-script>
        function eventCreate() {
            return {
                modal: false,

                repeatModal: false,

                date: new Date(),

                endDate: new Date(),

                startTime: {
                    h: new Date().getHours(),
                    m: new Date().getMinutes()
                },

                endTime: {
                    h: 23,
                    m: 59
                },

                frequency: 0,

                interval: 1,

                repeatsForever: true,

                days: [],

                errorMessages: @entangle('errorMessages'),

                init: function() {
                    this.frequencies = @this.get('frequencies');

                    this.daysOfWeek = [];
                    this.$nextTick(() => {
                        this.daysOfWeek = this.$parent.weekDays;
                    })

                    this.$watch('date', (val, oldVal) => {
                        const oldDate = dayjs(oldVal) ?? null;
                        const newDate = dayjs(val);

                        //End date needs to be at least one day after the start date
                        if (newDate.add(1, 'day').toDate() >= this.endDate)
                            this.endDate = newDate.add(1, 'day').toDate()

                        this.$wire.setDate(newDate.format('YYYY-MM-DD'));

                        if (!this.modal) {
                            if (oldDate)
                                this.daysToggle(oldDate.day());
                            this.daysToggle(newDate.day());
                        }
                    });
                },

                submit: function() {
                    this.$wire.setDate(dayjs(this.date).format('YYYY-MM-DD'));
                    this.$wire.setEndDate(this.repeatsForever ? null : dayjs(this.endDate).format('YYYY-MM-DD'));
                    this.$wire.setStartTime(this.startTime);
                    this.$wire.setEndTime(this.endTime);
                    this.$wire.set('event.days', this.days);
                    this.$wire.set('event.frequency', this.frequency);
                    this.$wire.set('event.interval', this.interval);

                    this.$wire.create();
                },

                openDialog: function() {
                    if (dayjs().isSameOrBefore(this.$parent.date))
                        this.date = this.$parent.date.toDate();
                    this.endDate = dayjs(this.date).add(1, 'day').toDate();
                    this.days = [new dayjs(this.date.valueOf()).day()];
                    this.modal = true;
                },

                validDate: function(date) {
                    return date >= new Date();
                },

                validEndDate: function(date) {
                    return date > this.date;
                },

                daysToggle: function(day) {
                    var index = this.days.indexOf(day);
                    index !== -1 && !this.isCurrentWeekday(day) ? this.days.splice(index, 1) :
                        this.days.push(day);
                },

                isCurrentWeekday: function(val) {
                    return val == new dayjs(this.date).day();
                },

                set intervalInput(val) {
                    if (val < 1)
                        val == 1;

                    if (val % 1 != 0 || val > 99)
                        val = this.interval;

                    if (this.frequency == 1 && val % 7 == 0) {
                        this.frequency = this.frequencies.find(el => el.unit == 'week').value;
                        val = Math.floor(val / 7);
                    }
                    this.interval = val;
                },

                get intervalInput() {
                    return this.interval;
                },

                get repeatString() {
                    const frequency = this.frequencies[this.frequency].unit;
                    let str = 'Occurs every ';

                    switch (frequency) {
                        case 'day':
                            str = str + `${this.interval == 1 ? 'day' : this.interval + ' days'} `;
                            break;
                        case 'week':
                            const days = [];
                            this.days.forEach((item) => {
                                days[item + 1] = dayjs().date(item + 1).format('ddd');
                            });
                            str = str +
                                `${this.interval == 1 ? 'week' : this.interval + ' weeks'} on ${days.filter(i => i != null).join(', ')} `;
                            break;
                        case 'month':
                            str = str +
                                `${this.interval == 1 ? 'month' : this.interval + ' months'} on the ${dayjs(this.date).format('Do')} day `;
                            break;
                        case 'year':
                            str = str +
                                `${this.interval == 1 ? 'year' : this.interval + ' years'} on ${dayjs(this.date).format('MMMM Do')} `;
                            break;
                    }

                    if (!this.repeatsForever)
                        str = str + `until ${dayjs(this.endDate).format('MMM DD, YYYY')}`

                    return str;
                }
            }
        }
    </script>
@endpush
