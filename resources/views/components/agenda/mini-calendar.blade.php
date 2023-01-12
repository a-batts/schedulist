<div x-data="miniCalendar" @update-current-date.window="init()">
    <div class="flex w-full mb-4">
        <div class="flex-grow -ml-2 text-xs text-gray-600">
            <button class="mdc-icon-button material-icons date-picker-button" aria-describedby="prev-month"
                @click="prevYear()">
                <div class="mdc-icon-button__ripple"></div>
                keyboard_double_arrow_left
            </button>
            <button class="mdc-icon-button material-icons date-picker-button" aria-describedby="prev-month"
                @click="prevMonth()">
                <div class="mdc-icon-button__ripple"></div>
                chevron_left
            </button>
        </div>
        <span class="self-center flex-grow font-bold text-center align-middle" x-text="monthYear"></span>
        <div class="flex justify-end flex-grow -mr-2 text-gray-600">
            <button class="mdc-icon-button material-icons date-picker-button" aria-describedby="prev-month"
                @click="nextMonth()">
                <div class="mdc-icon-button__ripple"></div>
                chevron_right
            </button>
            <button class="mdc-icon-button material-icons date-picker-button" aria-describedby="prev-month"
                @click="nextYear()">
                <div class="mdc-icon-button__ripple"></div>
                keyboard_double_arrow_right
            </button>
        </div>
    </div>
    <div class="grid grid-cols-7 gap-3">
        <template x-for="d in daysOfWeek" :key="'pre' + d">
            <div class="text-center">
                <span class="inline-block text-gray-400 align-middle" x-text="d"></span>
            </div>
        </template>

        <template x-for="day in startingBlankDays">
            <div class="flex items-center justify-center">
                <div class="w-8 h-8 text-center rounded-lg cursor-default">
                    <span class="inline-block text-gray-400 align-middle select-none" x-text="day"></span>
                </div>
            </div>
        </template>

        <template x-for="day in monthDays">
            <div>
                <div class="flex items-center justify-center">
                    <div class="flex items-center justify-center w-8 h-8 text-center transition-all rounded-lg cursor-pointer"
                        :class="{ 'text-primary-theme font-bold': isToday(day), 'bg-primary-theme': isActiveDate(day) }"
                        @click="changeDate(day)">
                        <span class="inline-block align-middle select-none" x-text="day"></span>
                    </div>
                </div>
                <div class="flex justify-center h-1 pt-1">
                    <template x-if="agenda?.[day]?.length > 0 && monthYear == $parent.month + ' ' + $parent.year">
                        <div class="bg-primary-theme w-1 h-1 rounded-full"></div>
                    </template>
                </div>
            </div>
        </template>

        <template x-for="day in endingBlankDays">
            <div class="w-8 h-8 text-center rounded-lg cursor-default">
                <span class="text-gray-400 align-middle select-none" x-text="day"></span>
            </div>
        </template>
    </div>
</div>
