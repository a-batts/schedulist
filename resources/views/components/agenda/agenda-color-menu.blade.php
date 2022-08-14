<div class="mdc-typography" wire:ignore>
  <div class="agenda-color-picker mdc-card mdc-card-outlined fixed z-20 px-5 py-3 md:ml-72" x-bind:style="`top: calc(${colorPopupHeight}px - 60px) `" x-show="colorPicker" style="display: none" x-on:click.away="colorPicker = false; colorPopupHeight = -200; closeDetails()" x-cloak>
    <div>
      <button class="mdc-icon-button material-icons float-left" x-on:click="colorPicker = false; colorPopupHeight = -200; setSelectedItem(selectedItem)" wire:ignore>arrow_back</button>
      <p class="float-left mt-2.5 ml-3 text-lg font-medium">Update Event Color</p>
    </div>
    <div class="left-0 right-0 ml-auto mr-auto mt-4">
      <div class="background-pink mdc-icon-button h-12 w-12 rounded-full" x-bind:class="{'border-white border-solid border-2': selectedColor == 'pink'}" x-on:click="updateEventColor('pink')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div class="background-orange mdc-icon-button ml-5 h-12 w-12 rounded-full" x-bind:class="{'border-white border-solid border-2': selectedColor == 'orange'}" x-on:click="updateEventColor('orange')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div cla
      <div class="background-lemon mdc-icon-button ml-5 h-12 w-12 rounded-full" x-bind:class="{'border-white border-solid border-2': selectedColor == 'lemon'}" x-on:click="updateEventColor('lemon')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div class="background-mint mdc-icon-button ml-5 h-12 w-12 rounded-full" x-bind:class="{'border-white border-solid border-2': selectedColor == 'mint'}" x-on:click="updateEventColor('mint')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div class="background-blue mdc-icon-button ml-5 h-12 w-12 rounded-full" x-bind:class="{'border-white border-solid border-2': selectedColor == 'blue'}" x-on:click="updateEventColor('blue')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
    </div>
    <div class="left-0 right-0 ml-auto mr-auto mt-4">
      <div class="background-teal mdc-icon-button h-12 w-12 rounded-full" x-bind:class="{'border-white border-solid border-2': selectedColor == 'teal'}" x-on:click="updateEventColor('teal')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div class="background-purple mdc-icon-button ml-5 h-12 w-12 rounded-full" x-bind:class="{'border-white border-solid border-2': selectedColor == 'purple'}" x-on:click="updateEventColor('purple')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div class="background-lav mdc-icon-button ml-5 h-12 w-12 rounded-full" x-bind:class="{'border-white border-solid border-2': selectedColor == 'lav'}" x-on:click="updateEventColor('lav')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
      <div class="background-beige mdc-icon-button ml-5 h-12 w-12 rounded-full" x-bind:class="{'border-white border-solid border-2': selectedColor == 'beige'}" x-on:click="updateEventColor('beige')">
        <div class="mdc-icon-button__ripple"></div>
      </div>
    </div>
  </div>
</div>
