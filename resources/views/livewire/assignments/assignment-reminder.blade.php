<div class="" x-data="reminders()"
x-init="reminders.sort(function(a, b){return a.hours_before - b.hours_before})">
    <div class="mdc-dialog manage-reminders-dialog z-50" wire:ignore>
        <div class="mdc-dialog__container">
          <div class="mdc-dialog__surface"
            role="alertdialog"
            aria-modal="true"
            aria-labelledby="my-dialog-title"
            aria-describedby="my-dialog-content">
            <h2 class="mdc-dialog__title text-primary text-2xl font-bold mt-4" id="my-dialog-title">Manage Reminders</h2>
            <div class="mdc-dialog__content" id="my-dialog-content">
                <div class="max-w-screen w-96 px-2 overflow-x-hidden" wire:ignore.self>
                        <template x-for="reminder, index in reminders">
                        <div class="py-2 flex items-center">
                            <span class="material-icons inline-block">notifications_active</span> 
                            <p class="text-secondary ml-4 text-base tracking-normal flex-grow">
                                <span x-text="reminder.hours_before" class=""></span> hours before
                            </p>
                            <button class="mdc-icon-button material-icons" @click="removeReminder(reminder.id, index)">
                                <div class="mdc-icon-button__ripple"></div>
                                cancel
                            </button>
                        </div>
                    </template>
                    <template x-if="reminders.length == 0">
                        <div class="flex flex-col items-center pb-4">
                            <p class="material-icons assignment-card-icon left-0 right-0 mx-0 mt-10 select-none text-center text-9xl">notifications_off</p>
                            <p class="mt-1 text-center text-lg font-medium tracking-normal text-gray-600">No reminders have been set</p>
                        </div>
                    </template>
                    <div class="mt-2 pt-4 border-t border-gray-100" x-show="addingEvent" x-cloak>
                        <div class="flex">
                            <div class="flex-grow flex items-center">
                                <span class="text-secondary mr-2 inline-block tracking-normal">Remind me</span>
                                <label class="new-reminder-textfield mdc-text-field mdc-text-field--outlined mdc-text-field--no-label mx-1 w-16">
                                    <span class="mdc-notched-outline">
                                      <span class="mdc-notched-outline__leading"></span>
                                      <span class="mdc-notched-outline__notch">
                                      </span>
                                      <span class="mdc-notched-outline__trailing"></span>
                                    </span>
                                    <input type="number" min="1" class="mdc-text-field__input" x-model="newReminder">
                                </label>
                                <span class="text-secondary ml-2 inline-block tracking-normal">hours before</span>  
                            </div>
                            <div class="">
                                <button class="mdc-icon-button material-icons" @click.prevent="addReminder()" type="button" aria-describedby="checkmark">
                                    <div class="mdc-icon-button__ripple"></div>
                                    check
                                </button>
                            </div> 
                        </div>
                        <div class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg mdc-text-field-helper-text--persistent text-error ml-1 mt-0.5 mb-0.5 inline-block h-5 w-full" aria-hidden="true" x-text="validationError"></div>
                    </div>
                </div>
            </div>
            <div class="mdc-dialog__actions flex px-3 py-3 justify-start">
                <div class="flex-grow">
                    <button class="mdc-button mdc-button--icon-leading self-start" type="button" @click.prevent="showNewReminder()" :disabled="reminders.length > 9 || addingEvent == true">
                        <span class="mdc-button__ripple"></span>
                        <i class="material-icons mdc-button__icon" aria-hidden="true">add_circle_outline</i>
                        <span class="mdc-button__label">New Reminder</span>
                    </button>
                </div>
                <div>
                    <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="accept">
                        <div class="mdc-button__ripple"></div>
                        <span class="mdc-button__label">Done</span>
                    </button>
                </div>
            </div>
          </div>
        </div>
        <div class="mdc-dialog__scrim"></div>
    </div>
    <x-ui.tooltip tooltip-id="checkmark" text="Set new reminder"/>
</div>

@push('scripts')
    <script wire:ignore>
        function reminders() {
            return {
                addingEvent: false,

                newReminder: 1,

                reminders: @this.reminders.filter(() => true),

                errorMessages: @entangle('errorMessages'),
                
                addReminder: function() {
                    this.newReminder = Math.round(this.newReminder);

                    this.$wire.addReminder(this.newReminder).then((result) => {
                        if (result != null){
                            this.reminders.push(result);
                            this.reminders.sort(function(a, b){return a.hours_before - b.hours_before});
                            this.newReminder = 1;
                        }
                    })
                },

                showNewReminder: function() {
                    this.addingEvent = true;
                },
                
                removeReminder: function(id, index) {
                    this.$wire.removeReminder(id).then(() => {
                        this.reminders.splice(index,1)
                    });
                },

                get validationError() {
                    return this.errorMessages.hoursBefore != undefined ? this.errorMessages.hoursBefore[0] : '';
                },
            }
        }
    </script>
@endpush
