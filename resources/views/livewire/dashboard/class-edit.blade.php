 <div x-data="classEdit()" @edit-class.window="selectClass(event.detail.id)" wire:ignore>
     <x-ui.modal class="top-3 bottom-3" title="Edit Class" bind="dialog">
         <x-slot name="actions">
             <button class="mdc-icon-button material-icons float-left mr-3 -mt-1" type="button"
                 aria-describedby="delete-class" aria-label="close"
                 @click="$dispatch('delete-class', selectedClass); dialog = false">delete</button>
             <x-ui.tooltip tooltip-id="delete-class" text="Delete Class" />
             <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" wire:click="edit">
                 <span class="mdc-button__ripple"></span>Save
             </button>
         </x-slot>
         <div class="flex w-full space-x-3">
             <div class="w-full">
                 <label class="mdc-text-field mdc-text-field--filled w-full"
                     :class="{ 'mdc-text-field--invalid': errorMessages['editClass.name'] != undefined }" wire:ignore>
                     <span class="mdc-text-field__ripple"></span>
                     <span class="mdc-floating-label mdc-floating-label--float-above"
                         id="edit-class-name-label">Name</span>
                     <input class="mdc-text-field__input" type="text" aria-labelledby="edit-class-name-label"
                         wire:model.lazy="editClass.name" x-model="editClass.name" required>
                     <span class="mdc-line-ripple"></span>
                 </label>
                 <x-ui.validation-error for="editClass.name" />
             </div>
             <div class="w-full">
                 <label class="mdc-text-field mdc-text-field--filled w-full"
                     :class="{ 'mdc-text-field--invalid': errorMessages['editClass.location'] != undefined }"
                     wire:ignore>
                     <span class="mdc-text-field__ripple"></span>
                     <span class="mdc-floating-label mdc-floating-label--float-above"
                         id="edit-class-location-label">Location</span>
                     <input class="mdc-text-field__input" type="text" aria-labelledby="edit-class-location-label"
                         wire:model.lazy="editClass.location" x-model="editClass.location">
                     <span class="mdc-line-ripple"></span>
                 </label>
                 <x-ui.validation-error for="editClass.location" />
             </div>
         </div>

         <div class="flex w-full space-x-3">
             <div class="w-full">
                 <label class="mdc-text-field mdc-text-field--filled w-full"
                     :class="{ 'mdc-text-field--invalid': errorMessages['editClass.teacher'] != undefined }"
                     wire:ignore>
                     <span class="mdc-text-field__ripple"></span>
                     <span class="mdc-floating-label mdc-floating-label--float-above"
                         id="edit-class-teacher-label">Teacher</span>
                     <input class="mdc-text-field__input" type="text" aria-labelledby="edit-class-teacher-label"
                         wire:model.lazy="editClass.teacher" x-model="editClass.teacher" required>
                     <span class="mdc-line-ripple"></span>
                 </label>
                 <x-ui.validation-error for="editClass.teacher" />
             </div>
             <div class="w-full">
                 <label class="mdc-text-field mdc-text-field--filled w-full"
                     :class="{ 'mdc-text-field--invalid': errorMessages['editClass.teacher_email'] != undefined }"
                     wire:ignore>
                     <span class="mdc-text-field__ripple"></span>
                     <span class="mdc-floating-label mdc-floating-label--float-above" id="teacher-email-label">Teacher
                         email</span>
                     <input class="mdc-text-field__input" type="text" aria-labelledby="teacher-email-label"
                         wire:model.lazy="editClass.teacher_email" x-model="editClass.teacher_email">
                     <span class="mdc-line-ripple"></span>
                 </label>
                 <x-ui.validation-error for="editClass.teacher_email" />
             </div>
         </div>

         <label class="mdc-text-field mdc-text-field--filled w-full"
             :class="{ 'mdc-text-field--invalid': errorMessages['editClass.video_link'] != undefined }" wire:ignore>
             <span class="mdc-text-field__ripple"></span>
             <span class="mdc-floating-label mdc-floating-label--float-above" id="vid-link-label">Zoom/Google Meet
                 link</span>
             <input class="mdc-text-field__input" type="text" aria-labelledby="vid-link-label"
                 wire:model.lazy="editClass.video_link" x-model="editClass.video_link">
             <span class="mdc-line-ripple"></span>
         </label>
         <x-ui.validation-error for="editClass.video_link" />

         <div class="ml-1 text-lg font-medium text-gray-700">Color</div>
         <div class="px-auto mx-auto mb-2 py-3">
             @foreach ($colorOptions as $color)
                 <div class="background-{{ $color }} mdc-icon-button mx-1 h-11 w-11 rounded-full"
                     :class="{ 'border-white border-solid border-3': color == '{{ $color }}' }"
                     @click="color = '{{ $color }}'">
                     <div class="mdc-icon-button__ripple"></div>
                 </div>
             @endforeach
         </div>
     </x-ui.modal>
 </div>

 @push('scripts')
     <script data-swup-reload-script>
         function classEdit() {
             return {
                 dialog: false,
                 editClass: -1,
                 color: '',

                 errorMessages: @entangle('errorMessages'),

                 init: function() {
                     this.$watch('color', (val) => {
                         this.$wire.call('setColor', val);
                     })
                 },

                 selectClass: function(id) {
                     this.editClass = this.classData[id];
                     this.color = this.editClass.color;
                     this.$wire.call('selectClass', id);

                     this.dialog = true;
                 }
             }
         }
     </script>
 @endpush
