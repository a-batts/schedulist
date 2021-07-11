<div class="mb-4" wire:poll.300000ms="getTimeString"
x-data="{
  changeBlock: false,
}" x-on:keydown.escape="changeBlock = false"
@hide-change-block-dialog.window="changeBlock = false"
>
  <h6 class="mdc-typography--headline3 ml-6 mt-2 mb-2 nunito">
     {{$timeString}}, {{Auth::User()->firstname}}!
     <br / class="lg:hidden block">
     @if(isset($currentBlock) && $currentBlock != "off")
       <span class="lg:float-right mdc-typography--headline5 mt-2 text-lg font-medium nunito mr-20">
        {{$blockString}}
       </span>
     @endif
  </h6>
  <a href="/assignments">
    <button class="mdc-button mdc-button-ripple ml-4" wire:ignore>
      <span class="mdc-button__ripple "></span>@if(Auth::User()->num_assignments > 0) You have {{Auth::User()->num_assignments}} incomplete @if(Auth::User()->num_assignments > 1)assignments @else()assignment @endif @else You're all caught up! @endif
    </button>
  </a>
  @if(isset($currentBlock) && $currentBlock != "off")
    <button class="mdc-button mdc-button-ripple ml-4 lg:float-right mr-20 md:-mt-2" @click="changeBlock = true; fixBody()" wire:ignore>
      <span class="mdc-button__ripple "></span>Update current block day
    </button>
  @endif
  @livewire('dashboard.update-block' , ['currentBlock' =>  $currentBlock])
</div>
