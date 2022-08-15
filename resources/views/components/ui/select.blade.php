<div
x-data="{
  data: {{$data}},
  value: '{{$value != null ? $value : 'null'}}',
}"
>
  <div class="w-full mdc-select {{ $style == 'outlined' ? 'mdc-select--outlined' : 'mdc-select--filled'}} {{$attributes->has('required') ? 'mdc-select--required' : ''}} {{ $attributes->get('class') }}">
    <div class="mdc-select__anchor"
        role="button"
        aria-haspopup="listbox"
        aria-expanded="false"
        aria-labelledby="{{$title}}-label {{$title}}-selected-text">
      
      @if($style == 'outlined')
        <span class="mdc-notched-outline">
          <span class="mdc-notched-outline__leading"></span>
          <span class="mdc-notched-outline__notch">
            <span id="{{$title}}-labe" class="mdc-floating-label" wire:ignore>{{$title}}</span>
          </span>
          <span class="mdc-notched-outline__trailing"></span>
        </span>
      @else
        <span class="mdc-select__ripple"></span>
        <span id="{{$title}}-label" class="mdc-floating-label" wire:ignore>{{$title}}</span>
        <span class="mdc-line-ripple"></span>
      @endif
      
      <span class="mdc-select__selected-text-container">
        <span id="{{$title}}-selected-text" class="mdc-select__selected-text" x-text="value"></span>
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
    </div>

    <div class="mdc-select__menu mdc-menu mdc-menu-surface mdc-menu-surface--fullwidth">
      <ul class="mdc-deprecated-list" role="listbox" aria-label="Food picker listbox">
        <template x-if="! value">
          <li class="mdc-deprecated-list-item mdc-deprecated-list-item--selected" aria-selected="true" data-value="" role="option">
            <span class="mdc-deprecated-list-item__ripple"></span>
          </li>
        </template>

        <template x-for="item in data">
          <li class="mdc-deprecated-list-item" :class="{'mdc-deprecated-list-item--selected': item == value}" :aria-selected="item == value" 
          @click="{{$bind}} = item" :data-value="item" role="option">
            <span class="mdc-deprecated-list-item__ripple"></span>
            <span class="mdc-deprecated-list-item__text" x-text="item"></span>
          </li>
        </template>
      </ul>
    </div>
  </div>
</div>