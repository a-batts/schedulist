<div class="time-picker" x-data="timePicker('{{ $bind }}')">
    <div class="w-full">
        <label class="mdc-text-field mdc-text-field--filled mdc-text-field--with-leading-icon dummy-field w-full"
            x-on:click="timePickerState = 1">
            <span class="mdc-text-field__ripple"></span>
            <span class="mdc-floating-label mdc-floating-label--float-above"
                id="my-label-id">{{ $title ?? 'Time' }}</span>
            <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" role="button"
                tabindex="0">schedule</i>
            <p x-text="formattedTime"></p>
            <span class="mdc-line-ripple" :class="{ 'mdc-line-ripple--active': timePickerState }"></span>
        </label>
    </div>
    <div class="mdc-card absolute z-50 h-[26rem] w-[19rem] rounded-lg border-none drop-shadow-lg"
        x-show="timePickerState != 0" x-transition x-cloak x-on:click.outside="timePickerState = 0">
        <div class="relative w-full h-full pb-4">
            <div>
                <div class="flex items-center justify-center px-3 py-5">
                    <div class="hour-min-slot cursor-pointer rounded-lg bg-gray-200 p-3.5"
                        :class="{ 'active': timePickerState == 1 }" @click="setState(1)">
                        <span class="text-5xl font-medium"
                            x-text="String(parseHour(selectedTime.h)).padStart(2, '0')"></span>
                    </div>
                    <span class="mx-1.5 py-3 text-5xl font-medium">:</span>
                    <div class="hour-min-slot mr-1.5 cursor-pointer rounded-lg bg-gray-200 p-3.5"
                        :class="{ 'active': timePickerState == 2 }" @click="setState(2)">
                        <span class="text-5xl font-medium" x-text="String(selectedTime.m).padStart(2, '0')"></span>
                    </div>
                    <div class="ml-2 border border-gray-200 rounded-lg">
                        <div class="cursor-pointer border-b px-3 py-1.5" @click="toggleIsMorning(true)"
                            :class="{ 'text-primary-theme': isMorning }">AM</div>
                        <div class="cursor-pointer border-t px-3 py-1.5" @click="toggleIsMorning(false)"
                            :class="{ 'text-primary-theme': !isMorning }">PM</div>
                    </div>
                </div>
            </div>
            <div class="clock-face w-64 h-64 mx-auto mt-4 bg-gray-200 rounded-full" x-bind="clock" x-ref="clock">
                <div class="absolute mt-2 ml-2 pointer-events-none">
                    <template x-for="(i, index) in labelsContent">
                        <div class="clock-label-text absolute z-20 w-8 h-8 text-center rounded-full cursor-pointer select-none"
                            :style="{
                                top: innerRadius - Math.round(innerRadius * Math.sin(angles[(index + numLabels / 3 -
                                    1) % numLabels])) + 'px',
                            
                                left: innerRadius - Math.round(innerRadius * Math.cos(angles[(index + numLabels / 3 -
                                    1) % numLabels])) + 'px',
                            }"
                            :class="{
                                'bg-primary-theme font-bold': selectedQuadrant == index * (numQuadrants / numLabels),
                                'fade': !fading
                            }">
                            <span class="inline-block align-sub" x-text="i" x-transition></span></div>
                    </template>
                    <div class="bg-primary-theme absolute left-4 h-0.5 origin-right"
                        x-bind:style="`top: ${innerRadius + 15}px; width: ${innerRadius}px; transform: rotateZ(${(selectedQuadrant / numQuadrants * 360) + (90)}deg)`">
                        <div class="bg-primary-theme -mt-1 h-2.5 w-2.5 rounded-full"></div>
                    </div>
                    <div class="bg-primary-theme absolute z-20 h-1.5 w-1.5 rounded-full"
                        x-bind:style="`top: ${innerRadius + 13}px; left: ${innerRadius + 12.9}px;`"></div>
                </div>

            </div>
        </div>
    </div>
</div>
