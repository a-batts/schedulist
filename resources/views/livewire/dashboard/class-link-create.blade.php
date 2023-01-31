<div class="mdc-dialog z-50" :class="{ 'mdc-dialog--open': showingClassDetails && showingLinkCreate }"
    x-trap.noscroll="showingLinkCreate" x-data="classLinks()">
    <div class="mdc-dialog__scrim"></div>
    <div class="mdc-card mdc-dialog__surface dialog-modal fixed left-1/2 top-20 z-50 w-96 -translate-x-1/2 px-5 py-4 text-sm"
        x-show="showingClassDetails && showingLinkCreate" @click.outside="showingLinkCreate = false" x-cloak>
        <div class="mb-2 py-2">
            <p class="text-2xl font-semibold">New link</p>
        </div>
        <div class="mt-4 flex flex-col space-y-1">
            <div>
                <label class="mdc-text-field mdc-text-field--outlined w-full" wire:ignore>
                    <span class="mdc-notched-outline">
                        <span class="mdc-notched-outline__leading"></span>
                        <span class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label" id="link-name-label">Name</span>
                        </span>
                        <span class="mdc-notched-outline__trailing"></span>
                    </span>
                    <input class="mdc-text-field__input" type="text" aria-labelledby="link-name-label"
                        x-model="newLink.name">
                </label>
                <x-ui.validation-error for="name" />
            </div>
            <div>
                <label class="mdc-text-field mdc-text-field--outlined w-full" wire:ignore>
                    <span class="mdc-notched-outline">
                        <span class="mdc-notched-outline__leading"></span>
                        <span class="mdc-notched-outline__notch">
                            <span class="mdc-floating-label" id="link-link-label">URL</span>
                        </span>
                        <span class="mdc-notched-outline__trailing"></span>
                    </span>
                    <input class="mdc-text-field__input" type="text" aria-labelledby="link-link-label"
                        x-model="newLink.link">
                </label>
                <x-ui.validation-error for="url" />
            </div>
        </div>
        <div class="flex justify-end space-x-2 pt-4" wire:ignore>
            <button class="mdc-button" type="button" @click="showingLinkCreate = false">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label">Cancel</span>
            </button>
            <button class="mdc-button" type="button" @click="addLink()">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label">Save</span>
            </button>
        </div>
    </div>
</div>
@push('scripts')
    <script data-swup-reload-script>
        function classLinks() {
            return {
                newLink: {
                    name: '',
                    link: '',
                },

                addLink: function() {
                    this.$wire.addLink(this.selectedClass, this.newLink.name, this.newLink.link).then((response) => {
                        if (response) {
                            this.classData[this.selectedClass]['links'].push({
                                id: response.id,
                                name: this.newLink.name,
                                link: this.newLink.link
                            });
                            this.newLink = {
                                name: '',
                                link: '',
                            };
                            this.showingLinkCreate = false;
                        }
                    })
                },
            }
        }
    </script>
@endpush
