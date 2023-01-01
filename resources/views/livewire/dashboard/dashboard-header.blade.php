<div class="" wire:poll.300000ms="refresh">
  <div class="mdc-card mdc-card--outlined px-6 py-8 text-white md:px-10" style="background-color: #242323">
    <div>
      <p class="float-left text-4xl font-semibold md:text-6xl">{{$greeting}} {{Auth::user()->firstname}}!</p>
    </div>
    <p class="mt-3 text-xl font-medium md:text-2xl">Today is {{Carbon::now()->format('l, F jS')}}</p>
  </div>
  <x-ui.tooltip tooltip-id="update-label" text="Create or modify your class schedule"/>
</div>
