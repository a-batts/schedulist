<div
    {{ $attributes->merge(['class' => 'mdc-card mdc-card--outlined pt-6 pb-4 px-6 md:px-10 transition-colors ' . $backgroundColor]) }}>
    <div>
        <p class="float-left mb-2">{{ $title }}</p>
        <div class="float-right -mt-2 mb-1">{{ $actionButton }}</div>
    </div>
    {{ $slot }}
</div>
