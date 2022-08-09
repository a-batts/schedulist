<div class="px-4 md:px-24 roboto mt-16" x-data="{
  selected: -1,
}">
    <p class="font-semibold text-3xl">All of your classes</p>
    <div class="border-t border-gray-200 my-5"></div>
    <div>
      @foreach($classes as $index => $class)
        <div class="mdc-card mdc-card--outlined py-6 px-6 md:px-10 my-4 transition-colors {{'background-'.strtolower($class->color)}}">
          <div>
            <div class="float-left">
              <p class="font-semibold text-2xl">{{$class->name}}</p>
              @isset ($class->teacher_email)
                <div class="-ml-2 -mb-1">
                  <a class="mdc-button mdc-button-ripple mdc-button--icon-tailing text-inherit" href="mailto:{{Crypt::decryptString($class->teacher_email)}}">
                    <span class="mdc-button__ripple"></span>
                    <span class="mdc-button__label text-lg tracking-normal font-normal capitalize">{{Crypt::decryptString($class->teacher)}}</span>
                    <i class="material-icons mdc-button__icon" aria-hidden="true">email</i>
                  </a>
                </div>
              @else
                <span class="mt-1 inline-block text-lg tracking-normal">{{Crypt::decryptString($class->teacher)}}</span>
              @endisset
              @isset($class->class_location)
                <p class="text-base mt-1">{{Crypt::decryptString($class->class_location)}}</p>
              @endisset
            </div>
            <div class="float-right">
              @isset ($class->video_link)
                <a href="{{Crypt::decryptString($class->video_link)}}" class="mdc-icon-button material-icons -mt-1" aria-describedby="video-label-{{$index}}" target="_blank">
                  <div class="mdc-icon-button__ripple"></div>
                  videocam
                </a>
                <x-ui.tooltip tooltip-id="video-label-{{$index}}" text="Join video call"/>
              @endif
              <button class="mdc-icon-button material-icons -mt-1" aria-describedby="edit-label-{{$index}}" @click="$dispatch('edit-class', { id: {{$class->id}}})">
                <div class="mdc-icon-button__ripple"></div>
                edit
              </button>
              <x-ui.tooltip tooltip-id="edit-label-{{$index}}" text="Edit class"/>
              @if ($class->links->count() > 0)
                <button class="mdc-icon-button material-icons -mt-1" aria-describedby="dropdown-label-{{$index}}" @click="selected == {{$index}} ? selected = -1 : selected = {{$index}}" x-text="selected != {{$index}} ? 'expand_more' : 'expand_less'">
                  <div class="mdc-icon-button__ripple"></div>
                </button>
                <x-ui.tooltip tooltip-id="dropdown-label-{{$index}}" text="Toggle class links"/>
              @endif
            </div>
          </div>
          <div class="mt-4" x-transition x-show="selected == {{$index}}" x-cloak>
            @foreach($class->links as $link)
              <a class="mdc-button mdc-button-ripple text-inherit mr-2" href="{{Crypt::decryptString($link->link)}}" target="_blank">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label">{{$link->name}}</span>
              </a>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
</div>
