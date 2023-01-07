<div class="mdc-card mdc-card--outlined">
<a href="{{ $preview->getLink() }}" target="_blank" rel="noopener">
        <div class="mdc-card__primary-action link__p-a" tabindex="0">
            <div class="link-primary-text left-28 mt-2.5">
                <h2 class="ml-1 text-xl font-medium truncate mdc-typography--headline6 assignment-link-title">
                    {{ $preview->getText() }}</h2>
                <h3 class="ml-1 text-xs text-gray-600 truncate mdc-typography--subtitle1 assignment-link-url">
                    {{ $preview->getLink() }}</h3>
            </div>
            <div class="mdc-card__media mdc-card__media--square assignment-link-image" {{ $preview->getPreview() }}>
            </div>
            <div class="mdc-card__ripple"></div>
        </div>
    </a>
</div>
