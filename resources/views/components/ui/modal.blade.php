<div @close-{{$alpine}}.window="{{$alpine}} = false">
    <div class="inset-0 bg-gray-500 opacity-75 modal-skim hidden" style="display: none" x-show="{{$alpine}}" x-cloak></div>
    <div class="modal-container {{$classes}}" x-show.transition="{{$alpine}}" x-cloak>
      <form {{$attributes->whereStartsWith('wire:submit')}} >
        <div class="mdc-card mdc-card--outlined modal-card">
          <div class="top-row-container">
            <div class="close-and-title">
              <button class="mdc-icon-button close-icon material-icons float-left" type="button" aria-describedby="close-modal" x-on:click="{{$alpine}} = false" aria-label="close">close</button>
              <h1 class="modal-title mdc-typography--headline6 nunito">{{$title}}</h1>
            </div>
            <div class="action-submit-button">
              <button class="mdc-button mdc-button--raised mdc-button-ripple" @isset($submit) type="submit" @else type="button" @endisset {{ $attributes->whereStartsWith('@click') }} {{ $attributes->whereStartsWith('x-on:click') }} aria-label="{{$action}}" wire:ignore>
                <span class="mdc-button__ripple"></span>{{$action}}
              </button>
            </div>
          </div>
          {{$slot}}
        </div>
      </form>
    </div>
    <x-ui.tooltip tooltip-id="close-modal" text="Close"/>
</div>
