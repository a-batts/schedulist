<div x-data>
    <img class="h-8" src="{{ asset('images/logo/logo_light.svg') }}" alt="Schedulist"
        x-show="document.documentElement.classList.contains('dark')" x-cloak>
    <img class="h-8" src="{{ asset('images/logo/logo_dark.svg') }}" alt="Schedulist"
        x-show="! document.documentElement.classList.contains('dark')" x-cloak>
</div>
