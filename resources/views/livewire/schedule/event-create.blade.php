<div class="mdc-typography" x-data="eventCreate()" @close-create-modal.window="modal = false">
    <x-ui.modal class="top-4" title="New Event" bind="modal">
        <x-slot name="actions">
            <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button"
                @click="$wire.set('event.reoccuring', reoccuring); $wire.set('frequency', frequency); $wire.set('days', days); $wire.create()">
                <span class="mdc-button__ripple"></span>Create
            </button>
        </x-slot>

        <label class="mdc-text-field mdc-text-field--filled w-4/5"
            x-bind:class="{ 'mdc-text-field--invalid': errorMessages['event.name'] != undefined }" wire:ignore>
            <span class="mdc-text-field__ripple"></span>
            <span class="mdc-floating-label" id="event-name-label">Event Name</span>
            <input class="mdc-text-field__input" type="text" aria-labelledby="event-name-label"
                wire:model.lazy="event.name" required>
            <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error for="event.name" />

        <div class="mdc-select mdc-select--filled w-4/5" wire:ignore>
            <div class="mdc-select__anchor">
                <span class="mdc-select__ripple"></span>
                <span class="mdc-floating-label" wire:ignore>Event Category</span>
                <span class="mdc-line-ripple"></span>

                <span class="mdc-select__selected-text-container" wire:ignore>
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
                            @click="category = {{ $category['value'] }}">
                            <span class="mdc-deprecated-list-item__ripple"></span>
                            <span class="mdc-deprecated-list-item__text">{{ $category['formatted_name'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <x-ui.validation-error for="event.category" />

        <div class="flex space-x-3">
            <div class="w-full">
                <x-ui.time-picker title="Start Time" bind="startTime" />
                <x-ui.validation-error for="start_time" />
            </div>

            <div class="w-full">
                <x-ui.time-picker title="End Time" bind="endTime" />
                <x-ui.validation-error for="end_time" />
            </div>
        </div>

        <x-ui.date-picker title="Event Date" bind="date" valid-date="validDate" />
        <x-ui.validation-error for="event.date" />

        <div class="py-2 -ml-2">
            <div class="mdc-checkbox">
                <input class="mdc-checkbox__native-control" id="create-check" type="checkbox"
                    @click="reoccuring = !reoccuring" :checked="reoccuring" />
                <div class="mdc-checkbox__background">
                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                        <path class="mdc-checkbox__checkmark-path" fill="none"
                            d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                    </svg>
                    <div class="mdc-checkbox__mixedmark"></div>
                </div>
                <div class="mdc-checkbox__ripple"></div>
            </div>
            <label for="create-check" style="vertical-align: 6px">This event recurrs</label>
        </div>

        <div class="py-3" x-transition x-show="reoccuring && modal" x:cloak>

            <x-ui.select class="w-3/5" title="Repeat event every..." style="filled" bind="frequency" :data="json_encode($frequencies)"
                x-bind:class="{ 'mdc-select--invalid': errorMessages['event.frequency'] != undefined }" required />
            <x-ui.validation-error for="event.frequency" />

            <div wire:ignore>
                <template x-if="frequency == 'Week' || frequency == 'Two Weeks'">
                    <div class="mt-5 ml-1">
                        <span>Repeat event on</span>
                        <div class="h-10 mt-3">
                            <template x-for="day in ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']">
                                <button
                                    class="mdc-icon-button day-selector float-left w-8 h-8 mr-2 rounded-full select-none"
                                    type="button"
                                    :class="{ 'day-selector-selected': days.includes(day) && !isCurrentWeekday(day) }"
                                    :disabled="isCurrentWeekday(day)" @click="daysToggle(day)" :wire:key="day">
                                    <div class="mdc-icon-button__ripple"></div>
                                    <span class="day-selector-text text-sm text-center" x-text="day"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                    <x-ui.validation-error for="event.days" />
                </template>
            </div>
        </div>
    </x-ui.modal>

    <div class="fab-button">
        <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Event" @click="modal = true">
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

                date: new Date(),

                startTime: {
                    h: new Date().getHours(),
                    m: new Date().getMinutes()
                },

                endTime: {
                    h: 23,
                    m: 59
                },

                category: @entangle('event.category'),

                reoccuring: false,

                frequency: null,

                days: [],

                errorMessages: @entangle('errorMessages'),

                init: function() {
                    this.daysToggle(this.date.toLocaleString('default', {
                        weekday: 'short'
                    }));

                    this.$watch('date', (value, oldVal) => {
                        this.$wire.setDate(
                            value.getFullYear() + '-' + String(value.getMonth() + 1).padStart(2, '0') +
                            '-' + String(value.getDate()).padStart(2, '0')
                        )

                        if (oldVal)
                            this.daysToggle(oldVal.toLocaleString('default', {
                                weekday: 'short'
                            }))
                        this.daysToggle(value.toLocaleString('default', {
                            weekday: 'short'
                        }))
                    });

                    this.$watch('startTime', (value) => {
                        this.$wire.setStartTime(value);
                    });

                    this.$watch('endTime', (value) => {
                        if (value.h < 12 && this.startTime.h >= 12) {
                            value.h = value.h + 12;
                            this.endTime = value;
                        }

                        this.$wire.setEndTime(value);
                    });

                },

                validDate: function(date) {
                    return date >= new Date();
                },

                daysToggle: function(e) {
                    var index = this.days.indexOf(e);
                    if (index !== -1 && !this.isCurrentWeekday(e))
                        this.days.splice(index, 1);
                    else
                        this.days.push(e);
                },

                isCurrentWeekday: function(val) {
                    return val == this.date.toLocaleString('default', {
                        weekday: 'short'
                    });
                },
            }
        }
    </script>
@endpush
