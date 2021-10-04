<div class="" wire:poll.300000ms="refresh">
  <div class="px-6 py-8 text-white mdc-card mdc-card--outlined md:px-10" style="background-color: #242323">
    <div>
      <p class="float-left text-4xl font-semibold md:text-6xl">{{$greeting}} {{Auth::User()->firstname}}!</p>
      <div class="float-right">
        <a class="-mt-3 mdc-icon-button material-icons" aria-describedby="update-label" href="{{route('schedule-settings')}}">
          <div class="mdc-icon-button__ripple"></div>
          settings_suggest
        </a>
      </div>
    </div>
    <p class="mt-3 text-xl font-medium md:text-2xl">Today is {{Carbon::now()->format('l, F jS')}}</p>
    <p class="mt-4">{{$dayOfWeekString}}</p>
  </div>
  <x-ui.tooltip tooltip-id="update-label" text="Create or modify your class schedule"/>
</div>
