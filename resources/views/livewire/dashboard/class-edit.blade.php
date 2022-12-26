 <div x-data="classEdit()"
@edit-class.window="selectClass(event.detail.id)">
  <x-ui.modal bind="dialog" title="Edit Class" class="top-3 bottom-3">
    <x-slot name="actions">
      <button class="float-left mr-3 -mt-1 mdc-icon-button material-icons" type="button" aria-describedby="delete-class" aria-label="close" @click="$dispatch('delete-class', editClass.id); dialog = false">delete</button>
      <x-ui.tooltip tooltip-id="delete-class" text="Delete Class"/>
      <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" wire:click="edit">
        <span class="mdc-button__ripple"></span>Save
      </button>
    </x-slot>
    <div class="flex w-full space-x-3">
      <div class="w-full">
        <label class="w-full mdc-text-field mdc-text-field--filled" :class="{'mdc-text-field--invalid': errorMessages['editClass.name'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label mdc-floating-label--float-above" id="edit-class-name-label">Name</span>
          <input class="mdc-text-field__input" wire:model.lazy="editClass.name" x-model="editClass.name" type="text" aria-labelledby="edit-class-name-label" required>
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error for="editClass.name"/>
      </div>
      <div class="w-full">
        <label class="w-full mdc-text-field mdc-text-field--filled" :class="{'mdc-text-field--invalid': errorMessages['editClass.location'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label mdc-floating-label--float-above" id="edit-class-location-label">Location</span>
          <input class="mdc-text-field__input" wire:model.lazy="editClass.location" x-model="editClass.location" type="text" aria-labelledby="edit-class-location-label">
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error for="editClass.location"/>
      </div>
    </div>

    <div class="flex w-full space-x-3">
      <div class="w-full">
        <label class="w-full mdc-text-field mdc-text-field--filled" :class="{'mdc-text-field--invalid': errorMessages['editClass.teacher'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label mdc-floating-label--float-above" id="edit-class-teacher-label">Teacher</span>
          <input class="mdc-text-field__input" wire:model.lazy="editClass.teacher" x-model="editClass.teacher" type="text" aria-labelledby="edit-class-teacher-label" required>
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error for="editClass.teacher"/>
      </div>
      <div class="w-full">
        <label class="w-full mdc-text-field mdc-text-field--filled" :class="{'mdc-text-field--invalid': errorMessages['editClass.teacher_email'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label mdc-floating-label--float-above" id="teacher-email-label">Teacher email</span>
          <input class="mdc-text-field__input" wire:model.lazy="editClass.teacher_email" x-model="editClass.teacher_email" type="text" aria-labelledby="teacher-email-label">
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error for="editClass.teacher_email"/>
      </div>
    </div>

    <label class="w-full mdc-text-field mdc-text-field--filled" :class="{'mdc-text-field--invalid': errorMessages['editClass.video_link'] != undefined}" wire:ignore>
      <span class="mdc-text-field__ripple"></span>
      <span class="mdc-floating-label mdc-floating-label--float-above" id="vid-link-label">Zoom/Google Meet link</span>
      <input class="mdc-text-field__input" wire:model.lazy="editClass.video_link" x-model="editClass.video_link" type="text" aria-labelledby="vid-link-label">
      <span class="mdc-line-ripple"></span>
    </label>
    <x-ui.validation-error for="editClass.video_link"/>

    <div class="ml-1 text-lg font-medium text-gray-700">Color</div>
    <div class="py-3 mx-auto mb-2 px-auto">
      @foreach ($colorOptions as $color)
        <div class="background-{{$color}} mdc-icon-button rounded-full h-11 w-11 mx-1" :class="{'border-white border-solid border-3': color == '{{$color}}'}" @click="color = '{{$color}}'">
          <div class="mdc-icon-button__ripple"></div>
        </div>
      @endforeach
    </div>
    <div class="pt-4 mb-5 ml-1 text-base font-medium border-t border-gray-100 text-primary">Links for this class</div>
    <div wire:ignore>
      <template x-if="links.length > 0">
        <template x-for="(item, index) in links">
          <div class="flex">
            <div class="flex flex-grow space-x-3">
              <div class="basis-1/3">
                <label class="w-full mdc-text-field mdc-text-field--filled" :class="{'mdc-text-field--invalid': errorMessages['links.' + index + '.link']}" wire:ignore>
                  <span class="mdc-text-field__ripple"></span>
                  <span class="mdc-floating-label mdc-floating-label--float-above" :id="`link-${index}-name`">Link name</span>
                  <input class="mdc-text-field__input" type="text" :aria-labelledby="`link-${index}-name`" x-init="$el.value = links[index]['name']" @keyup="links[index]['name'] = $el.value">
                  <span class="mdc-line-ripple"></span>
                </label>
                <div class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg mdc-text-field-helper-text--persistent text-error ml-1 mt-0.5 mb-0.5 h-6" aria-hidden="true">
                  <template x-if="errorMessages['links.' + index + '.name']">
                    <span x-text="errorMessages['links.' + index + '.name'][0]"></span>
                  </template>
                </div>
              </div>
              <div class="basis-2/3">
                <label class="w-full mdc-text-field mdc-text-field--filled" :class="{'mdc-text-field--invalid': errorMessages['links.' + index + '.link']}" wire:ignore>
                  <span class="mdc-text-field__ripple"></span>
                  <span class="mdc-floating-label mdc-floating-label--float-above" :id="`link-${index}-url`">URL</span>
                  <input class="mdc-text-field__input" type="text" :aria-labelledby="`link-${index}-url`"  x-init="$el.value = links[index]['link']" @keyup="links[index]['link'] = $el.value">
                  <span class="mdc-line-ripple"></span>
                </label>
                <div class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg mdc-text-field-helper-text--persistent text-error ml-1 mt-0.5 mb-0.5 h-6" aria-hidden="true">
                  <template x-if="errorMessages['links.' + index + '.link']">
                    <span x-text="errorMessages['links.' + index + '.link'][0]"></span>
                  </template>
                </div>
              </div>             
            </div>
            <div class="w-12">
              <button class="mt-1 ml-3 text-gray-600 mdc-icon-button material-icons" type="button" @click="removeLink(index)">
                <div class="mdc-icon-button__ripple"></div>
                remove_circle_outline
              </button>
            </div>
          </div>
        </template>
      </template>
      <button class="mdc-button mdc-button--icon-leading" type="button" @click="addLink" :disabled="links.length > 9">
        <span class="mdc-button__ripple"></span>
        <i class="material-icons mdc-button__icon" aria-hidden="true">add_circle_outline</i>
        <span class="mdc-button__label">Add New Link</span>
      </button>
    </div>
  </x-ui.modal>
</div>

@push('scripts')
  <script>
    function classEdit(){
      return{
        dialog: false,
        color: '',
        links: @entangle('links').defer,
        loading: false,

        errorMessages: @entangle('errorMessages'),

        editClass: -1,

        init: function () {
          this.$watch('color', (val) => {
            this.$wire.call('setColor', val);
          })
        },

        selectClass: function(id) {
          this.editClass = this.classData[id];

          this.links = [];

          this.editClass.links.forEach((val) => {
            this.links.push({name: val.name, link: val.link});
          })

          this.color = this.editClass.color;
          this.$wire.call('selectClass', id);

          this.dialog = true;
        },

        addLink: function(){
          if (this.links.length < 10)
            this.links.push({'name': '', 'link': ''});
        },

        removeLink: function(pos){
          this.links.splice(pos - 1, 1);
        },
      }
    }
  </script>
@endpush
