<div>
  <div x-show="changeBlock" style="display: none" class="inset-0 bg-gray-500 opacity-75 modal_skim hidden" x-cloak wire:ignore></div>
  <div class="mdc-card mdc-card--outlined schedule-modal pb-5" style="position: absolute; left: 0; right: 0" x-transition x-show="changeBlock"
  @close-change-block.window="changeBlock = false"
  x-cloak wire:ignore.self>
    <div class="toprowcontainer">
      <div class="closebutton">
        <button class="mdc-icon-button close-icon material-icons float-left mr-2" type="reset" aria-describedby="close-schedule-tooltip" onclick="undoFixBody()" @click="changeBlock = false" aria-label="Close Block Change">close</button>
        <h1 class="w-72 mt-2.5 ml-5 mdc-typography--headline6 nunito">Update Block Day</h1>
      </div>
      <div id="close-schedule-tooltip" class="mdc-tooltip" role="tooltip" aria-hidden="true">
        <div class="mdc-tooltip__surface">
          Close
        </div>
      </div>
      <div class="addbutton">
        <button class="mdc-button mdc-button--raised mdc-button-ripple" type="button" wire:click="save()">
          <span class="mdc-button__ripple" wire:ignore></span>Save
        </button>
      </div>
    </div>
    <h1 class="-mt-8 ml-2 mb-4 mdc-typography--body text-gray-600">
      If the current block day no longer matches up to your school's schedule because of a holiday or gap, you can update it here.
    </h1>
    <div class="mdc-select mdc-select--required mdc-select--filled mt-2 ml-1 md:w-72 w-auto" wire:ignore>
      <div class="mdc-select__anchor"
           role="button"
           aria-haspopup="listbox"
           aria-expanded="false"
           aria-required="true"
           aria-labelledby="demo-label demo-selected-text" wire:ignore>
        <span class="mdc-select__ripple"></span>
        <span id="demo-label" class="mdc-floating-label">Today's Block</span>
        <span class="mdc-select__selected-text-container">
          <span id="demo-selected-text" class="mdc-select__selected-text">{{$currentBlock}}</span>
        </span>
        <span class="mdc-select__dropdown-icon">
          <svg
              class="mdc-select__dropdown-icon-graphic"
              viewBox="7 10 10 5" focusable="false">
            <polygon
                class="mdc-select__dropdown-icon-inactive"
                stroke="none"
                fill-rule="evenodd"
                points="7 10 12 15 17 10">
            </polygon>
            <polygon
                class="mdc-select__dropdown-icon-active"
                stroke="none"
                fill-rule="evenodd"
                points="7 15 12 10 17 15">
            </polygon>
          </svg>
        </span>
        <span class="mdc-line-ripple"></span>
      </div>
      <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
        <ul class="mdc-deprecated-list dark-theme-list" role="listbox" aria-label="Starting week selection">
          @if($userSchedule != null && $userSchedule->schedule_type == 'block')
            @for ($i=0; $i < $numberOfBlocks; $i++)
              <li class="mdc-deprecated-list-item @if($currentBlock == $i + 1) mdc-deprecated-list-item--selected @endif" aria-selected="false" wire:click="setTodayBlock('{{$labels[$i]}}')" wire:key="block{{$labels[$i]}}" data-value="{{$labels[$i]}}" role="option">
              <span class="mdc-deprecated-list-item__ripple"></span><span class="mdc-deprecated-list-item__text">{{$labels[$i]}}</span>
              </li>
            @endfor
          @endif
        </ul>
      </div>
    </div>
  </div>
</div>
