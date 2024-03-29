<div x-data="editMenu()" @display-edit-menu.window="openModal()" @hide-edit-menu.window="modal = false">
    <div class="mdc-dialog delete-item-confirmation" style="z-index: 70" wire:ignore>
        <div class="mdc-dialog__container">
            <div class="mdc-dialog__surface" role="alertdialog" aria-modal="true" aria-labelledby="my-dialog-title"
                aria-describedby="my-dialog-content">
                <div class="mdc-dialog__title">Really delete assignment?</div>
                <div class="mdc-dialog__content" id="my-dialog-content">
                    Once it is deleted it will not be able to be recovered
                </div>
                <div class="mdc-dialog__actions">
                    <button class="mdc-button mdc-dialog__button" data-mdc-dialog-action="cancel" type="button">
                        <div class="mdc-button__ripple"></div>
                        <span class="mdc-button__label">Cancel</span>
                    </button>
                    <button class="mdc-button mdc-dialog__button" data-mdc-dialog-action="delete" type="button"
                        wire:click="delete()">
                        <div class="mdc-button__ripple"></div>
                        <span class="mdc-button__label">Delete</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="mdc-dialog__scrim"></div>
    </div>
    <div>
        <x-ui.modal class="top-4" title="Edit Assignment" bind="modal">
            <x-slot name="actions">
                <button class="mdc-icon-button material-icons float-left mr-3 -mt-1" type="button"
                    aria-describedby="delete-class" aria-label="close" :disabled="offline"
                    @click="modal = false; openAssignmentDialog();">delete</button>
                <x-ui.tooltip tooltip-id="delete-class" text="Delete Assignment" />
                <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" :disabled="offline"
                    wire:click="edit">
                    <span class="mdc-button__ripple"></span>Save
                </button>
            </x-slot>

            <div class="flex space-x-3">
                <div class="w-full">
                    <label class="mdc-text-field mdc-text-field--filled w-full"
                        :class="{ 'mdc-text-field--invalid': errorMessages['assignment.name'] != undefined }"
                        wire:ignore>
                        <span class="mdc-text-field__ripple"></span>
                        <span class="mdc-floating-label" id="assignment-name-label">Name</span>
                        <input class="mdc-text-field__input" type="text" aria-labelledby="assignment-name-label"
                            wire:model.lazy="assignment.name" x-model="title" required>
                        <span class="mdc-line-ripple"></span>
                    </label>
                    <x-ui.validation-error for="assignment.name" />
                </div>
                <div class="w-full">
                    <div class="mdc-select mdc-select--filled w-full" wire:ignore>
                        <div class="mdc-select__anchor" role="button" aria-haspopup="listbox" aria-expanded="false">
                            <span class="mdc-select__ripple"></span>
                            <span class="mdc-floating-label mdc-floating-label--float-above">Class</span>
                            <span class="mdc-select__selected-text-container">
                                <span class="mdc-select__selected-text"></span>
                            </span>
                            <span class="mdc-select__dropdown-icon">
                                <svg class="mdc-select__dropdown-icon-graphic" viewBox="7 10 10 5" focusable="false">
                                    <polygon class="mdc-select__dropdown-icon-inactive" stroke="none"
                                        fill-rule="evenodd" points="7 10 12 15 17 10">
                                    </polygon>
                                    <polygon class="mdc-select__dropdown-icon-active" stroke="none" fill-rule="evenodd"
                                        points="7 15 12 10 17 15">
                                    </polygon>
                                </svg>
                            </span>
                            <span class="mdc-line-ripple"></span>
                        </div>
                        <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
                            <ul class="mdc-deprecated-list dark-theme-list" role="listbox">
                                @foreach ($classes as $each)
                                    <li class="mdc-deprecated-list-item @if ($each['id'] == $assignment->class_id) mdc-deprecated-list-item--selected @endif"
                                        data-value="{{ $each['id'] }}" role="option"
                                        @if ($each['id'] == $assignment->class_id) aria-selected="true" @endif
                                        wire:click="setClass({{ $each['id'] }})">
                                        <span class="mdc-deprecated-list-item__ripple"></span>
                                        <span class="mdc-deprecated-list-item__text">
                                            {{ $each['name'] }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex space-x-3">
                <div class="w-full">
                    <x-ui.date-picker title="Due Date" bind="date" valid-date="validDate" />
                    <x-ui.validation-error for="due_date" />
                </div>

                <div class="w-full">
                    <x-ui.time-picker title="Due Time" bind="time" />
                    <x-ui.validation-error for="due_time" />
                </div>
            </div>

            <label class="mdc-text-field mdc-text-field--filled w-full mt-1"
                x-bind:class="{ 'mdc-text-field--invalid': errorMessages['assignment.link'] != undefined }" wire:ignore>
                <span class="mdc-text-field__ripple"></span>
                <span class="mdc-floating-label mdc-floating-label--float-above" id="assignment-link-label">Link</span>
                <input class="mdc-text-field__input" type="text" aria-labelledby="assignment-link-label"
                    wire:model.lazy="assignment.link">
                <span class="mdc-line-ripple"></span>
            </label>
            <x-ui.validation-error for="assignment.link" />

            <div class="w-full pt-4 pb-8">
                <div class="left-0 right-0 mx-auto">
                    @if ($assignment->link != '')
                        <x-link-preview :preview="$preview" />
                    @endif
                </div>
            </div>

            <label
                class="mdc-text-field mdc-text-field--filled mdc-text-field--textarea autosize mdc-text-field--with-internal-counter w-full"
                x-bind:class="{ 'mdc-text-field--invalid': errorMessages['assignment.description'] != undefined }"
                x-ref="descriptionContainer" wire:ignore>
                <span class="mdc-floating-label mdc-floating-label--float-above"
                    id="assignment-description-label">Description</span>
                <textarea class="mdc-text-field__input autosize" id="descriptionBox" aria-labelledby="assignment-description-label"
                    rows="6" wire:model.lazy="assignment.description"></textarea>
                <span class="mdc-line-ripple"></span>
            </label>
            <x-ui.validation-error for="assignment.description" />
        </x-ui.modal>
    </div>
</div>
@push('scripts')
    <script data-swup-reload-script>
        function editMenu() {
            return {
                modal: false,

                errorMessages: @entangle('errorMessages'),

                title: @this.assignment.name,

                date: new Date(),

                time: {
                    h: 23,
                    m: 59
                },

                init: function($watch, $wire) {
                    this.$watch('title', newtitle => {
                        document.title = newtitle != '' ? newtitle : 'Untitled Assignment';
                    });

                    this.$watch('date', (value, oldVal) => {
                        this.$wire.setDate(
                            value.getFullYear() + '-' + String(value.getMonth() + 1).padStart(2, '0') +
                            '-' + String(value.getDate()).padStart(2, '0')
                        )
                    });

                    this.$watch('time', (value) => {
                        this.$wire.setTime(value);
                    });

                    this.$wire.getDate().then((result) => {
                        date = new Date(result);
                        date.setDate(date.getDate() + 1);
                        this.date = date;
                    }).then(
                        this.$wire.getTime().then(result => {
                            result = result.split(':');
                            this.time.h = parseInt(result[0]);
                            this.time.m = parseInt(result[1])

                        }));
                },

                openModal: function() {
                    this.modal = true;

                    setTimeout(() => {
                        //Force an autosize when the modal is opened

                        var event = document.createEvent('event');
                        event.initEvent('autosize:update', true, false);
                        document.getElementById('descriptionBox').dispatchEvent(event);
                    }, 10);
                },

                validDate: function(date) {
                    return date >= new Date();
                },
            }
        }
    </script>
@endpush
