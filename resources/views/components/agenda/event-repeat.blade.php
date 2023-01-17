<div class="mdc-dialog z-50" :class="{ 'mdc-dialog--open': modal && repeatModal }">
    <div class="mdc-dialog__scrim"></div>
    <div class="mdc-card mdc-dialog__surface dialog-modal fixed z-50 px-5 py-4 text-sm -translate-x-1/2 left-1/2 top-20 w-96"
        x-show="modal && repeatModal" x-data="{
            cancel: function() {
                this.repeatModal = false;
                this.frequency = 0;
                this.interval = 1;
                this.repeatsForever = true;
                this.endDate = dayjs(this.date).add(1, 'day').toDate();
            }
        }" @click.outside="repeatModal = false" x-cloak>
        <div class="py-2 mb-2">
            <p class="text-2xl font-semibold">Repeat</p>
        </div>
        <div class="flex items-center gap-x-3">
            <p>Repeat every </p>
            <label class="mdc-text-field mdc-text-field--filled mdc-text-field--no-label w-16 h-12 px-2 text-center">
                <span class="mdc-text-field__ripple"></span>
                <input class="mdc-text-field__input with-arrows text-center" type="number" aria-label="Label"
                    x-model="intervalInput" min="1" max="99">
                <span class="mdc-line-ripple"></span>
            </label>
            <p>
                <span x-text="frequencies[frequency]['unit']">
                </span><span x-text="interval > 1 ? 's' : ''"></span>
            </p>
        </div>
        <div wire:ignore>
            <template x-if="frequency == 2">
                <div class="mt-5">
                    <span>Repeat on</span>
                    <div class="h-10 mt-3">
                        <template x-for="day in daysOfWeek">
                            <button
                                class="mdc-icon-button day-selector float-left w-8 h-8 mr-2 rounded-full select-none"
                                type="button"
                                :class="{
                                    'day-selector-selected': days.includes(day.day()) &&
                                        !isCurrentWeekday(day.day())
                                }"
                                :disabled="isCurrentWeekday(day.day())" @click="daysToggle(day.day())">
                                <div class="mdc-icon-button__ripple"></div>
                                <span class="day-selector-text repeat-selector text-sm text-center"
                                    x-text="day.format('dd').substr(0,1)"></span>
                            </button>
                        </template>
                    </div>
                </div>
                <x-ui.validation-error for="event.days" />
            </template>
        </div>
        <p class="mt-5">Repeat until</p>
        <div class="flex items-center mt-2 gap-x-2">
            <div class="mdc-radio">
                <input class="mdc-radio__native-control" id="ends-1" name="radios" type="radio"
                    @click="repeatsForever = true" :checked="repeatsForever">
                <div class="mdc-radio__background">
                    <div class="mdc-radio__outer-circle"></div>
                    <div class="mdc-radio__inner-circle"></div>
                </div>
                <div class="mdc-radio__ripple"></div>
            </div>
            <label class="text-primary" for="ends-1">Forever</label>
        </div>
        <div class="flex items-center gap-x-2">
            <div class="mdc-radio">
                <input class="mdc-radio__native-control" id="ends-2" name="radios" type="radio"
                    @click="repeatsForever = false" :checked="!repeatsForever">
                <div class="mdc-radio__background">
                    <div class="mdc-radio__outer-circle"></div>
                    <div class="mdc-radio__inner-circle"></div>
                </div>
                <div class="mdc-radio__ripple"></div>
            </div>
            <label class="text-primary" for="ends-2">Date</label>
            <div class="flex-grow ml-8">
                <x-ui.date-picker title="End date" bind="endDate" disabled="repeatsForever" valid-date="validEndDate" />
            </div>
        </div>

        <div class="flex justify-end pt-4 space-x-2">
            <button class="mdc-button" type="button" @click="cancel()">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label">Reset</span>
            </button>
            <button class="mdc-button" type="button" @click="repeatModal = false">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label">Done</span>
            </button>
        </div>
    </div>
</div>
