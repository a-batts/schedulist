<div x-data="{
  pond: null,
  errorMessages: @entangle('errorMessages'),
  photoDialog: false,
}"
x-init="
FilePond.registerPlugin(FilePondPluginFileValidateType);

let config = {
  labelIdle: 'Click or Drag and Drop',
  imagePreviewHeight: 160,
  imageCropAspectRatio: '1:1',
  imageResizeTargetWidth: 200,
  imageResizeTargetHeight: 200,
  stylePanelLayout: 'circle compact',
  styleLoadIndicatorPosition: 'center bottom',
  styleProgressIndicatorPosition: 'center bottom',
  styleButtonRemoveItemPosition: 'right bottom',
  styleButtonProcessItemPosition: 'right bottom',
  hopperState: 'drag-drop',
  allowImagePreview: 'true',
  files: [],
  server: {
      process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
          @this.upload('profilePhoto', file, load, error, progress)
      },
      revert: (filename, load) => {
          @this.removeUpload('profilePhoto', filename, load)
      },
      load: (source, load, error, progress, abort, headers) => {
          fetch(source).then((response) => {
              response.blob().then((blob) => {
                  load(blob)
              })
          })
      },
  },
}
photoUrl = @this.profilePhotoUrl;
if (photoUrl){
  config.files = [{
          source: 'http://'.concat(photoUrl),
          options: {
              type: 'local'
          }
      }]
}
function initPond(){
  setTimeout(() => {
    pond = FilePond.create( $refs.input, config );
    pondEvent = document.querySelector('.filepond--root')
    pondEvent.addEventListener('FilePond:error', e => {
      Livewire.emit('filePondError', e.detail.error.main)
    })
    pondEvent.addEventListener('FilePond:addfilestart', e => {
      Livewire.emit('filePondError', '')
    })
    pondEvent.addEventListener('FilePond:removefile', e => {
      @this.profilePhotoUrl = null
    })
  }, 20);
}
window.initPond = initPond;
">
  <div x-show="photoDialog" style="display: none" class="inset-0 bg-gray-500 opacity-75 modal_skim hidden" x-cloak wire:ignore></div>
  <div class="mdc-card mdc-card--outlined schedule_dialog pb-7 mt-40 md:mt-0 absolute left-0 right-0"  x-show.transition="photoDialog"
  @close-photo-dialog.window="photoDialog = false; undoFixBody()"
  @open-photo-dialog.window="photoDialog = true; fixBody(); initPond()"
  x-cloak wire:ignore.self>
    <div class="toprowcontainer">
      <div class="closebutton">
        <button class="mdc-icon-button close-icon material-icons float-left mr-2" type="button" aria-describedby="close-photo-dialog-tooltip" @click="$dispatch('close-photo-dialog')" aria-label="Close Photo Dialog">close</button>
        <h1 class="w-72 mt-2.5 ml-5 mdc-typography--headline6 nunito">Set Profile Photo</h1>
      </div>
      <div id="close-photo-dialog-tooltip" class="mdc-tooltip" role="tooltip" aria-hidden="true">
        <div class="mdc-tooltip__surface">
          Close
        </div>
      </div>
      <div class="addbutton">
        <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" wire:click="save()" wire:loading.attr="disabled" wire:target="profilePhoto" x-bind:disabled="errorMessages['profilePhoto'] == 'File is of invalid type'">
          <span class="mdc-button__ripple" wire:ignore></span>Save
        </button>
      </div>
    </div>
    <div class="mx-auto">
      <div class="h-40 w-40" wire:ignore>
        <input type="file" x-ref="input" id="profile" accept="image/png, image/jpeg, image/gif" wire:model="profilePhoto">
      </div>
    </div>
    <div class="h-4 mx-auto mt-4">
      <p x-show="errorMessages['profilePhoto'] != undefined" class="text-red" x-cloak>
        @isset($errorMessages['profilePhoto'])
          {{$errorMessages['profilePhoto'][0]}}
        @endisset
      </p>
    </div>
  </div>
</div>
