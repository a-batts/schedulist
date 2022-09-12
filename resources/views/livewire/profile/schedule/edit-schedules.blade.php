<div class="pt-20" x-data="schedules()">
    <x-ui.settings-card title="Manage Your Schedules"
    description="Edit or delete a previously created schedule, or create a new one."
    back-button>
        <div>
            <div class="pt-1 pb-6 border-b border-gray-200">
                <div class="h-10 my-2" wire:ignore>
                    <template x-if="editing != -1">
                        <div class="flex items-center h-full space-x-2">
                            <p class="flex-grow text-base">Currently editing <span class="font-bold" x-text="name"></span></p>
                            <button class="mdc-icon-button material-icons" @click="clear()" wire:ignore>
                                <div class="mdc-icon-button__ripple"></div>
                                cancel
                            </button>
                        </div>
                    </template>
                    <template x-if="editing == -1">
                        <div class="flex items-center h-full">
                            <p class="">Create a new schedule</p>
                        </div>
                    </template>
                </div>
                <label class="w-full mt-3 md:w-3/5 mdc-text-field mdc-text-field--filled" wire:ignore>
                    <span class="mdc-text-field__ripple"></span>
                    <span class="mdc-floating-label" :class="{'mdc-floating-label--float-above': editing != -1}" id="event-name-label">Name</span>
                    <input class="mdc-text-field__input" x-model="name" type="text" aria-labelledby="event-name-label" required>
                    <span class="mdc-line-ripple"></span>
                </label>
                <x-ui.validation-error for="schedule.name"/>
                <div class="flex mt-3 space-x-3">
                    <div class="w-full">
                        <x-ui.date-picker bind="startDate" valid-date="beforeEnd" title="Start Date" show-prev-years/>
                        <x-ui.validation-error for="start_date"/>
                    </div>
                    
                    <div class="w-full">
                        <x-ui.date-picker bind="endDate" valid-date="afterStart" title="End Date" show-prev-years/>
                        <x-ui.validation-error for="end_date"/>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" x-bind="saveButton" disabled wire:ignore>
                        <span class="mdc-button__ripple"></span>
                        Create
                    </button>
                </div>
            </div>
    
            <div class="py-4">
                <template x-for="schedule in schedules">
                    <div class="flex px-4 py-2 space-x-5" :data-id="schedule.id">
                        <div class="flex-grow">
                            <p class="font-bold" x-text="schedule.name"></p>
                            <p class="text-sm text-gray-600"><span x-text="schedule.start"></span> to <span x-text="schedule.end"></span></p>
                        </div>
                        <div>
                            <button class="mdc-icon-button material-icons" x-bind="editButton" wire:ignore>
                                <div class="mdc-icon-button__ripple"></div>
                                edit
                            </button>
                            <button class="mdc-icon-button material-icons" x-bind="deleteButton" wire:ignore>
                                <div class="mdc-icon-button__ripple"></div>
                                delete
                            </button>
                        </div>
                    </div>
                </template>    
            </div>    
        </div>    
    </x-ui.settings-card>


    <div class="mdc-dialog confirm-dialog delete-schedule-confirmation" id="confirm-dialog"
        wire:ignore>
        <div class="mdc-dialog__container">
            <div class="mdc-dialog__surface"
            role="alertdialog"
            aria-modal="true"
            aria-labelledby="my-dialog-title"
            aria-describedby="my-dialog-content">
            <div class="mdc-dialog__title">Really delete schedule?</div>
            <div class="mdc-dialog__content" id="my-dialog-content">
                This schedule and its associated class times will be deleted permanently.
            </div>
            <div class="mdc-dialog__actions">
                <button type="button" class="mdc-button mdc-dialog__button cancel" data-mdc-dialog-action="cancel">
                    <div class="mdc-button__ripple"></div>
                    <span class="mdc-button__label">Cancel</span>
                </button>
                <button type="button" class="mdc-button mdc-dialog__button confirm" data-mdc-dialog-action="delete">
                    <div class="mdc-button__ripple"></div>
                    <span class="mdc-button__label">Delete</span>
                </button>
            </div>
            </div>
        </div>
        <div class="mdc-dialog__scrim"></div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('schedules', () => ({
            startDate: new Date(),
            endDate: new Date(new Date().getTime() + (24 * 60 * 60 * 1000)),
            name: @entangle('name').defer,

            editing: -1 ,

            modal: true,

            schedules: @js($this->getSchedulesArray()),

            init: function () {
                this.$wire.getSchedulesArray().then((result) => {this.schedules = result});

                this.$watch('startDate', (value) => {
                    this.$wire.setStartDate(
                        value.getFullYear() + '-' + String(value.getMonth() + 1).padStart(2, '0') + '-' + String(value.getDate()).padStart(2, '0')
                    )
                });

                this.$watch('endDate', (value) => {
                    this.$wire.setEndDate(
                        value.getFullYear() + '-' + String(value.getMonth() + 1).padStart(2, '0') + '-' + String(value.getDate()).padStart(2, '0')
                    )
                });
            },

            clear: function () {
                this.editing = -1;
                this.name = '';
                this.startDate = new Date();
                this.endDate = new Date(new Date().getTime() + (24 * 60 * 60 * 1000));
            },

            beforeEnd: function (value) {
                return value < this.endDate;
            },

            afterStart: function (value) {
                return value > new Date(this.startDate.getTime() + (24 * 60 * 60 * 1000));                
            },

            deleteButton: {
                ['@click'](e) {
                    const id = e.target.parentElement.parentElement.dataset.id;

                    scheduleDeleteDialog().then(() => {
                        this.$wire.delete(id).then(this.$wire.getSchedulesArray().then((result) => {
                            this.schedules = result;
                        })).finally(
                            () => { 
                                this.clear();
                                snack('Deleted schedule successfully');
                            }
                        );
                    }).catch(() => {});
                },
            },

            editButton: {
                ['@click'](e) {
                    const id = e.target.parentElement.parentElement.dataset.id;
                    var selected = {};
                    
                    this.schedules.forEach((item, index) => {
                        if (item.id == id){
                            selected = item;
                            this.editing = index;
                        }  
                    })

                    const startDate = selected.start_date.split('-');
                    const endDate = selected.end_date.split('-');

                    this.startDate = new Date(startDate[0], startDate[1] - 1, startDate[2]);
                    this.endDate = new Date(endDate[0], endDate[1] - 1, endDate[2]);
                    this.name = selected.name;
                },
            },

            saveButton: {
                ['@click']() {
                    if (this.editing == -1){
                        this.$wire.create().then(this.$wire.getSchedulesArray().then((result) => {
                            if (result.length != this.schedules.length){
                                this.clear();
                                snack('Successfully added new schedule');
                                this.schedules = result;
                            }    
                        }))
                    }
                    else{
                        this.$wire.edit(this.schedules[this.editing].id).then(() => {
                            setTimeout(() => {
                                this.$wire.getSchedulesArray().then((result) => {

                                if (JSON.stringify(result) != JSON.stringify(this.schedules)){
                                    this.clear();
                                    snack('Successfully updated schedule');
                                    this.schedules = result;
                                }
                                else {
                                    this.clear();
                                }
                                })  
                            }, 20);
                        }
                        )
                    }
                },
                ['x-text']() {
                    return this.editing == -1 ? 'Create' : 'Save'                    
                },
                [':disabled'](){
                    return this.name == ''
                }
            }
        }))
    })
</script>
@endpush
  