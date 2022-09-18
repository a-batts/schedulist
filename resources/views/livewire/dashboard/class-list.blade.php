<div class="px-4 mt-16 md:px-24" x-data="{
  selected: -1,
}">
    <p class="text-3xl font-semibold">All of your classes</p>
    <div class="my-5 border-t border-gray-200"></div>
    <div>
      @foreach($classes as $index => $class)
        <div class="mdc-card mdc-card--outlined py-6 px-6 md:px-10 my-4 transition-colors {{'background-'.strtolower($class->color)}}">
          <div>
            <div class="float-left">
              <p class="text-2xl font-semibold">{{$class->name}}</p>
              @isset ($class->teacher_email)
                <div class="-mb-1 -ml-2">
                  <a class="mdc-button mdc-button-ripple mdc-button--icon-tailing text-inherit" href="mailto:{{$class->teacher_email}}">
                    <span class="mdc-button__ripple"></span>
                    <span class="text-lg font-normal tracking-normal capitalize mdc-button__label">{{$class->teacher}}</span>
                    <i class="material-icons mdc-button__icon" aria-hidden="true">email</i>
                  </a>
                </div>
              @else
                <span class="inline-block mt-1 text-lg tracking-normal">{{$class->teacher}}</span>
              @endisset
              @isset($class->location)
                <p class="mt-1 text-base">{{$class->location}}</p>
              @endisset
            </div>
            <div class="float-right">
              @isset ($class->video_link)
                <a href="{{$class->video_link}}" class="-mt-1 mdc-icon-button material-icons" aria-describedby="video-label-{{$index}}" target="_blank">
                  <div class="mdc-icon-button__ripple"></div>
                  videocam
                </a>
                <x-ui.tooltip tooltip-id="video-label-{{$index}}" text="Join video call"/>
              @endif
              <button class="-mt-1 mdc-icon-button material-icons" aria-describedby="edit-label-{{$index}}" @click="$dispatch('edit-class', { id: {{$class->id}}})">
                <div class="mdc-icon-button__ripple"></div>
                edit
              </button>
              <x-ui.tooltip tooltip-id="edit-label-{{$index}}" text="Edit class"/>
              @if ($class->links->count() > 0)
                <button class="-mt-1 mdc-icon-button material-icons" aria-describedby="dropdown-label-{{$index}}" @click="selected == {{$index}} ? selected = -1 : selected = {{$index}}" x-text="selected != {{$index}} ? 'expand_more' : 'expand_less'">
                  <div class="mdc-icon-button__ripple"></div>
                </button>
                <x-ui.tooltip tooltip-id="dropdown-label-{{$index}}" text="Toggle class links"/>
              @endif
            </div>
          </div>
          <div class="mt-4" x-transition x-show="selected == {{$index}}" x-cloak>
            @foreach($class->links as $link)
              <a class="mr-2 mdc-button mdc-button-ripple text-inherit" href="{{$link->link}}" target="_blank">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label">{{$link->name}}</span>
              </a>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
</div>
