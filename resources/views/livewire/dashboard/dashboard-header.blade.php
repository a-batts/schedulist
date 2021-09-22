<div class="" wire:poll.300000ms="refresh">
  <div class="mdc-card mdc-card--outlined py-8 px-6 md:px-10 text-white" style="background-color: #242323">
    <div>
      <p class="text-4xl md:text-6xl font-semibold float-left">{{$greeting}} {{Auth::User()->firstname}}!</p>
      <div class="float-right">
        <button class="mdc-icon-button material-icons -mt-3" aria-describedby="update-label">
          <div class="mdc-icon-button__ripple"></div>
          settings_suggest
        </button>
      </div>
    </div>
    <p class="mt-3 text-xl md:text-2xl font-medium">Today is {{Carbon::now()->format('l, F jS')}}</p>
    <p class="mt-4">{{$dayOfWeekString}}</p>
  </div>
  <x-ui.tooltip tooltip-id="update-label" text="Change the schedule block for today"/>
</div>
