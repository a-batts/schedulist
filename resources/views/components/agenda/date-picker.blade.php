<div x-data="datePicker"
@update-current-date.window="init()">
    <div class="flex w-full mb-4">
        <div class="flex-grow text-gray-600 text-xs -ml-2">
            <button class="mdc-icon-button material-icons date-picker-button" @click="prevYear()" aria-describedby="prev-month">
                <div class="mdc-icon-button__ripple"></div>
                keyboard_double_arrow_left
            </button>
            <button class="mdc-icon-button material-icons date-picker-button" @click="prevMonth()" aria-describedby="prev-month">
                <div class="mdc-icon-button__ripple"></div>
                chevron_left
            </button>
        </div>
        <span class="flex-grow align-middle font-bold text-center self-center" x-text="monthYear"></span>
        <div class="flex-grow flex justify-end text-gray-600 -mr-2">
            <button class="mdc-icon-button material-icons date-picker-button" @click="nextMonth()" aria-describedby="prev-month">
                <div class="mdc-icon-button__ripple"></div>
                chevron_right
            </button>
            <button class="mdc-icon-button material-icons date-picker-button" @click="nextYear()" aria-describedby="prev-month">
                <div class="mdc-icon-button__ripple"></div>
                keyboard_double_arrow_right
            </button>
        </div>
    </div>
    <div class="grid grid-cols-7 gap-3">
        <template x-for="d in daysOfWeek" :key="'pre' + d">
           <div class="text-center">
                <span x-text="d" class="text-gray-400 inline-block align-middle"></span>
           </div>
        </template>

        <template x-for="day in startingBlankDays">
            <div class="rounded-lg w-8 h-8 cursor-default text-center">
                <span x-text="day" class="text-gray-400 inline-block align-middle"></span>
            </div>
        </template>

        <template x-for="day in monthDays">
            <div class="rounded-lg w-8 h-8 transition-all cursor-pointer text-center" 
            :class="{ 'text-primary-theme font-bold': isToday(day), 'bg-primary-theme': isActiveDate(day) }" 
            @click="changeDate(day)">
                <span x-text="day" class="inline-block align-middle"></span>
            </div>
        </template>

        <template x-for="day in endingBlankDays">
            <div class="rounded-lg w-8 h-8 cursor-default text-center">
                <span x-text="day" class="text-gray-400 align-middle"></span>
            </div>
        </template>
    </div>
</div>