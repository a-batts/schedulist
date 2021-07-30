<div class="agenda-item-details mdc-card mdc-card-outlined mdc-elevation--z14 px-6 py-2 md:ml-72" x-on:click.away="closeDetails()" x-show.transition.in.opacity.scale.out.opacity="agendaContext" x-bind:style="`top: calc(${popupHeight}px - 60px) `" x-cloak x-ref="popupBox" wire:ignore.self>
  <div class="item-details-top w-full h-8 mb-4">
    <button class="mdc-icon-button float-right material-icons" x-on:click="closeDetails()" aria-describedby="close-details" wire:ignore>close</button>
    <div wire:ignore>
      <template x-if="selectedItemData != null && selectedItemData['type'] == 'Assignment'">
        <div>
          <button class="mdc-icon-button float-right material-icons" aria-describedby="delete-details">delete</button>
          <a x-bind:href="selectedItemData['link']">
            <button class="mdc-icon-button float-right material-icons" aria-describedby="edit-details">edit</button>
          </a>
          <a x-bind:href="selectedItemData['url']">
            <button class="mdc-icon-button float-right material-icons" aria-describedby="delete-details" x-bind:disabled="selectedItemData['url'] == null">link</button>
          </a>
        </div>
      </template>
      <template x-if="selectedItemData != null && selectedItemData['type'] == 'Event' && selectedItemData['isOwner']">
        <div>
          <button class="mdc-icon-button float-right material-icons" aria-describedby="delete-details" x-bind:disabled="! online" x-on:click="$wire.emit('setDeleteEvent', `${selectedItemData['id']}`); delDialog()">delete</button>
          <button class="mdc-icon-button float-right material-icons" aria-describedby="edit-details" x-bind:disabled="! online" x-on:click="$wire.emit('setEditEvent', `${selectedItemData['id']}`); closeDetails()">edit</button>
          <button class="mdc-icon-button float-right material-icons" aria-describedby="share-details" x-bind:disabled="! online" x-on:click="$wire.emit('setShareEvent', `${selectedItemData['id']}`); closeDetails()">share</button>
          <button class="mdc-icon-button float-right material-icons" aria-describedby="color-details" x-bind:disabled="! online" x-on:click="openColorPicker()">palette</button>
        </div>
      </template>
      <template x-if="selectedItemData != null && selectedItemData['type'] == 'Event' && ! selectedItemData['isOwner']">
        <div>
          <button class="mdc-icon-button float-right material-icons" aria-describedby="unsub-details" x-bind:disabled="! online" x-on:click="$wire.emit('setDeleteEvent', `${selectedItemData['id']}`); unsubDialog()">block</button>
        </div>
      </template>
    </div>
  </div>
  <div>
    <div class="w-4 h-4 float-left mt-2.5 rounded-full" x-bind:class="`${'agenda-' + getItemColor(selectedItemData['id'], selectedItemData['color'])}`"></div>
    <span class="ml-5 uppercase font-bold text-2xl" x-text="selectedItemData['title']"></span>
    <p><span class="ml-9 text-sm md:text-base" x-text="dateString"></span> ⋅ <span class="text-sm md:text-base" x-text="selectedItemData['timestring']"></span></p>
    <div wire:ignore>
      <template x-if="selectedItemData != null && selectedItemData['type'] != 'Event'">
        <p class="text-gray-700"><span class="material-icons mt-5 -ml-0.5">label</span> <span class="mdc-typography--subtitle1 ml-2.5 agenda-detail-row-text" x-text="selectedItemData['type']"></span></p>
      </template>
      <template x-if="selectedItemData != null && selectedItemData['type'] == 'Assignment'">
        <p class="text-gray-700"><span class="material-icons mt-3 -ml-0.5">school</span> <span class="mdc-typography--subtitle1 ml-2.5 agenda-detail-row-text" x-text="selectedItemData['className']"></span></p>
      </template>
      <template x-if="selectedItemData != null && selectedItemData['type'] == 'Event'">
        <div>
          <p class="text-gray-700"><span class="material-icons mt-3 -ml-0.5">label</span> <span class="mdc-typography--subtitle1 ml-2.5 agenda-detail-row-text" x-text="selectedItemData['category']"></span></p>
          <p class="text-gray-700"><span class="material-icons mt-3 -ml-0.5">restart_alt</span> <span class="mdc-typography--subtitle1 ml-2.5 agenda-detail-row-text" x-text="selectedItemData['repeat']"></span></p>
        </div>
      </template>
    </div>
  </div>
  <x-ui.tooltip tooltip-id="close-details" text="Close"/>
</div>
