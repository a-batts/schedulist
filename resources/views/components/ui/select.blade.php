<div>
  <div class="mdc-select {{ $attributes->get('class') }} @if($type == 'outlined') mdc-select--outlined @else mdc-select--filled @endif @if($attributes->has('required')) mdc-select--required @endif" {{ $attributes->whereStartsWith('x-bind:class') }}>
    <div class="mdc-select__anchor" aria-labelledby="{{$text}}-label" @if($attributes->has('required')) aria-required="true" @endif>
      @if($type == 'outlined')
        <span class="mdc-notched-outline">
          <span class="mdc-notched-outline__leading"></span>
          <span class="mdc-notched-outline__notch">
            <span id="{{$text}}-label" class="mdc-floating-label @if($attributes->has('prefilled')) mdc-floating-label--float-above @endif" @if($attributes->has('prefilled'))  style="transform: translateY(-106%) scale(0.75)" @else wire:ignore @endif>{{$text}}</span>
          </span>
          <span class="mdc-notched-outline__trailing"></span>
        </span>
      @else
        <span class="mdc-select__ripple"></span>
        <span id="{{$text}}-label" class="mdc-floating-label @if($attributes->has('prefilled')) mdc-floating-label--float-above @endif" @if(!$attributes->has('prefilled')) wire:ignore @endif>{{$text}}</span>
          <span class="mdc-line-ripple"></span>
      @endif
      <span class="mdc-select__selected-text-container" @if(! $attributes->has('prefilled')) wire:ignore @endif>
        <span id="demo-selected-text" class="mdc-select__selected-text">{{$default ?? ''}}</span>
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
      <ul class="mdc-list dark-theme-list pl-0" role="listbox" aria-label="">
        @if($default && ! in_array($default, $data))
          <li class="mdc-list-item mdc-list-item--selected" aria-selected="true"
          @isset($var) wire:click="set{{$var}}('{{$default}}')" @endisset
          @isset($alpine) @click="{{$alpine}} = '{{$default}}'" @endisset
          data-value="{{$default}}" role="option">
            <span class="mdc-list-item__ripple"></span>
            <span class="mdc-list-item__text">
              {{$default}}
            </span>
          </li>
        @endif
        @foreach($data as $item)
          <li class="mdc-list-item @if($item == $default) mdc-list-item--selected @endif" aria-selected="{{$item == $default}}" data-value="{{$item}}"
           @isset($var) wire:click="set{{$var}}('{{$item}}')" @endisset
           @isset($alpine) @click="{{$alpine}} = '{{$item}}'" @endisset
           role="option">
            <span class="mdc-list-item__ripple"></span>
            <span class="mdc-list-item__text">
              {{$item}}
            </span>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
