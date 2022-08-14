 <div x-data="classEdit()"
x-init = "init()"
@edit-class.window="editClass(event.detail.id)"
class="roboto overflow-y-auto">
  <x-ui.modal alpine="dialog" title="Edit Class" action="Save" classes="top-3 bottom-3" wire:submit.prevent="edit">
    <x-slot name="topAction">
      <button class="mdc-icon-button material-icons float-left -mt-1 mr-3" type="button" aria-describedby="delete-class" aria-label="close" @click="$dispatch('delete-class', selClass.id); dialog = false">delete</button>
      <x-ui.tooltip tooltip-id="delete-class" text="Delete Class"/>
    </x-slot>
    <div>
      <div class="float-left w-1/2 pr-1.5">
        <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['selClass.name'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label mdc-floating-label--float-above" id="class-name-label">Class Name</span>
          <input class="mdc-text-field__input" wire:model.lazy="selClass.name" x-model="selClass.name" type="text" aria-labelledby="class-name-label" required>
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error :message="$errorMessages" for="selClass.name"/>
      </div>
      <div class="float-right w-1/2 pl-1.5">
        <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['selClass.teacher'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label mdc-floating-label--float-above" id="class-teacher-label">Teacher</span>
          <input class="mdc-text-field__input" wire:model.lazy="selClass.teacher" x-model="selClass.teacher" type="text" aria-labelledby="class-teacher-label" required>
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error :message="$errorMessages" for="selClass.teacher"/>
      </div>
    </div>
    <div>
      <div class="float-left w-1/2 pr-1.5">
        <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['selClass.teacher_email'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label mdc-floating-label--float-above" id="teacher-email-label">Teacher Email</span>
          <input class="mdc-text-field__input" wire:model.lazy="selClass.teacher_email" x-model="selClass.teacher_email" type="text" aria-labelledby="teacher-email-label">
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error :message="$errorMessages" for="selClass.teacher_email"/>
      </div>
    </div>
    <div>
      <div class="float-left w-2/3 pr-1.5">
        <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['selClass.class_location'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label mdc-floating-label--float-above" id="class-location-label">Class Location</span>
          <input class="mdc-text-field__input" wire:model.lazy="selClass.class_location" x-model="selClass.class_location" type="text" aria-labelledby="class-location-label">
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error :message="$errorMessages" for="selClass.class_location"/>
      </div>
      <div class="float-right w-1/3 pl-1.5">
        <label class="mdc-text-field mdc-text-field--filled w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['selClass.period'] != undefined, 'mdc-text-field--label-floating': selClass.period != null}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label" :style="selClass.period != null ? 'transform: translateY(-106%) scale(0.75)' : ''" id="class-period-label">Period</span>
          <input class="mdc-text-field__input" wire:model.lazy="selClass.period" x-model="selClass.period" type="text" aria-labelledby="class-period-label">
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error :message="$errorMessages" for="selClass.period"/>
      </div>
    </div>
    <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['selClass.video_link'] != undefined}" wire:ignore>
      <span class="mdc-text-field__ripple"></span>
      <span class="mdc-floating-label mdc-floating-label--float-above" id="vid-link-label">Video Link</span>
      <input class="mdc-text-field__input" wire:model.lazy="selClass.video_link" x-model="selClass.video_link" type="text" aria-labelledby="vid-link-label">
      <span class="mdc-line-ripple"></span>
    </label>
    <x-ui.validation-error :message="$errorMessages" for="selClass.video_link"/>
    <div class="ml-1 text-lg font-medium text-gray-700">Color</div>
    <div class="px-auto mx-auto mb-2 py-3">
      @foreach ($colorOptions as $color)
        <div class="background-{{$color}} mdc-icon-button rounded-full h-11 w-11 mx-1" x-bind:class="{'border-white border-solid border-3': color == '{{$color}}'}" @click="setColor('{{$color}}')">
          <div class="mdc-icon-button__ripple"></div>
        </div>
      @endforeach
    </div>
    <div wire:ignore>
      <template x-if="numberLinks > 0">
        <template x-for="i in numberLinks">
          <div>
            <div class="float-left w-1/3 pr-1.5">
              <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['links_'+(i-1)+'_name'] != undefined}" wire:ignore>
                <span class="mdc-text-field__ripple"></span>
                <span class="mdc-floating-label mdc-floating-label--float-above" :id="`link-${i}-name`">Link Name</span>
                <input class="mdc-text-field__input" x-model="selClass['links'][i - 1]['name']"  type="text" :aria-labelledby="`link-${i}-name`" @keyup="@this.setLink(i, selClass['links'][i - 1]['name'], selClass['links'][i - 1]['link'])">
                <span class="mdc-line-ripple"></span>
              </label>
              <div class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg mdc-text-field-helper-text--persistent text-error ml-1 mt-0.5 mb-0.5 h-5" aria-hidden="true">
                <template x-if="errorMessages['links_'+(i-1)+'_name'] != null">
                  <span x-text="errorMessages['links_'+(i-1)+'_name'][0]"></span>
                </template>
              </div>
            </div>
            <div class="float-right w-2/3 pl-1.5">
              <div class="link-field-left float-left">
                <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating w-full" x-bind:class="{'mdc-text-field--invalid': errorMessages['links_'+(i-1)+'_url'] != undefined}" wire:ignore>
                  <span class="mdc-text-field__ripple"></span>
                  <span class="mdc-floating-label mdc-floating-label--float-above" :id="`link-${i}-url`">URL</span>
                  <input class="mdc-text-field__input" x-model="selClass['links'][i - 1]['link']" type="text" :aria-labelledby="`link-${i}-url`" @keyup="@this.setLink(i, selClass['links'][i - 1]['name'], selClass['links'][i - 1]['link'])">
                  <span class="mdc-line-ripple"></span>
                </label>
                <div class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg mdc-text-field-helper-text--persistent text-error ml-1 mt-0.5 mb-0.5 h-5" aria-hidden="true">
                  <template x-if="errorMessages['links_'+(i-1)+'_url'] != null">
                    <span x-text="errorMessages['links_'+(i-1)+'_url'][0]"></span>
                  </template>
                </div>
              </div>
              <div class="float-left w-12">
                <template x-if="i != numberLinks">
                  <button class="mdc-icon-button material-icons ml-3 mt-1 text-gray-600" type="button" @click="removeLink(i)">
                    <div class="mdc-icon-button__ripple"></div>
                    remove_circle_outline
                  </button>
                </template>
              </div>
            </div>
          </div>
        </template>
      </template>
      <button class="mdc-button mdc-button--icon-leading" type="button" @click="addLink" :disabled="numberLinks > 9">
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
        classData: @entangle('classData'),
        color: '',
        dialog: false,
        errorMessages: @entangle('errorMessages'),
        numberLinks: 0,
        selClass: -1,
        addLink: function(){
          if (this.numberLinks < 10){
            this.numberLinks ++;
            this.selClass.links[this.numberLinks - 1] = {'name': '', 'link': ''};
          }
        },
        editClass: function(id){
          fixBody();
          this.selClass = JSON.parse(JSON.stringify(this.classData[id]));
          this.selClass.links[this.selClass.links.length] = {'name': '', 'link': ''};
          this.numberLinks = this.classData[id].links.length + 1;
          this.dialog = true;
          Livewire.emit('selectClass', id);
          this.color = this.selClass.color;

        },
        init: function(){
        },
        removeLink: function(pos){
          this.selClass.links.splice(pos - 1, 1);
          this.numberLinks--;
          @this.removeLink(pos);
        },
        setColor: function(color){
          this.color = color;
          @this.setColor(color);
        }
      }
    }
  </script>
@endpush
