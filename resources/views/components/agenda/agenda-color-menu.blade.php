<div class="mdc-typography" wire:ignore>
  <div class="agenda-color-picker mdc-card mdc-card-outlined px-5 py-3 z-20 md:ml-72 fixed" x-bind:style="`top: calc(${colorPopupHeight}px - 60px) `" x-show="colorPicker" style="display: none" x-on:click.away="colorPicker = false; colorPopupHeight = -200; closeDetails()" x-cloak>
    <div>
      <button class="mdc-icon-button float-left material-icons" x-on:click="colorPicker = false; colorPopupHeight = -200; setSelectedItem(selectedItem)" wire:ignore>arrow_back</button>
      <p class="font-medium float-left text-lg mt-2.5 ml-3">Update Event Color</p>
    </div>
    <div class="ml-auto mr-auto mt-4 left-0 right-0">
      <div class="agenda-pink mdc-icon-button rounded-full h-12 w-12" x-bind:class="{'border-white border-solid border-2': selectedColor == 'pink'}" x-on:click="updateEventColor('pink')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div class="agenda-orange ml-5 mdc-icon-button rounded-full h-12 w-12" x-bind:class="{'border-white border-solid border-2': selectedColor == 'orange'}" x-on:click="updateEventColor('orange')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div cla
      <div class="agenda-lemon ml-5 mdc-icon-button rounded-full h-12 w-12" x-bind:class="{'border-white border-solid border-2': selectedColor == 'lemon'}" x-on:click="updateEventColor('lemon')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div class="agenda-mint ml-5 mdc-icon-button rounded-full h-12 w-12" x-bind:class="{'border-white border-solid border-2': selectedColor == 'mint'}" x-on:click="updateEventColor('mint')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div class="agenda-blue ml-5 mdc-icon-button rounded-full h-12 w-12" x-bind:class="{'border-white border-solid border-2': selectedColor == 'blue'}" x-on:click="updateEventColor('blue')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
    </div>
    <div class="ml-auto mr-auto mt-4 left-0 right-0">
      <div class="agenda-teal mdc-icon-button rounded-full h-12 w-12" x-bind:class="{'border-white border-solid border-2': selectedColor == 'teal'}" x-on:click="updateEventColor('teal')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div class="agenda-purple ml-5 mdc-icon-button rounded-full h-12 w-12" x-bind:class="{'border-white border-solid border-2': selectedColor == 'purple'}" x-on:click="updateEventColor('purple')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div class="agenda-lav ml-5 mdc-icon-button rounded-full h-12 w-12" x-bind:class="{'border-white border-solid border-2': selectedColor == 'lav'}" x-on:click="updateEventColor('lav')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div class="agenda-beige ml-5 mdc-icon-button rounded-full h-12 w-12" x-bind:class="{'border-white border-solid border-2': selectedColor == 'beige'}" x-on:click="updateEventColor('beige')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
    </div>
  </div>
</div>
