<div @close-{{$alpine}}.window="{{$alpine}} = false; undoFixBody()">
    <div class="inset-0 hidden bg-gray-500 opacity-75 modal-skim" style="display: none" x-show="{{$alpine}}" x-cloak></div>
    <div class="fixed top-0 w-screen h-screen overflow-y-auto modal-container" x-transition x-show="{{$alpine}}" x-cloak>
      <form {{$attributes->whereStartsWith('wire:submit')}} >
        <div class="mdc-card mdc-card--outlined modal-card {{$classes}}">
          <div class="top-row-container">
            <div class="close-and-title">
              <button class="float-left mdc-icon-button close-icon material-icons" type="button" aria-describedby="close-modal" x-on:click="{{$alpine}} = false; undoFixBody()" aria-label="close">close</button>
              <h1 class="modal-title mdc-dialog__title">{{$title}}</h1>
            </div>
            <div class="action-submit-button">
              {{$topAction ?? ''}}
              <div class="float-left">
                <button class="mdc-button mdc-button--raised mdc-button-ripple" @if($attributes->has('wire:submit.prevent')) type="submit" @else type="button" @endif {{ $attributes->whereStartsWith('@click') }} {{ $attributes->whereStartsWith('x-on:click') }} aria-label="{{$action}}" wire:ignore>
                <span class="mdc-button__ripple"></span>{{$action}}
              </button>
              </div>
            </div>
          </div>
          {{$slot}}
        </div>
      </form>
    </div>
    <x-ui.tooltip tooltip-id="close-modal" text="Close"/>
</div>
