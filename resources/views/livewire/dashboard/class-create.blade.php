<div class="mdc-typography" x-data="{
  addModal: @entangle('addClassModal'),
  showingLinks: @entangle('showingMoreLinks'),
  errorMessages: @entangle('errorMessages'),
  field1: '',
  field1name: '',
  field2: '',
  field2name: '',
  offline: false
}"
@close-add-modal.window="addModal = false; undoFixBody()"
@offline.window="offline = true"
@online.window="offline = false">
  @if (Auth::User()->num_classes < 10)
  <div class="fab_button">
    <button class="mdc-fab mdc-fab--extended mdc-button-ripple" aria-label="Add Class" @click="addModal = true; fixBody()" wire:offline.attr="disabled">
      <div class="mdc-fab__ripple"></div>
      <span class="material-icons mdc-fab__icon">add</span>
      <span class="mdc-fab__label">Add Class</span>
    </button>
  </div>
  @endif
  @if (session()->has('success'))
  <div class="mdc-snackbar mdc-snackbar--leading submit-snackbar" id="submit-snackbar">
    <div class="mdc-snackbar__surface">
      <div class="mdc-snackbar__label" role="status" aria-live="polite">New class was successfully added!</div>
      <div class="mdc-snackbar__actions">
        <button type="button" class="mdc-button mdc-snackbar__action" wire:click="undoCreate({{session()->get( 'success' )}})">
          <div class="mdc-button__ripple"></div>
          <div class="mdc-button__label">Undo</div>
        </button>
      </div>
    </div>
  </div>
  @endif
  <div class="inset-0 bg-gray-500 opacity-75 modal_skim" style="display: none" id="createskim" x-show="addModal" x-cloak></div>
  <div class="add_class_div" x-show.transition="addModal" x-cloak>
    <form wire:submit.prevent="save">
      <div class="mdc-card mdc-card--outlined addclass_card">
        <div class="toprowcontainer">
          <div class="closebutton">
            <button class="mdc-icon-button close-icon material-icons closeleft" type="reset" aria-describedby="close-tooltip" @click="$dispatch('close-add-modal')" aria-label="close">close</button>
            <h1 class="closeright mdc-typography--headline6 nunito">New Class</h1>
          </div>
          <div id="close-tooltip" class="mdc-tooltip" role="tooltip" aria-hidden="true">
            <div class="mdc-tooltip__surface">
              Close
            </div>
          </div>
          <div class="addbutton">
            <button class="mdc-button mdc-button--raised mdc-button-ripple" type="submit" aria-label="Add" x-bind:disabled="offline || ! navigator.onLine" wire:ignore>
              <span class="mdc-button__ripple"></span>Add
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
          <label class="mdc-text-field mdc-text-field--filled double_left @error('newclass.name') mdc-text-field--invalid @enderror">
            <span class="mdc-text-field__ripple" wire:ignore></span>
            <input type="text" class="mdc-text-field__input" aria-labelledby="name-label" maxlength="255" wire:ignore wire:model.lazy="newclass.name" required>
            <span class="mdc-floating-label" wire:ignore>Class Name</span>
            <span class="mdc-line-ripple" wire:ignore></span>
          </label>

          <label class="mdc-text-field mdc-text-field--filled double_right @error('newclass.teacher') mdc-text-field--invalid @enderror">
            <span class="mdc-text-field__ripple" wire:ignore></span>
            <input type="text" class="mdc-text-field__input" aria-labelledby="teacher-label" maxlength="255" wire:ignore wire:model.lazy="newclass.teacher" required>
            <span class="mdc-floating-label" wire:ignore>Teacher</span>
            <span class="mdc-line-ripple" wire:ignore></span>
          </label>
        </div>
        <div class="select-textfield-row mb-3">
          <div class="textfield-right-container">
            <label class="mdc-text-field mdc-text-field--filled textfield-right @error('newclass.class_link') mdc-text-field--invalid @enderror">
              <span class="mdc-text-field__ripple" wire:ignore></span>
              <input type="url" class="mdc-text-field__input" aria-labelledby="class-label" maxlength="255" wire:ignore wire:model.lazy="newclass.class_link" required>
              <span class="mdc-floating-label" wire:ignore>Class Link</span>
              <span class="mdc-line-ripple" wire:ignore></span>
            </label>
            <div class="mdc-text-field-helper-line textfield-right-label" style="height: 15px" wire:ignore>
              <div class="mdc-text-field-helper-text" id="my-helper-id" aria-hidden="true">Blackboard Collaborate, Google Meet or Zoom</div>
            </div>
          </div>
          <div class="select-left-container">
            <div class="mdc-select mdc-select--filled mdc-select--required period-select @error('newclass.period') mdc-select--invalid @enderror">
              <div class="mdc-select__anchor reduceselectsize" aria-required="true" wire:ignore>
                <span class="mdc-select__ripple"></span>
                <span class="mdc-select__selected-text-container">
                  <span class="mdc-select__selected-text"></span>
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
                <span class="mdc-floating-label">Period</span>
                <span class="mdc-line-ripple"></span>
              </div>

              <div class="mdc-select__menu mdc-menu mdc-menu-surface @error('newclass.period') mdc-select__menu--invalid @enderror">
                <ul class="mdc-list dark-theme-list" wire:ignore>
                  @foreach($hasclass as $checkclass)
                  <li class="mdc-list-item" wire:click="setPeriod({{$checkclass}})" data-value="{{$checkclass}}" wire:key="{{$checkclass}}">
                    <span class="mdc-list-item__ripple"></span>
                    <span class="mdc-list-item__text">{{$checkclass}}</span>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- Class color picker dropdown -->
        <div class="mdc-select mdc-select--filled mdc-select--required mdc-select--with-leading-icon colorselect mb-6 mt-2 @error('newclass.color') mdc-select--invalid @enderror">
          <div class="mdc-select__anchor" aria-required="true" wire:ignore>
            <i class="material-icons mdc-select__icon">palette</i>
            <span class="mdc-select__ripple"></span>
            <span class="mdc-select__selected-text-container">
              <span id="demo-selected-text" class="mdc-select__selected-text"></span>
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
            <span class="mdc-floating-label">Class Color</span>
            <span class="mdc-line-ripple"></span>
          </div>

          <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth @error('newclass.color') mdc-select__menu--invalid @enderror">
            <ul class="mdc-list dark-theme-list" wire:ignore>
              <li class="mdc-list-item" data-value="Red" wire:click="setColor('Red')">
                <span class="mdc-list-item__ripple"></span>
                <span class="mdc-list-item__text">Red</span>
              </li>
              <li class="mdc-list-item" data-value="Orange"  wire:click="setColor('Orange')">
                <span class="mdc-list-item__ripple"></span>
                <span class="mdc-list-item__text">Orange</span>
              </li>
              <li class="mdc-list-item" data-value="Yellow"  wire:click="setColor('Yellow')">
                <span class="mdc-list-item__ripple"></span>
                <span class="mdc-list-item__text">Yellow</span>
              </li>
              <li class="mdc-list-item" data-value="Green"  wire:click="setColor('Green')">
                <span class="mdc-list-item__ripple"></span>
                <span class="mdc-list-item__text">Green</span>
              </li>
              <li class="mdc-list-item" data-value="Lime"  wire:click="setColor('Lime')">
                <span class="mdc-list-item__ripple"></span>
                <span class="mdc-list-item__text">Lime</span>
              </li>
              <li class="mdc-list-item" data-value="Blue"  wire:click="setColor('Blue')">
                <span class="mdc-list-item__ripple"></span>
                <span class="mdc-list-item__text">Blue</span>
              </li>
              <li class="mdc-list-item" data-value="Indigo"  wire:click="setColor('Indigo')">
                <span class="mdc-list-item__ripple"></span>
                <span class="mdc-list-item__text">Indigo</span>
              </li>
              <li class="mdc-list-item" data-value="Purple"  wire:click="setColor('Purple')">
                <span class="mdc-list-item__ripple"></span>
                <span class="mdc-list-item__text">Purple</span>
              </li>
            </ul>
          </div>
        </div>
        <label class="mdc-text-field mdc-text-field--filled mdc-text-field--with-leading-icon mb-6 @error('newclass.teacher_email') mdc-text-field--invalid @enderror">
          <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" aria-hidden="true" wire:ignore>email</i>
          <span class="mdc-text-field__ripple" wire:ignore></span>
          <input type="email" class="mdc-text-field__input" wire:model.lazy="newclass.teacher_email" wire:ignore>
          <span class="mdc-floating-label" wire:ignore>Teacher Email</span>
          <span class="mdc-line-ripple" wire:ignore></span>
        </label>
        <div class="double mb-6">
          <label class="mdc-text-field mdc-text-field--filled mdc-text-field--with-leading-icon double_left @error('newclass.g_classroom') mdc-text-field--invalid @enderror">
            <img class="material-icons mdc-text-field__icon mdc-text-field__icon--leading classroom_icon" src="/images/icon/vendor/classroom.svg" aria-hidden="true" wire:ignore>
            <span class="mdc-text-field__ripple" wire:ignore></span>
            <input type="url" class="mdc-text-field__input" wire:model.lazy="newclass.g_classroom" wire:ignore>
            <span class="mdc-floating-label" wire:ignore>Google Classroom</span>
            <span class="mdc-line-ripple" wire:ignore></span>
          </label>
          <label class="mdc-text-field mdc-text-field--filled mdc-text-field--with-leading-icon double_right @error('newclass.blackboard') mdc-text-field--invalid @enderror">
            <img class="material-icons mdc-text-field__icon mdc-text-field__icon--leading classroom_icon" src="/images/icon/vendor/bb.svg" aria-hidden="true">
            <span class="mdc-text-field__ripple" wire:ignore></span>
            <input type="url" class="mdc-text-field__input" wire:model.lazy="newclass.blackboard" wire:ignore>
            <span class="mdc-floating-label" wire:ignore>Blackboard</span>
            <span class="mdc-line-ripple" wire:ignore></span>
          </label>
        </div>
        <div class="double">
          <label class="mdc-text-field mdc-text-field--filled mdc-text-field--with-leading-icon mb-5 double_left @error('newclass.textbook') mdc-text-field--invalid @enderror">
            <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading"aria-hidden="true">book</i>
            <span class="mdc-text-field__ripple" wire:ignore></span>
            <input type="url" class="mdc-text-field__input" wire:model.lazy="newclass.textbook" wire:ignore>
            <span class="mdc-floating-label" wire:ignore>Textbook</span>
            <span class="mdc-line-ripple" wire:ignore></span>
          </label>
          <label class="mdc-text-field mdc-text-field--filled mdc-text-field--with-leading-icon mb-5 double_right @error('newclass.ap_classroom') mdc-text-field--invalid @enderror">
            <img class="material-icons mdc-text-field__icon mdc-text-field__icon--leading classroom_icon" src="/images/icon/vendor/cb.svg" aria-hidden="true">
            <span class="mdc-text-field__ripple" wire:ignore></span>
            <input type="url" class="mdc-text-field__input" wire:model.lazy="newclass.ap_classroom" wire:ignore>
            <span class="mdc-floating-label" wire:ignore>AP Classroom</span>
            <span class="mdc-line-ripple" wire:ignore></span>
          </label>
        </div>
          <div class="additional_links_switch" wire:ignore>
            <div class="mdc-switch">
              <div class="mdc-switch__track"></div>
              <div class="mdc-switch__thumb-underlay">
                <div class="mdc-switch__thumb"></div>
                <input type="checkbox" id="morelinks_switch" class="mdc-switch__native-control" role="switch" x-bind:checked="showingLinks" @click="showingLinks = !showingLinks">
              </div>
            </div>
            <label for="basic-switch" class="ml-3">Add additional links</label>
          </div>
          <div x-show="showingLinks" x-cloak wire:ignore.self>
            <div class="double">
              <label class="mdc-text-field mdc-text-field--filled mb-5 double_left @error('newclass.linkone') mdc-text-field--invalid @enderror">
                <span class="mdc-text-field__ripple" wire:ignore></span>
                <input type="url" class="mdc-text-field__input" x-model="field1" wire:model.lazy="newclass.linkone" wire:ignore>
                <span class="mdc-floating-label" wire:ignore>Link One</span>
                <span class="mdc-line-ripple" wire:ignore></span>
              </label>
              <label class="mdc-text-field mdc-text-field--filled mb-5 double_right">
                <span class="mdc-text-field__ripple" wire:ignore></span>
                <input type="text" class="mdc-text-field__input" x-model="field1name" wire:model.lazy="newclass.linkone_name" wire:ignore maxlength="50">
                <span class="mdc-floating-label" wire:ignore>Link Name</span>
                <span class="mdc-line-ripple" wire:ignore></span>
              </label>
            </div>
            <div class="double">
              <label class="mdc-text-field mdc-text-field--filled mb-5 double_left" x-bind:class="{'mdc-text-field--disabled': !field1 || !field1name, 'mdc-text-field--invalid': errorMessages['newclass.linktwo'] != undefined}" wire:ignore>
                <span class="mdc-text-field__ripple"></span>
                <input type="url" class="mdc-text-field__input" x-model="field2" x-bind:disabled="!field1 || !field1name" wire:model.lazy="newclass.linktwo" >
                <span class="mdc-floating-label">Link Two</span>
                <span class="mdc-line-ripple"></span>
              </label>
              <label class="mdc-text-field mdc-text-field--filled mb-5 double_right" x-bind:class="{'mdc-text-field--disabled': !field1 || !field1name, 'mdc-text-field--invalid': errorMessages['newclass.linktwo_name'] != undefined}" wire:ignore>
                <span class="mdc-text-field__ripple"></span>
                <input type="text" class="mdc-text-field__input" x-model="field2name" x-bind:disabled="!field1 || !field1name" wire:model.lazy="newclass.linktwo_name" maxlength="50">
                <span class="mdc-floating-label">Link Name</span>
                <span class="mdc-line-ripple"></span>
              </label>
            </div>
            <div class="double">
              <label class="mdc-text-field mdc-text-field--filled mb-5 double_left" x-bind:class="{'mdc-text-field--disabled': !field1 || !field1name || !field2 || !field2name, 'mdc-text-field--invalid': errorMessages['newclass.linkthree'] != undefined}" wire:ignore>
                <span class="mdc-text-field__ripple"></span>
                <input type="url" class="mdc-text-field__input" x-bind:disabled="!field1 || !field1name || !field2 || !field2name" wire:model.lazy="newclass.linkthree">
                <span class="mdc-floating-label">Link Three</span>
                <span class="mdc-line-ripple"></span>
              </label>
              <label class="mdc-text-field mdc-text-field--filled mb-5 double_right @error('newclass.linkthree_name') mdc-text-field--invalid @enderror" x-bind:class="{'mdc-text-field--disabled': !field1 || !field1name || !field2 || !field2name, 'mdc-text-field--invalid': errorMessages['newclass.linkthree_name'] != undefined}" wire:ignore>
                <span class="mdc-text-field__ripple"></span>
                <input type="text" class="mdc-text-field__input" x-bind:disabled="!field1 || !field1name || !field2 || !field2name" wire:model.lazy="newclass.linkthree_name" maxlength="50">
                <span class="mdc-floating-label">Link Name</span>
                <span class="mdc-line-ripple"></span>
              </label>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
