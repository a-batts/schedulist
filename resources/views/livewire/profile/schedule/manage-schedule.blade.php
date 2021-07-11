<div class="mdc-card mdc-card--outlined options_card"
x-data="{
  showingQuery: false,
  showDropdownMenu(){
    if (! suggestionsMenu.open && document.getElementById('query').disabled == false){
      suggestionsMenu.open = true;
    }
  },
  usingCustomSchedule: @entangle('usingCustomSchedule'),
  hasSchedule: @entangle('hasSchedule'),
  scheduleType: @entangle('scheduleType'),
  numberClasses: @entangle('numberClasses'),
  query: @entangle('selectedSchedule'),
  blockStyle: @entangle('blockStyle'),
}"
x-on:hide-query.window="showingQuery = false"
>
  <h4 class="mdc-typography mdc-typography--headline5 nunito mt-2">Manage schedule</h4>
  <p class="mdc-typography mdc-typography--body2 text-gray-600 mt-1">Set or modify your class schedule and class times, or use an existing preset.</p>
  <div class="border-t border-gray-200 mt-5"></div>
  <div>
    <div x-show="hasSchedule" @if(!$hasSchedule) x-cloak @endif>
      <div x-show="!usingCustomSchedule" @if($usingCustomSchedule) x-cloak @endif>
        <div x-show.transform="! showingQuery">
          <p class="mt-5 ml-2 mdc-typography--body text-gray-600">
            You're using the schedule for {{$schoolName}}
          </p>
          <div class="mt-2">
            <button class="mdc-button mdc-button-ripple mt-2 mr-5" x-on:click="showingQuery = true" wire:ignore>
              <span class="mdc-button__ripple "></span>Change School
            </button>
            <button class="mdc-button mdc-button-ripple mt-2 mr-20" wire:click="copyAndEdit()" wire:ignore>
              <span class="mdc-button__ripple "></span>Copy and Edit
            </button>
          </div>
        </div>
        <div x-show.transform="showingQuery" x-cloak>
          <h1 class="mt-5 ml-2 mdc-typography--body text-gray-600">
            You can search for your school to use your school's class times if they have been previously inputted by others.
          </h1>
          <label class="mdc-text-field mdc-text-field--filled mt-6 @error('query') mdc-text-field--invalid @enderror @if($query != null) mdc-text-field--label-floating @endif login-form" x-on:dblclick="showDropdownMenu()">
            <span class="mdc-text-field__ripple" wire:ignore></span>
            <span class="mdc-floating-label @if($query != null) mdc-floating-label--float-above @endif" id="query-label">School or School District Name</span>
            <input id="query" class="mdc-text-field__input" type="text" aria-labelledby="query-label" autocomplete="query" wire:model.debounce.50ms="query" x-on:keydown="showDropdownMenu()" wire:ignore>
            <span class="mdc-line-ripple" wire:ignore></span>
          </label>
          <div class="mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth suggestions-menu mt-64 md:ml-8 md:w-9/12" wire:ignore.self>
            <ul class="mdc-list dark-theme-list">
              @foreach($suggestions as $i => $suggestion)
                <li class="mdc-list-item" data-value="{{$suggestion['id']}}" wire:click="useExistingSchedule({{$suggestion['id']}})" wire:key="{{$suggestion['id']}}">
                  <span class="mdc-list-item__ripple"></span>
                  <span class="mdc-list-item__text">{{$suggestion['type']}} - {{$suggestion['location']}}</span>
                </li>
              @endforeach
            </ul>
          </div>
          <div class="mt-5">
            <button class="mdc-button mdc-button--raised mdc-button-ripple float-right mr-1" type="button" wire:click="saveExistingSchedule()" x-bind:disabled="query == null" wire:ignore>
              <span class="mdc-button__ripple" wire:ignore></span>Save
            </button>
            <button class="mdc-button mdc-button-ripple float-right mr-5" x-on:click="showingQuery = false; @if($usingCustomSchedule) usingCustomSchedule = true @endif" @if($startingNewSchedule) wire:click="$set('startingNewSchedule', false)" @endif>
              <span class="mdc-button__ripple " wire:ignore></span>Cancel
            </button>
          </div>
        </div>
      </div>
      <div class="mt-7 ml-2">
        <div class="mdc-switch @if($usingCustomSchedule) mdc-switch--checked @endif">
          <div class="mdc-switch__track"></div>
          <div class="mdc-switch__thumb-underlay">
            <div class="mdc-switch__thumb"></div>
            <input type="checkbox" id="customScheduleToggle" class="mdc-switch__native-control" role="switch"  @if($usingCustomSchedule) aria-checked="true" checked @endif x-on:click="usingCustomSchedule = !usingCustomSchedule; @if($usingCustomSchedule) showingQuery = true @endif">
          </div>
        </div>
        <label for="basic-switch" class="roboto ml-3 mb-5">Use custom class schedule</label>
      </div>
      <div class="border-t border-gray-200 mt-5"></div>
      <div x-show="usingCustomSchedule" @if(! $usingCustomSchedule) x-cloak @endif>
        <h1 class="mt-6 ml-2 mb-4 mdc-typography--body text-gray-600">
          Which style of scheduling does your school use?
        </h1>
        <div>
          <div class="mb-5">
            <div class="mdc-radio">
              <input class="mdc-radio__native-control" type="radio" id="radio-1" name="types" x-on:click="scheduleType = 'fixed'" wire:click="setScheduleType('fixed')" x-bind:checked="scheduleType == 'normal'">
              <div class="mdc-radio__background">
                <div class="mdc-radio__outer-circle"></div>
                <div class="mdc-radio__inner-circle"></div>
              </div>
              <div class="mdc-radio__ripple"></div>
            </div>
            <label for="radio-1 -mt-4">Classes are the same every single week (fixed schedule)</label>
            <br />
            <div class="mdc-radio mt-2">
              <input class="mdc-radio__native-control" type="radio" id="radio-2" name="types" x-on:click="scheduleType = 'block'" wire:click="setScheduleType('block')" x-bind:checked="scheduleType == 'block'">
              <div class="mdc-radio__background">
                <div class="mdc-radio__outer-circle"></div>
                <div class="mdc-radio__inner-circle"></div>
              </div>
              <div class="mdc-radio__ripple"></div>
            </div>
            <label for="radio-2 -mt-4">Classes take place on lettered or numbered days (block schedule)</label>
          </div>
          <div x-show.transition="scheduleType == 'block'" x-cloak>
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
                  <span id="demo-selected-text" class="mdc-select__selected-text">{{$numberOfBlockDays}}</span>
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
                <ul class="mdc-list dark-theme-list " role="listbox" aria-label="Starting week selection" wire:ignore>
                  <li class="mdc-list-item @if($numberOfBlockDays == 1) mdc-list-item--selected @endif" aria-selected="false" wire:click="setNumberBlocks(1)" data-value="1" role="option">
                    <span class="mdc-list-item__ripple"></span><span class="mdc-list-item__text">1</span>
                  </li>
                  <li class="mdc-list-item @if($numberOfBlockDays == 2) mdc-list-item--selected @endif" aria-selected="false" wire:click="setNumberBlocks(2)" data-value="2" role="option">
                  <span class="mdc-list-item__ripple"></span><span class="mdc-list-item__text">2</span>
                  </li>
                  <li class="mdc-list-item @if($numberOfBlockDays == 3) mdc-list-item--selected @endif" aria-selected="false" wire:click="setNumberBlocks(3)" data-value="3" role="option">
                    <span class="mdc-list-item__ripple"></span><span class="mdc-list-item__text">3</span>
                  </li>
                  <li class="mdc-list-item @if($numberOfBlockDays == 4) mdc-list-item--selected @endif" aria-selected="false" wire:click="setNumberBlocks(4)" data-value="4" role="option">
                    <span class="mdc-list-item__ripple"></span><span class="mdc-list-item__text">4</span>
                  </li>
                  <li class="mdc-list-item @if($numberOfBlockDays == 5) mdc-list-item--selected @endif" aria-selected="false" wire:click="setNumberBlocks(5)" data-value="5" role="option">
                    <span class="mdc-list-item__ripple"></span><span class="mdc-list-item__text">5</span>
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
                  <span id="demo-selected-text" class="mdc-select__selected-text">{{$startingBlock}}</span>
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
              <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth ">
                <ul class="mdc-list dark-theme-list" role="listbox" aria-label="Starting week selection">
                  @for ($i=1; $i <= $numberOfBlockDays; $i++)
                    <li class="mdc-list-item @if($i == $startingBlock) mdc-list-item--selected @endif" aria-selected="false" wire:click="setStartingWeek({{$i}})" data-value="{{$i}}" role="option" wire:key="b{{$i}}">
                      <span class="mdc-list-item__ripple"></span><span class="mdc-list-item__text">{{$i}}</span>
                    </li>
                  @endfor
                </ul>
              </div>
            </div>
          </div>
      </div>
      <div class="border-t border-gray-200 mt-7"></div>
      <h1 class="mt-6 ml-2 mb-4 mdc-typography--body text-gray-600">
        Set the times and frequencies for each of your classes
      </h1>
      <div>
        <div class="mdc-select mdc-select--required mdc-select--filled mt-1 ml-0 w-64" x-bind:class="{'mdc-select--disabled' : scheduleType == null}" wire:ignore>
          <div class="mdc-select__anchor"
               role="button"
               aria-haspopup="listbox"
               aria-expanded="false"
               aria-required="true"
               aria-labelledby="demo-label demo-selected-text" wire:ignore>
            <span class="mdc-select__ripple"></span>
            <span id="demo-label" class="mdc-floating-label mdc-floating-label--float-above">Number of classes</span>
            <span class="mdc-select__selected-text-container">
              <span id="demo-selected-text" class="mdc-select__selected-text">{{$numberClasses}}</span>
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
            <ul class="mdc-list dark-theme-list" role="listbox" aria-label="Number of classes select" wire:ignore>
              @for ($i=1; $i <= 10; $i++)
                <li class="mdc-list-item @if($numberClasses == $i) mdc-list-item--selected @endif" aria-selected="false" wire:click="setNumberClasses({{$i}})" data-value="{{$i}}" role="option" wire:key="{{$i}}">
                  <span class="mdc-list-item__ripple"></span><span class="mdc-list-item__text">{{$i}}</span>
                </li>
              @endfor
            </ul>
          </div>
        </div>
          @for ($i=1; $i<=$numberClasses; $i++)
            <div class="mt-6 ml-2 mb-24 lg:mb-0" wire:key="pd{{$i}}">
              <span class="mdc-typography--body-2 @if($i != 10 )mr-4 @endif" @if($i==10) style="margin-right: .4rem" @endif>{{$i}}</span>
              <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating w-28">
                <span class="mdc-text-field__ripple" wire:ignore></span>
                <span class="mdc-floating-label mdc-floating-label--float-above" id="period-{{$i}}-label">Start Time</span>
                <input id="start{{$i}}" class="mdc-text-field__input" type="text" aria-labelledby="period-{{$i}}-label" autocomplete="timestart" wire:model.lazy="customTimes.pd{{$i}}start" wire:ignore>
                <span class="mdc-line-ripple" wire:ignore></span>
              </label>
              <label class="mdc-text-field mdc-text-field--filled mdc-text-field--label-floating w-28 ml-2">
                <span class="mdc-text-field__ripple" wire:ignore></span>
                <span class="mdc-floating-label mdc-floating-label--float-above" id="period-{{$i}}-label">End Time</span>
                <input id="end{{$i}}" class="mdc-text-field__input" type="text" aria-labelledby="period-{{$i}}-label" autocomplete="timestop" wire:model.lazy="customTimes.pd{{$i}}end" wire:ignore>
                <span class="mdc-line-ripple" wire:ignore></span>
              </label>
            </div>
            <div x-show.transition="scheduleType == 'normal' || scheduleType == 'fixed'" @if($scheduleType != 'normal' && $scheduleType != 'fixed') x-cloak @endif>
              <div class="lg:float-right ml-7 lg:ml-0 lg:-mt-14 mr-4 checkbox-row">
                <div class="inline-block w-12">
                  <div class="mdc-checkbox">
                    <input type="checkbox"class="mdc-checkbox__native-control"id="{{$i}}checkbox-M" wire:click="updateFixedCustomSchedule({{$i}}, 'M')"/ @if(in_array($i, $customFixedDays['M'])) checked @endif @if(! isset($customTimes['pd'.$i.'start']) || !isset($customTimes['pd'.$i.'end'])) disabled @endif>
                    <div class="mdc-checkbox__background">
                      <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                      </svg>
                      <div class="mdc-checkbox__mixedmark"></div>
                    </div>
                    <div class="mdc-checkbox__ripple"></div>
                    <label for="{{$i}}checkbox-M" class="mt-8 block text-gray-600 text-center">M</label>
                  </div>
                </div>
                <div class="inline-block w-12">
                  <div class="mdc-checkbox">
                    <input type="checkbox"class="mdc-checkbox__native-control"id="{{$i}}checkbox-T" wire:click="updateFixedCustomSchedule({{$i}}, 'T')"/ @if(in_array($i, $customFixedDays['T'])) checked @endif @if(! isset($customTimes['pd'.$i.'start']) || !isset($customTimes['pd'.$i.'end'])) disabled @endif>
                    <div class="mdc-checkbox__background">
                      <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                      </svg>
                      <div class="mdc-checkbox__mixedmark"></div>
                    </div>
                    <div class="mdc-checkbox__ripple"></div>
                    <label for="{{$i}}checkbox-T" class="mt-8 block text-gray-600 text-center">T</label>
                  </div>
                </div>
                <div class="inline-block w-12">
                  <div class="mdc-checkbox">
                    <input type="checkbox"class="mdc-checkbox__native-control"id="{{$i}}checkbox-W" wire:click="updateFixedCustomSchedule({{$i}}, 'W')"/ @if(in_array($i, $customFixedDays['W'])) checked @endif @if(! isset($customTimes['pd'.$i.'start']) || !isset($customTimes['pd'.$i.'end'])) disabled @endif>
                    <div class="mdc-checkbox__background">
                      <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                      </svg>
                      <div class="mdc-checkbox__mixedmark"></div>
                    </div>
                    <div class="mdc-checkbox__ripple"></div>
                    <label for="{{$i}}checkbox-W" class="mt-8 block text-gray-600 text-center">W</label>
                  </div>
                </div>
                <div class="inline-block w-12">
                  <div class="mdc-checkbox">
                    <input type="checkbox"class="mdc-checkbox__native-control"id="{{$i}}checkbox-Th" wire:click="updateFixedCustomSchedule({{$i}}, 'Th')"/ @if(in_array($i, $customFixedDays['Th'])) checked @endif @if(! isset($customTimes['pd'.$i.'start']) || !isset($customTimes['pd'.$i.'end'])) disabled @endif>
                    <div class="mdc-checkbox__background">
                      <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                      </svg>
                      <div class="mdc-checkbox__mixedmark"></div>
                    </div>
                    <div class="mdc-checkbox__ripple"></div>
                    <label for="{{$i}}checkbox-Th" class="mt-8 block text-gray-600 text-center">Th</label>
                  </div>
                </div>
                <div class="inline-block w-12">
                  <div class="mdc-checkbox">
                    <input type="checkbox"class="mdc-checkbox__native-control"id="{{$i}}checkbox-F" wire:click="updateFixedCustomSchedule({{$i}}, 'F')"/ @if(in_array($i, $customFixedDays['F'])) checked @endif @if(! isset($customTimes['pd'.$i.'start']) || !isset($customTimes['pd'.$i.'end'])) disabled @endif>
                    <div class="mdc-checkbox__background">
                      <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                      </svg>
                      <div class="mdc-checkbox__mixedmark"></div>
                    </div>
                    <div class="mdc-checkbox__ripple"></div>
                    <label for="{{$i}}checkbox-F" class="mt-8 block text-gray-600 text-center">F</label>
                  </div>
                </div>
              </div>
            </div>
            <div x-show.transition="scheduleType == 'block'" @if($scheduleType != 'block') x-cloak @endif>
              <div class="lg:float-right ml-7 lg:ml-0 lg:-mt-14 mr-4 checkbox-row">
                @for ($j=1; $j <= $numberOfBlockDays; $j++)
                  <div class="inline-block w-12" wire:key="check{{$j}}">
                    <div class="mdc-checkbox">
                      <input type="checkbox"class="mdc-checkbox__native-control"id="{{$j}}checkbox-bl" wire:click="updateBlockCustomSchedule({{$i}}, {{$j}})" @if(in_array($i, $customBlockDays[$j])) checked @endif @if(! isset($customTimes['pd'.$i.'start']) || !isset($customTimes['pd'.$i.'end'])) disabled @endif/>
                      <div class="mdc-checkbox__background">
                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                          <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                        </svg>
                        <div class="mdc-checkbox__mixedmark"></div>
                      </div>
                      <div class="mdc-checkbox__ripple"></div>
                      <label for="{{$j}}checkbox-bl" class="mt-8 block text-gray-600 text-center">Day {{$j}}</label>
                    </div>
                  </div>
                @endfor
              </div>
            </div>
          @endfor
          <div x-show="scheduleType == 'normal' || scheduleType == 'fixed'" @if($scheduleType != 'normal' && $scheduleType != 'fixed') x-cloak @endif>
            <button class="mdc-button mdc-button--raised mdc-button-ripple float-right mt-8 mb-2 mr-4" type="button" wire:click="saveFixedSchedule()" wire:ignore x-bind:disabled="numberClasses < 1">
              <span class="mdc-button__ripple"></span>Save Schedule
            </button>
          </div>
          <div x-show="scheduleType == 'block'" @if($scheduleType != 'block') x-cloak @endif>
            <div class="border-t border-gray-200 mt-8"></div>
            <h1 class="mt-8 ml-2 mb-4 mdc-typography--body text-gray-600">
              Choose your block labeling style
            </h1>
            <div class="mb-5">
              <div class="mdc-radio">
                <input class="mdc-radio__native-control" type="radio" id="number-radio" name="blocks" x-bind:checked="blockStyle == 'number'" x-on:click="blockStyle = 'number'">
                <div class="mdc-radio__background">
                  <div class="mdc-radio__outer-circle"></div>
                  <div class="mdc-radio__inner-circle"></div>
                </div>
                <div class="mdc-radio__ripple"></div>
              </div>
              <label for="radio-1 -mt-4">Numbered (Day 1, Day 2, Day 3...)</label>
              <br />
              <div class="mdc-radio mt-2">
                <input class="mdc-radio__native-control" type="radio" id="letter-radio" name="blocks" x-on:click="blockStyle = 'letter'" x-bind:checked="blockStyle == 'letter'">
                <div class="mdc-radio__background">
                  <div class="mdc-radio__outer-circle"></div>
                  <div class="mdc-radio__inner-circle"></div>
                </div>
                <div class="mdc-radio__ripple"></div>
              </div>
              <label for="radio-2 -mt-4">Lettered (A Day, B Day, C Day...)</label>
            </div>
            <button class="mdc-button mdc-button--raised mdc-button-ripple float-right mt-8 mb-2 mr-4" type="button" wire:click="saveBlockSchedule()" wire:ignore x-bind:disabled="numberClasses < 1">
              <span class="mdc-button__ripple"></span>Save Schedule
            </button>
          </div>
        </div>
      </div>
    </div>
    <div x-show="hasSchedule == false" @if($hasSchedule)x-cloak @endif>
      <div>
        <p class="mt-5 ml-2 mdc-typography--body text-gray-600">
          You currently don't have a schedule selected. Add one to automatically have your current classes and events displayed on the dashboard.
        </p>
        <button class="mdc-button mdc-button--raised mdc-button-ripple ml-2 mt-8 mb-2 mr-4" type="button" wire:click="$set('hasSchedule', true)" x-on:click="usingCustomSchedule = true" wire:ignore>
          <span class="mdc-button__ripple"></span>New schedule
        </button>
        <button class="mdc-button mdc-button-ripple mt-8 mb-2 mr-8" type="button" wire:click="$set('hasSchedule', true)" x-on:click="showingQuery = true" wire:ignore>
          <span class="mdc-button__ripple"></span>Search for schedule
        </button>
      </div>
    </div>
  </div>
</div>
