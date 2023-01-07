<div class="pt-20" x-data="dataManager()" @started-download.window="downloadInProgress = true"
    @finished-redownload.window="$refs.redownloadButton.innerHTML = 'Download archive'; $refs.redownloadButton.disabled = false"">
    <x-ui.settings-card title="Manage Your Data" description="Backup or delete parts or all of your Schedulist data."
        back-button>
        <div style="max-width: 600px">
            @if ($existingBackup != null)
                <div class="px-6 py-5 my-4 mdc-card mdc-card--outlined">
                    <h4 class="mt-2 text-2xl font-medium">Your most recent backup</h4>
                    <p class="mt-1 text-sm text-gray-500">Created on {{ $existingBackup['created'] }}</p>
                    <p class="mt-1 text-sm text-gray-500">Includes your {{ $existingBackup['contains'] }}</p>
                    <button class="mt-5 mdc-button mdc-button--raised mdc-button-ripple" x-ref="redownloadButton"
                        @click="@this.redownload(); $refs.redownloadButton.innerHTML = 'Download is Processing'; $refs.redownloadButton.disabled = true"
                        wire:ignore>
                        <span class="mdc-button__ripple" wire:ignore></span>Download archive
                    </button>
                </div>
            @endif
            <p class="mt-5 text-lg text-gray-600">Select the data you want to download or delete</p>
            <p class="text-sm text-gray-500">All data will be exported as JSON (JavaScript Object Notation) files,
                unless otherwise specified.</p>
            <p class="mt-2 text-sm text-gray-500">If an option to delete or download is disabled for a category, that
                means you do not have anything that can be archived or deleted.</p>
            <div class="flex items-center py-4 mt-5 border-t border-b border-gray-200">
                <div class="flex-none w-10 mr-4">
                    <span class="inline-block text-3xl text-gray-600 material-icons">badge</span>
                </div>
                <div class="flex-1">
                    <p class="text-lg">Profile data</p>
                    <p class="text-sm text-gray-500">Profile information will be exported as a JSON file, your profile
                        picture will be exported in its original format.</p>
                </div>
                <div class="relative float-left ml-2 mr-4 mdc-checkbox mdc-checkbox--touch" wire:ignore>
                    <input class="mdc-checkbox__native-control" type="checkbox" @click="toggleCategory('profile')"
                        :checked="selectedData.includes('profile')">
                    <div class="mdc-checkbox__background">
                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                            <path class="mdc-checkbox__checkmark-path" fill="none"
                                d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                        </svg>
                        <div class="mdc-checkbox__mixedmark"></div>
                    </div>
                    <div class="mdc-checkbox__ripple"></div>
                </div>
            </div>
            <div class="py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="flex-none w-10 mr-4">
                        <span class="inline-block text-3xl text-gray-600 material-icons">assignment</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg">Assignments</p>
                        <p class="text-sm text-gray-500">All of the assignments you've created, includes links and
                            descriptions.</p>
                    </div>
                    <div class="relative float-left ml-2 mr-4 mdc-checkbox mdc-checkbox--touch" wire:ignore>
                        <input class="mdc-checkbox__native-control" type="checkbox"
                            @click="toggleCategory('assignments')" :checked="selectedData.includes('assignments')"
                            @if ($user->assignments->count() < 1) disabled @endif>
                        <div class="mdc-checkbox__background">
                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                <path class="mdc-checkbox__checkmark-path" fill="none"
                                    d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                            </svg>
                            <div class="mdc-checkbox__mixedmark"></div>
                        </div>
                        <div class="mdc-checkbox__ripple"></div>
                    </div>
                </div>
                <button class="mt-2 ml-12 mdc-button mdc-button-ripple" wire:click="deleteData('assignments')"
                    x-ref="assignmentButton" @click="$refs.assignmentButton.disabled = true" wire:ignore
                    @if ($user->assignments->count() < 1) disabled @endif>
                    <span class="mdc-button__ripple"></span>Delete
                </button>
            </div>
            <div class="py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="flex-none w-10 mr-4">
                        <span class="inline-block text-3xl text-gray-600 material-icons">school</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg">Classes</p>
                        <p class="text-sm text-gray-500">All of the classes you've created, includes links and other
                            included data.</p>
                    </div>
                    <div class="relative float-left ml-2 mr-4 mdc-checkbox mdc-checkbox--touch" wire:ignore>
                        <input class="mdc-checkbox__native-control" type="checkbox" @click="toggleCategory('classes')"
                            :checked="selectedData.includes('classes')"
                            @if ($user->classes->count() < 1) disabled @endif>
                        <div class="mdc-checkbox__background">
                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                <path class="mdc-checkbox__checkmark-path" fill="none"
                                    d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                            </svg>
                            <div class="mdc-checkbox__mixedmark"></div>
                        </div>
                        <div class="mdc-checkbox__ripple"></div>
                    </div>
                </div>
                <button class="mt-2 ml-12 mdc-button mdc-button-ripple" wire:click="deleteData('classes')"
                    x-ref="classButton" @click="$refs.classButton.disabled = true" wire:ignore
                    @if ($user->classes->count() < 1) disabled @endif>
                    <span class="mdc-button__ripple"></span>Delete
                </button>
            </div>
            <div class="py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="flex-none w-10 mr-4">
                        <span class="inline-block text-3xl text-gray-600 material-icons">schedule</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg">Class Schedules</p>
                        <p class="text-sm text-gray-500">All of the class schedules you've created. Download this along
                            side your class data to determine when your classes took place.</p>
                    </div>
                    <div class="relative float-left ml-2 mr-4 mdc-checkbox mdc-checkbox--touch" wire:ignore>
                        <input class="mdc-checkbox__native-control" type="checkbox" @click="toggleCategory('schedules')"
                            :checked="selectedData.includes('schedules')" wire:ignore
                            @if ($user->schedules->count() < 1) disabled @endif>
                        <div class="mdc-checkbox__background">
                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                <path class="mdc-checkbox__checkmark-path" fill="none"
                                    d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                            </svg>
                            <div class="mdc-checkbox__mixedmark"></div>
                        </div>
                        <div class="mdc-checkbox__ripple"></div>
                    </div>
                </div>
                <button class="mt-2 ml-12 mdc-button mdc-button-ripple" wire:click="deleteData('schedules')"
                    x-ref="scheduleButton" @click="$refs.scheduleButton.disabled = true" wire:ignore
                    @if ($user->schedules->count() < 1) disabled @endif>
                    <span class="mdc-button__ripple"></span>Delete
                </button>
            </div>
            <div class="py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="flex-none w-10 mr-4">
                        <span class="inline-block text-3xl text-gray-600 material-icons">date_range</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-lg">Events</p>
                        <p class="text-sm text-gray-500">All of the events you have created, as well as any events
                            shared with you by other users.</p>
                    </div>
                    <div class="relative float-left ml-2 mr-4 mdc-checkbox mdc-checkbox--touch" wire:ignore>
                        <input class="mdc-checkbox__native-control" type="checkbox" @click="toggleCategory('events')"
                            :checked="selectedData.includes('events')"
                            @if ($user->events->count() < 1) disabled @endif>
                        <div class="mdc-checkbox__background">
                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                <path class="mdc-checkbox__checkmark-path" fill="none"
                                    d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                            </svg>
                            <div class="mdc-checkbox__mixedmark"></div>
                        </div>
                        <div class="mdc-checkbox__ripple"></div>
                    </div>
                </div>
                <button class="mt-2 ml-12 mdc-button mdc-button-ripple" wire:click="deleteData('events')"
                    x-ref="eventButton" @click="$refs.eventButton.disabled = true" wire:ignore
                    @if ($user->events->count() < 1) disabled @endif>
                    <span class="mdc-button__ripple"></span>Delete and Unshare
                </button>
            </div>
            <div class="mt-5">
                <button class="mt-5 mdc-button mdc-button--raised mdc-button-ripple tfa-button" disabled
                    :disabled="selectedData.length < 1 || creatingArchive" x-ref="downloadButton"
                    @click="@this.createArchive(); creatingArchive = true; $refs.downloadButton.innerHTML = 'Download is Processing'"
                    wire:ignore>
                    <span class="mdc-button__ripple"></span>Download Selected Data
                </button>
            </div>
        </div>
    </x-ui.settings-card>
    <div id="dataDownload" x-cloak wire:ignore>
        <div class="inset-0 hidden bg-gray-500 opacity-75 modal-skim" style="display: none"
            x-show="downloadInProgress"></div>
        <div class="fixed top-0 z-40 flex items-center justify-center w-screen h-screen" x-transition
            x-show="downloadInProgress" x-trap.noscroll="downloadInProgress" x-cloak>
            <div class="flex-initial px-20 pt-10 pb-4 text-gray-500 w-50 h-30 mdc-card mdc-card--outlined">
                <div>
                    <p class="text-center text-9xl">
                        <span class="text-gray-500 select-none material-icons text-9xl text-inherit">downloading</span>
                    </p>
                    <p class="mt-2 text-lg">The data you've selected is now being downloaded</p>
                </div>
                <div class="mt-5 -mx-14">
                    <a class="mt-5 mdc-button mdc-button--raised mdc-button-ripple tfa-button"
                        href="{{ route('profile') }}" wire:ignore>
                        <span class="mdc-button__ripple"></span>Done
                    </a>
                    <button class="mt-5 mr-4 mdc-button mdc-button-ripple tfa-button" x-ref="redownload"
                        @click="@this.redownload(); $refs.redownload.disabled = true; setTimeout(() => $refs.redownload.disabled = false, 5000)"
                        wire:ignore>
                        <span class="mdc-button__ripple"></span>Redownload
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function dataManager() {
            return {
                creatingArchive: false,
                downloadInProgress: false,
                selectedData: @entangle('selectedData'),
                toggleCategory: function(e) {
                    if (this.selectedData.includes(e)) {
                        const search = (element) => element == e;
                        var i = this.selectedData.findIndex(search);
                        this.selectedData.splice(i, i + 1);
                    } else
                        this.selectedData.push(e);
                },
            }
        }
    </script>
@endpush
