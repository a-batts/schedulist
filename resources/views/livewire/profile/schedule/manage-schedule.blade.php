<div x-data="scheduleManager()"
x-init="$watch('scheduleType', (value, oldValue) => updateNumBlocks(oldValue, value)); $watch('numberBlocks', value => initTextFields()); initTextFields()"
x-on:class-removed.window="blocks['block_'+event.detail.block]['classes'][event.detail.index] = ''; initTextFields()"
class="mdc-typography" wire:ignore>
  <x-ui.settings-card title="Manage schedule"
  description="Set or modify the times for your classes or create a new schedule entirely.">
    <div class="block h-16 w-full" wire:ignore>
      <div class="float-left">
        <x-ui.select text="Schedule Type" "scheduleType" var="ScheduleType" type="filled" :data="$scheduleTypes" :default="$scheduleType" class="mt-4 mr-4 w-60" required />
      </div>
      <div class="" x-show="scheduleType.toLowerCase() == 'block'">
        <x-ui.select text="Number of Blocks" "numberBlocks" var="NumberBlocks" type="filled" :data="$possibleNumberBlocks" :default="$schedule->number_blocks" class="mt-4 w-60" required />
      </div>
    </div>
    <div class="mt-4">
      <template x-for="(each, index) in classes">
        <div class="mt-2 block">
          <h2 class="my-6 text-2xl font-medium" x-text="each.name + ' -'"></h2>
          <template x-for="i in parseInt(numberBlocks)">
            <div class="my-5">
              <div class="mr-12 sm:float-left">
                <p x-text="scheduleType.toLowerCase() != 'fixed' ? 'Block ' + i : isoDays[i - 1]" class="mr-8"></p>
                <div class="mdc-form-field mt-2 -ml-2">
                  <div class="mdc-checkbox" wire:ignore>
                    <input type="checkbox" class="mdc-checkbox__native-control mx-auto" x-bind:id="each.id + '-' + i" x-bind:checked="blocks['block_'+i]['classes'].includes(each.id.toString())" x-on:click="toggleClass(i, each.id)">
                    <div class="mdc-checkbox__background">
                      <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                      </svg>
                      <div class="mdc-checkbox__mixedmark"></div>
                    </div>
                    <div class="mdc-checkbox__ripple"></div>
                  </div>
                  <label class="text-gray-600" x-bind:for="each.id + '-' + i">Class on this day</label>
                </div>
              </div>
              <div class="mx-0 w-full pt-2 sm:float-right sm:w-auto">
                <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating schedule-time-textfield w-28 sm:w-36" x-bind:id="i + 'start-time-' + each.id" wire:ignore>
                  <span class="mdc-text-field__ripple" wire:ignore></span>
                  <span class="mdc-floating-label mdc-floating-label--float-above" x-bind:id="i + 'start-time-' + each.id + 'label'">Start Time</span>
                  <input class="mdc-text-field__input" type="text" x-bind:aria-labelledby="i + 'start-time-' + each.id + 'label'" autocomplete="timestart" 
                  x-bind:disabled="! blocks['block_'+i]['classes'].includes(each.id.toString())" x-bind:value="blocks['block_' + i]['times'][(blocks['block_'+i]['classes'].indexOf(each.id.toString()))*2] ?? ''" x-on:blur="@this.updateTime(each.id, i, $event.target.value, 'start')">
                  <span class="mdc-line-ripple" wire:ignore></span>
                </label>
                <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating schedule-time-textfield ml-2 w-28 sm:w-36" x-bind:id="i + 'end-time-' + each.id" wire:ignore>
                  <span class="mdc-text-field__ripple" wire:ignore></span>
                  <span class="mdc-floating-label mdc-floating-label--float-above" x-bind:id="i + 'end-time-' + each.id + 'label'">End Time</span>
                  <input class="mdc-text-field__input" type="text" x-bind:aria-labelledby="i + 'end-time-' + each.id + 'label'" autocomplete="timestart"
                  x-bind:disabled="! blocks['block_'+i]['classes'].includes(each.id.toString())" x-bind:value="blocks['block_' + i]['times'][(blocks['block_'+i]['classes'].indexOf(each.id.toString()))*2 + 1] ?? ''" x-on:blur="@this.updateTime(each.id, i, $event.target.value, 'end')">
                  <span class="mdc-line-ripple" wire:ignore></span>
                </label>
              </div>
              <div class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg mdc-text-field-helper-text--persistent text-error ml-1 mt-0.5 mb-0.5 inline-block h-5 w-full" aria-hidden="true" x-text="getValidationError(each.id, i)"></div>
            </div>
          </template>
        </div>
      </template>
      <template x-if="classes.length == 0">
        <div class="flex flex-col items-center">
          <p class="material-icons text-12xl assignment-card-icon mx-0 mt-10 select-none text-center">school</p>
            <p class="mt-1 text-center text-lg font-medium text-gray-600">Once you add a class you can start making your schedule</p>
        </div>
      </template>
    </div>
    <button class="mdc-button mdc-button--raised mdc-button-ripple float-right mt-8 mb-2 mr-4" type="button" wire:click="saveSchedule()" x-bind:disabled="classes.length == 0" wire:ignore>
      <span class="mdc-button__ripple"></span>Save Schedule
    </button>
  </x-ui.settings-card>
</div>

@push('scripts')
  <script>
    function scheduleManager(){
      return {
        blocks: @entangle('blocks'),
        classes: @entangle('classes'),
        errorMessages: @entangle('errorMessages'),
        isoDays: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat', 'Sun'],
        numberBlocks: {{$schedule->number_blocks}},
        scheduleType: '{{$schedule->schedule_type}}',
        formatTime: function(time){

        },
        initTextFields: function(){
          setTimeout(() => {
            allFields = document.querySelectorAll('.schedule-time-textfield');
            allFields.forEach(field => {
              initTextField(field.id)
            })
          }, 50);
        },
        toggleClass: function(block, id){
          if (this.blocks['block_' + block]['classes'].includes(id.toString())){
            this.blocks['block_' + block]['classes'].splice(this.blocks['block_' + block]['classes'].indexOf(id.toString()), 1);
            this.blocks['block_' + block]['times'].splice(this.blocks['block_' + block]['classes'].indexOf(id.toString()) - 1, 2);
            @this.removeClass(block, id);
          }
          else
            this.blocks['block_' + block]['classes'].push(id.toString());
          this.initTextFields()
        },
        updateNumBlocks: function(oldValue, value){
          if (value.toLowerCase() == 'fixed'){
            this.oldNumberBlocks = this.numberBlocks;
            this.numberBlocks = 7;
          }
          else {
            this.numberBlocks = this.oldNumberBlocks ?? this.numberBlocks
            @this.setNumberBlocks(this.numberBlocks)
          }
        },
        getValidationError: function(id, block) {
            if (this.errorMessages['class' + id + 'block' + block + 'error'] != undefined)
                return this.errorMessages['class' + id + 'block' + block + 'error'][0];
            return '';
        },
      }
    }
  </script>
@endpush