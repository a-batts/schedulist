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
         <div class="px-auto py-3 mx-auto mb-2">
             @foreach ($colorOptions as $color)
                 <div class="background-{{ $color }} mdc-icon-button mx-1 h-11 w-11 rounded-full"
                     :class="{ 'border-white border-solid border-3': color == '{{ $color }}' }"
                     @click="color = '{{ $color }}'">
                     <div class="mdc-icon-button__ripple"></div>
                 </div>
             @endforeach
         </div>
         <div class="text-primary pt-4 mb-5 ml-1 text-base font-medium border-t border-gray-100">Links for this class
         </div>
         <div wire:ignore>
             <template x-if="links.length > 0">
                 <template x-for="(item, index) in links">
                     <div class="flex">
                         <div class="flex flex-grow space-x-3">
                             <div class="basis-1/3">
                                 <label class="mdc-text-field mdc-text-field--filled w-full"
                                     :class="{ 'mdc-text-field--invalid': errorMessages['links.' + index + '.link'] }"
                                     wire:ignore>
                                     <span class="mdc-text-field__ripple"></span>
                                     <span class="mdc-floating-label mdc-floating-label--float-above"
                                         :id="`link-${index}-name`">Link name</span>
                                     <input class="mdc-text-field__input" type="text"
                                         :aria-labelledby="`link-${index}-name`"
                                         @keyup="links[index]['name'] = $el.value">
                                     <span class="mdc-line-ripple"></span>
                                 </label>
                                 <div class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg mdc-text-field-helper-text--persistent text-error ml-1 mt-0.5 mb-0.5 h-6"
                                     aria-hidden="true">
                                     <template x-if="errorMessages['links.' + index + '.name']">
                                         <span x-text="errorMessages['links.' + index + '.name'][0]"></span>
                                     </template>
                                 </div>
                             </div>
                             <div class="basis-2/3">
                                 <label class="mdc-text-field mdc-text-field--filled w-full"
                                     :class="{ 'mdc-text-field--invalid': errorMessages['links.' + index + '.link'] }"
                                     wire:ignore>
                                     <span class="mdc-text-field__ripple"></span>
                                     <span class="mdc-floating-label mdc-floating-label--float-above"
                                         :id="`link-${index}-url`">URL</span>
                                     <input class="mdc-text-field__input" type="text"
                                         :aria-labelledby="`link-${index}-url`"
                                         @keyup="links[index]['link'] = $el.value">
                                     <span class="mdc-line-ripple"></span>
                                 </label>
                                 <div class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg mdc-text-field-helper-text--persistent text-error ml-1 mt-0.5 mb-0.5 h-6"
                                     aria-hidden="true">
                                     <template x-if="errorMessages['links.' + index + '.link']">
                                         <span x-text="errorMessages['links.' + index + '.link'][0]"></span>
                                     </template>
                                 </div>
                             </div>
                         </div>
                         <div class="w-12">
                             <button class="mdc-icon-button material-icons mt-1 ml-3 text-gray-600" type="button"
                                 @click="removeLink(index)">
                                 <div class="mdc-icon-button__ripple"></div>
                                 remove_circle_outline
                             </button>
                         </div>
                     </div>
                 </template>
             </template>
             <button class="mdc-button mdc-button--icon-leading" type="button" @click="addLink"
                 :disabled="links.length > 9">
                 <span class="mdc-button__ripple"></span>
                 <i class="material-icons mdc-button__icon" aria-hidden="true">add_circle_outline</i>
                 <span class="mdc-button__label">Add New Link</span>
             </button>
         </div>
     </x-ui.modal>
 </div>

 @push('scripts')
     <script data-swup-reload-script>
         function classCreate() {
             return {
                 dialog: false,

                 color: 'pink',
                 links: @entangle('links').defer,

                 errorMessages: @entangle('errorMessages'),

                 init: function() {
                     this.$watch('color', (val) => {
                         this.$wire.call('setColor', val);
                     })
                 },

                 addLink: function() {
                     if (this.links.length < 10)
                         this.links.push({
                             'name': '',
                             'link': ''
                         });
                 },

                 removeLink: function(pos) {
                     this.links.splice(pos - 1, 1);
                 },

                 reset: function() {
                     this.color = 'pink';
                     this.dialog = true;
                 },
             }
         }
     </script>
 @endpush
