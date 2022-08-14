<div class="agenda-item-details mdc-card mdc-card-outlined mdc-elevation--z14 px-6 py-2 md:ml-72" x-on:click.away="closeDetails()" x-show="agendaContext" x-transition.in.opacity.scale.out.opacity x-bind:style="`top: calc(${popupHeight}px - 60px) `" x-cloak x-ref="popupBox" wire:ignore.self>
  <div class="item-details-top mb-4 h-8 w-full">
    <button class="mdc-icon-button material-icons float-right" x-on:click="closeDetails()" aria-describedby="close-details" wire:ignore>close</button>
    <div wire:ignore>
      <template x-if="selectedItemData && selectedItemData.type == 'assignment'">
        <div>
          <button class="mdc-icon-button material-icons float-right" aria-describedby="delete-details">delete</button>
          <a x-bind:href="selectedItemData.link">
            <button class="mdc-icon-button material-icons float-right" aria-describedby="edit-details">edit</button>
          </a>
          <a x-bind:href="selectedItemData.data['url']">
            <button class="mdc-icon-button material-icons float-right" aria-describedby="delete-details" x-bind:disabled="selectedItemData.data['url'] == null">link</button>
          </a>
        </div>
      </template>
      <template x-if="selectedItemData && selectedItemData.type == 'event' && selectedItemData.data['isOwner']">
        <div>
          <button class="mdc-icon-button material-icons float-right" aria-describedby="delete-details" x-bind:disabled="! online" x-on:click="$wire.emit('setDeleteEvent', `${selectedItemData.id}`); delDialog()">delete</button>
          <button class="mdc-icon-button material-icons float-right" aria-describedby="edit-details" x-bind:disabled="! online" x-on:click="$wire.emit('setEditEvent', `${selectedItemData.id}`); closeDetails()">edit</button>
          <button class="mdc-icon-button material-icons float-right" aria-describedby="share-details" x-bind:disabled="! online" x-on:click="$wire.emit('setShareEvent', `${selectedItemData.id}`); closeDetails()">share</button>
          <button class="mdc-icon-button material-icons float-right" aria-describedby="color-details" x-bind:disabled="! online" x-on:click="openColorPicker()">palette</button>
        </div>
      </template>
      <template x-if="selectedItemData && selectedItemData.type == 'event' && ! selectedItemData.data['isOwner']">
        <div>
          <button class="mdc-icon-button material-icons float-right" aria-describedby="unsub-details" x-bind:disabled="! online" x-on:click="$wire.emit('setDeleteEvent', `${selectedItemData.id}`); unsubDialog()">block</button>
        </div>
      </template>
    </div>
  </div>
  <div>
    <div class="float-left mt-2.5 h-4 w-4 rounded-full" x-bind:class="`${'background-' + getItemColor(selectedItemData.id, selectedItemData.color)}`"></div>
    <span class="ml-5 text-2xl font-bold uppercase" x-text="selectedItemData.name"></span>
    <p><span class="ml-9 text-sm md:text-base" x-text="dateString"></span> ⋅ <span class="text-sm md:text-base" x-text="selectedItemData.timeString"></span></p>
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
