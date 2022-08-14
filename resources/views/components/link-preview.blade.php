<div class="mdc-card mdc-card--outlined assignment-link">
  <a href="{{$preview->getLink()}}" target="_blank">
    <div class="mdc-card__primary-action link__p-a" tabindex="0">
      <div class="link-primary-text left-28 mt-2.5">
        <h2 class="mdc-typography--headline6 assignment-link-title ml-1 truncate text-xl font-medium">{{$preview->getText()}}</h2>
        <h3 class="mdc-typography--subtitle1 assignment-link-url ml-1 truncate text-xs text-gray-600">{{$preview->getLink()}}</h3>
      </div>
      <div class="mdc-card__media mdc-card__media--square assignment-link-image" {{$preview->getPreview()}}></div>
    </div>
  </a>
</div>
