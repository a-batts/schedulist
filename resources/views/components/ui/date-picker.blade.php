<div x-data="datePicker('{{ $bind }}', '{{ $validDate }}', {{ $attributes->has('show-prev-years') }})">
    <div class="w-full">
        <label class="mdc-text-field mdc-text-field--filled mdc-text-field--with-leading-icon dummy-field w-full"
            x-on:click="datePickerOpen =! datePickerOpen">
            <span class="mdc-text-field__ripple"></span>
            <span class="mdc-floating-label mdc-floating-label--float-above"
                id="my-label-id">{{ $title ?? 'Date' }}</span>
            <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" role="button"
                tabindex="0">event</i>
            <p x-text="formattedDate"></p>
            <span class="mdc-line-ripple" :class="{ 'mdc-line-ripple--active': datePickerOpen }"></span>
        </label>
    </div>
    <div class="mdc-card absolute z-50 h-[26rem] w-[19rem] rounded-lg border-none drop-shadow-lg"
        x-show="datePickerOpen" x-transition x-cloak x-on:click.outside="datePickerOpen = false">
        <div class="date-time-picker-bg p-4 transition-all rounded-t-lg text-gray-50">
            <p class="mb-1 text-sm font-medium cursor-pointer" x-text="year" @click="showingYearSelector = true"
                :class="{ 'active': showingYearSelector }"></p>
            <p class="text-3xl font-bold cursor-pointer" x-text="headerDateString" @click="showingYearSelector = false"
                :class="{ 'active': !showingYearSelector }"></p>
        </div>
        <div class="relative w-full h-full pb-4">
            <div class="px-4 pt-2" x-show="!showingYearSelector" x-transition.in>
                <div class="flex w-full mb-4 max-h-8">
                    <div class="flex-grow -ml-2 text-xs text-gray-600">
                        <button class="mdc-icon-button material-icons date-picker-button" aria-describedby="prev-month"
                            @click.prevent="prevMonth()">
                            <div class="mdc-icon-button__ripple"></div>
                            chevron_left
                        </button>
                    </div>
                    <span class="self-center flex-grow font-medium text-center align-middle" x-text="monthYear"></span>
                    <div class="flex justify-end flex-grow -mr-2 text-gray-600">
                        <button class="mdc-icon-button material-icons date-picker-button" aria-describedby="prev-month"
                            @click.prevent="nextMonth()">
                            <div class="mdc-icon-button__ripple"></div>
                            chevron_right
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-7 gap-2 text-sm">
                    <template x-for="d in daysOfWeek">
                        <div class="text-center">
                            <span class="inline-block text-gray-400 align-middle" x-text="d"></span>
                        </div>
                    </template>

                    <template x-for="_ in numberBlanks">
                        <div><span></span></div>
                    </template>

                    <template x-for="day in monthDays">
                        <button class="mdc-icon-button w-8 h-8 text-center transition-all rounded-full cursor-pointer"
                            @click.prevent="setDate(day)" x-bind:class="{ 'bg-primary-theme': isSelectedDate(day) }"
                            :disabled="!isValidDate(day)">
                            <div class="mdc-icon-button__ripple"></div>
                            <span class="day-selector-text text-sm text-center" x-text="day"></span>
                        </button>
                    </template>
                </div>
            </div>
            <div class="" x-show="showingYearSelector" x-transition.in x-cloak>
                <div class="h-[20rem] max-h-[20rem] overflow-y-scroll text-center" x-ref="yearsListContainer">
                    <template x-for="year in yearsList">
                        <div class="py-2"
                            :class="{ 'text-2xl text-primary-theme font-bold selected-date cursor-pointer': year == viewDate
                                    .getFullYear() }"
                            @click="setYear(year)">
                            <p class="cursor-pointer" x-text="year"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
