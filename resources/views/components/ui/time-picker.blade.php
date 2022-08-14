<div x-data="timePicker" class="time-picker">
    <div class="w-full">
        <label class="w-full mdc-text-field mdc-text-field--filled mdc-text-field--with-leading-icon" x-on:click="timePickerState = 1">
            <span class="mdc-text-field__ripple"></span>
            <span class="mdc-floating-label mdc-floating-label--float-above" id="my-label-id">{{ $title ?? 'Time'}}</span>
            <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" tabindex="0" role="button">schedule</i>
            <p x-text="formattedTime"></p>
            <span class="mdc-line-ripple" :class="{'mdc-line-ripple--active': timePickerState}"></span>
        </label>
    </div>
    <div class="absolute z-50 border-none rounded-lg mdc-card drop-shadow-lg w-[19rem] h-[26rem]" x-show="timePickerState != 0" x-transition x-cloak x-on:click.outside="timePickerState = 0">
        <div class="relative w-full h-full pb-4">
            <div>
                <div class="flex items-center justify-center px-3 py-5">
                    <div class="p-3.5 bg-gray-200 rounded-lg cursor-pointer hour-min-slot" 
                    :class="{'active' : timePickerState == 1}"
                    @click="setState(1)">
                        <span class="text-5xl font-medium" 
                        x-text="String(parseHour(selectedTime.h)).padStart(2, '0')"></span>
                    </div>
                    <span class="py-3 mx-1.5 text-5xl font-medium">:</span>
                    <div class="p-3.5 mr-1.5 bg-gray-200 rounded-lg cursor-pointer hour-min-slot"
                    :class="{'active' : timePickerState == 2}"
                    @click="setState(2)">
                        <span class="text-5xl font-medium" 
                        x-text="String(selectedTime.m).padStart(2, '0')"></span>
                    </div>
                    <div class="ml-2 border border-gray-200 rounded-lg">
                        <div class="px-3 py-1.5 border-b cursor-pointer" @click="isMorning = true" 
                        :class="{'text-primary-theme' : isMorning}"
                        >AM</div>
                        <div class="px-3 py-1.5 border-t cursor-pointer" @click="isMorning = false"
                        :class="{'text-primary-theme' : ! isMorning}"
                        >PM</div>
                    </div>
                </div>
            </div>
            <div class="w-64 h-64 mx-auto mt-4 bg-gray-200 rounded-full clock-face" x-bind="clock" x-ref="clock">
                <div class="absolute mt-2 ml-2 pointer-events-none">
                    <template x-for="(i, index) in labelsContent">
                        <div class="absolute z-20 w-8 h-8 text-center rounded-full cursor-pointer select-none clock-label-text"
                        :style="{
                            top: innerRadius - Math.round(innerRadius * Math.sin(angles[(index + numLabels/3 - 1) % numLabels])) + 'px',
    
                            left: innerRadius - Math.round(innerRadius * Math.cos(angles[(index + numLabels/3 - 1) % numLabels])) + 'px',
                        }"
                        :class="{
                            'bg-primary-theme font-bold': selectedQuadrant == index * (numQuadrants / numLabels),
                            'fade' : ! fading
                        }"
                        ><span x-text="i" class="inline-block align-sub" x-transition></span></div>
                    </template>
                    <div class="absolute h-0.5 origin-right bg-primary-theme left-4"
                    x-bind:style="`top: ${innerRadius + 15}px; width: ${innerRadius}px; transform: rotateZ(${(selectedQuadrant / numQuadrants * 360) + (90)}deg)`">
                        <div class="w-2.5 h-2.5 -mt-1 rounded-full bg-primary-theme"></div>
                    </div>
                    <div class="absolute w-1.5 h-1.5 rounded-full bg-primary-theme z-20"
                    x-bind:style="`top: ${innerRadius + 13}px; left: ${innerRadius + 12.9}px;`"
                    ></div>
                </div>
                
            </div>
        </div>
    </div>
</div>