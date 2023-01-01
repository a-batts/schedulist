<div x-data>
    <img src="{{ asset('images/logo/logo_light.svg') }}" x-show="document.documentElement.classList.contains('dark')" alt="Schedulist" class="h-8" x-cloak>
    <img src="{{ asset('images/logo/logo_dark.svg') }}" x-show="! document.documentElement.classList.contains('dark')" alt="Schedulist" class="h-8" x-cloak>
</div>