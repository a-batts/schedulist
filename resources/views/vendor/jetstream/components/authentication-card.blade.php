<div class="flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0">
    <div>
        {{ $logo }}
    </div>

    <div class="mdc-card mdc-card--outlined mt-6 w-full overflow-hidden px-6 py-4 sm:max-w-md sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
