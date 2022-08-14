<div x-data="datePicker">
    <div class="w-full">
        <label class="mdc-text-field mdc-text-field--filled mdc-text-field--with-leading-icon w-full" x-on:click="datePickerOpen =! datePickerOpen">
            <span class="mdc-text-field__ripple"></span>
            <span class="mdc-floating-label mdc-floating-label--float-above" id="my-label-id">{{ $title ?? 'Date'}}</span>
            <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" tabindex="0" role="button">event</i>
            <p x-text="formattedDate"></p>
            <span class="mdc-line-ripple" :class="{'mdc-line-ripple--active': datePickerOpen}"></span>
        </label>
    </div>
    <div class="mdc-card absolute z-50 h-[26rem] w-[19rem] rounded-lg border-none drop-shadow-lg" x-show="datePickerOpen" x-transition x-cloak x-on:click.outside="datePickerOpen = false">
        <div class="date-time-picker-bg rounded-t-lg p-4 text-gray-50 transition-all">
            <p class="mb-1 cursor-pointer text-sm font-medium" x-text="year" @click="showingYearSelector = true" :class="{'active' :  showingYearSelector}"></p>
            <p class="cursor-pointer text-3xl font-bold" x-text="headerDateString" @click="showingYearSelector = false" :class="{'active' :  !showingYearSelector}"></p>
        </div>
        <div class="relative h-full w-full pb-4">
            <div class="px-4 pt-2" x-show="!showingYearSelector" x-transition.in>
                <div class="mb-4 flex max-h-8 w-full">
                    <div class="-ml-2 flex-grow text-xs text-gray-600">
                        <button class="mdc-icon-button material-icons date-picker-button" @click.prevent="prevMonth()" aria-describedby="prev-month">
                            <div class="mdc-icon-button__ripple"></div>
                            chevron_left
                        </button>
                    </div>
                    <span class="flex-grow self-center text-center align-middle font-medium" x-text="monthYear"></span>
                    <div class="-mr-2 flex flex-grow justify-end text-gray-600">
                        <button class="mdc-icon-button material-icons date-picker-button" @click.prevent="nextMonth()" aria-describedby="prev-month">
                            <div class="mdc-icon-button__ripple"></div>
                            chevron_right
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-7 gap-2 text-sm">
                    <template x-for="d in daysOfWeek">
                       <div class="text-center">
                            <span x-text="d" class="inline-block align-middle text-gray-400"></span>
                       </div>
                    </template>
    
                    <template x-for="_ in numberBlanks">
                        <div><span></span></div>
                     </template>
            
                    <template x-for="day in monthDays">
                        <button class="mdc-icon-button h-8 w-8 cursor-pointer rounded-full text-center transition-all" @click.prevent="setDate(day)"
                        x-bind:class="{'bg-primary-theme': isSelectedDate(day)}" :disabled="! validDate(day)">
                            <div class="mdc-icon-button__ripple"></div>
                            <span x-text="day" class="day-selector-text text-center text-sm"></span>
                        </button>
                    </template>
                </div>
            </div>
            <div class="" x-show="showingYearSelector" x-transition.in x-cloak>
                <div class="h-[20rem] max-h-[20rem] overflow-y-scroll text-center" x-ref="yearsListContainer">
                    <template x-for="year in yearsList">
                        <div class="py-2" :class="{'text-2xl text-primary-theme font-bold selected-date cursor-pointer' : year == viewDate.getFullYear()}"
                        @click="setYear(year)">
                            <p x-text="year" class="cursor-pointer"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>