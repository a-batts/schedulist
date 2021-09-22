<div class="px-4 md:px-24 roboto">
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
        <p class="text-4xl md:text-6xl capitalize font-semibold">{{$activeClass->name}}</p>
        @isset ($activeClass->teacher_email)
          <div class="mt-2 -ml-2">
            <a class="mdc-button mdc-button-ripple mdc-button--icon-tailing text-inherit" href="mailto:{{Crypt::decryptString($activeClass->teacher_email)}}">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label text-lg font-normal tracking-normal capitalize">{{$activeClass->teacher}}</span>
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
        <div class="h-5" x-show.transition="cardExpanded" x-cloak>
          <div class="section-border border-gray-100 mt-5"></div>
          <div class="pt-3 pb-5">
            @foreach($activeClass->links as $link)
              <a class="mdc-button mdc-button-ripple text-inherit mr-2" href="{{Crypt::decryptString($link->link)}}" target="_blank">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label">{{$link->name}}</span>
              </a>
            @endforeach
          </div>
        </div>
        <div class="pt-3">
          <button class="mdc-button mdc-button-ripple mdc-button--icon-tailing text-inherit float-right" @click="cardExpanded = !cardExpanded">
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
        <p class="text-4xl md:text-5xl font-semibold">You don't have class right now</p>
        @isset($nextClass)
          <p class="mt-5 text-base mb-4">Your next class is {{$nextClass->name}} at {{$nextClass->timestring}}</p>
        @endisset
        <!--
          <span class="material-icons absolute text-center text-gray-300 text-8xl left-0 right-0">nights_stay</span>
        -->
      </x-ui.dashboard-card>
    @endif
    <div class="dual-dashboard-cards flex flex-wrap">
      <div class="w-full lg:w-1/2 lg:pr-3 px-0 float-left flex-1">
        <x-ui.dashboard-card background-color="" title="Upcoming Assignments" class="mt-6 min-h-full">
          <x-slot name="actionButton">
            <a href="{{route('assignments')}}" class="mdc-button mdc-button-ripple mt-1">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label md:block hidden">All Assignments</span>
              <span class="mdc-button__label md:hidden">View All</span>
            </a>
          </x-slot>
          <div class="w-full block text-center">
            @if($assignments->isEmpty())
              <p class="material-icons text-9xl text-center mt-10 mx-0 assignment-card-icon select-none">assignment_turned_in</p>
              <p class="text-center text-lg mt-1 font-medium text-gray-600">You're all caught up on your work</p>
            @else
              <div class="mt-2">
                @foreach ($assignments as $index => $assignment)
                  <a href="{{'/assignments/assignment/'.$assignment->url_string}}">
                    <div class="mdc-card mdc-card--outlined mt-3 roboto">
                      <div class="mdc-card__primary-action assignment-card-dashboard px-5 truncate text-left" tabindex="0">
                        <div class="float-left assignment-card-left">
                          <p class="font-medium text-xl -mt-0.5">{{Crypt::decryptString($assignment->assignment_name)}}</p>
                          <p class="text-gray-600 text-sm">{{$assignment->class_name}}</p>
                        </div>
                        <div class="md:float-right mt-12 mb-4 md:my-0 assignment-card-right">
                          <p class="text-green text-sm mt-3">Due {{$assignment->due}}</p>
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
      <div class="w-full lg:w-1/2 lg:pl-3 px-0 float-right flex-2 mt-5 lg:mt-0">
        <x-ui.dashboard-card background-color="" title="Events" class="mt-6 h-full">
          <x-slot name="actionButton">
            <a href="{{route('schedule')}}" class="mdc-button mdc-button-ripple mt-1">
              <span class="mdc-button__ripple"></span>
              <span class="mdc-button__label">View Calendar</span>
            </a>
          </x-slot>
          <div class="w-full block text-center">
            @if($events->isEmpty())
            <p class="material-icons text-9xl text-center mt-10 mx-0 assignment-card-icon select-none">event_busy</p>
            <p class="text-center text-lg mt-1 font-medium text-gray-600">No events scheduled for today. Movie night?</p>
            @else
              <div class="mt-2">
                @foreach ($events as $index => $event)
                  <div class="mdc-card mdc-card--outlined mt-3 roboto background-{{$event->color ?? 'blue'}}">
                    <div class="mdc-card__primary-action assignment-card-dashboard px-5 truncate text-left" tabindex="0">
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
