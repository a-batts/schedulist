<div x-data="miniCalendar" @update-current-date.window="init()">
    <div class="mb-4 flex w-full">
        <div class="-ml-2 flex-grow text-xs text-gray-600">
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
        <span class="flex-grow self-center text-center align-middle font-bold" x-text="monthYear"></span>
        <div class="-mr-2 flex flex-grow justify-end text-gray-600">
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
                <span class="inline-block align-middle text-gray-400" x-text="d"></span>
            </div>
        </template>

        <template x-for="day in startingBlankDays">
            <div class="flex items-center justify-center">
                <div class="h-8 w-8 cursor-default rounded-lg text-center">
                    <span class="inline-block align-middle text-gray-400" x-text="day"></span>
                </div>
            </div>
        </template>

        <template x-for="day in monthDays">
            <div class="flex items-center justify-center">
                <div class="h-8 w-8 cursor-pointer rounded-lg text-center transition-all flex items-center justify-center"
                    :class="{ 'text-primary-theme font-bold': isToday(day), 'bg-primary-theme': isActiveDate(day) }"
                    @click="changeDate(day)">
                    <span class="inline-block align-middle" x-text="day"></span>
                </div>
            </div>
        </template>

        <template x-for="day in endingBlankDays">
            <div class="h-8 w-8 cursor-default rounded-lg text-center">
                <span class="align-middle text-gray-400" x-text="day"></span>
            </div>
        </template>
    </div>
</div>
