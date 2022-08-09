<div class="px-4 md:px-24 roboto">
  @livewire('dashboard.dashboard-header')
  <div x-data="{ cardExpanded: false }" class="pt-6" wire:poll.40000ms="refresh">
    @if($activeClass)
      <x-ui.dashboard-card :background_color="'background-'.strtolower($activeClass->color)" title="Current Class">
        <x-slot name="actionButton">
          @isset ($activeClass->video_link)
            <a href="{{Crypt::decryptString($activeClass->video_link)}}" class="-mt-1 mdc-icon-button material-icons" aria-describedby="video-label" target="_blank">
              <div class="mdc-icon-button__ripple"></div>
              videocam
            </a>
            <x-ui.tooltip tooltip-id="video-label" text="Join video call"/>
          @endif
          <button class="-mt-1 mdc-icon-button material-icons" aria-describedby="edit-label" @click="$dispatch('edit-class', { id: {{$activeClass->id}}})">
            <div class="mdc-icon-button__ripple"></div>
            edit
          </button>
        </x-slot>
        <p class="text-4xl font-semibold capitalize md:text-6xl">{{$activeClass->name}}</p>
        @isset ($activeClass->teacher_email)
          <div class="mt-2 -ml-2">
            <a class="mdc-button mdc-button-ripple mdc-button--icon-tailing text-inherit" href="mailto:{{Crypt::decryptString($activeClass->teacher_email)}}">
              <span class="mdc-button__ripple"></span>
              <span class="text-lg font-normal tracking-normal capitalize mdc-button__label">{{$activeClass->teacher}}</span>
              <i class="material-icons mdc-button__icon" aria-hidden="true">email</i>
            </a>
          </div>
        @else
          <span class="mt-2 text-lg tracking-normal">{{$activeClass->teacher}}</span>
        @endisset
        @isset($activeClass->class_location)
          <span class="mt-1">{{$activeClass->class_location}}</span>
        @endisset
        <span class="mt-1">{{$activeClass->timestring}}</span>
        <div class="h-5" x-transition x-show="cardExpanded" x-cloak>
          <div class="mt-5 border-gray-100 section-border"></div>
          <div class="pt-3 pb-5">
            @foreach($activeClass->links as $link)
              <a class="mr-2 mdc-button mdc-button-ripple text-inherit" href="{{Crypt::decryptString($link->link)}}" target="_blank">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label">{{$link->name}}</span>
              </a>
            @endforeach
          </div>
        </div>
        <div class="pt-3">
          <button class="float-right mdc-button mdc-button-ripple mdc-button--icon-tailing text-inherit" @click="cardExpanded = !cardExpanded">
            <span class="mdc-button__ripple"></span>
            <span class="mdc-button__label" x-text="cardExpanded ? 'Hide Class Links' : 'Show Class Links'"></span>
            <i class="material-icons mdc-button__icon" aria-hidden="true" x-text="cardExpanded ? 'expand_less' : 'expand_more'"></i>
          </button>
        </div>
        <x-ui.tooltip tooltip-id="edit-label" text="Edit class"/>
      </x-ui.dashboard-card>
    @else
      <x-ui.dashboard-card background-color="" title="Current Class">
        <x-slot name="actionButton">
          <button class="-mt-1 mdc-icon-button material-icons" aria-describedby="edit-label" wire:click="refresh()" type="button" wire:ignore>
            <div class="mdc-icon-button__ripple"></div>
            refresh
          </button>
        </x-slot>
        <p class="text-4xl font-semibold md:text-5xl">You don't have class right now</p>
        @isset($nextClass)
          <p class="mt-5 mb-4 text-base">Your next class is {{$nextClass->name}} at {{$nextClass->timestring}}</p>
        @else
          <p class="mt-5 mb-4 text-base">No upcoming classes. You can add classes to your schedule by clicking on the gear icon at the top of the page</p>
        @endisset
        <!--
          <span class="absolute left-0 right-0 text-center text-gray-300 material-icons text-8xl">nights_stay</span>
        -->
      </x-ui.dashboard-card>
    @endif
    <div class="flex flex-wrap dual-dashboard-cards">
      <div class="flex-1 float-left w-full px-0 lg:w-1/2 lg:pr-3">
        <x-ui.dashboard-card background-color="" title="Upcoming Assignments" class="min-h-full mt-6">
          <x-slot name="actionButton">
            <a href="{{route('assignments')}}" class="mt-1 mdc-button mdc-button-ripple">
              <span class="mdc-button__ripple"></span>
              <span class="hidden mdc-button__label md:block">All Assignments</span>
              <span class="mdc-button__label md:hidden">View All</span>
            </a>
          </x-slot>
          <div class="block w-full text-center">
            @if($assignments->isEmpty())
              <p class="mx-0 mt-10 text-center select-none material-icons text-9xl assignment-card-icon">assignment_turned_in</p>
              <p class="mt-1 text-lg font-medium text-center text-gray-600">You're all caught up on your work</p>
            @else
              <div class="mt-2">
                @foreach ($assignments as $index => $assignment)
                  <a href="{{'/assignments/assignment/'.$assignment->url_string}}">
                    <div class="mt-3 mdc-card mdc-card--outlined roboto">
                      <div class="px-5 text-left truncate mdc-card__primary-action assignment-card-dashboard" tabindex="0">
                        <div class="float-left assignment-card-left">
                          <p class="font-medium text-xl -mt-0.5">{{Crypt::decryptString($assignment->assignment_name)}}</p>
                          <p class="text-sm text-gray-600">{{$assignment->class_name}}</p>
                        </div>
                        <div class="mt-12 mb-4 md:float-right md:my-0 assignment-card-right">
                          <p class="mt-3 text-sm text-green">Due {{$assignment->due}}</p>
                        </div>
                      </div>
                    </div>
                  </a>
                @endforeach
              </div>
            @endif
          </div>
        </x-ui.dashboard-card>
      </div>
      <div class="float-right w-full px-0 mt-5 lg:w-1/2 lg:pl-3 flex-2 lg:mt-0">
        <x-ui.dashboard-card background-color="" title="Events" class="h-full mt-6">
          <x-slot name="actionButton">
            <a href="{{route('schedule')}}" class="mt-1 mdc-button mdc-button-ripple">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label">View Calendar</span>
            </a>
          </x-slot>
          <div class="block w-full text-center">
            @if($events->isEmpty())
            <p class="mx-0 mt-10 text-center select-none material-icons text-9xl assignment-card-icon">event_busy</p>
            <p class="mt-1 text-lg font-medium text-center text-gray-600">No events scheduled for today. Movie night?</p>
            @else
              <div class="mt-2">
                @foreach ($events as $index => $event)
                  <div class="mdc-card mdc-card--outlined mt-3 roboto background-{{$event->color ?? 'blue'}}">
                    <div class="px-5 text-left truncate mdc-card__primary-action assignment-card-dashboard" tabindex="0">
                      <div class="float-left assignment-card-left">
                        <p class="font-medium text-xl -mt-0.5">{{Crypt::decryptString($event->name)}}</p>
                        <p class="text-sm">{{$event->timestring}}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
          </div>
        </x-ui.dashboard-card>
      </div>
    </div>
  </div>
</div>
