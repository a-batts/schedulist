<div class="mdc-typography" x-data="classCreate()">
  <div class="fab_button">
    <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Class" @click="newClass()" wire:offline.attr="disabled">
      <div class="mdc-fab__ripple"></div>
      <span class="material-icons mdc-fab__icon">add</span>
      <span class="mdc-fab__label">Add Class</span>
    </button>
  </div>
  <x-ui.modal bind="addDialog" title="New Class" class="top-3 bottom-3">
    <x-slot name="actions">
      <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" wire:click="create">
        <span class="mdc-button__ripple"></span>Create
      </button>
    </x-slot>
    <div>
      <div class="float-left w-1/2 pr-1.5">
        <label class="w-full mdc-text-field mdc-text-field--filled" x-bind:class="{'mdc-text-field--invalid': errorMessages['class.name'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label" id="new-class-name-label">Class Name</span>
          <input class="mdc-text-field__input" wire:model.lazy="class.name" type="text" aria-labelledby="new-class-name-label" required>
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error :message="$errorMessages" for="class.name"/>
      </div>
      <div class="float-right w-1/2 pl-1.5">
        <label class="w-full mdc-text-field mdc-text-field--filled" x-bind:class="{'mdc-text-field--invalid': errorMessages['class.teacher'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label" id="new-class-teacher-label">Teacher</span>
          <input class="mdc-text-field__input" wire:model.lazy="class.teacher" type="text" aria-labelledby="new-class-teacher-label" required>
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error :message="$errorMessages" for="class.teacher"/>
      </div>
    </div>
    <div>
      <div class="float-left w-1/2 pr-1.5">
        <label class="w-full mdc-text-field mdc-text-field--filled" x-bind:class="{'mdc-text-field--invalid': errorMessages['class.teacher_email'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label" id="teacher-email-label">Teacher Email</span>
          <input class="mdc-text-field__input" wire:model.lazy="class.teacher_email" type="text" aria-labelledby="teacher-email-label">
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error :message="$errorMessages" for="class.teacher_email"/>
      </div>
    </div>
    <div>
      <div class="float-left w-2/3 pr-1.5">
        <label class="w-full mdc-text-field mdc-text-field--filled" x-bind:class="{'mdc-text-field--invalid': errorMessages['class.class_location'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label" id="new-class-location-label">Class Location</span>
          <input class="mdc-text-field__input" wire:model.lazy="class.class_location" type="text" aria-labelledby="new-class-location-label">
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error :message="$errorMessages" for="class.class_location"/>
      </div>
      <div class="float-right w-1/3 pl-1.5">
        <label class="w-full mdc-text-field mdc-text-field--filled" x-bind:class="{'mdc-text-field--invalid': errorMessages['class.period'] != undefined}" wire:ignore>
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label" id="new-class-period-label">Period</span>
          <input class="mdc-text-field__input" wire:model.lazy="class.period" type="text" aria-labelledby="new-class-period-label">
          <span class="mdc-line-ripple"></span>
        </label>
        <x-ui.validation-error :message="$errorMessages" for="class.period"/>
      </div>
    </div>
    <label class="w-full mdc-text-field mdc-text-field--filled" x-bind:class="{'mdc-text-field--invalid': errorMessages['class.video_link'] != undefined}" wire:ignore>
      <span class="mdc-text-field__ripple"></span>
      <span class="mdc-floating-label" id="vid-link-label">Video Link</span>
      <input class="mdc-text-field__input" wire:model.lazy="class.video_link" type="text" aria-labelledby="vid-link-label">
      <span class="mdc-line-ripple"></span>
    </label>
    <x-ui.validation-error :message="$errorMessages" for="class.video_link"/>
    <div class="ml-1 text-lg font-medium text-gray-700">Color</div>
    <div class="py-3 mx-auto mb-2 px-auto">
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
              <label class="w-full mdc-text-field mdc-text-field--filled" x-bind:class="{'mdc-text-field--invalid': errorMessages['links_'+(i-1)+'_name'] != undefined}" wire:ignore>
                <span class="mdc-text-field__ripple"></span>
                <span class="mdc-floating-label" :id="`link-${i}-name`">Link Name</span>
                <input class="mdc-text-field__input"  type="text" :aria-labelledby="`link-${i}-name`" @keyup="@this.setLink(i, class['links'][i - 1]['name'], class['links'][i - 1]['link'])">
                <span class="mdc-line-ripple"></span>
              </label>
              <div class="mdc-text-field-helper-text mdc-text-field-helper-text--validation-msg mdc-text-field-helper-text--persistent text-error ml-1 mt-0.5 mb-0.5 h-5" aria-hidden="true">
                <template x-if="errorMessages['links_'+(i-1)+'_name'] != null">
                  <span x-text="errorMessages['links_'+(i-1)+'_name'][0]"></span>
                </template>
              </div>
            </div>
            <div class="float-right w-2/3 pl-1.5">
              <div class="float-left link-field-left">
                <label class="w-full mdc-text-field mdc-text-field--filled" x-bind:class="{'mdc-text-field--invalid': errorMessages['links_'+(i-1)+'_url'] != undefined}" wire:ignore>
                  <span class="mdc-text-field__ripple"></span>
                  <span class="mdc-floating-label" :id="`link-${i}-url`">URL</span>
                  <input class="mdc-text-field__input" type="text" :aria-labelledby="`link-${i}-url`" @keyup="@this.setLink(i, class['links'][i - 1]['name'], class['links'][i - 1]['link'])">
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
                  <button class="mt-1 ml-3 text-gray-600 mdc-icon-button material-icons" type="button" @click="removeLink(i)">
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
    function classCreate(){
      return{
        color: 'pink',
        addDialog: false,
        errorMessages: @entangle('errorMessages'),
        numberLinks: 0,
        class: -1,
        addLink: function(){
          if (this.numberLinks < 10){
            this.numberLinks ++;
            this.class.links[this.numberLinks - 1] = {'name': '', 'link': ''};
          }
        },
        newClass: function(){
          this.class = JSON.parse(JSON.stringify(@this.class));
          this.class['links'] = [];
          this.class.links[0] = {'name': '', 'link': ''};
          this.numberLinks = 1;
          this.addDialog = true;
        },
        removeLink: function(pos){
          this.class.links.splice(pos - 1, 1);
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
