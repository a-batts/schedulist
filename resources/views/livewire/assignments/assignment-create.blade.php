<div class="mdc-typography" x-data="assignmentCreate()" @close-assignment-modal.window="modal = false">
    <div class="fab-button">
        <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Assignment" @click="dialog = true">
            <div class="mdc-fab__ripple"></div>
            <span class="material-icons mdc-fab__icon">add</span>
            <span class="mdc-fab__label">New Assignment</span>
        </button>
    </div>

    <x-ui.modal class="top-4" title="New Assignment" bind="dialog">
        <x-slot name="actions">
            <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" wire:click="create()"
                wire:ignore>
                <span class="mdc-button__ripple"></span>Create
            </button>
        </x-slot>

        <div class="flex space-x-3">
            <div class="w-full">
                <label class="mdc-text-field mdc-text-field--filled w-full"
                    :class="{ 'mdc-text-field--invalid': errorMessages['assignment.name'] != undefined }" wire:ignore>
                    <span class="mdc-text-field__ripple"></span>
                    <span class="mdc-floating-label" id="assignment-name-label">Name</span>
                    <input class="mdc-text-field__input" type="text" aria-labelledby="assignment-name-label"
                        wire:model.lazy="assignment.name" required>
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
                                <polygon class="mdc-select__dropdown-icon-inactive" stroke="none" fill-rule="evenodd"
                                    points="7 10 12 15 17 10">
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
                            @foreach ($classes as $x)
                                <li class="mdc-deprecated-list-item" data-value="{{ $x['id'] }}" role="option"
                                    wire:click="setClass({{ $x['id'] }})">
                                    <span class="mdc-deprecated-list-item__ripple"></span>
                                    <span class="mdc-deprecated-list-item__text">
                                        {{ $x['name'] }}
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
            :class="{ 'mdc-text-field--invalid': errorMessages['assignment.link'] != undefined }" wire:ignore>
            <span class="mdc-text-field__ripple"></span>
            <span class="mdc-floating-label" id="assignment-link-label">Link</span>
            <input class="mdc-text-field__input" type="text" aria-labelledby="assignment-link-label"
                wire:model.lazy="assignment.link">
            <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error for="assignment.link" />

        <label
            class="mdc-text-field mdc-text-field--filled mdc-text-field--textarea mdc-text-field--with-internal-counter w-full"
            :class="{ 'mdc-text-field--invalid': errorMessages['assignment.description'] != undefined }" wire:ignore>
            <span class="mdc-floating-label" id="assignment-description-label">Description</span>
            <textarea class="mdc-text-field__input" aria-labelledby="assignment-description-label" rows="6"
                wire:model.lazy="assignment.description"></textarea>
            <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error for="assignment.description" />
    </x-ui.modal>
</div>

@push('scripts')
    <script data-swup-reload-script>
        function assignmentCreate() {
            return {
                dialog: false,

                errorMessages: @entangle('errorMessages'),

                date: new Date(),

                time: {
                    h: 23,
                    m: 59
                },

                init: function() {
                    this.$watch('date', (value, oldVal) => {
                        this.$wire.setDate(
                            value.getFullYear() + '-' + String(value.getMonth() + 1)
                            .padStart(2, '0') + '-' + String(value.getDate()).padStart(
                                2, '0')
                        )
                    });

                    this.$watch('time', (value) => {
                        this.$wire.setTime(value);
                    });
                },

                validDate: function(date) {
                    return date >= new Date();
                },
            }
        }
    </script>
@endpush
