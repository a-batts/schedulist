<div class="mdc-typography">
  <div class="py-4">
  </div>
  <div class="mdc-select mdc-select--filled mdc-select--no-label mb30 assignmentc_select" >
    <div class="mdc-select__anchor">
      <span class="mdc-select__ripple"></span>
      <span class="mdc-select__selected-text-container">
        <span id="selectedtext-assignmentspd" class="mdc-select__selected-text">@if ($period != null){{ $this->getClassString() }} @else()All classes @endif</span>
      </span>
      <span class="mdc-select__dropdown-icon">
        <svg
            class="mdc-select__dropdown-icon-graphic"
            viewBox="7 10 10 5">
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
      <ul class="mdc-list dark-theme-list">
        <li class="mdc-list-item @if($period==null)mdc-list-item--selected @endif selectindex0" data-value="All classes" wire:click="swapPeriod(null, 0)">
          <span class="mdc-list-item__ripple"></span>
          <span class="mdc-list-item__text">All classes</span>
        </li>
        @foreach($classes as $class)
        <li class="mdc-list-item @if($period==$class->period)mdc-list-item--selected @endif selectindex{{$class->period}}" data-value="{{$class->period}}" wire:click="swapPeriod({{$class->period}})">
          <span class="mdc-list-item__ripple"></span>
          <span class="mdc-list-item__text">{{$class->period}}: {{$class->name}}</span>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
  <div class="mdc-select mdc-select--filled mdc-select--no-label mb30 assignmentd_select">
      <div class="mdc-select__anchor">
        <span class="mdc-select__ripple"></span>
        <span class="mdc-select__selected-text-container">
          <span id="selectedtext-assignmentspd" class="mdc-select__selected-text">@if($due==null)Incomplete @elseif($due=='done')Done @elseif($due=='late')Late @endif</span>
        </span>
        <span class="mdc-select__dropdown-icon">
          <svg
              class="mdc-select__dropdown-icon-graphic"
              viewBox="7 10 10 5">
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
        <ul class="mdc-list dark-theme-list">
          <li class="mdc-list-item @if($due==null)mdc-list-item--selected @endif" data-value="Incomplete" wire:click="swapDue(null)">
            <span class="mdc-list-item__ripple"></span>
            <span class="mdc-list-item__text">Incomplete</span>
          </li>
          <li class="mdc-list-item @if($due=='late')mdc-list-item--selected @endif" data-value="Late" wire:click="swapDue('late')">
            <span class="mdc-list-item__ripple"></span>
            <span class="mdc-list-item__text">Late</span>
          </li>
          <li class="mdc-list-item @if($due=='done')mdc-list-item--selected @endif" data-value="Done" wire:click="swapDue('done')">
            <span class="mdc-list-item__ripple"></span>
            <span class="mdc-list-item__text">Done</span>
          </li>
        </ul>
      </div>
    </div>
  <br>
  <div class="assignmentholder_div" x-data="{ selected: false }">
    @if (isset($assignments))
      <h6 class="mdc-typography--headline6 assignment_group mb-6 mt-10 nunito">All assignments</h6>
      @foreach($assignments as $assignment)
      <div class="mdc-card mdc-card--outlined assignment_card" wire:key="{{ $assignment->id}}">
        <div class="mdc-card__primary-action assignment_card_prim" tabindex="0" x-on:click="selected !== '{{$assignment->id}}' ? selected = '{{$assignment->id}}' : selected = null" >
          <div class="float-left">
            <p class="mdc-typography--subtitle2 assignment_name assignment_all_text">{{Crypt::decryptString($assignment->assignment_name)}}</p>
            <p class="mdc-typography mdc-typography--body2 assignment_class assignment_all_text text-gray-600">{{$assignment->class_name}}</p>
          </div>
          @if($assignment->status == 'inc')
          <div class="float-right">
            <span class="text-error assignment_all_text">Due {{$assignment->due_date}}, {{$assignment->due_time}}</span>
            <button class="mdc-button mdc-button--outlined mdc-button-ripple ml-2 assignment_button" type="submit" aria-label="Add" tabindex="12" wire:click="markDone({{$assignment->id}})">
              <span class="mdc-button__ripple"></span>{{ __('Mark completed') }}
            </button>
          </div>
          @else
          <div class="float-right">
            <span class="assignment_all_text">Completed</span>
          </div>
          @endif
        </div>
        <div x-show.transition.origin.top.center.duration.50ms= "selected == '{{$assignment->id}}'" style="width: inherit" x-cloak>
          <div class="border-t border-gray-100"></div>
          <div class="assignment_card_content_div">
            <div class="float-left">
              <p class="assignment_description">{{Crypt::decryptString($assignment->description)}}</p>
            </div>
            <br>
            <div class="float-right">
              @if($assignment->assignment_link != null)
              <button class="mdc-button mdc-button mdc-button-ripple ml-2 view_button" type="submit" aria-label="Add" tabindex="12">
                <a href="{{Crypt::decryptString($assignment->assignment_link)}}" target="_blank"><i class="material-icons mdc-button__icon" aria-hidden="true">link</i>
                <span class="mdc-button__ripple"></span>{{ __('Open') }}</a>
              </button>
              @endif
              <button class="mdc-button mdc-button mdc-button-ripple ml-2 view_button" type="submit" aria-label="Add" tabindex="12">
                <a href="/assignments/assignment/{{$assignment->url_string}}"><span class="mdc-button__ripple"></span>{{ __('View Assignment') }}</a>
              </button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    @else
      <h6 class="mdc-typography--headline6 assignment_group mb-6 mt-10 nunito">Due today</h6>
      @foreach($todayassignments as $assignment)
      <div class="mdc-card mdc-card--outlined assignment_card" wire:key="{{ $assignment->id}}">
        <div class="mdc-card__primary-action assignment_card_prim" tabindex="0" x-on:click="selected !== '{{$assignment->id}}' ? selected = '{{$assignment->id}}' : selected = null" >
          <div class="float-left">
            <p class="mdc-typography--subtitle2 assignment_name assignment_all_text">{{Crypt::decryptString($assignment->assignment_name)}}</p>
            <p class="mdc-typography mdc-typography--body2 assignment_class assignment_all_text text-gray-600">{{$assignment->class_name}}</p>
          </div>
          <div class="float-right">
            <span class="text-green assignment_all_text">Due {{$assignment->due_time}}</span>
            <button class="mdc-button mdc-button--outlined mdc-button-ripple ml-2 assignment_button" type="submit" aria-label="Add" tabindex="12" wire:click="markDone({{$assignment->id}})">
              <span class="mdc-button__ripple"></span>{{ __('Mark completed') }}
            </button>
          </div>
        </div>
        <div x-show.transition.origin.top.center.duration.50ms= "selected == '{{$assignment->id}}'" style="width: inherit" x-cloak>
          <div class="border-t border-gray-100"></div>
          <div class="assignment_card_content_div">
            <div class="float-left">
              <p class="assignment_description">{{Crypt::decryptString($assignment->description)}}</p>
            </div>
            <br>
            <div class="float-right">
              @if($assignment->assignment_link != null)
              <button class="mdc-button mdc-button mdc-button-ripple ml-2 view_button" type="submit" aria-label="Add" tabindex="12">
                <a href="{{Crypt::decryptString($assignment->assignment_link)}}" target="_blank"><i class="material-icons mdc-button__icon" aria-hidden="true">link</i>
                <span class="mdc-button__ripple"></span>{{ __('Open') }}</a>
              </button>
              @endif
              <button class="mdc-button mdc-button mdc-button-ripple ml-2 view_button" type="submit" aria-label="Add" tabindex="12">
                <a href="/assignments/assignment/{{$assignment->url_string}}"><span class="mdc-button__ripple"></span>{{ __('View Assignment') }}</a>
              </button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <h6 class="mdc-typography--headline6 assignment_group mb-6 mt-4 nunito">Later this week</h6>
      @foreach($weekassignments as $assignment)
      <div class="mdc-card mdc-card--outlined assignment_card" wire:key="{{ $assignment->id}}">
        <div class="mdc-card__primary-action assignment_card_prim" tabindex="0" x-on:click="selected !== '{{$assignment->id}}' ? selected = '{{$assignment->id}}' : selected = null" >
          <div class="float-left">
            <p class="mdc-typography--subtitle2 assignment_name assignment_all_text">{{Crypt::decryptString($assignment->assignment_name)}}</p>
            <p class="mdc-typography mdc-typography--body2 assignment_class assignment_all_text text-gray-600">{{$assignment->class_name}}</p>
          </div>
          <div class="float-right">
            <span class="text-green assignment_all_text">Due {{$assignment->due_date}}, {{$assignment->due_time}}</span>
            <button class="mdc-button mdc-button--outlined mdc-button-ripple ml-2 assignment_button" type="submit" aria-label="Add" tabindex="12" wire:click="markDone({{$assignment->id}})">
              <span class="mdc-button__ripple"></span>{{ __('Mark completed') }}
            </button>
          </div>
        </div>
        <div x-show.transition.origin.top.center.duration.50ms= "selected == '{{$assignment->id}}'" style="width: inherit" x-cloak>
          <div class="border-t border-gray-100"></div>
          <div class="assignment_card_content_div">
            <div class="float-left">
              <p class="assignment_description">{{Crypt::decryptString($assignment->description)}}</p>
            </div>
            <br>
            <div class="float-right">
              @if($assignment->assignment_link != null)
              <button class="mdc-button mdc-button mdc-button-ripple ml-2 view_button" type="submit" aria-label="Add" tabindex="12">
                <a href="{{Crypt::decryptString($assignment->assignment_link)}}" target="_blank"><i class="material-icons mdc-button__icon" aria-hidden="true">link</i>
                <span class="mdc-button__ripple"></span>{{ __('Open') }}</a>
              </button>
              @endif
              <button class="mdc-button mdc-button mdc-button-ripple ml-2 view_button" type="submit" aria-label="Add" tabindex="12">
                <a href="/assignments/assignment/{{$assignment->url_string}}"><span class="mdc-button__ripple"></span>{{ __('View Assignment') }}</a>
              </button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <h6 class="mdc-typography--headline6 assignment_group mb-6 mt-4 nunito">Later</h6>
      @foreach($remainingassignments as $assignment)
        <div class="mdc-card mdc-card--outlined assignment_card" wire:key="{{ $assignment->id}}">
          <div class="mdc-card__primary-action assignment_card_prim" tabindex="0" x-on:click="selected !== '{{$assignment->id}}' ? selected = '{{$assignment->id}}' : selected = null" >
            <div class="float-left">
              <p class="mdc-typography--subtitle2 assignment_name assignment_all_text">{{Crypt::decryptString($assignment->assignment_name)}}</p>
              <p class="mdc-typography mdc-typography--body2 assignment_class assignment_all_text text-gray-600">{{$assignment->class_name}}</p>
            </div>
            <div class="float-right">
              <span class="text-green assignment_all_text">Due {{$assignment->due_date}}, {{$assignment->due_time}}</span>
              <button class="mdc-button mdc-button--outlined mdc-button-ripple ml-2 assignment_button" type="submit" aria-label="Add" tabindex="12" wire:click="markDone({{$assignment->id}})">
                <span class="mdc-button__ripple"></span>{{ __('Mark completed') }}
              </button>
            </div>
          </div>
          <div x-show.transition.origin.top.center.duration.50ms= "selected == '{{$assignment->id}}'" style="width: inherit" x-cloak>
            <div class="border-t border-gray-100"></div>
            <div class="assignment_card_content_div">
              <div class="float-left">
                <p class="assignment_description">{{Crypt::decryptString($assignment->description)}}</p>
              </div>
              <br>
              <div class="float-right">
                @if($assignment->assignment_link != null)
                <button class="mdc-button mdc-button mdc-button-ripple ml-2 view_button" type="submit" aria-label="Add" tabindex="12">
                  <a href="{{Crypt::decryptString($assignment->assignment_link)}}" target="_blank"><i class="material-icons mdc-button__icon" aria-hidden="true">link</i>
                  <span class="mdc-button__ripple"></span>{{ __('Open') }}</a>
                </button>
                @endif
                <button class="mdc-button mdc-button mdc-button-ripple ml-2 view_button" type="submit" aria-label="Add" tabindex="12">
                  <a href="/assignments/assignment/{{$assignment->url_string}}"><span class="mdc-button__ripple"></span>{{ __('View Assignment') }}</a>
                </button>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>
</div>
