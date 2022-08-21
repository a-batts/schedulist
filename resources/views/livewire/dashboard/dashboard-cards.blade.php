<div class="px-4 md:px-24">
  @livewire('dashboard.dashboard-header')
  <div x-data="{ cardExpanded: false }" class="pt-6" wire:poll.40000ms="refresh">
    @if($activeClass)
      <x-ui.dashboard-card :background_color="'background-'.strtolower($activeClass->color)" title="Current Class">
        <x-slot name="actionButton">
          @isset ($activeClass->video_link)
            <a href="{{Crypt::decryptString($activeClass->video_link)}}" class="mdc-icon-button material-icons -mt-1" aria-describedby="video-label" target="_blank">
              <div class="mdc-icon-button__ripple"></div>
              videocam
            </a>
            <x-ui.tooltip tooltip-id="video-label" text="Join video call"/>
          @endif
          <button class="mdc-icon-button material-icons -mt-1" aria-describedby="edit-label" @click="$dispatch('edit-class', { id: {{$activeClass->id}}})">
            <div class="mdc-icon-button__ripple"></div>
            edit
          </button>
        </x-slot>
        <p class="text-4xl font-semibold capitalize md:text-6xl">{{$activeClass->name}}</p>
        @isset ($activeClass->teacher_email)
          <div class="mt-2 -ml-2">
            <a class="mdc-button mdc-button-ripple mdc-button--icon-tailing text-inherit" href="mailto:{{Crypt::decryptString($activeClass->teacher_email)}}">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label text-lg font-normal capitalize tracking-normal">{{$activeClass->teacher}}</span>
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
          <div class="section-border mt-5 border-gray-100"></div>
          <div class="pt-3 pb-5">
            @foreach($activeClass->links as $link)
              <a class="mdc-button mdc-button-ripple mr-2 text-inherit" href="{{Crypt::decryptString($link->link)}}" target="_blank">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label">{{$link->name}}</span>
              </a>
            @endforeach
          </div>
        </div>
        <div class="pt-3">
          <button class="mdc-button mdc-button-ripple mdc-button--icon-tailing float-right text-inherit" @click="cardExpanded = !cardExpanded">
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
          <button class="mdc-icon-button material-icons -mt-1" aria-describedby="edit-label" wire:click="refresh()" type="button" wire:ignore>
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
          <span class="material-icons absolute left-0 right-0 text-center text-8xl text-gray-300">nights_stay</span>
        -->
      </x-ui.dashboard-card>
    @endif
    <div class="dual-dashboard-cards flex flex-wrap">
      <div class="float-left w-full flex-1 px-0 lg:w-1/2 lg:pr-3">
        <x-ui.dashboard-card background-color="" title="Upcoming Assignments" class="mt-6 min-h-full">
          <x-slot name="actionButton">
            <a href="{{route('assignments')}}" class="mdc-button mdc-button-ripple mt-1">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label hidden md:block">All Assignments</span>
              <span class="mdc-button__label md:hidden">View All</span>
            </a>
          </x-slot>
          <div class="block w-full text-center">
            @if($assignments->isEmpty())
              <p class="material-icons assignment-card-icon mx-0 mt-10 select-none text-center text-9xl">assignment_turned_in</p>
              <p class="mt-1 text-center text-lg font-medium text-gray-600">You're all caught up on your work</p>
            @else
              <div class="mt-2">
                @foreach ($assignments as $index => $assignment)
                  <a href="{{'/assignments/assignment/'.$assignment->url_string}}">
                    <div class="mdc-card mdc-card--outlined mt-3">
                      <div class="mdc-card__primary-action assignment-card-dashboard truncate px-5 text-left" tabindex="0">
                        <div class="assignment-card-left float-left">
                          <p class="-mt-0.5 text-xl font-medium">{{Crypt::decryptString($assignment->assignment_name)}}</p>
                          <p class="text-sm text-gray-600">{{$assignment->class_name}}</p>
                        </div>
                        <div class="assignment-card-right mt-12 mb-4 md:float-right md:my-0">
                          <p class="text-green mt-3 text-sm">Due {{$assignment->due}}</p>
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
      <div class="flex-2 float-right mt-5 w-full px-0 lg:mt-0 lg:w-1/2 lg:pl-3">
        <x-ui.dashboard-card background-color="" title="Events" class="mt-6 h-full">
          <x-slot name="actionButton">
            <a href="{{route('schedule')}}" class="mdc-button mdc-button-ripple mt-1">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label">View Calendar</span>
            </a>
          </x-slot>
          <div class="block w-full text-center">
            @if($events->isEmpty())
            <p class="material-icons assignment-card-icon mx-0 mt-10 select-none text-center text-9xl">event_busy</p>
            <p class="mt-1 text-center text-lg font-medium text-gray-600">No events scheduled for today. Movie night?</p>
            @else
              <div class="mt-2">
                @foreach ($events as $index => $event)
                  <div class="mdc-card mdc-card--outlined mt-3 background-{{$event->color ?? 'blue'}}">
                    <div class="mdc-card__primary-action assignment-card-dashboard truncate px-5 text-left" tabindex="0">
                      <div class="assignment-card-left float-left">
                        <p class="-mt-0.5 text-xl font-medium">{{Crypt::decryptString($event->name)}}</p>
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
