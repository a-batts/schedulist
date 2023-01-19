<div class="agenda-item-details mdc-card mdc-card-outlined mdc-elevation--z14 left-0 z-50 px-6 pt-2 pb-4 sm:left-6"
    @click.outside="closeDetails()" x-show="showingDetails" x-transition.in.opacity.scale.out.opacity
    :style="`top: calc(${popupHeight}px - 100px); ${popupPos};`" x-ref="popupBox" x-cloak wire:ignore.self>
    <div x-show="! colorPicker" x-transition.in>
        <div class="item-details-top w-full h-12 mb-2">
            <button class="mdc-icon-button material-icons float-right" aria-describedby="close-details"
                @click="closeDetails()" wire:ignore>
                <div class="mdc-icon-button__ripple"></div>
                close
            </button>
            <div wire:ignore>
                <template x-if="selectedItemData?.type == 'assignment'">
                    <div>
                        <a x-bind:href="selectedItemData?.link">
                            <button class="mdc-icon-button material-icons float-right" aria-describedby="edit-details">
                                <div class="mdc-icon-button__ripple"></div>
                                edit
                            </button>
                        </a>
                        <a x-bind:href="selectedItemData?.data?.url">
                            <button class="mdc-icon-button material-icons float-right" aria-describedby="link-details"
                                :disabled="selectedItemData?.data?.url == null">
                                <div class="mdc-icon-button__ripple"></div>
                                link
                            </button>
                        </a>
                    </div>
                </template>
                <template x-if="selectedItemData?.type == 'event' && selectedItemData?.data.isOwner">
                    <div>
                        <button class="mdc-icon-button material-icons float-right" aria-describedby="delete-details"
                            :disabled="offline"
                            @click="$wire.emit('setDeleteEvent', `${selectedItemData.id}`); delDialog()">
                            <div class="mdc-icon-button__ripple"></div>
                            delete
                        </button>
                        <button class="mdc-icon-button material-icons float-right" aria-describedby="edit-details"
                            :disabled="offline"
                            @click="$wire.emit('setEditEvent', `${selectedItemData.id}`); closeDetails()">
                            <div class="mdc-icon-button__ripple"></div>
                            edit
                        </button>
                        <button class="mdc-icon-button material-icons float-right" aria-describedby="share-details"
                            :disabled="offline"
                            @click="$wire.emit('setShareEvent', `${selectedItemData.id}`); closeDetails()">
                            <div class="mdc-icon-button__ripple"></div>
                            share
                        </button>
                        <button class="mdc-icon-button material-icons float-right" aria-describedby="color-details"
                            :disabled="offline" @click="colorPicker = true">
                            <div class="mdc-icon-button__ripple"></div>
                            palette
                        </button>
                    </div>
                </template>
                <template x-if="selectedItemData?.type == 'event' && ! selectedItemData?.data.isOwner">
                    <div>
                        <button class="mdc-icon-button material-icons float-right" aria-describedby="unsub-details"
                            :disabled="offline"
                            @click="$wire.emit('setDeleteEvent', `${selectedItemData.id}`); unsubDialog()">
                            <div class="mdc-icon-button__ripple"></div>
                            block
                        </button>
                    </div>
                </template>
            </div>
        </div>
        <div>
            <div class="flex gap-x-4">
                <div class="flex items-center justify-center w-6 shrink-0">
                    <div class="w-4 h-4 rounded-full"
                        :class="`${'background-' + getItemColor(selectedItemData.id, selectedItemData.color)}`"></div>
                </div>
                <p class="flex-grow overflow-y-hidden text-2xl font-bold overflow-x-clip overflow-ellipsis whitespace-nowrap"
                    x-text="selectedItemData.name">
                </p>
            </div>

            <div class="flex items-center mt-3 gap-x-4">
                <i class="material-icons text-gray-700">event</i>
                <p class="flex-grow">
                    <span class="text-sm md:text-base" x-text="dateString"></span> ⋅
                    <span class="text-sm md:text-base" x-text="selectedItemData?.timeString"></span>
                </p>
            </div>

            <div class="pt-2" wire:ignore>
                <template x-if="selectedItemData?.type != 'event'">
                    <div class="flex items-center mt-3 text-gray-700 gap-x-4">
                        <i class="material-icons">label</i>
                        <p class="flex-grow">
                            <span class="capitalize" x-text="selectedItemData?.type"></span>
                        </p>
                    </div>
                </template>
                <template x-if="selectedItemData?.type == 'assignment'">
                    <div class="flex items-center mt-3 text-gray-700 gap-x-4">
                        <i class="material-icons">school</i>
                        <p class="flex-grow">
                            <span x-text="selectedItemData?.data['className']"></span>
                        </p>
                    </div>
                </template>
                <template x-if="selectedItemData?.data?.location">
                    <div class="flex items-center mt-3 text-gray-700 gap-x-4">
                        <i class="material-icons">place</i>
                        <p class="flex-grow">
                            <span x-text="selectedItemData?.data['location']"></span>
                        </p>
                    </div>
                </template>
                <template x-if="selectedItemData?.type == 'event'">
                    <div>
                        <div class="flex items-center mt-3 text-gray-700 gap-x-4">
                            <i class="material-icons">label</i>
                            <p class="flex-grow">
                                <span x-text="selectedItemData?.data['category']"></span>
                            </p>
                        </div>
                        <div class="flex items-center mt-3 text-gray-700 gap-x-4">
                            <i class="material-icons">restart_alt</i>
                            <p class="flex-grow">
                                <span x-text="selectedItemData?.data['repeat']"></span>
                            </p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
        <x-ui.tooltip tooltip-id="close-details" text="Close" />
    </div>
    <div x-show="colorPicker" x-transition.in>
        <div class="item-details-top flex w-full h-12 mb-2">
            <button class="mdc-icon-button material-icons"
                @click="colorPicker = false; colorPopupHeight = -200; setSelectedItem(selectedItem)" wire:ignore>
                <div class="mdc-icon-button__ripple"></div>
                arrow_back
            </button>
            <p class="mt-2 ml-3 text-lg font-medium">Event color</p>
        </div>
        <div class="grid grid-cols-5 mt-4">
            <template x-for="color in ['pink', 'orange', 'lemon', 'mint', 'blue', 'teal', 'purple', 'lav', 'beige']">
                <div class="mx-auto mb-4">
                    <div class="mdc-icon-button h-12 w-12 rounded-full lg:h-[3.5rem] lg:w-[3.5rem]"
                        :class="`background-${color} ${$color = selectedColor ? 'border-white border-solid border-2' : ''}`"
                        @click="updateEventColor(color)">
                        <div class="mdc-icon-button__ripple"></div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
