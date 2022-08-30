<div class="px-6 py-2 agenda-item-details mdc-card mdc-card-outlined mdc-elevation--z14 md:ml-72" @click.outside="closeDetails()" 
x-show="showingDetails" x-transition.in.opacity.scale.out.opacity x-bind:style="`top: calc(${popupHeight}px - 60px)`" 
x-ref="popupBox" x-cloak
x-data="{
  get online() {
    return window.navigator.onLine;
  }
}"
wire:ignore.self>
  <div x-show="! colorPicker" x-transition.in>
    <div class="w-full h-12 mb-2 item-details-top">
      <button class="float-right mdc-icon-button material-icons" @click="closeDetails()" aria-describedby="close-details" wire:ignore>
        <div class="mdc-icon-button__ripple"></div>
        close
      </button>
      <div wire:ignore>
        <template x-if="selectedItemData && selectedItemData.type == 'assignment'">
          <div>
            <button class="float-right mdc-icon-button material-icons" aria-describedby="delete-details">
              <div class="mdc-icon-button__ripple"></div>
              delete
            </button>
            <a x-bind:href="selectedItemData.link">
              <button class="float-right mdc-icon-button material-icons" aria-describedby="edit-details">
                <div class="mdc-icon-button__ripple"></div>
                edit
              </button>
            </a>
            <a x-bind:href="selectedItemData.data['url']">
              <button class="float-right mdc-icon-button material-icons" aria-describedby="delete-details" :disabled="selectedItemData.data['url'] == null">
                <div class="mdc-icon-button__ripple"></div>
                link
              </button>
            </a>
          </div>
        </template>
        <template x-if="selectedItemData && selectedItemData.type == 'event' && selectedItemData.data['isOwner']">
          <div>
            <button class="float-right mdc-icon-button material-icons" aria-describedby="delete-details" :disabled="! online" @click="$wire.emit('setDeleteEvent', `${selectedItemData.id}`); delDialog()">
              <div class="mdc-icon-button__ripple"></div>
              delete
            </button>
            <button class="float-right mdc-icon-button material-icons" aria-describedby="edit-details" :disabled="! online" @click="$wire.emit('setEditEvent', `${selectedItemData.id}`); closeDetails()">
              <div class="mdc-icon-button__ripple"></div>
              edit
            </button>
            <button class="float-right mdc-icon-button material-icons" aria-describedby="share-details" :disabled="! online" @click="$wire.emit('setShareEvent', `${selectedItemData.id}`); closeDetails()">
              <div class="mdc-icon-button__ripple"></div>
              share
            </button>
            <button class="float-right mdc-icon-button material-icons" aria-describedby="color-details" :disabled="! online" @click="colorPicker = true">
              <div class="mdc-icon-button__ripple"></div>
              palette
            </button>
          </div>
        </template>
        <template x-if="selectedItemData && selectedItemData.type == 'event' && ! selectedItemData.data['isOwner']">
          <div>
            <button class="float-right mdc-icon-button material-icons" aria-describedby="unsub-details" :disabled="! online" @click="$wire.emit('setDeleteEvent', `${selectedItemData.id}`); unsubDialog()">
              <div class="mdc-icon-button__ripple"></div>
              block
            </button>
          </div>
        </template>
      </div>
    </div>
    <div>
      <div class="float-left mt-2.5 h-4 w-4 rounded-full" :class="`${'background-' + getItemColor(selectedItemData.id, selectedItemData.color)}`"></div>
      <span class="ml-5 text-2xl font-bold uppercase" x-text="selectedItemData.name"></span>
      <p><span class="text-sm ml-9 md:text-base" x-text="dateString"></span> ⋅ <span class="text-sm md:text-base" x-text="selectedItemData.timeString"></span></p>
      <div wire:ignore>
        <template x-if="selectedItemData && selectedItemData.type != 'event'">
          <p class="text-gray-700"><span class="material-icons mt-5 -ml-0.5">label</span> <span class="mdc-typography--subtitle1 agenda-detail-row-text ml-2.5 capitalize" x-text="selectedItemData.type"></span></p>
        </template>
        <template x-if="selectedItemData && selectedItemData.type == 'assignment'">
          <p class="text-gray-700"><span class="material-icons mt-3 -ml-0.5">school</span> <span class="mdc-typography--subtitle1 agenda-detail-row-text ml-2.5" x-text="selectedItemData.data['className']"></span></p>
        </template>
        <template x-if="selectedItemData && selectedItemData['type'] == 'event'">
          <div>
            <p class="text-gray-700"><span class="material-icons mt-3 -ml-0.5">label</span> <span class="mdc-typography--subtitle1 agenda-detail-row-text ml-2.5" x-text="selectedItemData.data['category']"></span></p>
            <p class="text-gray-700"><span class="material-icons mt-3 -ml-0.5">restart_alt</span> <span class="mdc-typography--subtitle1 agenda-detail-row-text ml-2.5" x-text="selectedItemData.data['repeat']"></span></p>
          </div>
        </template>
      </div>
    </div>
    <x-ui.tooltip tooltip-id="close-details" text="Close"/>
  </div>
  <div x-show="colorPicker" x-transition.in>
    <div class="flex w-full h-12 mb-2 item-details-top">
      <button class="mdc-icon-button material-icons" @click="colorPicker = false; colorPopupHeight = -200; setSelectedItem(selectedItem)" wire:ignore>
        <div class="mdc-icon-button__ripple"></div>
        arrow_back
      </button>
      <p class="mt-2 ml-3 text-lg font-medium">Event color</p>
    </div>
    <div class="grid grid-cols-5 mt-4">
      <template x-for="color in ['pink', 'orange', 'lemon', 'mint', 'blue', 'teal', 'purple', 'lav', 'beige']">
        <div class="mx-auto mb-4">
          <div class="w-12 h-12 rounded-full lg:w-[3.5rem] lg:h-[3.5rem] mdc-icon-button" :class="`background-${color} ${$color = selectedColor ? 'border-white border-solid border-2' : ''}`" @click="updateEventColor(color)">
            <div class="mdc-icon-button__ripple"></div>
          </div>
        </div>
      </template>
    </div>
  </div>
</div>
