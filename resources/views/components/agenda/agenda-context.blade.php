<div class="px-6 py-2 agenda-item-details mdc-card mdc-card-outlined mdc-elevation--z14 md:ml-72" x-on:click.away="closeDetails()" x-show.transition.in.opacity.scale.out.opacity="agendaContext" x-bind:style="`top: calc(${popupHeight}px - 60px) `" x-cloak x-ref="popupBox" wire:ignore.self>
  <div class="w-full h-8 mb-4 item-details-top">
    <button class="float-right mdc-icon-button material-icons" x-on:click="closeDetails()" aria-describedby="close-details" wire:ignore>close</button>
    <div wire:ignore>
      <template x-if="selectedItemData && selectedItemData.type == 'assignment'">
        <div>
          <button class="float-right mdc-icon-button material-icons" aria-describedby="delete-details">delete</button>
          <a x-bind:href="selectedItemData.link">
            <button class="float-right mdc-icon-button material-icons" aria-describedby="edit-details">edit</button>
          </a>
          <a x-bind:href="selectedItemData.data['url']">
            <button class="float-right mdc-icon-button material-icons" aria-describedby="delete-details" x-bind:disabled="selectedItemData.data['url'] == null">link</button>
          </a>
        </div>
      </template>
      <template x-if="selectedItemData && selectedItemData.type == 'event' && selectedItemData.data['isOwner']">
        <div>
          <button class="float-right mdc-icon-button material-icons" aria-describedby="delete-details" x-bind:disabled="! online" x-on:click="$wire.emit('setDeleteEvent', `${selectedItemData.id}`); delDialog()">delete</button>
          <button class="float-right mdc-icon-button material-icons" aria-describedby="edit-details" x-bind:disabled="! online" x-on:click="$wire.emit('setEditEvent', `${selectedItemData.id}`); closeDetails()">edit</button>
          <button class="float-right mdc-icon-button material-icons" aria-describedby="share-details" x-bind:disabled="! online" x-on:click="$wire.emit('setShareEvent', `${selectedItemData.id}`); closeDetails()">share</button>
          <button class="float-right mdc-icon-button material-icons" aria-describedby="color-details" x-bind:disabled="! online" x-on:click="openColorPicker()">palette</button>
        </div>
      </template>
      <template x-if="selectedItemData && selectedItemData.type == 'event' && ! selectedItemData.data['isOwner']">
        <div>
          <button class="float-right mdc-icon-button material-icons" aria-describedby="unsub-details" x-bind:disabled="! online" x-on:click="$wire.emit('setDeleteEvent', `${selectedItemData.id}`); unsubDialog()">block</button>
        </div>
      </template>
    </div>
  </div>
  <div>
    <div class="w-4 h-4 float-left mt-2.5 rounded-full" x-bind:class="`${'background-' + getItemColor(selectedItemData.id, selectedItemData.color)}`"></div>
    <span class="ml-5 text-2xl font-bold uppercase" x-text="selectedItemData.name"></span>
    <p><span class="text-sm ml-9 md:text-base" x-text="dateString"></span> ⋅ <span class="text-sm md:text-base" x-text="selectedItemData.timeString"></span></p>
    <div wire:ignore>
      <template x-if="selectedItemData && selectedItemData.type != 'event'">
        <p class="text-gray-700"><span class="material-icons mt-5 -ml-0.5">label</span> <span class="mdc-typography--subtitle1 ml-2.5 agenda-detail-row-text capitalize" x-text="selectedItemData.type"></span></p>
      </template>
      <template x-if="selectedItemData && selectedItemData.type == 'assignment'">
        <p class="text-gray-700"><span class="material-icons mt-3 -ml-0.5">school</span> <span class="mdc-typography--subtitle1 ml-2.5 agenda-detail-row-text" x-text="selectedItemData.data['className']"></span></p>
      </template>
      <template x-if="selectedItemData && selectedItemData['type'] == 'event'">
        <div>
          <p class="text-gray-700"><span class="material-icons mt-3 -ml-0.5">label</span> <span class="mdc-typography--subtitle1 ml-2.5 agenda-detail-row-text" x-text="selectedItemData.data['category']"></span></p>
          <p class="text-gray-700"><span class="material-icons mt-3 -ml-0.5">restart_alt</span> <span class="mdc-typography--subtitle1 ml-2.5 agenda-detail-row-text" x-text="selectedItemData.data['repeat']"></span></p>
        </div>
      </template>
    </div>
  </div>
  <x-ui.tooltip tooltip-id="close-details" text="Close"/>
</div>
