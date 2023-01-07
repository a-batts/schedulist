<div x-data="updateProfilePhoto()" @open-photo-dialog.window="initPond(); photoPicker = true"
    @close-photo-dialog.window="photoPicker = false;" @clear-photo-picker.window="clearPhotoPicker()">
    <div class="modal-skim inset-0 hidden bg-gray-500 opacity-75" style="display: none" x-show="photoPicker" x-cloak></div>
    <div class="modal-container mdc-typography fixed w-screen h-screen pb-6 overflow-y-auto top-12" x-show="photoPicker"
        x-trap.noscroll="photoPicker" x-transition x-cloak>
        <div class="mdc-card mdc-card--outlined modal-card">
            <div class="top-row-container">
                <div class="close-and-title">
                    <button class="mdc-icon-button close-icon material-icons float-left" type="button"
                        aria-describedby="close-profile-photo-modal" aria-label="close"
                        x-on:click="photoPicker = false; undoFixBody()">
                        <div class="mdc-icon-button__ripple"></div>close
                    </button>
                </div>
            </div>
            <div class="mx-auto -mt-8 text-center">
                <div class="inline-block h-60 w-60" wire:ignore>
                    <input id="photo-picker" type="file" accept="image/png, image/jpeg, image/gif"
                        wire:model="uploadedPhoto">
                </div>
                <div class="h-4 mx-auto mt-4">
                    <p class="text-red" x-show="errorMessages['uploadedPhoto'] != undefined" x-cloak>
                        @isset($errorMessages['uploadedPhoto'])
                            {{ $errorMessages['uploadedPhoto'][0] }}
                        @endisset
                    </p>
                </div>
                <p class="mt-4 text-3xl font-medium">Update profile photo</p>
                <div class="px-12 mt-6 sm:px-16">
                    <p class="text-gray-600">Personalize your account with a picture that represents yourself</p>
                    <p class="mt-1 text-sm text-gray-500"><span class="inline-block"><span
                                class="material-icons inline-block mt-1 mr-3 align-text-bottom text-inherit"
                                style="vertical-align: -5px">public</span>Other Schedulist users will be able to view
                            the picture you select.</span></p>
                </div>

            </div>
            <div class="pb-6 mt-8 text-center" wire:ignore>
                <button class="mdc-button mdc-button--outlined mdc-button--icon-leading inline-block"
                    x-bind:disabled="!@this.hasProfilePicture" wire:click="removeProfilePhoto()">
                    <span class="mdc-button__ripple"></span>
                    <i class="material-icons mdc-button__icon" aria-hidden="true">delete</i>
                    <span class="mdc-button__label">Remove current photo</span>
                </button>
                <button
                    class="mdc-button mdc-button--raised mdc-button-ripple mdc-button--icon-leading inline-block ml-2"
                    id="saveButton" type="button" wire:click="save()" wire:loading.attr="disabled"
                    wire:target="uploadedPhoto" wire:ignore>
                    <i class="material-icons mdc-button__icon" aria-hidden="true">save</i>
                    <span class="mdc-button__ripple" wire:ignore></span>Save
                </button>
            </div>
        </div>
    </div>
    <x-ui.tooltip tooltip-id="close-profile-photo-modal" text="Close" />
</div>

@push('scripts')
    <script>
        function updateProfilePhoto() {
            return {
                pond: null,

                photoPicker: false,

                errorMessages: @entangle('errorMessages'),

                init: function() {
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
                            process: (fieldName, file, metadata, load, error, progress, abort, transfer,
                            options) => {
                                @this.upload('uploadedPhoto', file, load, error, progress)
                            },
                            revert: (filename, load) => {
                                @this.removeUpload('uploadedPhoto', filename, load)
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
                    if (photoUrl) {
                        config.files = [{
                            source: photoUrl,
                            options: {
                                type: 'local'
                            }
                        }]
                    }

                    function initPond() {
                        setTimeout(() => {
                            window.pond = FilePond.create(document.getElementById('photo-picker'), config);
                            pondEvent = document.querySelector('.filepond--root')
                            pondEvent.addEventListener('FilePond:error', e => {
                                @this.filePondError(e.detail.error.main);
                            })
                            pondEvent.addEventListener('FilePond:addfilestart', e => {
                                document.getElementById('saveButton').disabled = true;
                                @this.filePondError('');
                            })
                            pondEvent.addEventListener('FilePond:removefile', e => {
                                @this.profilePhotoUrl = '';
                            })
                        }, 20);
                    }
                    window.initPond = initPond;
                },

                clearPhotoPicker: function() {
                    const filePond = window.pond;

                    if (filePond.getFiles().length != 0) {
                        for (var i = 0; i <= filePond.getFiles().length - 1; i++) {
                            filePond.removeFile(filePond.getFiles()[0].id);
                        }
                    }
                }
            }
        }
    </script>
@endpush
