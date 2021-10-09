<div class="mdc-card mdc-card--outlined options_card mdc-typography">
    <div>
        @if ($attributes->has('back-button'))
            <div class="float-left mt-1 mr-2 -ml-4">
                <a class="mdc-icon-button material-icons" href="{{route('profile')}}" aria-describedby="back-arrow">
                    <div class="mdc-icon-button__ripple"></div>
                    arrow_back
                </a>
            </div>
            <x-ui.tooltip tooltip-id="back-arrow" text="Back to settings"/>
        @endif
        <div>
            <h4 class="mt-2 text-4xl font-medium">{{$title}}</h4>
            <p class="mt-1 text-gray-600">{{$description}}</p>
        </div>
    </div>
    <div class="mt-5 border-t border-gray-200"></div>
    <div>
        {{$slot}}
    </div>
</div>