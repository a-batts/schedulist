<div class="mdc-typography" x-data="{
  editingClass: false,
  schedulePicker: @entangle('schedulePicker'),
}"
@close-edit-modal.window="editingClass = false"
@close-schedule-dialog.window="schedulePicker = false">
  <div x-show="editingClass" id="editskim" style="display: none" class="inset-0 bg-gray-500 opacity-75 modal_skim hidden" x-cloak></div>
  <div x-show.transition="editingClass" x-cloak wire:ignore.self>
    @livewire('dashboard.class-edit')
  </div>
  <div>
    @livewire('dashboard.set-schedule')
    <div wire:poll.25000ms="refreshClasses" id="makefixed" x-bind:class="{'noscroll' : editingClass}" wire:ignore.self>
      @livewire('dashboard.dashboard-header', ['currentBlock' =>  $currentBlock])
      @if (!$userHasSchedule && !$userHasClasses)
        <div class="items-center">
          <span class="material-icons text-center text-center text-gray-400 add_icon">
          schedule
          </span>
          <h1 class="mdc-typography mdc-typography--headline4 text-center text-gray-400 nunito" style="font-weight: 300">Set up your class schedule to get started
            <div class="mx-auto">
              <button class="mdc-button mdc-button-ripple mx-auto mt-5" wire:ignore @click="schedulePicker = true" onclick="fixBody()">
                <span class="mdc-button__ripple "></span>Add a new schedule
              </button>
            </div>
          </h1>
        </div>
      @elseif (!$userHasClasses)
        <div class="items-center">
          <span class="material-icons text-center text-center text-gray-400 add_icon">
          add
          </span>
          <h1 class="mdc-typography mdc-typography--headline4 text-center text-gray-400 nunito" style="font-weight: 300">Add your first class to continue</h1>
        </div>
      @else
      <div class="mdc-layout-grid mdc-layout-grid__cell--span-2">
        <div class="mdc-layout-grid__inner">
          @if(!$userHasSchedule)
            <div class="mdc-layout-grid__cell">
              <span>
                <div class="mdc-card class-card items-center current_class">
                  <span class="material-icons-two-tone day_icon">schedule</span>
                  <h6 class="mdc-typography mdc-typography--headline6 text-center class-header">No class schedule found</h6>
                  <p class="mdc-typography mdc-typography--paragraph text-center class-header text-gray-500">You have to add a class schedule before this tile can automatically populate</p>
                    <button class="mdc-icon-button material-icons mr-1 mt-5 self-end" wire:ignore @click="schedulePicker = true" onclick="fixBody()">settings</button>
                </div>
              </span>
            </div>
          @elseif (! $schoolYearInSession)
            <div class="mdc-layout-grid__cell">
              <span>
                <div class="mdc-card class-card items-center current_class">
                  <span class="material-icons-two-tone day_icon">beach_access</span>
                  <h6 class="mdc-typography mdc-typography--headline6 text-center class-header">The school year is over</h6>
                  <p class="mdc-typography mdc-typography--paragraph text-center class-header text-gray-500">Have a wonderful summer break! See you next year!</p>
                    <a href="{{ route('schedule-settings')}}" class="self-end"><button class="mdc-icon-button material-icons mr-1 mt-5 self-end" wire:ignore>settings</button></a>
                </div>
              </span>
            </div>
          @elseif ($currentClass == "async")
            <div class="mdc-layout-grid__cell">
              <span>
                <div class="mdc-card class-card items-center current_class">
                  <span class="material-icons-two-tone day_icon">wb_sunny</span>
                  <h6 class="mdc-typography mdc-typography--headline6 text-center class-header">Today is an asynchronous day</h6>
                  <p class="mdc-typography mdc-typography--paragraph text-center class-header text-gray-500">It's a good time to work on assignments, meet teachers in office hours or study</p>
                </div>
              </span>
            </div>
          @elseif ($currentClass == "event")
            <div class="mdc-layout-grid__cell">
              <span>
                <div class="mdc-card class-card items-center current_class">
                  <span class="material-icons-two-tone day_icon">wb_sunny</span>
                  <h6 class="mdc-typography mdc-typography--headline6 text-center class-header">{{$event['title']}}</h6>
                  <p class="mdc-typography mdc-typography--paragraph text-center class-header text-gray-500">{{$event['description']}}</p>
                </div>
              </span>
            </div>
          @elseif($currentClass instanceof \App\Models\Classes)
            <div class="mdc-layout-grid__cell">
              <span>
                <div class="mdc-card class-card class_{{$currentClass->color}}">
                  <div>
                    <div class="card-left">
                        <h2 class="mdc-typography mdc-typography--headline6 class-header nunito white"><span class="material-icons-two-tone rec_icon">video_call</span>
                          {{$currentClass->period}}@if($currentClass->period == 1)st @elseif($currentClass->period == 2)nd @elseif($currentClass->period == 3)rd @else()th @endif period - {{$currentClass->name}}</h2>
                    </div>
                    <div class="card-right">
                    </div>
                  </div>
                  <p class="mdc-typography ml-2 white">{{Crypt::decryptString($currentClass->teacher)}}@if($currentClass->teacher_email != null)<button class="mdc-button mdc-button-ripple email_link  button_white">
                    <a href="mailto:{{Crypt::decryptString($currentClass->teacher_email)}}">
                      <i class="material-icons mdc-button__icon white" aria-hidden="true">email</i>
                    <span class="mdc-button__ripple "></span>EMAIL</button></a>@endif</p>
                    <div>
                      <div class="card-left mt-2">
                        @if($currentClass->g_classroom != null)<button class="mdc-button mdc-button-ripple  button_white">
                          <a href="{{Crypt::decryptString($currentClass->g_classroom)}}" rel="noreferrer" target="_blank">
                            <img class="material-icons mdc-button__icon classroom_icon" src="/images/icon/vendor/classroom_white.svg" aria-hidden="true">
                            <span class="mdc-button__ripple "></span>CLASSROOM</button></a>@endif
                        @if($currentClass->blackboard != null)<button class="mdc-button mdc-button-ripple  button_white">
                          <a href="{{Crypt::decryptString($currentClass->blackboard)}}" rel="noreferrer" target="_blank">
                            <img class="material-icons mdc-button__icon classroom_icon" src="/images/icon/vendor/bb_white.svg" aria-hidden="true">
                            <span class="mdc-button__ripple "></span>BLACKBOARD</button></a>@endif
                        @if($currentClass->textbook != null)<button class="mdc-button mdc-button-ripple  button_white">
                          <a href="{{Crypt::decryptString($currentClass->textbook)}}" rel="noreferrer" target="_blank">
                            <i class="material-icons mdc-button__icon " aria-hidden="true">book</i>
                            <span class="mdc-button__ripple "></span>TEXTBOOK</button></a>@endif
                        @if($currentClass->ap_classroom != null)<button class="mdc-button mdc-button-ripple  button_white">
                          <a href="{{Crypt::decryptString($currentClass->ap_classroom)}}" rel="noreferrer" target="_blank">
                            <img class="material-icons mdc-button__icon classroom_icon" src="/images/icon/vendor/cb_white.svg" aria-hidden="true">
                            <span class="mdc-button__ripple "></span>AP CLASSROOM</button></a>@endif
                        @if($currentClass->linkone != null)<button class="mdc-button mdc-button-ripple  button_white">
                          <a href="{{Crypt::decryptString($currentClass->linkone)}}" rel="noreferrer" target="_blank">
                            <span class="mdc-button__ripple "></span>{{$currentClass->linkone_name}}</button></a>@endif
                        @if($currentClass->linktwo != null)<button class="mdc-button mdc-button-ripple  button_white">
                          <a href="{{Crypt::decryptString($currentClass->linktwo)}}" rel="noreferrer" target="_blank">
                            <span class="mdc-button__ripple "></span>{{$currentClass->linktwo_name}}</button></a>@endif
                        @if($currentClass->linkthree != null)<button class="mdc-button mdc-button-ripple  button_white">
                          <a href="{{Crypt::decryptString($currentClass->linkthree)}}" rel="noreferrer" target="_blank">
                            <span class="mdc-button__ripple "></span>{{$currentClass->linkthree_name}}</button></a>@endif
                      </div>
                    </div>
                    <button class="mdc-button mdc-button--raised mdc-button-ripple join_class">
                      <a href="{{Crypt::decryptString($currentClass->class_link)}}" rel="noreferrer" target="_blank">
                        <span class="mdc-button__ripple"></span>
                        <span class="mdc-button__label">JOIN CLASS IN NEW TAB</span>
                      </a>
                    </button>
                </div>
              </span>
            </div>
          @elseif($currentClass == "off")
            <div class="mdc-layout-grid__cell">
              <span>
                <div class="mdc-card class-card items-center current_class">
                  <span class="material-icons-two-tone day_icon">wb_sunny</span>
                  <h6 class="mdc-typography mdc-typography--headline6 text-center class-header nunito">No school today</h6>
                  <p class="mdc-typography mdc-typography--paragraph text-center class-header text-gray-500">Have a relaxing day off! Rememember to make time for yourself and the things you enjoy.</p>
                </div>
              </span>
            </div>
          @else
            <div class="mdc-layout-grid__cell">
              <span>
                <div class="mdc-card class-card items-center current_class">
                  <span class="material-icons-two-tone night_icon">nights_stay</span>
                  <h6 class="mdc-typography mdc-typography--headline6 text-center class-header nunito">There's no class right now</h6>
                  <p class="mdc-typography mdc-typography--paragraph text-center class-header text-gray-500">Take some time to relax or catch up on assigments</p>
                </div>
              </span>
            </div>
          @endif
          @foreach ($classes as $class)
            @if(!isset($currentClass->period) || $class->period != $currentClass->period)
              <div class="mdc-layout-grid__cell">
                <span>
                  <div class="mdc-card class-card class_{{$class->color}}">
                    <h2 class="mdc-typography mdc-typography--headline6 class-header white nunito">{{$class->period}}@if($class->period == 1)st period @elseif($class->period == 2)nd period @elseif($class->period == 3)rd period @else()th period @endif - {{$class->name}}</h2>
                    <p class="mdc-typography ml-2 white">{{Crypt::decryptString($class->teacher)}}@if($class->teacher_email != null)<button class="mdc-button mdc-button-ripple email_link  button_white">
                      <a href="mailto:{{Crypt::decryptString($class->teacher_email)}}">
                        <i class="material-icons mdc-button__icon " aria-hidden="true">email</i>
                      <span class="mdc-button__ripple "></span>EMAIL</button></a>@endif</p>
                      <div>
                        <div class="card-left mt-2">
                          @if($class->g_classroom != null)<button class="mdc-button mdc-button-ripple  button_white">
                            <a href="{{Crypt::decryptString($class->g_classroom)}}" rel="noreferrer" target="_blank">
                              <img class="material-icons mdc-button__icon classroom_icon" src="/images/icon/vendor/classroom_white.svg" aria-hidden="true">
                              <span class="mdc-button__ripple "></span>CLASSROOM</button></a>@endif
                          @if($class->blackboard != null)<button class="mdc-button mdc-button-ripple  button_white">
                            <a href="{{Crypt::decryptString($class->blackboard)}}" rel="noreferrer" target="_blank">
                              <img class="material-icons mdc-button__icon classroom_icon" src="/images/icon/vendor/bb_white.svg" aria-hidden="true">
                              <span class="mdc-button__ripple "></span>BLACKBOARD</button></a>@endif
                          @if($class->textbook != null)<button class="mdc-button mdc-button-ripple  button_white">
                            <a href="{{Crypt::decryptString($class->textbook)}}" rel="noreferrer" target="_blank">
                              <i class="material-icons mdc-button__icon " aria-hidden="true">book</i>
                              <span class="mdc-button__ripple "></span>TEXTBOOK</button></a>@endif
                          @if($class->ap_classroom != null)<button class="mdc-button mdc-button-ripple  button_white">
                            <a href="{{Crypt::decryptString($class->ap_classroom)}}" rel="noreferrer" target="_blank">
                              <img class="material-icons mdc-button__icon classroom_icon" src="/images/icon/vendor/cb_white.svg" aria-hidden="true">
                              <span class="mdc-button__ripple "></span>AP CLASSROOM</button></a>@endif
                          @if($class->linkone != null)<button class="mdc-button mdc-button-ripple  button_white">
                            <a href="{{Crypt::decryptString($class->linkone)}}" rel="noreferrer" target="_blank">
                              <span class="mdc-button__ripple "></span>{{$class->linkone_name}}</button></a>@endif
                          @if($class->linktwo != null)<button class="mdc-button mdc-button-ripple  button_white">
                            <a href="{{Crypt::decryptString($class->linktwo)}}" rel="noreferrer" target="_blank">
                              <span class="mdc-button__ripple "></span>{{$class->linktwo_name}}</button></a>@endif
                          @if($class->linkthree != null)<button class="mdc-button mdc-button-ripple  button_white">
                            <a href="{{Crypt::decryptString($class->linkthree)}}" rel="noreferrer" target="_blank">
                              <span class="mdc-button__ripple "></span>{{$class->linkthree_name}}</button></a>@endif
                        </div>
                      </div>
                      <div>
                        <div class="card-right bottom-icons">
                          <button class="mdc-icon-button material-icons colbutton" aria-describedby="edit{{$class->period}}" wire:click="$emit('resetEditValidation')" @click="editingClass = true; $dispatch('set-edit-class', { period: '{{$class->period}}'}); fixBody()">edit</button>
                          <button class="mdc-icon-button material-icons colbutton" aria-describedby="delete{{$class->period}}" wire:click="$emit('selectedPeriod', {{$class->period}})" onclick="delDialog()">delete_forever</button>
                          <button class="mdc-icon-button material-icons colbutton" aria-describedby="launch{{$class->period}}"><a href="{{Crypt::decryptString($class->class_link)}}" rel="noreferrer" target="_blank">launch</a></button>
                        </div>
                      </div>
                  </div>
                </span>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    @endif
    </div>
  </div>
</div>
