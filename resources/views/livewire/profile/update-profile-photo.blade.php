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
          source: photoUrl,
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
"
@close-photo-dialog.window="photoDialog = false; undoFixBody()"
@open-photo-dialog.window="photoDialog = true; fixBody(); initPond()"
>
  <div class="modal-skim inset-0 hidden bg-gray-500 opacity-75" style="display: none" x-show="photoDialog" x-cloak></div>
  <div class="modal-container mdc-typography fixed top-12 h-screen w-screen overflow-y-auto pb-6" x-transition x-show="photoDialog" x-cloak>
    <div class="mdc-card mdc-card--outlined modal-card">
      <div class="top-row-container">
        <div class="close-and-title">
          <button class="mdc-icon-button close-icon material-icons float-left" type="button" aria-describedby="close-profile-photo-modal" x-on:click="photoDialog = false; undoFixBody()" aria-label="close"><div class="mdc-icon-button__ripple"></div>close</button>
        </div>
      </div>
      <div class="mx-auto -mt-8 text-center">
        <div class="inline-block h-60 w-60" wire:ignore>
          <input type="file" x-ref="input" id="profile" accept="image/png, image/jpeg, image/gif" wire:model="profilePhoto">
        </div>
        <div class="mx-auto mt-4 h-4">
          <p x-show="errorMessages['profilePhoto'] != undefined" class="text-red" x-cloak>
            @isset($errorMessages['profilePhoto'])
              {{$errorMessages['profilePhoto'][0]}}
            @endisset
          </p>
        </div>
        <p class="mt-4 text-3xl font-medium">Update profile photo</p>
        <div class="mt-6 px-12 sm:px-16">
          <p class="text-gray-600">Personalize your account with a picture that represents yourself</p>
          <p class="mt-1 text-sm text-gray-500"><span class="inline-block"><span class="material-icons mt-1 mr-3 inline-block align-text-bottom text-inherit" style="vertical-align: -5px">public</span>Other Schedulist users will be able to view the picture you select.</span></p>
        </div>
        
      </div>
      <div class="mt-8 pb-6 text-center" wire:ignore>
        <button class="mdc-button mdc-button--outlined mdc-button--icon-leading inline-block" x-bind:disabled="! @this.hasProfilePicture" wire:click="removeProfilePhoto()">
          <span class="mdc-button__ripple"></span>
          <i class="material-icons mdc-button__icon" aria-hidden="true">delete</i>
          <span class="mdc-button__label">Remove current photo</span>
        </button>
        <button class="mdc-button mdc-button--raised mdc-button-ripple mdc-button--icon-leading ml-2 inline-block" type="button" wire:click="save()" wire:loading.attr="disabled" wire:target="profilePhoto" x-bind:disabled="errorMessages['profilePhoto'] == 'File is of invalid type'">
          <i class="material-icons mdc-button__icon" aria-hidden="true">save</i>
          <span class="mdc-button__ripple" wire:ignore></span>Save
        </button>
      </div>
    </div>
  </div>
  <x-ui.tooltip tooltip-id="close-profile-photo-modal" text="Close"/>
</div>
