<div class="" x-data="reminders()"
x-init="reminders.sort(function(a, b){return a.hours_before - b.hours_before})"
x-on:update-reminders.window="reminders = @this.reminders.filter(() => true); reminders.sort(function(a, b){return a.hours_before - b.hours_before})">
    <div class="mdc-dialog manage-reminders-dialog z-50" wire:ignore>
        <div class="mdc-dialog__container">
          <div class="mdc-dialog__surface"
            role="alertdialog"
            aria-modal="true"
            aria-labelledby="my-dialog-title"
            aria-describedby="my-dialog-content">
            <h2 class="mdc-dialog__title" id="my-dialog-title">Manage Reminders</h2>
            <div class="mdc-dialog__content" id="my-dialog-content">
                <div class="max-w-screen w-96 overflow-x-hidden" wire:ignore.self>
                    <template x-for="reminder, index in reminders">
                        <div class="h-12 py-4">
                            <p class="text-secondary float-left text-base tracking-normal">Text message <span x-text="reminder.hours_before" class=""></span> hours before</p>
                            <div>
                                <button class="inline-block float-right -mt-3 mdc-icon-button material-icons" x-on:click="removeReminder(reminder.id, index)">
                                    <div class="mdc-icon-button__ripple"></div>
                                    cancel
                                </button>
                            </div>
                        </div>
                    </template>
                    <template x-if="reminders.length == 0">
                        <div class="flex flex-col items-center">
                            <p class="material-icons assignment-card-icon left-0 right-0 mx-0 mt-10 select-none text-center text-9xl">notifications_off</p>
                            <p class="mt-1 text-center text-lg font-medium tracking-normal text-gray-600">No reminders have been set</p>
                        </div>
                    </template>
                    <div class="my-2 pt-4" x-show="addingEvent" x-cloak>
                        <div>
                            <div class="float-left -mr-4">
                                <label class="new-reminder-textfield mdc-text-field mdc-text-field--outlined mdc-text-field--no-label" x-model="newReminder">
                                    <span class="mdc-notched-outline">
                                      <span class="mdc-notched-outline__leading"></span>
                                      <span class="mdc-notched-outline__notch">
                                      </span>
                                      <span class="mdc-notched-outline__trailing"></span>
                                    </span>
                                    <input type="text" class="mdc-text-field__input">
                                </label>
                                <span class="text-secondary ml-2 inline-block tracking-normal">hours before</span>
                                  
                            </div>
                            <div class="float-right mt-1">
                                <button class="mdc-icon-button material-icons" x-on:click="addReminder(); event.preventDefault()" type="button" aria-describedby="checkmark">
                                    <div class="mdc-icon-button__ripple"></div>
                                    save
                                </button>
                            </div>
                        </div>
                        <div class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg mdc-text-field-helper-text--persistent text-error ml-1 mt-0.5 mb-0.5 inline-block h-5 w-full" aria-hidden="true" x-text="validationError"></div>
                    </div>
                    <div>
                        <button class="mdc-button mdc-button--icon-leading absolute left-3 bottom-2 z-50" type="button" x-on:click="showNewReminder(); event.preventDefault()" x-bind:disabled="reminders.length > 9 || addingEvent == true">
                            <span class="mdc-button__ripple"></span>
                            <i class="material-icons mdc-button__icon" aria-hidden="true">add_circle_outline</i>
                            <span class="mdc-button__label">New Reminder</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="mdc-dialog__actions">
              <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="accept">
                <div class="mdc-button__ripple"></div>
                <span class="mdc-button__label">Done</span>
              </button>
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
                errorMessages: @entangle('errorMessages'),
                newReminder: '',
                reminders: @this.reminders.filter(() => true),
                reminderDialog: false,
                addReminder: function() {
                    @this.addReminder(this.newReminder);
                    this.newReminder = '';
                },
                showNewReminder: function() {
                    this.newReminder = '';
                    this.addingEvent = true;
                },
                removeReminder: function(id, index) {
                    @this.removeReminder(id);
                    this.reminders.splice(index,1);
                },
                get validationError() {
                    if (this.errorMessages.hoursBefore != undefined)
                        return this.errorMessages.hoursBefore[0];
                    return '';
                },
            }
        }
    </script>
@endpush
