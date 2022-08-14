<div class="mdc-typography"
@close-schedule-dialog.window="schedulePicker = false"
>
  <div x-show="schedulePicker" style="display: none" class="modal_skim inset-0 hidden bg-gray-500 opacity-75" x-cloak></div>
  <div class="mdc-card mdc-card--outlined schedule-modal" style="position: absolute; left: 0; right: 0" x-transition x-show="schedulePicker"
  x-cloak wire:ignore.self>
    <form wire:submit.prevent="save"
    x-data="{
      page: @entangle('page'),
      disableScheduleButton: @entangle('saveButtonDisabled'),
      customSchedule: @entangle('usingCustomSchedule'),
      showDropdownMenu(){
        if (! suggestionsMenu.open && document.getElementById('query').disabled == false){
          suggestionsMenu.open = true;
        }
      },
      scheduleType: @entangle('scheduleType'),

    }">
      <div class="toprowcontainer">
        <div class="closebutton">
          <button class="mdc-icon-button close-icon material-icons float-left mr-2" type="reset" aria-describedby="close-schedule-tooltip" onclick="undoFixBody()" @click="$dispatch('close-schedule-dialog')" aria-label="Close Schedule Picker">close</button wire:ignore>
          <h1 class="mdc-typography--headline6 nunito mt-2.5 ml-6 w-56">Set Schedule</h1>
        </div>
        <div id="close-schedule-tooltip" class="mdc-tooltip" role="tooltip" aria-hidden="true">
          <div class="mdc-tooltip__surface">
            Close
          </div>
        </div>
        <div class="addbutton">
          <button class="mdc-button mdc-button--raised mdc-button-ripple" @if($page != 3) wire:click="incrementPage()" @else wire:click="saveCustom()" @endif @if($usingCustomSchedule) type="button" @else x-on:click="" type="submit" @endif aria-label="Save" @enable-schedule-save-button.window="disableScheduleButton = false" x-bind:disabled="disableScheduleButton" >
            <span class="mdc-button__ripple" wire:ignore></span>@if($page == 3)Save @elseif($page == 2 && $scheduleType == "fixed")Save @elseif($usingCustomSchedule)Next @else Save @endif
          </button>
        </div>
      </div>
      <div x-show="page == 1">
        <h1 class="mdc-typography--body mt-14 ml-2 mb-4 text-gray-600">
          You can search for your school to use your school's class times if they have been previously inputted by others.
        </h1>
        <div class="mdc-menu-surface--anchor">
          <label class="mdc-text-field mdc-text-field--filled @error('query') mdc-text-field--invalid @enderror @if($query != null) mdc-text-field--label-floating @endif login-form" x-bind:class="{ 'mdc-text-field--disabled': customSchedule }" @dblclick="showDropdownMenu()">
            <span class="mdc-text-field__ripple" wire:ignore></span>
            <span class="mdc-floating-label @if($query != null) mdc-floating-label--float-above @endif" id="query-label">School or School District Name</span>
            <input id="query" class="mdc-text-field__input" type="text" aria-labelledby="query-label" autocomplete="query" wire:model.debounce.50ms="query" x-on:keydown="showDropdownMenu()" x-bind:disabled="customSchedule" wire:ignore>
            <span class="mdc-line-ripple" wire:ignore></span>
          </label>
          <div class="mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth suggestions-menu mt-14" wire:ignore.self>
            <ul class="mdc-deprecated-list dark-theme-list">
              @foreach($suggestions as $i => $suggestion)
                <li class="mdc-deprecated-list-item" data-value="{{$suggestion['id']}}" wire:click="useExistingSchedule({{$suggestion['id']}})" wire:key="{{$suggestion['id']}}">
                  <span class="mdc-deprecated-list-item__ripple"></span>
                  <span class="mdc-deprecated-list-item__text">{{$suggestion['type']}} - {{$suggestion['location']}}</span>
                </li>
              @endforeach
            </ul>
          </div>
          <div class="mt-6 ml-2">
            <div class="mdc-switch @if($usingCustomSchedule) mdc-switch--checked @endif">
              <div class="mdc-switch__track"></div>
              <div class="mdc-switch__thumb-underlay">
                <div class="mdc-switch__thumb"></div>
                <input type="checkbox" id="customScheduleToggle" class="mdc-switch__native-control" role="switch"  @if($usingCustomSchedule) aria-checked="true" @endif x-on:click="customSchedule = !customSchedule" onclick="delayFixChecks()">
              </div>
            </div>
            <label for="basic-switch" class="roboto ml-3 mb-5">Use custom class schedule</label>
            <div x-show="customSchedule">
              <br />
              <div class="border-t border-gray-200"></div>
              <h1 class="mdc-typography--body mt-6 ml-2 mb-4 text-gray-600">
                Which style of scheduling does your school use?
              </h1>
              <div>
                <div class="mb-5">
                  <div class="mdc-radio">
                    <input class="mdc-radio__native-control" type="radio" id="radio-1" name="types" x-on:click="scheduleType = 'fixed'" wire:click="setScheduleType('fixed')">
                    <div class="mdc-radio__background">
                      <div class="mdc-radio__outer-circle"></div>
                      <div class="mdc-radio__inner-circle"></div>
                    </div>
                    <div class="mdc-radio__ripple"></div>
                  </div>
                  <label for="radio-1 -mt-4">Classes are the same every single week (fixed schedule)</label>
                  <br />
                  <div class="mdc-radio mt-2">
                    <input class="mdc-radio__native-control" type="radio" id="radio-2" name="types" x-on:click="scheduleType = 'block'" wire:click="setScheduleType('block')">
                    <div class="mdc-radio__background">
                      <div class="mdc-radio__outer-circle"></div>
                      <div class="mdc-radio__inner-circle"></div>
                    </div>
                    <div class="mdc-radio__ripple"></div>
                  </div>
                  <label for="radio-2 -mt-4">Classes take place on lettered or numbered days (block schedule)</label>
                </div>
                <div x-transition x-show="scheduleType == 'block'">
                  <div class="mdc-select mdc-select--required mdc-select--filled mt-2 ml-1 w-56" wire:ignore>
                    <div class="mdc-select__anchor"
                         role="button"
                         aria-haspopup="listbox"
                         aria-expanded="false"
                         aria-required="true"
                         aria-labelledby="demo-label demo-selected-text" wire:ignore>
                      <span class="mdc-select__ripple"></span>
                      <span id="demo-label" class="mdc-floating-label">Number of Blocks</span>
                      <span class="mdc-select__selected-text-container">
                        <span id="demo-selected-text" class="mdc-select__selected-text"></span>
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
                      <ul class="mdc-deprecated-list dark-theme-list" role="listbox" aria-label="Starting week selection" wire:ignore>
                        <li class="mdc-deprecated-list-item" aria-selected="false" wire:click="setNumberBlocks(1)" data-value="1" role="option">
                          <span class="mdc-deprecated-list-item__ripple"></span><span class="mdc-deprecated-list-item__text">1</span>
                        </li>
                        <li class="mdc-deprecated-list-item" aria-selected="false" wire:click="setNumberBlocks(2)" data-value="2" role="option">
                        <span class="mdc-deprecated-list-item__ripple"></span><span class="mdc-deprecated-list-item__text">2</span>
                        </li>
                        <li class="mdc-deprecated-list-item" aria-selected="false" wire:click="setNumberBlocks(3)" data-value="3" role="option">
                          <span class="mdc-deprecated-list-item__ripple"></span><span class="mdc-deprecated-list-item__text">3</span>
                        </li>
                        <li class="mdc-deprecated-list-item" aria-selected="false" wire:click="setNumberBlocks(4)" data-value="4" role="option">
                          <span class="mdc-deprecated-list-item__ripple"></span><span class="mdc-deprecated-list-item__text">4</span>
                        </li>
                        <li class="mdc-deprecated-list-item" aria-selected="false" wire:click="setNumberBlocks(5)" data-value="5" role="option">
                          <span class="mdc-deprecated-list-item__ripple"></span><span class="mdc-deprecated-list-item__text">5</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="mdc-select mdc-select--required mdc-select--filled mt-2 ml-1 w-72" wire:ignore.self>
                    <div class="mdc-select__anchor"
                         role="button"
                         aria-haspopup="listbox"
                         aria-expanded="false"
                         aria-required="true"
                         aria-labelledby="demo-label demo-selected-text" wire:ignore>
                      <span class="mdc-select__ripple"></span>
                      <span id="demo-label" class="mdc-floating-label">First blockday of this week</span>
                      <span class="mdc-select__selected-text-container">
                        <span id="demo-selected-text" class="mdc-select__selected-text"></span>
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
                        @for ($i=1; $i <= $numberOfBlockDays; $i++)
                          <li class="mdc-deprecated-list-item" aria-selected="false" wire:click="setStartingWeek({{$i}})" data-value="{{$i}}" role="option" wire:key="b{{$i}}">
                            <span class="mdc-deprecated-list-item__ripple"></span><span class="mdc-deprecated-list-item__text">{{$i}}</span>
                          </li>
                        @endfor
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div x-show="page == 2">
        <h1 class="mdc-typography--body mt-14 ml-2 mb-4 text-gray-600">
          Set the times and frequencies for each of your classes
        </h1>
        <div class="mdc-select mdc-select--required mdc-select--filled mt-3 ml-0 w-56" wire:ignore>
          <div class="mdc-select__anchor"
               role="button"
               aria-haspopup="listbox"
               aria-expanded="false"
               aria-required="true"
               aria-labelledby="demo-label demo-selected-text" wire:ignore>
            <span class="mdc-select__ripple"></span>
            <span id="demo-label" class="mdc-floating-label">Number of classes</span>
            <span class="mdc-select__selected-text-container">
              <span id="demo-selected-text" class="mdc-select__selected-text"></span>
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
          <div class="mdc-select__menu mdc-menu mdc-menu-surface w-12">
            <ul class="mdc-deprecated-list dark-theme-list" role="listbox" aria-label="Number of classes select" wire:ignore>
              @for ($i=1; $i <= 10; $i++)
                <li class="mdc-deprecated-list-item" aria-selected="false" wire:click="setNumberClasses({{$i}})" data-value="{{$i}}" role="option" wire:key="{{$i}}">
                  <span class="mdc-deprecated-list-item__ripple"></span><span class="mdc-deprecated-list-item__text">{{$i}}</span>
                </li>
              @endfor
            </ul>
          </div>
        </div>
        <div class="mt-5 border-t border-gray-200"></div>
        @for ($i=1; $i<=$numberClasses; $i++)
          <div class="mt-6 ml-2" wire:key="pd{{$i}}">
            <span class="mdc-typography--body-2 @if($i != 10 )mr-4 @endif" @if($i==10) style="margin-right: .4rem" @endif>{{$i}}</span>
            <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating w-28">
              <span class="mdc-text-field__ripple" wire:ignore></span>
              <span class="mdc-floating-label mdc-floating-label--float-above" id="period-{{$i}}-label">Start Time</span>
              <input id="start{{$i}}" class="mdc-text-field__input" type="text" aria-labelledby="period-{{$i}}-label" autocomplete="timestart" wire:model.lazy="customTimes.pd{{$i}}start" wire:ignore>
              <span class="mdc-line-ripple" wire:ignore></span>
            </label>
            <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating ml-2 w-28">
              <span class="mdc-text-field__ripple" wire:ignore></span>
              <span class="mdc-floating-label mdc-floating-label--float-above" id="period-{{$i}}-label">End Time</span>
              <input id="end{{$i}}" class="mdc-text-field__input" type="text" aria-labelledby="period-{{$i}}-label" autocomplete="timestop" wire:model.lazy="customTimes.pd{{$i}}end" wire:ignore>
              <span class="mdc-line-ripple" wire:ignore></span>
            </label>
          </div>
          @if($scheduleType == "fixed")
            <div class="float-right -mt-14 mr-4">
              <div class="inline-block w-12">
                <div class="mdc-checkbox">
                  <input type="checkbox"class="mdc-checkbox__native-control"id="{{$i}}checkbox-M" wire:click="updateFixedCustomSchedule({{$i}}, 'M')"/>
                  <div class="mdc-checkbox__background">
                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                      <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                    </svg>
                    <div class="mdc-checkbox__mixedmark"></div>
                  </div>
                  <div class="mdc-checkbox__ripple"></div>
                  <label for="{{$i}}checkbox-M" class="mt-8 block text-center text-gray-600">M</label>
                </div>
              </div>
              <div class="inline-block w-12">
                <div class="mdc-checkbox">
                  <input type="checkbox"class="mdc-checkbox__native-control"id="{{$i}}checkbox-T" wire:click="updateFixedCustomSchedule({{$i}}, 'T')"/>
                  <div class="mdc-checkbox__background">
                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                      <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                    </svg>
                    <div class="mdc-checkbox__mixedmark"></div>
                  </div>
                  <div class="mdc-checkbox__ripple"></div>
                  <label for="{{$i}}checkbox-T" class="mt-8 block text-center text-gray-600">T</label>
                </div>
              </div>
              <div class="inline-block w-12">
                <div class="mdc-checkbox">
                  <input type="checkbox"class="mdc-checkbox__native-control"id="{{$i}}checkbox-W" wire:click="updateFixedCustomSchedule({{$i}}, 'W')"/>
                  <div class="mdc-checkbox__background">
                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                      <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                    </svg>
                    <div class="mdc-checkbox__mixedmark"></div>
                  </div>
                  <div class="mdc-checkbox__ripple"></div>
                  <label for="{{$i}}checkbox-W" class="mt-8 block text-center text-gray-600">W</label>
                </div>
              </div>
              <div class="inline-block w-12">
                <div class="mdc-checkbox">
                  <input type="checkbox"class="mdc-checkbox__native-control"id="{{$i}}checkbox-Th" wire:click="updateFixedCustomSchedule({{$i}}, 'Th')"/>
                  <div class="mdc-checkbox__background">
                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                      <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                    </svg>
                    <div class="mdc-checkbox__mixedmark"></div>
                  </div>
                  <div class="mdc-checkbox__ripple"></div>
                  <label for="{{$i}}checkbox-Th" class="mt-8 block text-center text-gray-600">Th</label>
                </div>
              </div>
              <div class="inline-block w-12">
                <div class="mdc-checkbox">
                  <input type="checkbox"class="mdc-checkbox__native-control"id="{{$i}}checkbox-F" wire:click="updateFixedCustomSchedule({{$i}}, 'F')"/>
                  <div class="mdc-checkbox__background">
                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                      <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                    </svg>
                    <div class="mdc-checkbox__mixedmark"></div>
                  </div>
                  <div class="mdc-checkbox__ripple"></div>
                  <label for="{{$i}}checkbox-F" class="mt-8 block text-center text-gray-600">F</label>
                </div>
              </div>
            </div>
          @elseif($scheduleType == "block")
            <div class="float-right -mt-14 mr-4">
              @for ($j=1; $j <= $numberOfBlockDays; $j++)
                <div class="inline-block w-12">
                  <div class="mdc-checkbox">
                    <input type="checkbox"class="mdc-checkbox__native-control"id="{{$j}}checkbox-bl" wire:click="updateBlockCustomSchedule({{$i}}, {{$j}})"/>
                    <div class="mdc-checkbox__background">
                      <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                      </svg>
                      <div class="mdc-checkbox__mixedmark"></div>
                    </div>
                    <div class="mdc-checkbox__ripple"></div>
                    <label for="{{$j}}checkbox-bl" class="mt-8 block text-center text-gray-600">Day {{$j}}</label>
                  </div>
                </div>
              @endfor
            </div>
          @endif
        @endfor
      </div>
      <div x-show="page == 3">
        @if($scheduleType == "block")
          <h1 class="mdc-typography--body mt-14 ml-2 mb-4 text-gray-600">
            Are your block days lettered or numbered?
          </h1>
          <div class="mb-5">
            <div class="mdc-radio">
              <input class="mdc-radio__native-control" type="radio" id="number-radio" name="blocks" wire:click="setBlockStyling('number')">
              <div class="mdc-radio__background">
                <div class="mdc-radio__outer-circle"></div>
                <div class="mdc-radio__inner-circle"></div>
              </div>
              <div class="mdc-radio__ripple"></div>
            </div>
            <label for="radio-1 -mt-4">Numbered (Day 1, Day 2, Day 3...)</label>
            <br />
            <div class="mdc-radio mt-2">
              <input class="mdc-radio__native-control" type="radio" id="letter-radio" name="blocks" wire:click="setBlockStyling('letter')">
              <div class="mdc-radio__background">
                <div class="mdc-radio__outer-circle"></div>
                <div class="mdc-radio__inner-circle"></div>
              </div>
              <div class="mdc-radio__ripple"></div>
            </div>
            <label for="radio-2 -mt-4">Lettered (A Day, B Day, C Day...)</label>
          </div>
        @endif


      </div>
    </form>
  </div>

</div>
