<div x-data="classEdit()"
x-init="loadInitData()"
@set-edit-class.window="editClass = classDataArray[$event.detail.period]; @this.initPeriod = $event.detail.period">
  <form wire:submit.prevent="save">
    <div class="mdc-card mdc-card--outlined addclass_card" style="position:absolute; left: 0; right: 0">
      <div class="toprowcontainer">
        <div class="closebutton">
          <button class="mdc-icon-button close-icon material-icons closeleft" type="reset" aria-describedby="close-tooltip" @click="$dispatch('close-edit-modal'); undoFixBody()" aria-label="Close Edit Menu">close</button>
          <h1 class="closeright mdc-typography--headline6 nunito">Edit Class</h1>
        </div>
        <div id="close-tooltip" class="mdc-tooltip" role="tooltip" aria-hidden="true">
          <div class="mdc-tooltip__surface">
            Close
          </div>
        </div>
        <div class="addbutton">
          <button class="mdc-button mdc-button--raised mdc-button-ripple" type="submit" aria-label="Add" x-bind:disabled="! navigator.onLine" wire:ignore>
            <span class="mdc-button__ripple"></span>Save
          </button>
        </div>
      </div>
      <div>
        @if($errors->any())
           <div class="alertmessage" style="height: {{count($errors) * 24 + 20}}px">
             <div style="width:24px; float:left">
               <span class="material-icons">error</span>
             </div>
             <div style="width: calc(100% - 24px); float:right">
              <ul>
                @foreach ($errors->all() as $error)
                  <li class="addmessage ml-2" wire:key="{{$error}}">{{$error}}</li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif
      </div>
      <div class="double mb-6">
        <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating double_left @error('editclass.name') mdc-text-field--invalid @enderror">
          <span class="mdc-text-field__ripple"></span>
          <input type="text" class="mdc-text-field__input" aria-labelledby="name-label" wire:model.lazy="editclass.name" x-model="editClass.name" required>
          <span class="mdc-floating-label mdc-floating-label--float-above">Class Name</span>
          <span class="mdc-line-ripple"></span>
        </label>

        <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating double_right mdc-text-field--label-floating @error('editclass.teacher') mdc-text-field--invalid @enderror">
          <span class="mdc-text-field__ripple" wire:ignore></span>
          <input type="text" class="mdc-text-field__input" aria-labelledby="teacher-label" wire:model.lazy="editclass.teacher" x-model="editClass.teacher" wire:ignore required>
          <span class="mdc-floating-label mdc-floating-label--float-above" wire:ignore>Teacher</span>
          <span class="mdc-line-ripple" wire:ignore></span>
        </label>
      </div>
      <div class="select-textfield-row mb-1">
        <div class="textfield-right-container">
          <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating textfield-right mdc-text-field--label-floating @error('editclass.class_link') mdc-text-field--invalid @enderror">
            <span class="mdc-text-field__ripple"></span>
            <input type="url" class="mdc-text-field__input" aria-labelledby="class-label" wire:model.lazy="editclass.class_link" x-model="editClass.class_link" required>
            <span class="mdc-floating-label mdc-floating-label--float-above">Class Link</span>
            <span class="mdc-line-ripple"></span>
          </label>
          <div class="mdc-text-field-helper-line textfield-right-label">
            <div class="mdc-text-field-helper-text" id="my-helper-id" aria-hidden="true">Blackboard Collaborate, Google Meet or Zoom</div>
          </div>
        </div>
        <div class="select-left-container">
          <div class="mdc-select mdc-select--filled periodone period-select editperiod-select">
            <div class="mdc-select__anchor"
                 role="button"
                 aria-haspopup="listbox"
                 aria-expanded="false"
                 aria-required="true"
                 aria-labelledby="demo-label editperiod-select-sel">
              <span class="mdc-select__ripple"></span>
              <span class="mdc-select__selected-text-container">
                <span id="editperiod-select-sel" class="mdc-select__selected-text" x-text="editClass.period"></span>
              </span>
              <span class="mdc-select__dropdown-icon">
                <svg
                    class="mdc-select__dropdown-icon-graphic"
                    viewBox="7 10 10 5" focusable="false">
                  <polygon
                      class="mdc-select__dropdown-icon-inactive"
                      stroke="none"
                      fill-rule="evenodd"
                      points="7 10 12 15 17 10">
                  </polygon>
                  <polygon
                      class="mdc-select__dropdown-icon-active"
                      stroke="none"
                      fill-rule="evenodd"
                      points="7 15 12 10 17 15">
                  </polygon>
                </svg>
              </span>
              <span id="demo-label" class="mdc-floating-label" style="transform: translateY(-106%) scale(0.75);" wire:ignore>Period</span>
              <span class="mdc-line-ripple"></span>
            </div>
            <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
              <ul class="mdc-list dark-theme-list" role="listbox" aria-label="Starting week selection">
                @foreach($hasclass as $checkclass)
                <li class="mdc-list-item @if($checkclass == $editclass['period']) mdc-list-item--selected @endif" data-value="{{$checkclass}}" wire:click="setPeriod({{$checkclass}})" wire:key="{{$checkclass}}">
                  <span class="mdc-list-item__ripple"></span>
                  <span class="mdc-list-item__text">{{$checkclass}}</span>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="mdc-select mdc-select--filled mdc-select--with-leading-icon editcolorselect mb-6 mt-1">
        <div class="mdc-select__anchor">
          <i class="material-icons mdc-select__icon">palette</i>
          <span class="mdc-select__ripple"></span>
          <span class="mdc-select__selected-text-container">
            <span id="demo-selected-text" class="mdc-select__selected-text" x-text="editClass.color"></span>
          </span>
          <span class="mdc-select__dropdown-icon">
            <svg
                class="mdc-select__dropdown-icon-graphic"
                viewBox="7 10 10 5">
              <polygon
                  class="mdc-select__dropdown-icon-inactive"
                  stroke="none"
                  fill-rule="evenodd"
                  points="7 10 12 15 17 10">
              </polygon>
              <polygon
                  class="mdc-select__dropdown-icon-active"
                  stroke="none"
                  fill-rule="evenodd"
                  points="7 15 12 10 17 15">
              </polygon>
            </svg>
          </span>
          <span class="mdc-floating-label mdc-floating-label--float-above" style="transform: translateY(-106%) scale(0.75)">Class Color</span>
          <span class="mdc-line-ripple"></span>
        </div>

        <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
          <ul class="mdc-list dark-theme-list">
            <li class="mdc-list-item @if($editclass['color'] == "Red") mdc-list-item--selected @endif" data-value="Red" wire:click="setColor('Red')">
              <span class="mdc-list-item__ripple"></span>
              <span class="mdc-list-item__text">Red</span>
            </li>
            <li class="mdc-list-item @if($editclass['color'] == "Orange") mdc-list-item--selected @endif" data-value="Orange" wire:click="setColor('Orange')">
              <span class="mdc-list-item__ripple"></span>
              <span class="mdc-list-item__text">Orange</span>
            </li>
            <li class="mdc-list-item @if($editclass['color'] == "Yellow") mdc-list-item--selected @endif" data-value="Yellow" wire:click="setColor('Yellow')">
              <span class="mdc-list-item__ripple"></span>
              <span class="mdc-list-item__text">Yellow</span>
            </li>
            <li class="mdc-list-item @if($editclass['color'] == "Green") mdc-list-item--selected @endif" data-value="Green" wire:click="setColor('Green')">
              <span class="mdc-list-item__ripple"></span>
              <span class="mdc-list-item__text">Green</span>
            </li>
            <li class="mdc-list-item @if($editclass['color'] == "Lime") mdc-list-item--selected @endif" data-value="Lime" wire:click="setColor('Lime')">
              <span class="mdc-list-item__ripple"></span>
              <span class="mdc-list-item__text">Lime</span>
            </li>
            <li class="mdc-list-item @if($editclass['color'] == "Blue") mdc-list-item--selected @endif" data-value="Blue" wire:click="setColor('Blue')">
              <span class="mdc-list-item__ripple"></span>
              <span class="mdc-list-item__text">Blue</span>
            </li>
            <li class="mdc-list-item @if($editclass['color'] == "Indigo") mdc-list-item--selected @endif" data-value="Indigo" wire:click="setColor('Indigo')">
              <span class="mdc-list-item__ripple"></span>
              <span class="mdc-list-item__text">Indigo</span>
            </li>
            <li class="mdc-list-item @if($editclass['color'] == "Purple") mdc-list-item--selected @endif" data-value="Purple" wire:click="setColor('Purple')">
              <span class="mdc-list-item__ripple"></span>
              <span class="mdc-list-item__text">Purple</span>
            </li>
          </ul>
        </div>
      </div>
      <label class="mdc-text-field mdc-text-field--filled @if($editclass['teacher_email']) mdc-text-field--label-floating @endif @error('editclass.teacher_email') mdc-text-field--invalid @enderror mdc-text-field--with-leading-icon mb-6">
        <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" aria-hidden="true">email</i>
        <span class="mdc-text-field__ripple"></span>
        <input type="email" class="mdc-text-field__input" wire:model.lazy="editclass.teacher_email">
        <span class="mdc-floating-label @if($editclass['teacher_email']) mdc-floating-label--float-above @endif">Teacher Email</span>
        <span class="mdc-line-ripple"></span>
      </label>
      <div class="double mb-6">
        <label class="mdc-text-field mdc-text-field--filled @if($editclass['g_classroom']) mdc-text-field--label-floating @endif @error('editclass.g_classroom') mdc-text-field--invalid @enderror mdc-text-field--with-leading-icon double_left">
          <img class="material-icons mdc-text-field__icon mdc-text-field__icon--leading classroom_icon" src="/images/icon/vendor/classroom.svg" aria-hidden="true">
          <span class="mdc-text-field__ripple"></span>
          <input type="url" class="mdc-text-field__input" wire:model.lazy="editclass.g_classroom">
          <span class="mdc-floating-label @if($editclass['g_classroom']) mdc-floating-label--float-above @endif">Google Classroom</span>
          <span class="mdc-line-ripple"></span>
        </label>
        <label class="mdc-text-field mdc-text-field--filled @if($editclass['blackboard']) mdc-text-field--label-floating @endif @error('editclass.blackboard') mdc-text-field--invalid @enderror mdc-text-field--with-leading-icon double_right">
          <img class="material-icons mdc-text-field__icon mdc-text-field__icon--leading classroom_icon" src="/images/icon/vendor/bb.svg" aria-hidden="true">
          <span class="mdc-text-field__ripple"></span>
          <input type="url" class="mdc-text-field__input" wire.model.lazy="editclass.blackboard">
          <span class="mdc-floating-label @if($editclass['blackboard']) mdc-floating-label--float-above @endif">Blackboard</span>
          <span class="mdc-line-ripple"></span>
        </label>
      </div>
      <div class="double mb-6">
        <label class="mdc-text-field mdc-text-field--filled @if($editclass['textbook']) mdc-text-field--label-floating @endif @error('editclass.textbook') mdc-text-field--invalid @enderror mdc-text-field--with-leading-icon double_left">
          <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading"aria-hidden="true">book</i>
          <span class="mdc-text-field__ripple"></span>
          <input type="url" class="mdc-text-field__input" wire:model.lazy="editclass.textbook">
          <span class="mdc-floating-label @if($editclass['textbook']) mdc-floating-label--float-above @endif">Textbook</span>
          <span class="mdc-line-ripple"></span>
        </label>
        <label class="mdc-text-field mdc-text-field--filled @if($editclass['ap_classroom']) mdc-text-field--label-floating @endif @error('editclass.ap_classroom') mdc-text-field--invalid @enderror mdc-text-field--with-leading-icon double_right">
          <img class="material-icons mdc-text-field__icon mdc-text-field__icon--leading classroom_icon" src="/images/icon/vendor/cb.svg" aria-hidden="true">
          <span class="mdc-text-field__ripple"></span>
          <input type="url" class="mdc-text-field__input" wire:model.lazy="editclass.ap_classroom">
          <span class="mdc-floating-label @if($editclass['ap_classroom']) mdc-floating-label--float-above @endif">AP Classroom</span>
          <span class="mdc-line-ripple"></span>
        </label>
      </div>
      <div class="additional_links_switch" wire:ignore>
        <div class="mdc-switch">
          <div class="mdc-switch__track"></div>
          <div class="mdc-switch__thumb-underlay">
            <div class="mdc-switch__thumb"></div>
            <input type="checkbox" id="morelinksedit_switch" class="mdc-switch__native-control" role="switch" x-bind:checked="showMoreLinks" @click="showMoreLinks = !showMoreLinks">
          </div>
        </div>
        <label for="basic-switch" class="roboto ml-3">Add additional links</label>
      </div>
      <div x-show="showMoreLinks" wire:ignore>
        <div class="double">
          <label class="mdc-text-field mdc-text-field--filled @if($editclass['linkone']) mdc-text-field--label-floating @endif @error('editclass.linkone') mdc-text-field--invalid @enderror mb15 double_left">
            <span class="mdc-text-field__ripple"></span>
            <input type="url" class="mdc-text-field__input" id="elinkone" onkeyup="efieldTwoAct()" wire:model="editclass.linkone">
            <span class="mdc-floating-label @if($editclass['linkone']) mdc-floating-label--float-above @endif">Link One</span>
            <span class="mdc-line-ripple"></span>
          </label>
          <label class="mdc-text-field mdc-text-field--filled @if($editclass['linkone_name']) mdc-text-field--label-floating @endif @error('editclass.linkone_name') mdc-text-field--invalid @enderror mb15 double_right">
            <span class="mdc-text-field__ripple"></span>
            <input type="text" class="mdc-text-field__input" id="elinkonename" onkeyup="efieldTwoAct()" wire:model="editclass.linkone_name">
            <span class="mdc-floating-label @if($editclass['linkone_name']) mdc-floating-label--float-above @endif">Link Name</span>
            <span class="mdc-line-ripple"></span>
          </label>
        </div>
        <div class="double">
          <label class="mdc-text-field mdc-text-field--filled @if($editclass['linktwo']) mdc-text-field--label-floating @endif @error('editclass.linktwo') mdc-text-field--invalid @enderror mb15 double_left" id="elinktwolabel">
            <span class="mdc-text-field__ripple"></span>
            <input type="url" class="mdc-text-field__input" id="elinktwo" onkeyup="efieldThreeAct()" wire:model="editclass.linktwo" disabled>
            <span class="mdc-floating-label @if($editclass['linktwo']) mdc-floating-label--float-above @endif">Link Two</span>
            <span class="mdc-line-ripple"></span>
          </label>
          <label class="mdc-text-field mdc-text-field--filled @if($editclass['linktwo_name']) mdc-text-field--label-floating @endif @error('editclass.linktwo_name') mdc-text-field--invalid @enderror mb15 double_right" id="elinktwonlabel">
            <span class="mdc-text-field__ripple"></span>
            <input type="text" class="mdc-text-field__input" id="elinktwoname" onkeyup="efieldThreeAct()" wire:model="editclass.linktwo_name" disabled>
            <span class="mdc-floating-label @if($editclass['linktwo_name']) mdc-floating-label--float-above @endif">Link Name</span>
            <span class="mdc-line-ripple"></span>
          </label>
        </div>
        <div class="double">
          <label class="mdc-text-field mdc-text-field--filled @if($editclass['linkthree']) mdc-text-field--label-floating @endif @error('editclass.linkthree') mdc-text-field--invalid @enderror mb15 double_left" id="elinkthreelabel">
            <span class="mdc-text-field__ripple"></span>
            <input type="url" class="mdc-text-field__input" id="elinkthree" wire:model="editclass.linkthree" disabled>
            <span class="mdc-floating-label @if($editclass['linkthree']) mdc-floating-label--float-above @endif">Link Three</span>
            <span class="mdc-line-ripple"></span>
          </label>
          <label class="mdc-text-field mdc-text-field--filled @if($editclass['linkthree_name']) mdc-text-field--label-floating @endif @error('editclass.linkthree_name') mdc-text-field--invalid @enderror mb15 double_right" id="elinkthreenlabel">
            <span class="mdc-text-field__ripple"></span>
            <input type="text" class="mdc-text-field__input" id="elinkthreename"  wire:model="editclass.linkthree_name" disabled>
            <span class="mdc-floating-label @if($editclass['linkthree_name']) mdc-floating-label--float-above @endif">Link Name</span>
            <span class="mdc-line-ripple"></span>
          </label>
        </div>
    </div>
    </div>
  </form>
</div>

@push('scripts')
<script>
  function classEdit(){
    return {
      classDataArray: @entangle('classData'),
      editClass: @entangle('editclass'),
      showMoreLinks: @entangle('toggleControl'),
      loadInitData: function(){

      },
    }
  }
</script>
@endpush
