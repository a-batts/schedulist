 <div class="mdc-typography" x-data="classCreate()" @close-add-diag="dialog = false">
     <div class="fab_button">
         <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Class" @click="reset()"
             wire:offline.attr="disabled">
             <div class="mdc-fab__ripple"></div>
             <span class="material-icons mdc-fab__icon">add</span>
             <span class="mdc-fab__label">Add Class</span>
         </button>
     </div>
     <x-ui.modal class="top-3 bottom-3" title="New Class" bind="dialog">
         <x-slot name="actions">
             <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" :disabled="offline"
                 wire:click="create">
                 <span class="mdc-button__ripple"></span>Create
             </button>
         </x-slot>
         <div class="flex w-full space-x-3">
             <div class="w-full">
                 <label class="mdc-text-field mdc-text-field--filled w-full"
                     :class="{ 'mdc-text-field--invalid': errorMessages['class.name'] != undefined }" wire:ignore>
                     <span class="mdc-text-field__ripple"></span>
                     <span class="mdc-floating-label" id="new-class-name-label">Name</span>
                     <input class="mdc-text-field__input" type="text" aria-labelledby="new-class-name-label"
                         wire:model.lazy="class.name" required>
                     <span class="mdc-line-ripple"></span>
                 </label>
                 <x-ui.validation-error for="class.name" />
             </div>
             <div class="w-full">
                 <label class="mdc-text-field mdc-text-field--filled w-full"
                     :class="{ 'mdc-text-field--invalid': errorMessages['class.location'] != undefined }" wire:ignore>
                     <span class="mdc-text-field__ripple"></span>
                     <span class="mdc-floating-label" id="new-class-location-label">Location</span>
                     <input class="mdc-text-field__input" type="text" aria-labelledby="new-class-location-label"
                         wire:model.lazy="class.location">
                     <span class="mdc-line-ripple"></span>
                 </label>
                 <x-ui.validation-error for="class.location" />
             </div>
         </div>

         <div class="flex w-full space-x-3">
             <div class="w-full">
                 <label class="mdc-text-field mdc-text-field--filled w-full"
                     :class="{ 'mdc-text-field--invalid': errorMessages['class.teacher'] != undefined }" wire:ignore>
                     <span class="mdc-text-field__ripple"></span>
                     <span class="mdc-floating-label" id="new-class-teacher-label">Teacher</span>
                     <input class="mdc-text-field__input" type="text" aria-labelledby="new-class-teacher-label"
                         wire:model.lazy="class.teacher" required>
                     <span class="mdc-line-ripple"></span>
                 </label>
                 <x-ui.validation-error for="class.teacher" />
             </div>
             <div class="w-full">
                 <label class="mdc-text-field mdc-text-field--filled w-full"
                     :class="{ 'mdc-text-field--invalid': errorMessages['class.teacher_email'] != undefined }"
                     wire:ignore>
                     <span class="mdc-text-field__ripple"></span>
                     <span class="mdc-floating-label" id="teacher-email-label">Teacher email</span>
                     <input class="mdc-text-field__input" type="text" aria-labelledby="teacher-email-label"
                         wire:model.lazy="class.teacher_email">
                     <span class="mdc-line-ripple"></span>
                 </label>
                 <x-ui.validation-error for="class.teacher_email" />
             </div>
         </div>

         <label class="mdc-text-field mdc-text-field--filled w-full"
             :class="{ 'mdc-text-field--invalid': errorMessages['class.video_link'] != undefined }" wire:ignore>
             <span class="mdc-text-field__ripple"></span>
             <span class="mdc-floating-label" id="vid-link-label">Zoom/Google Meet link</span>
             <input class="mdc-text-field__input" type="text" aria-labelledby="vid-link-label"
                 wire:model.lazy="class.video_link">
             <span class="mdc-line-ripple"></span>
         </label>
         <x-ui.validation-error for="class.video_link" />

         <div class="text-primary ml-1 text-base font-medium">Color</div>
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
         function classCreate() {
             return {
                 dialog: false,
                 color: 'pink',

                 errorMessages: @entangle('errorMessages'),

                 init: function() {
                     this.$watch('color', (val) => {
                         this.$wire.call('setColor', val);
                     })
                 },

                 reset: function() {
                     this.color = 'pink';
                     this.dialog = true;
                 },
             }
         }
     </script>
 @endpush
