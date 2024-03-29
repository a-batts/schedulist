<div class="px-4 md:px-24">
    @livewire('dashboard.dashboard-header')
    <div class="pt-6" wire:poll.40000ms="refresh">
        @if ($currentClass)
            <x-ui.dashboard-card title="Current Class" :background_color="'background-' . strtolower($currentClass->color)">
                <x-slot name="actionButton">
                    @isset($currentClass->video_link)
                        <a class="mdc-icon-button material-icons -mt-1" href="{{ $currentClass->video_link }}"
                            aria-describedby="video-label" target="_blank" rel="noopener">
                            <div class="mdc-icon-button__ripple"></div>
                            videocam
                        </a>
                        <x-ui.tooltip tooltip-id="video-label" text="Join video call" />
                    @endisset
                </x-slot>
                <p class="text-4xl font-semibold capitalize md:text-6xl">{{ $currentClass->name }}</p>
                @isset($currentClass->teacher_email)
                    <div class="mt-2 -ml-2">
                        <a class="mdc-button mdc-button-ripple mdc-button--icon-tailing text-inherit"
                            href="mailto:{{ $currentClass->teacher_email }}">
                            Email professor
                            <span class="mdc-button__ripple"></span>
                            <span
                                class="mdc-button__label text-lg font-normal capitalize tracking-normal">{{ $currentClass->teacher_name }}</span>
                            <i class="material-icons mdc-button__icon" aria-hidden="true">email</i>
                        </a>
                    </div>
                @else
                    <span class="mt-2 text-lg tracking-normal">{{ $currentClass->teacher_name }}</span>
                @endisset
                @isset($currentClass->location)
                    <span class="mt-1">{{ $currentClass->location }}</span>
                @endisset
                <span class="mt-1 mb-2">{{ $currentClass->timestring }}</span>
            </x-ui.dashboard-card>
        @else
            <x-ui.dashboard-card title="Current Class" background-color="">
                <x-slot name="actionButton">
                    <button class="mdc-icon-button material-icons -mt-1" type="button" aria-describedby="edit-label"
                        wire:click="updateCurrentClass()" wire:ignore>
                        <div class="mdc-icon-button__ripple"></div>
                        refresh
                    </button>
                </x-slot>
                <p class="text-4xl font-semibold md:text-5xl">You don't have class right now</p>
                @isset($nextClass)
                    <p class="mt-5 mb-4 text-base">Your next class is {{ $nextClass->name }} at {{ $nextClass->timestring }}
                    </p>
                @else
                    <p class="mt-5 mb-4 text-base">No upcoming classes.</p>
                @endisset
            </x-ui.dashboard-card>
        @endif
        <div class="dual-dashboard-cards flex flex-wrap">
            <div class="float-left w-full flex-1 px-0 lg:w-1/2 lg:pr-3">
                <x-ui.dashboard-card class="mt-6 min-h-full" title="Upcoming Assignments" background-color="">
                    <x-slot name="actionButton">
                        <a class="mdc-button mdc-button-ripple mt-1" href="{{ route('assignments') }}">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label hidden md:block">All Assignments</span>
                            <span class="mdc-button__label md:hidden">View All</span>
                        </a>
                    </x-slot>
                    <div class="block w-full text-center">
                        @if ($assignments->isEmpty())
                            <p class="material-icons assignment-card-icon mx-0 mt-10 select-none text-center text-9xl">
                                assignment_turned_in</p>
                            <p class="mt-1 text-center text-lg font-medium text-gray-600">You're all caught up on your
                                work</p>
                        @else
                            <div class="mt-2">
                                @foreach ($assignments as $index => $assignment)
                                    <a href="{{ '/assignments/assignment/' . $assignment->url_string }}">
                                        <div class="mdc-card mdc-card--outlined mt-3">
                                            <div class="mdc-card__primary-action assignment-card-dashboard truncate px-5 text-left"
                                                tabindex="0">
                                                <div class="assignment-card-left float-left">
                                                    <p class="-mt-0.5 text-xl font-medium">{{ $assignment->name }}</p>
                                                    <p class="text-sm text-gray-600">{{ $assignment->class_name }}</p>
                                                </div>
                                                <div class="assignment-card-right mt-12 mb-4 md:float-right md:my-0">
                                                    <p class="text-green mt-3 text-sm">Due {{ $assignment->humanDue }}
                                                    </p>
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
                <x-ui.dashboard-card class="mt-6 h-full" title="Events" background-color="">
                    <x-slot name="actionButton">
                        <a class="mdc-button mdc-button-ripple mt-1" href="{{ route('schedule') }}">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label">View Calendar</span>
                        </a>
                    </x-slot>
                    <div class="block w-full text-center">
                        @if ($events->isEmpty())
                            <p class="material-icons assignment-card-icon mx-0 mt-10 select-none text-center text-9xl">
                                event_busy</p>
                            <p class="mt-1 text-center text-lg font-medium text-gray-400">{{ $this->getEventPhrase() }}
                            </p>
                        @else
                            <div class="mt-2">
                                @foreach ($events as $index => $event)
                                    <div
                                        class="mdc-card mdc-card--outlined background-{{ $event['color'] ?? 'blue' }} mt-3">
                                        <div class="mdc-card__primary-action assignment-card-dashboard truncate px-5 text-left"
                                            tabindex="0">
                                            <div class="assignment-card-left float-left">
                                                <p class="-mt-0.5 text-xl font-medium">{{ $event['name'] }}</p>
                                                <p class="text-sm">{{ $event['timestring'] }}</p>
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
